<?php

namespace App\Services;

use App\Contracts\ImagesOwnerContract;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Brand;
use App\Models\Category;
use App\Models\City;
use App\Models\Contract;
use App\Models\Counterparty;
use App\Models\DeliveryAddress;
use App\Models\DeliveryType;
use App\Models\Document;
use App\Models\Driver;
use App\Models\Language;
use App\Models\Order;
use App\Models\OrderStatusType;
use App\Models\PersonalOffer;
use App\Models\PriceType;
use App\Models\Product;
use App\Models\User;
use App\Models\Warehouse;
use App\Rules\DeliveryAddressOwnerRule;
use App\Rules\PersonalOfferOwnerRule;
use Astrotomic\Translatable\Locales;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ImportService
{
    protected array $locales = [];

    public function __construct(Locales $locales)
    {
        //For imports make available all languages

        $languages = Language::query()->pluck('lang')->toArray();
        foreach ($languages as $language) {
            if (!in_array($language, $locales->all())) {
                $locales->add($language);
            }
        }

        $this->locales = $locales->all();
    }

    /**
     * Импорт пользователей.
     * @param array $customers
     * @return array
     */
    public function setCustomers(array $customers): array
    {
        $rules = [
            'fio' => 'required',
            'id_1c' => 'required',
        ];
        foreach ($customers as $customer) {
            if ($fail = $this->validate($customer, $rules)) {
                $errors[] = $fail;
                continue;
            }

            $customer['phone'] = preg_replace('/[^\d]/', '', trim($customer['phone']));

            /** @var User $user */
            $user =
                User::query()->role(['simple', 'legal'])->where('id', (int)($customer['id_site'] ?? 0))->first() ??
                User::query()->role(['simple', 'legal'])->where('id_1c', $customer['id_1c'])->first() ??
                new User();

            $user->{'name:uk'} = $customer['fio'];
            $user->id_1c = $customer['id_1c'] ?? $user->id_1c;
            $user->login = $customer['login'] ?? $user->login;
            $user->email = $customer['email'] ?? $user->email;
            $user->phone = $customer['phone'] ?? $user->phone;
            $user->position = $customer['position'] ?? $user->position;
            $user->is_active = (bool)($customer['is_active'] ?? $user->is_active);
            $user->is_admin = (bool)($customer['is_admin'] ?? $user->is_admin);
            $user->can_use_cashback = (bool)($customer['can_use_cashback'] ?? $user->can_use_cashback);

            $valid_date = strtotime($customer['birth_date'] ?? '');
            $user->birth_date = $valid_date ? date('Y-m-d H:i:s', $valid_date) : $user->birth_date;

            if (!$user->id) {
                $user->password = bcrypt(time());
            }

            $user->transferred = false;
            $user->save();

            // Устанавливаем тип клиента
            if (($customer['clienttype'] ?? false)) {
                $user->syncRoles(['legal']);
            } else {
                $user->syncRoles(['simple']);
            }

            $counterpartyIds = Counterparty::query()
                ->whereIn('id_1c', $this->explodeLine($customer['counterparty_ids_1c'] ?? ''))
                ->pluck('id');

            if ($user->counterparty_id && !$counterpartyIds->contains($user->counterparty_id)){
                $counterpartyIds->push($user->counterparty_id);
            }
            $user->counterparties()->sync($counterpartyIds);

        }

        return $errors ?? [];
    }

    /**
     * Импорт Менеджеров.
     * @param $managers
     * @return array
     */
    public function setManagers($managers): array
    {
        $rules = [
            'id_1c' => 'required',
            'email' => 'required|email',
            'fio' => 'required',
        ];
        foreach ($managers as $manager) {
            if ($fail = $this->validate($manager, $rules)) {
                $errors[] = $fail;
                continue;
            }

            $item = User::query()->role('manager')
                ->where('id_1c', $manager['id_1c'])
                ->orWhere('email', $manager['email'])
                ->firstOrNew();

            $item->id_1c = $manager['id_1c'];
            $item->email = $manager['email'];
            $item->phone = $manager['phone'] ?? null;
            $this->bindLangValues($item, 'name', $manager['fio']);

            if (!$item->id) {
                $item->password = bcrypt(time());
            }

            $item->save();

            $item->syncRoles('manager');
        }

        return $errors ?? [];
    }

    /**
     * Импорт контрагентов.
     * @param array $counterparties
     * @return array
     */
    public function setCounterparties(array $counterparties): array
    {
        $rules = [
            'id_site' => 'required_without:id_1c|bail|nullable|exists:counterparties,id',
            'id_1c' => 'required_without:id_site|bail|nullable',
        ];
        foreach ($counterparties as $counterparty) {
            if ($fail = $this->validate($counterparty, $rules)) {
                $errors[] = $fail;
                continue;
            }

            /** @var Counterparty $item */
            $item =
                Counterparty::query()->find((int)($counterparty['id_site'] ?? 0)) ??
                Counterparty::query()->where('id_1c', $counterparty['id_1c'])->firstOrNew();

            $item->id_1c = $counterparty['id_1c'];

//            $new_parent_id_1c = $counterparty['parent_id_1c'];
//            if ($item->parent_id_1c !== $new_parent_id_1c) {
//                if (empty($new_parent_id_1c)) {
//                    $item->parent_id_1c = null;
//                    $item->parent_id = null;
//                } else {
//                    $item->parent_id_1c = $new_parent_id_1c;
//
//                    $parent = Counterparty::where('id_1c', $new_parent_id_1c)->first();
//                    $item->parent_id = $parent ? $parent->id : null;
//                }
//            }

            $item->name = $counterparty['company_name'] ?? '';
            $item->okpo = $counterparty['okpo'] ?? '';
            $item->inn = $counterparty['inn'] ?? '';
            $item->is_nds = (bool)($counterparty['nds'] ?? false);
            $item->contract = $counterparty['contract'] ?? '';
            $item->is_payment_cash = ('nal' === ($counterparty['typepayment'] ?? 'nal'));
            $item->is_can_bonus = (bool)($counterparty['bonus'] ?? false);
            $item->phone = $counterparty['phone'] ?? null;

            $item->ur_address = $counterparty['legal_address'] ?? '';
            $item->fact_address = $counterparty['fact_address'] ?? '';
            $item->post_address = $counterparty['post_address'] ?? '';

            $city = City::whereKoatuu((int)$counterparty['town'])->first();
            $item->city_id = $city ? $city->id : null;

            if (!empty($counterparty['manager_id_1c'])) {
                $item->manager_id = User::query()
                    ->where('id_1c', $counterparty['manager_id_1c'])
                    ->take(1)->value('id');
            }

            if (!empty($counterparty['region_manager_id_1c'])) {
                $item->region_manager_id = User::query()
                    ->where('id_1c', $counterparty['region_manager_id_1c'])
                    ->take(1)->value('id');
            }

//            $item->bonus_earned = (float)($counterparty['bonus_earned'] ?? 0);
//            $item->bonus_used = (float)($counterparty['bonus_used'] ?? 0);
//            $item->cashback = (float)($counterparty['cashback'] ?? 0);

            $item->transferred = false;
            $item->save();

            $customer_ids_site = $this->explodeLine($counterparty['customer_ids_site'] ?? '');
            $customer_ids_1c = $this->explodeLine($counterparty['customer_ids_1c'] ?? '');
            $customer_ids = User::query()->role(['simple', 'legal'])
                ->whereIn('id', $customer_ids_site)
                ->orWhereIn('id_1c', $customer_ids_1c)
                ->pluck('id');


            if ($customer_ids->isNotEmpty()) {
                $item->users()->sync($customer_ids);

                // Если основатель не определен, устанавливаем первого пользователя из списка
                // пользователей отсортированного по полю is_admin
                // если пользователь не админ, делаем его админом
                if (!$item->founder_id) {
                    $founder = User::query()->role(['simple', 'legal'])
                        ->whereIn('id', $customer_ids)->orderBy('is_admin', 'desc')->first();
                    $item->founder()->associate($founder);

                    $founder->is_admin = true;
                    $founder->save();
                }
            } else {
                $item->users()->detach();
                $item->founder()->dissociate();
            }

//            DB::table('users')->where('counterparty_id_1c', $counterparty['id_1c'])
//                ->update(['counterparty_id' => $item->id]);
        }

        return $errors ?? [];
    }

    /**
     * Импорт контрактов.
     * @param array $contracts
     * @return array
     */
    public function setContracts(array $contracts): array
    {
        $rules = [
            'id_1c' => 'required',
            'registry_no' => 'required',
            'name' => 'required',
            'payment_type' => 'required|in:nal,beznal',
            'counterparty_id_1c' => 'required_without:counterparty_id_site|exists:counterparties,id_1c',
            'counterparty_id_site' => 'required_without:counterparty_id_1c|exists:counterparties,id',
        ];
        foreach ($contracts as $contract) {
            $rules = $this->restrictIdRules($contract, $rules, 'counterparty_id_site', 'counterparty_id_1c');

            if ($fail = $this->validate($contract, $rules)) {
                $errors[] = $fail;
                continue;
            }

            $item =
                Contract::query()->where('id_1c', $contract['id_1c'])->first() ??
                Contract::query()->where('registry_no', $contract['registry_no'])->first() ??
                new Contract();

            $item->id_1c = $contract['id_1c'];
            $item->registry_no = $contract['registry_no'];
            $item->name = $contract['name'];
            $item->payment_type = $contract['payment_type'];
            $item->status = (bool)($contract['status'] ?? false);

            $item->valid_at = $this->parseDate($contract['valid_at'] ?? '');
            $item->valid_to = $this->parseDate($contract['valid_to'] ?? '');

            $item->sum = (float)($contract['sum'] ?? $item->sum);

            $counterparty = Counterparty::query()
                ->withTrashed()
                ->whereAtLeastIdSiteOr1C(
                    ($contract['counterparty_id_site'] ?? null),
                    ($contract['counterparty_id_1c'] ?? null)
                )->first();
            $item->counterparty()->associate($counterparty);

            $item->save();
        }
        return $errors ?? [];
    }

    /**
     * Импорт Складов.
     * @param array $storages
     * @return array
     */
    public function setStorages(array $storages): array
    {
        $rules = [
            'id_1c' => 'required',
            'name' => 'required|filled|array',
        ];
        foreach ($storages as $storage) {
            if ($fail = $this->validate($storage, $rules)) {
                $errors[] = $fail;
                continue;
            }

            $item = Warehouse::query()->where('id_1c', $storage['id_1c'])->first();

            $item = $item ?? new Warehouse();

            $item->id_1c = $storage['id_1c'];
            $this->bindLangValues($item, 'name', $storage['name']);

            $item->save();
        }

        return $errors ?? [];
    }

    /**
     * Импорт Водителей.
     * @param array $drivers
     * @return array
     */
    public function setDrivers(array $drivers): array
    {
        $rules = [
            'id_1c' => 'required',
            'fio' => 'required|filled|array',
        ];

        foreach ($drivers as $driver) {
            if ($fail = $this->validate($driver, $rules)) {
                $errors[] = $fail;
                continue;
            }

            $item = Driver::query()->where('id_1c', $driver['id_1c'])->first();

            $item = $item ?? new Driver();

            $item->id_1c = $driver['id_1c'];
            $item->phone = $driver['phone'] ?? null;
            $this->bindLangValues($item, 'name', $driver['fio']);

            $item->save();
        }

        return $errors ?? [];
    }

    /**
     * Импорт Цен на товары.
     * @param array $inputs
     * @return array
     */
    public function setProductPrice(array $inputs): array
    {
        $rules = [
            'product_id_1c' => 'required|exists:products,id_1c',
            'price_purchase' => 'sometimes|numeric',
            'price_wholesale' => 'sometimes|numeric',
            'price_retail' => 'sometimes|numeric',
        ];
        foreach ($inputs as $input) {
            if ($fail = $this->validate($input, $rules)) {
                $errors[] = $fail;
                continue;
            }

            $product = Product::query()
                ->where('id_1c', $input['product_id_1c'])
                ->first();

            $product->price_purchase = (float) Arr::get($input, 'price_purchase', $product->price_purchase);
            $product->price_wholesale = (float) Arr::get($input, 'price_wholesale', $product->price_wholesale);
            $product->price_retail = (float) Arr::get($input, 'price_retail', $product->price_retail);

            $product->save();
        }

        return $errors ?? [];
    }

    /**
     * Импорт Цен на товары.
     * @param array $inputs
     * @return array
     */
    public function setProductsStock(array $inputs): array
    {
        $rules = [
            'product_id_1c' => 'required|exists:products,id_1c',
            'stock' => 'required|numeric',
        ];
        foreach ($inputs as $input) {
            if ($fail = $this->validate($input, $rules)) {
                $errors[] = $fail;
                continue;
            }

            $product = Product::query()
                ->where('id_1c', $input['product_id_1c'])
                ->first();

            $product->stock = abs($input['stock'] ?? $product->stock);
            // корректируем по stock.
            // Если stock = 0 устанавливаем "нет в наличии"
            // Если stock > 0 и availability = "нет в наличии", устанавливаем "в наличии"
            $product->availability = ($product->stock > 0)
                ? (intval($input['availability'] ?? 0) ?: 1)
                : 0;
            // Всегда положительное больше нуля
            $product->reserve_minutes = abs(intval($input['reserve_minutes'] ?? $product->reserve_minutes));
            $product->on_backorder = (bool)($input['on_backorder'] ?? $product->on_backorder);

            $product->save();
        }

        return $errors ?? [];
    }

    /**
     * Импорт разновидностей.
     * @param array $inputs
     * @return array
     */
    public function setProductsVariations(array $inputs): array
    {
        $rules = [
            'key' => 'required|string',
            'products_id_1c' => 'required|string',
        ];
        foreach ($inputs as $input) {
            if ($fail = $this->validate($input, $rules)) {
                $errors[] = $fail;
                continue;
            }

            $productsId1c = $this->explodeLine(strtolower($input['products_id_1c']));
            $updates = ['vars_key' => $input['key']];

            $attributes = collect($this->explodeLine(strtolower($input['attributes'] ?? '')));

            if ($attributes->isNotEmpty()) {
                $modelAttributes = ['width', 'height', 'length', 'depth'];
                $colorAttr = $attributes->filter(fn($el) => $el === 'color');
                $fromModel = $attributes->filter(fn($el) => in_array($el, $modelAttributes));
                $fromAttr = $attributes->diff($colorAttr)->diff($fromModel);
                $attributeIds = Attribute::query()
                    ->whereIn('id_1c', $fromAttr)
                    ->whereHas('products', function ($q) use($productsId1c){
                        $q->whereIn('id_1c', $productsId1c);
                    })
                    ->pluck('id', 'id_1c');

                // Собираем все атрибуты ограничивая максимальное кол-во без учета 'color'
                $varsAttrs = $attributeIds->values()
                    ->merge($fromModel)->slice(0,4)
                    ->merge($colorAttr)->toArray();

                $updates['vars_attrs'] = $varsAttrs ?: null;

                if (!empty($input['card_attribute']) && 'color' !== $input['card_attribute'] && $varsAttrs){
                    $cardAttr = $attributeIds->get($input['card_attribute'])
                        ?? $input['card_attribute'];
                    $updates['card_attribute'] = in_array($cardAttr, $varsAttrs)
                        ? $cardAttr
                        : null;
                } else {
                    $updates['card_attribute'] = null;
                }
            }

            Product::query()
                ->whereIn('id_1c', $productsId1c)
                ->update($updates);
        }

        return $errors ?? [];
    }

    /**
     * Импорт справочника персональны предложений.
     * @param array $offers
     * @return array
     */
    public function setPersonalOffers(array $offers): array
    {
        $rules = [
            'id_1c' => 'required',
            'product_id_1c' => 'required|exists:products,id_1c',
            'quantity' => 'required|numeric',
            'price' => 'required|numeric',
        ];

        foreach ($offers as $input) {
            if ($fail = $this->validate($input, $rules)) {
                $errors[] = $fail;
                continue;
            }

            $offer = PersonalOffer::where('id_1c', $input['id_1c'])->firstOrNew();

            if (!$offer->id) {
                $selfProduct = Product::create([
                    'id_1c' => $input['id_1c'],
                    'slug' => createSlugAndCheckUnique($input['id_1c'], Product::class),
                    'price_init' => $input['price'],
                    'parental_type' => 'personal_offer',
                ]);
            } else {
                $offer->selfProduct()->update(['price_init' => $input['price']]);
            }

            $offer->id_1c = $input['id_1c'];
            $offer->quantity = $input['quantity'];
            $offer->for_all = (bool)($input['for_all'] ?? $offer->for_all);

            $valid_date = strtotime($input['date_start'] ?? '');
            $offer->date_start = $valid_date ? date('Y-m-d H:i:s', $valid_date) : $offer->date_start;

            $valid_date = strtotime($input['date_end'] ?? '');
            $offer->date_end = $valid_date ? date('Y-m-d H:i:s', $valid_date) : $offer->date_end;

            $offer->save();

            $productId = Product::where('id_1c', $input['product_id_1c'])->pluck('id')->first();
            $offer->products()->sync([$productId => ['price' => $input['price']]]);

            if (!empty($selfProduct)) {
                $selfProduct->personal_offer_id = $offer->id;
                $selfProduct->save();
            }
        }

        return $errors ?? [];
    }

    /**
     * Импорт привязок клиентов и персональны предложений.
     * @param array $offers
     * @return array
     */
    public function setCustomerPersonalOffers(array $offers): array
    {
        $rules = [
            'owner' => ['required', 'array', new PersonalOfferOwnerRule()],
            'offer_ids_1c' => 'required'
        ];

        foreach ($offers as $input) {
            if ($fail = $this->validate($input, $rules)) {
                $errors[] = $fail;
                continue;
            }

            $query = $input['owner']['is_counterparty']
                ? Counterparty::query()
                : User::query()->role(['simple', 'legal']);

            $owner = $query
                ->whereAtLeastIdSiteOr1C(
                    ($input['owner']['id_site'] ?? null),
                    ($input['owner']['id_1c'] ?? null)
                )
                ->first();

            $offerIds = PersonalOffer::whereIn('id_1c', $input['offer_ids_1c'])->pluck('id');

            $owner->personalOffers()->sync($offerIds);
        }

        return $errors ?? [];
    }

    /**
     * Импорт Бонусов и кэшбека по контрагентам.
     * @param array $rewards
     * @return array
     */
    public function setCounterpartyRewards(array $rewards): array
    {
        $rules = [
            'counterparty_id_1c' => 'required_without:counterparty_id_site|exists:counterparties,id_1c',
            'counterparty_id_site' => 'required_without:counterparty_id_1c|exists:counterparties,id',
        ];

        foreach ($rewards as $input) {
            $rules = $this->restrictIdRules($input, $rules, 'counterparty_id_site', 'counterparty_id_1c');

            if ($fail = $this->validate($input, $rules)) {
                $errors[] = $fail;
                continue;
            }

            $counterparty = Counterparty::query()
                ->whereAtLeastIdSiteOr1C(
                    ($input['counterparty_id_site'] ?? null),
                    ($input['counterparty_id_1c'] ?? null)
                )
                ->first();

            $counterparty->bonus_earned = (float)($input['bonus_earned'] ?? $counterparty->bonus_earned);
            $counterparty->bonus_used = (float)($input['bonus_used'] ?? $counterparty->bonus_used);
            $counterparty->cashback = (float)($input['cashback'] ?? $counterparty->cashback);

            $counterparty->save();
        }

        return $errors ?? [];
    }

    /**
     * Импорт Типов Доставки.
     * @param array $delivery_types
     * @return array
     */
    public function setDeliveryTypes(array $delivery_types): array
    {
        $rules = [
            'id_1c' => 'required',
            'name' => 'required|filled|array',
        ];

        foreach ($delivery_types as $delivery_type) {
            if ($fail = $this->validate($delivery_type, $rules)) {
                $errors[] = $fail;
                continue;
            }

            $item = DeliveryType::query()->where('id_1c', $delivery_type['id_1c'])
                ->first();

            $item = $item ?? new DeliveryType();

            $item->id_1c = $delivery_type['id_1c'];
            $this->bindLangValues($item, 'name', $delivery_type['name']);

            $item->save();
        }

        return $errors ?? [];
    }

    /**
     * Импорт Типов Адресов Доставки.
     * @param array $addresses
     * @return array
     */
    public function setDeliveryAddresses(array $addresses): array
    {
        $rules = [
            'id_1c' => 'required',
            'delivery_type_id_1c' => 'required|exists:delivery_types,id_1c',
            //'owner' => ['required', 'array', new DeliveryAddressOwnerRule()],
        ];

        foreach ($addresses as $address) {
            if ($fail = $this->validate($address, $rules)) {
                $errors[] = $fail;
                continue;
            }

            $item = DeliveryAddress::where('id_1c', $address['id_1c'])->first()
                ?? DeliveryAddress::where('id', (int)$address['id_site'])->first();

            $item = $item ?? new DeliveryAddress();

            $item->id_1c = $address['id_1c'];

            $delivery_type = DeliveryType::where('id_1c', $address['delivery_type_id_1c'])->first();
            $item->delivery_type_id = $delivery_type->id;

            $city = City::where('koatuu', $address['city_code'])->first();
            $item->city_id = $city ? $city->id : null;

            $item->street_type = $address['street_type'] ?? null;
            $item->street_name = $address['street_name'] ?? null;
            $item->dom = $address['dom'] ?? null;
            $item->korpus = $address['korpus'] ?? null;
            $item->office = $address['office'] ?? null;
            $item->city_name = $address['city_name'] ?? null;
            $item->city_guid = $address['city_guid'] ?? null;
            $item->otdel_number = $address['otdel_number'] ?? null;
            $item->otdel_guid = $address['otdel_guid'] ?? null;
            $item->additional_data = $address['additional_data'] ?? null;

            if(count($address['owner'])>0){
                foreach ($address['owner'] as $key_owner => $value_owner) {
                   // if ($fail = $this->validate($value_owner, ['owner' => ['required', 'array', new DeliveryAddressOwnerRule()],])) {
                   //     $errors[] = $fail;
                   //     continue;
                   // }
                    $query = $value_owner['is_counterparty']
                    ? Counterparty::query()
                    : User::query()->role(['simple', 'legal']);

                    $owner = $query
                        ->where('id', (int)$value_owner['id_site'])
                        ->when($value_owner['id_1c'], fn ($q) => $q->orWhere('id_1c', $value_owner['id_1c']))
                        ->first();

                    //$owner;
                    if($owner)
                    $res = $owner->fill(['address_id'=>$item->id])->save();

                    //$item->owner()->associate($owner);
                }

            }
            $item->transferred = false;
            $item->save();
        }

        return $errors ?? [];
    }

    /**
     * Импорт Категорий товаров.
     * @param array $categories
     * @return array
     */
    public function setCategories(array $categories): array
    {
        $rules = [
            'id_1c' => 'required',
            'name' => 'required|filled|array',
        ];

        foreach ($categories as $category) {
            if ($fail = $this->validate($category, $rules)) {
                $errors[] = $fail;
                continue;
            }

            $item = Category::query()->where('id_1c', $category['id_1c'])->first()
                ?? new Category();

            $item->id_1c = $category['id_1c'];
            $item->sort_order = (int)($category['sort_order'] ?? 0);
            $this->bindLangValues($item, 'name', $category['name']);
            $this->bindLangValues($item, 'description', $category['description']);
//            $item->facebook = $category['socials']['facebook'] ?? null;
//            $item->instagram = $category['socials']['instagram'] ?? null;
//            $item->youtube = $category['socials']['youtube'] ?? null;
//            $item->linkedin = $category['socials']['linkedin'] ?? null;
//            $item->twitter = $category['socials']['twitter'] ?? null;

            if (!$item->slug) {
                $title = $category['name']['uk']
                    ?? $category['name']['ru']
                    ?? $category['name']['en']
                    ?? Str::random();
                $item->slug = createSlugAndCheckUnique($title, Category::class);
            }

            $new_parent_id_1c = $category['parent_id_1c'];
            if ($item->parent_id_1c !== $new_parent_id_1c) {
                if (empty($new_parent_id_1c)) {
                    $item->parent_id_1c = null;
                    $item->parent_id = 0;
                } else {
                    $item->parent_id_1c = $new_parent_id_1c;

                    $parent = Category::where('id_1c', $new_parent_id_1c)->first();
                    $item->parent_id = $parent ? $parent->id : 0;
                }
            }

//            if (!empty($category['brand_id_1c'])) {
//                $brand = Brand::query()->where('id_1c', $category['brand_id_1c'])->first();
//                if ($brand) {
//                    $item->brand()->associate($brand);
//                }
//            }

            $item->save();

//            // Привязка товаров аналогов - таблица products
//            $product_ids = Category::query()
//                ->whereIn('id_1c', $this->explodeLine($category['analog_ids_1c'] ?? ''))
//                ->pluck('id')->toArray();
//            $item->analogCategoies()->sync($product_ids);
//
//            // Привязка товаров сопутствующих - таблица products
//            $product_ids = Category::query()
//                ->whereIn('id_1c', $this->explodeLine($category['related_ids_1c'] ?? ''))
//                ->pluck('id')->toArray();
//            $item->relatedCategories()->sync($product_ids);

            // подгрузка картинок.
            $this->uploadModelImages($item, $category['image'], true);
            $this->uploadModelImages($item, $category['additional_images'], false);
        }

        // Пост привязка для случая если родитель был импортирован позже потомка.
        $this->bindParents('categories');

        return $errors ?? [];
    }

    /**
     * Импорт Группы товаров.
     * @param array $groups
     * @return array
     */
    public function setProductGroups(array $groups): array
    {
        $rules = [
            'id_1c' => 'required',
            'name' => 'required|filled|array',
        ];

        foreach ($groups as $group) {
            if ($fail = $this->validate($group, $rules)) {
                $errors[] = $fail;
                continue;
            }

            $item = ProductGroup::query()->where('id_1c', $group['id_1c'])->first()
                ?? new ProductGroup();

            $item->id_1c = $group['id_1c'];
            $item->sort_order = (int)($group['sort_order'] ?? 0);
            $this->bindLangValues($item, 'name', $group['name']);

            $new_parent_id_1c = $group['parent_id_1c'];
            if ($item->parent_id_1c !== $new_parent_id_1c) {
                if (empty($new_parent_id_1c)) {
                    $item->parent_id_1c = null;
                    $item->parent_id = null;
                } else {
                    $item->parent_id_1c = $new_parent_id_1c;

                    $parent = ProductGroup::where('id_1c', $new_parent_id_1c)->first();
                    $item->parent_id = $parent ? $parent->id : null;
                }
            }

            $item->save();
        }

        // Пост привязка для случая если родитель был импортирован позже потомка.
        $this->bindParents('product_groups');

        return $errors ?? [];
    }

    /**
     * Импорт Товаров.
     * @param array $products
     * @return array
     */
    public function setProducts(array $products): array
    {
        $rules = [
            'id_1c' => 'required',
            'name' => 'required',
            'attributes' => 'present|array',
            'color' => 'present|array',
        ];

        foreach ($products as $product) {
            if ($fail = $this->validate($product, $rules)) {
                $errors[] = $fail;
                continue;
            }

            $item = Product::query()->where('id_1c', $product['id_1c'])->firstOrNew();

            $item->id_1c = $product['id_1c'];

            $this->bindLangValues($item, 'name', (array)($product['name'] ?? []));
            $this->bindLangValues($item, 'description', (array)($product['description'] ?? []));
            $this->bindLangValues($item, 'short_description', (array)($product['short_description'] ?? []));
            $this->bindLangValues($item, 'technical_description', (array)($product['technical_description'] ?? []));
            $this->bindLangValues($item, 'measure', (array)($product['measure'] ?? []));
            $this->bindLangValues($item, 'markdown_description', (array)($product['markdown_description'] ?? []));
            if (!$item->slug) {
                $title = $product['name']['uk']
                    ?? $product['name']['ru']
                    ?? $product['name']['en']
                    ?? Str::random();
                $item->slug = createSlugAndCheckUnique($title, Product::class);
            }
            $item->uktved = $product['uktved'] ?? null;
            $item->barcode = $product['barcode'] ?? null;
            $item->depth = $product['depth'] ?? '';
            $item->width = $product['width'] ?? '';
            $item->height = $product['height'] ?? '';
            $item->weight = $product['weight'] ?? '';
            $item->articul = $product['articul'] ?? '';
            $item->articul_search = $product['articul_search'] ?? '';
//            $item->catalog_no = $product['cat_number'] ?? '';
//            $item->catalog_no_search = $product['cat_number_search'] ?? '';
//            $item->image = $product['image'] ?? '';
//            $item->additional_images = $product['additional_images'] ?? '';
            //$item->code_1c = $product['сode_1c'] ?? '';
            $item->brand_search = $product['brand_search'] ?? '';
            $item->multiplicity = (int)($product['multiplicity'] ?? 0);
            //$item-> = $product['goodsgroup'] ?? ''; // ToDo:
            $item->deleted = (bool)($product['deleted'] ?? false);
            //$item->imported = (int)($product['imported'] ?? 0);
            $item->recommended = (bool)($product['recommended'] ?? false);
            $item->sort_order = (int)($product['sort_order'] ?? 0);
            $item->markdown = (bool)($product['markdown'] ?? false);
            $item->new = (bool)($product['novelty'] ?? false);
            $item->cut_out = (bool)($product['cutout'] ?? false);
            $item->price_purchase = (float)($product['price_purchase'] ?? 0);
            $item->price_wholesale = (float)($product['price_wholesale'] ?? 0);
            $item->price_retail = (float)($product['price_retail'] ?? 0);

            $item->stock = abs($product['stock'] ?? 0);
            // корректируем по stock.
            // Если stock = 0 устанавливаем "нет в наличии"
            // Если stock > 0 и availability = "нет в наличии", устанавливаем "в наличии"
            $item->availability = ($item->stock > 0)
                ? (intval($product['availability'] ?? 0) ?: 1)
                : 0;
            // Всегда положительное больше нуля
            $item->reserve_minutes = abs(intval($product['reserve_minutes'] ?? 0));
            $item->on_backorder = (bool)($product['on_backorder'] ?? false);

            if (!empty($product['color'])){
                $this->bindLangValues($item, 'color_name', Arr::get($product, 'color.name', []));
                $item->color = Arr::get($product, 'color.code');
            }

            if (!empty($product['brand_id_1c'])) {
                $brand = Brand::query()->where('id_1c', $product['brand_id_1c'])->first();
                if ($brand) {
                    $item->brand()->associate($brand);
                }
            }

            $categoryIds =  Category::query()
                ->whereIn('id_1c', $this->explodeLine($product['categories_id_1c'] ?? ''))
                ->pluck('id', 'id_1c')
                ->toArray();

            $item->category_id = $categoryIds[$product['main_category_id_1c'] ?? ''] ?? null;

            $item->save();

            // Привязка категорий - таблица category_product
            $item->categories()->sync(array_values($categoryIds));

            // Привязка товаров replacement
            $product_ids = Product::query()
                ->whereIn('id_1c', $this->explodeLine($product['replacement_id_1c'] ?? ''))
                ->pluck('id')->toArray();
            $item->replacements()->sync($product_ids);

            // Привязка товаров accompanying
            $product_ids = Product::query()
                ->whereIn('id_1c', $this->explodeLine($product['accompanying_id_1c'] ?? ''))
                ->pluck('id')->toArray();
            $item->accompanying()->sync($product_ids);

            // Привязка атрибутов
            $item->attributeValues()->onlyImported()->delete();
            if (!empty($product['attributes'])) {
                foreach ($product['attributes'] as $attr) {
                    $attribute = $attr['id_1c']
                        ? Attribute::where('id_1c', $attr['id_1c'])->first()
                        : null;

                    if ($attribute && !empty($attr['value'])) {
                        $term = new AttributeValue();

                        $term->product()->associate($item);
                        $term->attribute()->associate($attribute);
                        $this->bindLangValues($term, 'name', $attr['value']);
                        $this->bindLangValues($term, 'slug', $this->slugableArrayValues($attr['value']));
                        $term->order = $attr['order'] ?? 0;
                        $term->option = $attr['option'] ?? null;
                        $term->imported = true;

                        $term->save();

                        if ($item->category_id) {
                            $attribute->categories()
                                ->syncWithoutDetaching([$item->category_id  => ['main' => true]]);
                        }
                    }
                }
            }

            // Привязка атрибутов к категориям.
//            $attribute_ids_1c = collect((array)$product['attributes'])->pluck('id_1c')->filter();
//            $attribute_ids = Attribute::query()->whereIn('id_1c', $attribute_ids_1c)->pluck('id','id')
//                ->map(fn($a) => ['main' => true]);
//            Category::query()->whereIn('id', $main_category_ids)->select('id')->get()
//                ->each(function (Category $category) use ($attribute_ids) {
//                    $category->attributes()->syncWithoutDetaching($attribute_ids);
//                });

            // подгрузка картинок.
            $this->uploadModelImages($item, $product['image'], true);
            $this->uploadModelImages($item, $product['additional_images'], false);
        }

        return $errors ?? [];
    }

    /**
     * Импорт Атрибутов.
     * @param array $inputs
     * @return array
     */
    public function setAttributes(array $inputs): array
    {
        $rules = [
            'id_1c' => 'required',
            'name' => 'required|array',
        ];

        foreach ($inputs as $input) {
            if ($fail = $this->validate($input, $rules)) {
                $errors[] = $fail;
                continue;
            }

            $item = Attribute::where('id_1c', $input['id_1c'])->firstOrNew();

            $item->id_1c = $input['id_1c'];
            $item->hidden = (bool)($input['hidden'] ?? false);
            $item->slug = $item->slug ?:
                createUniqueSlug(Arr::first($input['name']), Attribute::class);

            $this->bindLangValues($item, 'name', (array)($input['name'] ?? []));
            $item->basic = true;
            $item->save();
        }
        return $errors ?? [];
    }

    /**
     * Импорт Долговых задолженностей по контрактам.
     * @param array $debts
     * @return array
     */
//    public function setContractDebts(array $debts): array
//    {
//        $rules = [
//            'contract_id_1c' => 'required|exists:contracts,id_1c',
//        ];
//
//        foreach ($debts as $debt) {
//            if ($fail = $this->validate($debt, $rules)) {
//                $errors[] = $fail;
//                continue;
//            }
//
//            $item = ContractDebt::query()
//                ->whereRelation('contract', 'id_1c', '=', $debt['contract_id_1c'])
//                ->firstOrNew();
//
//            $item->contract_id = $item->contract_id
//                ?? Contract::query()->where('id_1c', $debt['contract_id_1c'])->value('id');
//
//            $item->currency = $debt['currency'] ?? null;
//            $item->limit_days = $debt['limit_days'] ?? 0;
//            $item->limit_sum = $debt['limit_sum'] ?? 0;
//            $item->debt_sum = $debt['debt_sum'] ?? 0;
//            $item->overdue_sum = $debt['overdue_sum'] ?? 0;
//            $item->overdue_days = $debt['overdue_days'] ?? 0;
//            $item->expected_sum = $debt['expected_sum'] ?? 0;
//
//            $valid_date = strtotime($debt['expected_to'] ?? '');
//            $item->expected_to = $valid_date ? date('Y-m-d H:i:s', $valid_date) : null;
//
//            $item->save();
//        }
//
//        return $errors ?? [];
//    }

    /**
     * Импорт Долговых задолженностей по заказам.
     * @param array $debts
     * @return array
     */
    public function setOrderDebts(array $debts): array
    {
        foreach ($debts as $debt) {
            $rules = empty($debt['order_id_1c'])
                ? ['order_id_site' => 'required|exists:orders,id']
                : ['order_id_1c' => 'required|exists:orders,id_1c'];

            if ($fail = $this->validate($debt, $rules)) {
                $errors[] = $fail;
                continue;
            }

            $order = Order::query()
                ->where('id', (int)($debt['order_id_site'] ?? 0))
                ->when($debt['order_id_1c'], fn($q) => $q->orWhere('id_1c', $debt['order_id_1c']))
                ->first();

            $order->debt_sum = $debt['debt_total'] ?? null;

            $valid_date = strtotime($debt['repayment_to'] ?? '');
            $order->debt_end_at = $valid_date ? date('Y-m-d H:i:s', $valid_date) : null;

            $order->save();
        }

        return $errors ?? [];
    }

    /**
     * Импорт Типов статусов Заказов.
     * @param array $status_types
     * @return array
     */
    public function setStatuses(array $status_types): array
    {
        $rules = [
            'id_1c' => 'required',
            'name' => 'required|filled|array',
        ];

        foreach ($status_types as $status_type) {
            if ($fail = $this->validate($status_type, $rules)) {
                $errors[] = $fail;
                continue;
            }

            $item = OrderStatusType::query()->where('id_1c', $status_type['id_1c'])
                ->first();

            $item = $item ?? new OrderStatusType();

            $item->id_1c = $status_type['id_1c'];
            $this->bindLangValues($item, 'name', $status_type['name']);

            $item->save();
        }

        return $errors ?? [];
    }

    /**
     * Импорт Брендов.
     * @param array $brands
     * @return array
     */
    public function setBrands(array $brands): array
    {
        $rules = [
            'id_1c' => 'required',
            'name' => 'required|filled|array',
        ];

        foreach ($brands as $brand) {
            if ($fail = $this->validate($brand, $rules)) {
                $errors[] = $fail;
                continue;
            }

            $item = Brand::query()->where('id_1c', $brand['id_1c'])->firstOrNew();

            $item->id_1c = $brand['id_1c'];
            $item->searches = $brand['searches'] ?? null;
            $this->bindLangValues($item, 'title', $brand['name']);
            $this->bindLangValues($item, 'description', $brand['description']);
            if (!$item->slug) {
                $title = $brand['name']['uk']
                    ?? $brand['name']['ru']
                    ?? $brand['name']['en']
                    ?? Str::random();
                $item->slug = createSlugAndCheckUnique($title, Brand::class);
            }

            $item->save();

            // подгрузка картинок.
            $this->uploadModelImages($item, $brand['image'], true);
        }

        return $errors ?? [];
    }

    /**
     * Импорт Заказов.
     * @param array $orders
     * @return array
     */
    public function setOrdersRegistered(array $orders): array
    {
        $rules = [
            'id_1c' => 'required_without:id_site',
            'id_site' => 'required_without:id_1c',
            'customer_id_1c' => 'required|exists:users,id_1c',
            'status_id_1c' => 'required|exists:order_status_types,id_1c',
        ];

        foreach ($orders as $order) {
            $rules = $this->restrictIdRules($order, $rules, 'id_site', 'id_1c');

            if ($fail = $this->validate($order, $rules)) {
                $errors[] = $fail;
                continue;
            }

            $item = Order::query()
                ->whereAtLeastIdSiteOr1C(
                    ($order['id_site'] ?? null),
                    ($order['id_1c'] ?? null)
                )
                ->firstOrNew();

            $item->id_1c = $order['id_1c'];

            $item->counterparty_okpo = $order['counterparty_okpo'] ?? null;
            $item->fio = $order['fio'] ?? null;
            $item->total = (float)($order['total'] ?? 0);
            $item->total_quantity = (float)($order['total_quantity'] ?? 0);

            $item->bonus = (float)($order['bonus'] ?? 0);

//            $item->bonus_earned = (float)($order['bonus_earned'] ?? 0);
//            $item->bonus_used = (float)($order['bonus_used'] ?? 0);
//            $item->cashback_used = (float)($order['cashback_used'] ?? 0);
//            $item->cashback_earned = (float)($order['cashback_earned'] ?? 0);

            if (!empty($order['type_payment']) && in_array($order['type_payment'], ['nal', 'beznal'])) {
                $item->type_payment = $order['type_payment'];
            }

            $item->date_registration = $this->parseDate($order['date_registration']);

            $item->date_delivery = $this->parseDate($order['date_delivery']);

            if (!empty($order['customer_id_1c'])) {
                $pack = DB::table('users')->select('id')
                    ->where('id_1c', $order['customer_id_1c'])->first();
                $item->customer_id = $pack->id;
            }

            if (!empty($order['manager_id_1c'])) {
                $pack = DB::table('users')->select('id')
                    ->where('id_1c', $order['manager_id_1c'])->first();
                $item->manager_id = $pack->id ?? null;
            }

            if (!empty($order['driver_id_1c'])) {
                $pack = DB::table('drivers')->select('id')
                    ->where('id_1c', $order['driver_id_1c'])->first();
                $item->driver_id = $pack->id ?? null;
            }

            if (!empty($order['status_id_1c'])) {
                $pack = DB::table('order_status_types')->select('id')
                    ->where('id_1c', $order['status_id_1c'])->first();
                $item->status_id = $pack->id ?? null;
            }

            if (!empty($order['delivery_address_id_1c'])) {
                $pack = DB::table('delivery_addresses')->select('id')
                    ->where('id_1c', $order['delivery_address_id_1c'])->first();
                $item->delivery_address_id = $pack->id ?? null;
            }

            if (!empty($order['counterparty_id_1c'])) {
                $pack = DB::table('counterparties')->select('id')
                    ->where('id_1c', $order['counterparty_id_1c'])->first();
                $item->counterparty_id = $pack->id ?? null;
            }

            $item->transferred = false;
            $item->save();

            if (isset($order['products']) && is_array($order['products'])) {
                // Проверяем наличие всех ключей
                $products = collect($order['products'])
                    ->filter(function ($product) {
                        return is_array($product)
                            && empty(
                            array_diff(
                                ['id_1c', 'quantity', 'price', 'reserve', 'options'],
                                array_keys($product)
                            )
                            );
                    });

                // Выбираем значения id_1c
                $products_id_1c = $products
                    ->map(function ($product) {
                        return (!empty($product['id_1c'])) ? $product['id_1c'] : false;
                    })->filter();

                $pack = DB::table('products')->select('id', 'id_1c')
                    ->whereIn('id_1c', $products_id_1c)
                    ->get()->keyBy(function ($el) {
                        return $el->id;
                    });

                $pivot_values = $pack
                    ->map(function ($ids) use ($products) {
                        $product = $products->firstWhere('id_1c', $ids->id_1c);
                        return (!$product) ? [] : [
                            'quantity' => (float)$product['quantity'],
                            'price' => (float)$product['price'],
                            'reserve' => $product['reserve'],
                            'options' => json_encode((array)$product['options']),
                        ];
                    })->filter();

                $item->products()->sync($pivot_values);
            }
        }

        return $errors ?? [];
    }

    /**
     * Импорт Статусов Заказов.
     * @param array $orders
     * @return array
     */
    public function setOrdersStatuses(array $orders): array
    {
        $rules = [
            'order_id_1c' => 'required|exists:orders,id_1c',
            'status_id_1c' => 'required|exists:order_status_types,id_1c',
        ];

        foreach ($orders as $order) {
            if ($fail = $this->validate($order, $rules)) {
                $errors[] = $fail;
                continue;
            }

            $item = Order::where('id_1c', $order['order_id_1c'])->first();

            $status = OrderStatusType::where('id_1c', $order['status_id_1c'])->first();

            $item->status_id = $status->id;

            $item->save();
        }

        return $errors ?? [];
    }

    /**
     * Импорт TTN Заказов.
     * @param array $orders
     * @return array
     */
    public function setOrderTtn(array $orders): array
    {
        $rules = [
            'order_id_1c' => 'required|exists:orders,id_1c',
            'status_id_1c' => 'required|exists:order_status_types,id_1c',
            'ttn' => 'required',
        ];

        foreach ($orders as $order) {
            if ($fail = $this->validate($order, $rules)) {
                $errors[] = $fail;
                continue;
            }

            $item = Order::where('id_1c', $order['order_id_1c'])->first();

            $status = OrderStatusType::where('id_1c', $order['status_id_1c'])->first();

            $item->status_id = $status->id;
            $item->ttn = $order['ttn'];

            $item->save();
        }

        return $errors ?? [];
    }

    /**
     * Импорт Инвойсов.
     * @param array $invoices
     * @return array
     */
    public function setInvoice(array $invoices): array
    {
        $rules = [
            'order_id_site' => 'required_without:order_id_1c|exists:orders,id',
            'order_id_1c' => 'required_without:order_id_site|exists:orders,id_1c',
            'file_name' => 'required',
            'file_content' => 'required',
        ];

        foreach ($invoices as $invoice) {
            $rules = $this->restrictIdRules($invoice, $rules, 'order_id_site', 'order_id_1c');

            if ($fail = $this->validate($invoice, $rules)) {
                $errors[] = $fail;
                continue;
            }

            $order = Order::query()
                ->whereAtLeastIdSiteOr1C(
                    ($invoice['order_id_site'] ?? null),
                    ($invoice['order_id_1c'] ?? null)
                )
                ->first();

            $document = $order->documentInvoices()->firstOrNew();
            $document->registry_no = $invoice['registry_no'] ?? $document->registry_no;
            $document->type = Document::TYPE_INVOICE;
            $document->status = Document::STATUS_UNDEFINED;

            $document->save();

            app(DocumentsService::class)
                ->saveFromBase64($document, $invoice['file_name'], $invoice['file_content']);
        }

        return $errors ?? [];
    }

    /**
     * Импорт Документов.
     * Все поля кроме обязательных заполняются при наличии.
     *
     * @param array $documents
     * @return array
     */
    public function setDocs(array $documents): array
    {
        $rules = [
            'id_1c' => 'required_without:id_site',
            'id_site' => 'required_without:id_1c',
            'type' => 'required|integer|in:1,2,3',
            'status' => 'required|integer|in:0,1,2',
            'order_id_site' => 'required_without:order_id_1c|exists:orders,id',
            'order_id_1c' => 'required_without:order_id_site|exists:orders,id_1c',
        ];

        foreach ($documents as $document) {
            $rules = $this->restrictIdRules($document, $rules, 'id_site', 'id_1c');
            $rules = $this->restrictIdRules($document, $rules, 'order_id_site', 'order_id_1c');

            if ($fail = $this->validate($document, $rules)) {
                $errors[] = $fail;
                continue;
            }

            $item = Document::query()
                ->whereAtLeastIdSiteOr1C(
                    ($document['id_site'] ?? null),
                    ($document['id_1c'] ?? null)
                )
                ->firstOrNew();

            $orderId = Order::query()
                ->whereAtLeastIdSiteOr1C(
                    ($document['order_id_site'] ?? null),
                    ($document['order_id_1c'] ?? null)
                )
                ->take(1)->value('id');

            $item->order_id = $orderId;
            $item->id_1c = $document['id_1c'];
            $item->type = (int)$document['type'];
            $item->status = (int)$document['status'];

            $item->counterparty_okpo = $document['counterparty_okpo'] ?? $item->counterparty_okpo;
            $item->registry_no = $document['registry_no'] ?? $item->registry_no;

            $valid_date = strtotime($document['date'] ?? '');
            $item->date_at = $valid_date ? date('Y-m-d H:i:s', $valid_date) : $item->date_at;


            $item->related_id = $document['related_id'] ?? $item->related_id;
            $valid_date = strtotime($document['related_date'] ?? '');
            $item->related_date = $valid_date ? date('Y-m-d H:i:s', $valid_date) : $item->related_date;

            $item->customer_doc_id = $document['customer_doc_id'] ?? $item->customer_doc_id;
            $valid_date = strtotime($document['customer_doc_date'] ?? '');
            $item->customer_doc_date = $valid_date ? date('Y-m-d H:i:s', $valid_date) : $item->customer_doc_date;

            $item->response = $document['response'] ?? $item->response;
            $item->counterparty_okpo = $document['counterparty_okpo'] ?? $item->counterparty_okpo;
            $item->total_with_nds = (float)($document['total_with_nds'] ?? $item->total_with_nds);

            $item->delivery_address_id = $document['delivery_address_id'] ?? $item->delivery_address_id;
            $item->storage_id_1c = $document['storage_id_1c'] ?? $item->storage_id_1c;


            $item->transferred = false;
            $item->save();

            if (isset($document['products']) && is_array($document['products'])) {
                // Проверяем наличие всех ключей
                $products = collect($document['products'])
                    ->filter(function ($product) {
                        return is_array($product)
                            && empty(
                            array_diff(
                                ['id_1c', 'quantity', 'price_nds', 'total_nds', 'reason'],
                                array_keys($product)
                            )
                            );
                    });

                // Выбираем значения id_1c
                $products_id_1c = $products
                    ->map(function ($product) {
                        return (!empty($product['id_1c'])) ? $product['id_1c'] : false;
                    })->filter();

                $pack = DB::table('products')->select('id', 'id_1c')
                    ->whereIn('id_1c', $products_id_1c)
                    ->get()->keyBy(function ($el) {
                        return $el->id;
                    });

                $pivot_values = $pack
                    ->map(function ($ids) use ($products) {
                        $product = $products->firstWhere('id_1c', $ids->id_1c);
                        return (!$product) ? [] : [
                            'quantity' => (float)$product['quantity'],
                            'price_nds' => (float)$product['price_nds'],
                            'total_nds' => $product['total_nds'],
                            'reason' => $product['reason'],
                        ];
                    })->filter();

                $item->products()->sync($pivot_values);
            }

            // Upload documents
            if ($document['file_name'] && $document['file_content']) {
                app(DocumentsService::class)
                    ->saveFromBase64($item, $document['file_name'], $document['file_content']);
            }
        }

        return $errors ?? [];
    }

    /**
     * Импорт Статусов Документов.
     * @param array $documents
     * @return array
     */
    public function setDocsStatuses(array $documents): array
    {
        $rules = [
            'status' => 'required|integer|in:1,2,3',
            'id_site' => 'required_without:id_1c|exists:documents,id',
            'id_1c' => 'required_without:id_site|exists:documents,id_1c',
        ];

        foreach ($documents as $document) {
            $rules = $this->restrictIdRules($document, $rules, 'id_site', 'id_1c');
            if ($fail = $this->validate($document, $rules)) {
                $errors[] = $fail;
                continue;
            }

            $item = Document::query()
                ->whereAtLeastIdSiteOr1C(
                    ($document['id_site'] ?? null),
                    ($document['id_1c'] ?? null)
                )
                ->first();

            $item->status = (int)$document['status'];
            $item->save();
        }

        return $errors ?? [];
    }

    /**
     * Установка статусов записей как переданные на сервер 1С.
     * @param array $targets
     */
    public function setTransferred($targets)
    {
        $tables = [
            'customers' => 'users',
            'orders_registered' => 'orders',
            'fast_orders' => 'orders',
            'counterparties' => 'counterparties',
            'docs' => 'documents',
            'your_techniques' => 'your_techniques',
            'delivery_addresses' => 'delivery_addresses',
        ];
        foreach ($targets as $target => $items) {
            if (in_array($target, array_keys($tables))) {
                foreach ($items as $item) {
                    $point = Carbon::parse($item['updated_at'])->toDateTimeString();
                    try {
                        DB::table($tables[$target])
                            ->where('id', (int)$item['id_site'])
                            ->where('updated_at', '<=', $point)
                            ->update(['transferred' => true]);
                    } catch (\Exception $e) {
                    }
                }
            }
        }
    }

    /********** Private functions **********/

    /**
     * Привязка родителей к потомкам.
     * @param string $table_name
     */
    private function bindParents(string $table_name)
    {
        DB::table($table_name, 't1')
            ->whereNotNull('t1.parent_id_1c')
            ->whereNull('t1.parent_id')
            ->join("{$table_name} as t2", 't2.id_1c', '=', 't1.parent_id_1c')
            ->select(['t1.id as child_id', 't2.id as parent_id'])
            ->orderBy('t1.id')
            ->chunk(500, function ($items) use ($table_name) {
                $items->each(function ($item) use ($table_name) {
                    DB::table($table_name)->where('id', $item->child_id)
                        ->update(['parent_id' => $item->parent_id]);
                });
            });
    }

    /**
     * Валидация
     * @param array $input
     * @param array $rules
     * @param array $keys Ключи используемые в правилах
     * @return array|false
     */
    private function validate(array $input, array $rules, array $keys = [])
    {
        $keys = $keys ?: array_keys($rules);
        $validator = Validator::make(collect($input)->only($keys)->all(), $rules);

        if ($validator->fails()) {
            return [
                'message' => 'not imported',
                'data' => $input,
                'errors' => $validator->errors()->messages(),
            ];
        }

        return false;
    }

    /**
     * Очищает пустое правило по фактору наличия второго правила
     * Также запрещает очистку обоих правил.
     * Используется для проверки хотя бы одного правила.
     * также утверждает проверку обоих если они заполнены.
     * Пример заполнения правил:
     *    'order_id_site' => 'required_without:order_id_1c|exists:orders,id',
     *    'order_id_1c' => 'required_without:order_id_site|exists:orders,id_1c',
     *
     * @param array $item
     * @param array $rules
     * @param string $param1
     * @param string $param2
     * @return array
     */
    private function restrictIdRules(array $item, array $rules, string $param1, string $param2): array
    {
        if (empty($item[$param1]) && !empty($item[$param2])) {
            unset($rules[$param1]);
        }
        if (empty($item[$param2]) && !empty($item[$param1])) {
            unset($rules[$param2]);
        }

        return $rules;
    }

    /**
     * Переводит все значения массива в слаги
     * @param array $values
     * @return array
     */
    private function slugableArrayValues(array $values): array
    {
        foreach ($values as $key => $value) {
            $slugs[$key] = (mb_strlen($value) < 255)
                ? Str::slug($value)
                : Str::slug(mb_substr($value, 0, 240)) . '_' . Str::random(10);
        }

        return $slugs ?? [];
    }

    /**
     * Привязка переводов к модели с проверкой на пустоту.
     *
     * @param Model $model Объект модели с подключенным трейтом переводов
     * @param string $field Название поля которое надо заполнить
     * @param array $values Ассоциативный массив переводов с ключами - кодами локали.
     */
    private function bindLangValues(Model $model, string $field, array $values)
    {
        foreach ($this->locales as $locale) {
            if (!empty($values[$locale])) {
                $model->translateOrNew($locale)->{$field} = $values[$locale] ?? '';
            }
        }
    }

    /**
     * Разбивка строки с очисткой.
     *
     * @param string $line
     * @param string $separator
     * @return string[]
     */
    private function explodeLine(string $line, string $separator = ','): array
    {
        return array_filter(array_map('trim', explode($separator, $line ?? '')));
    }

    /**
     * Upload model Images from urls coma separated string
     *
     * @param ImagesOwnerContract $model
     * @param string|null $inline
     * @param bool $main
     * @return void
     */
    private function uploadModelImages(ImagesOwnerContract $model, ?string $inline, bool $main)
    {
        if ($urls = $this->explodeLine($inline ?? '')) {
            try {
                app(UploadImagesService::class)
                    ->uploadImages($model, $urls, $main);
            } catch (\Exception $e) {
            }
        }
    }

    /**
     * Парсинг строки с датой
     *
     * @param string $date
     * @param $default
     * @return false|mixed|string
     */
    public function parseDate(string $date, $default = null)
    {
        return ($valid_date = strtotime($date ?? ''))
            ? date('Y-m-d H:i:s', $valid_date)
            : $default;
    }

}
