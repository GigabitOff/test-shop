<?php

namespace App\Models;

use App\Enums\ViewedType;
use App\Traits\HasCustomerScopes;
use App\Traits\HasDigitScopes;
use App\Traits\HasManagerScopes;
use App\Traits\HasOptions;
use App\Traits\HasTansferred;
use App\Traits\HasUserTypesAttributes;
use App\Traits\WithMultipleKeysScopes;
use Astrotomic\Translatable\Translatable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;
    use Translatable;
    use HasTansferred;
    use SoftDeletes;
    use HasManagerScopes;
    use HasCustomerScopes;
    use HasDigitScopes;
    use HasUserTypesAttributes;
    use WithMultipleKeysScopes;
    use HasOptions;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'customer_type',
        'admin_group_id',
        'blocked_ip_id',
        'is_admin',
        'city_id',
        'manager_id',
        'counterparty_id',
        'phone_confirm_at',
        'address_id',
        'options',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'phone_verified_at' => 'datetime',
        'birth_date' => 'datetime',
        'viewed_type' => ViewedType::class,
        'options' => 'array',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Array of controlled attributes to clear transferred attribute
     * Массив атрибутов которые влияют на изменение атрибута transferred
     * transferred - это флаг, что данные изменены и их надо отправить в 1С
     *
     * @var array
     */
    protected $transferredScopes = [
        'name',
        'email',
        'phone',
        'city_id',
        'manager_id',
        'counterparty_id',
        'position',
        'is_wholesale',
        'is_legal',
        'is_fop',
        'customer_type_id',
    ];

    // ToDo: Удалить эту константу, т.к. типы пользователей перенесены в роли.
    const CUSTOMER_TYPES = [
        '1' => 'admin',
        '2' => 'director',
        '3' => 'manager',
        '5' => 'head_manager',
       // '6' => 'customer',
        '0' => 'Unregistered',
        '2'=> 'Simple',
        '3'=>  'Legal',

    ];

    const USER_ROLES = [
        '1' => 'admin',
        '2' => 'Unregistered',
        '3' => 'Simple',
        '4' => 'Legal',
        '5' => 'manager',
        //'6' => 'manager',
        '7' => 'main_manager',
        '8' => 'director',
       // '8' => 'customer'

    ];

    public $translatedAttributes = ['name'];

    public function getCity()
    {
        return $this->hasOne(ShopCity::class, 'id', 'city_id');
    }

    // Todo: must be deleted
    public function counterparty()
    {
        return $this->belongsTo(Counterparty::class);
    }

    public function counterparties(): BelongsToMany
    {
        return $this->belongsToMany(Counterparty::class);
    }

    // Todo: must be deleted
    public function contracts()
    {
        return $this->belongsToMany(Contract::class, 'customer_contract', 'customer_id', 'contract_id')
            ->withPivot(['is_admin']);
    }

    public function favouriteProducts()
    {
        return $this->belongsToMany(Product::class, 'product_favorites', 'user_id', 'product_id');
    }

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id', 'id');
    }

    // Покупатели привязанные непосредственно к текущему менеджеру
    public function selfCustomers()
    {
        return $this->hasMany(User::class, 'manager_id');
    }

    // Получение запроса на выборку покупателей для разных типов привязок
    public function customers()
    {
        if ($this->hasRole('legal')) {
            return $this->counterpartyCustomers();
        } else {
            return $this->managerCustomers();
        }
    }

    public function groups()
    {
        return $this->belongsToMany(UserGroup::class, 'users_in_groups', 'user_id', 'group_id');
    }

    // Группы покупателей привязанные к мендежеру
    public function customerGroups()
    {
        return $this->belongsToMany(UserGroup::class, 'manager_customers_group', 'manager_id', 'group_id');
    }

    // покупатели привязанные к менеджеру инидивидуально
    public function customerList()
    {
        return $this->belongsToMany(User::class, 'manager_customers', 'manager_id', 'customer_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function deliveryAddresses(): MorphMany
    {
        return $this->morphMany(DeliveryAddress::class, 'owner');
    }

    public function personalOffers(): MorphToMany
    {
        return $this->morphToMany(PersonalOffer::class, 'owner', 'personal_offer_client');
    }

    public function orders()
    {
        $query = $this->hasMany(Order::class, 'customer_id');

        return $this->isCustomerLegalAdmin
            ? $query->whereHas('customer', function($q){
                    $sub = $this->customers()->select('id')->toRawSql();
                    $q->whereInRaw('id', $sub);
                })
            : $query;
    }

    public function cart()
    {
        return $this->hasOne(Cart::class, 'customer_id');
    }

    public function prices(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_user_price')
            ->withPivot(['brand','category','group','product','current']);
    }

    public function changes()
    {
        return $this->hasOne(UserChange::class);
    }

    public function recipients()
    {
        return $this->hasMany(CustomerRecipient::class, 'customer_id');
    }

    public function chats(): HasMany
    {
        return $this->hasMany(Chat::class, 'customer_id');
    }

    public function managerSelfChats(): HasMany
    {
        return $this->hasMany(Chat::class, 'manager_id');
    }

    public function managerChats(): HasMany
    {
        return $this->managerSelfChats()
            ->orWhereIn('manager_id', $this->proxies()->pluck('id'))
            ->orWhere(function ($q) {
                $q->whereNull('manager_id')
                    ->whereRelation('department.users', 'id', '=', $this->id);
            });
    }

    public function chatMessages()
    {
        return $this->hasMany(ChatMessage::class, 'owner_id');
    }

    public function compareProducts()
    {
        return $this->belongsToMany(Product::class, 'product_comparisons', 'customer_id');
    }

    public function departments()
    {
        return $this->belongsToMany(Contuct::class, 'user_contuct', 'user_id');
    }

    // ToDo: Восстановить таблицу Departments
//    public function departments()
//    {
//        return $this->belongsToMany(Department::class, 'department_employee', 'employee_id');
//    }

    /** Коллекция проксируемых пользователей */
    public function proxies(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_proxies', 'to_id', 'from_id')
            ->withPivot('date_to')
            ->wherePivot('date_to', '>=', now());
    }

    /** Коллекция пользователей к которым проксируется текущий пользователь */
    public function proxyDrivers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_proxies', 'from_id', 'to_id')
            ->withPivot('date_to')
            ->wherePivot('date_to', '>=', now());
    }

    /** Уведомления */
    public function myNotifications(): HasMany
    {
        return $this->hasMany(UserNotification::class);
    }

    /** Одно самое старое уведомление */
    public function getMyOldestNotificationAttribute()
    {
        return $this->myNotifications()->oldest()->first();
    }

    /**Входи пользователя */
    public function entrances()
    {
        return $this->hasMany(UserEntrance::class, 'user_id')->orderBy('id', 'DESC');
    }

    public function geoip()
    {
        return $this->hasOne(UserGeoIp::class);
    }

    /** Тип оплаты по выбранный пользователем */
    public function paymentType(): BelongsTo
    {
        return $this->belongsTo(PaymentType::class);
    }

    /** Доступные типы оплаты */
    public function availablePaymentTypes()
    {
        // Для legal получим type = 2 иначе type = 1
        $type = 1 + (int) $this->hasRole('legal');
        $query = PaymentType::query()->withTranslation()
            ->join('payment_types_available as pta', function ($q) use ($type) {
                $q->on('pta.payment_type_id', '=', 'payment_types.id')
                    ->where('pta.customer_type_id', $type);
            });

        // доступность постоплаты
        // ToDo: требует корректировки, т.к. долги теперь привязаны к контрактам
        $notReceivable = true; // $this->receivable()->count() === 0;
        if ($notReceivable) {
            $query->where('id', '!=', PaymentType::POSTPAID);
        }

        return $query;
    }

    /** Tип оплаты по умолчанию */
    public function getDefaultPaymentTypeAttribute()
    {
        return $this->isCustomerLegal
            ? PaymentType::INVOICE
            : PaymentType::CASH;
    }


    /**
     * Получить коллекцию ids контрактов привязанных к пользователю.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getContractIdsAttribute()
    {
        return $this->contracts()->toBase()->pluck('id');
    }

    /**
     * Корректирует путь к файлу аватара учитывая локальные и удаленные ресурсы
     *
     * @param string $default
     * @return string
     */
    public function correctAvatar(string $default = ''): string
    {
        if (false !== strpos($this->avatar_url, 'http')) {
            return $this->avatar_url;
        }

        return ($this->avatar_url) ? '/storage/' . $this->avatar_url : $default;
    }

    public function isRegistrationCompleted()
    {
        return $this->name
            && $this->phone;
    }

    public function isPhoneVerified()
    {
        return $this->phone_verified_at !== null
            && (Carbon::now())->diffInMonths($this->phone_verified_at) < 4;
    }

    private function managerCustomers()
    {
        // Привязка на просмотр всех покупателей
        if ($this->viewed_type->is(ViewedType::All)) {
            return User::query()->role(['customer']);
        }

        // Привязка на просмотр определенных покупателей
        return $this->newQuery()->where(function ($query) {
            // Привязка на просмотр покупателей с личным менедером в качестве текущего
            $query->where('manager_id', $this->id);
            $query->orWhereIn('manager_id', $this->proxies()->pluck('id'));

            // Привязка на просмотр покупателей по группе и/или списку
            if ($this->viewed_type->is(ViewedType::ByGroups)
                || $this->viewed_type->is(ViewedType::ByGroupsAndList)) {
                if ($groupIds = $this->customerGroups()->pluck('id')) {
                    $query->orWhereIn('id', function ($q) use ($groupIds) {
                        $q->select('user_id')->from('users_in_groups')
                            ->whereIn('group_id', $groupIds);
                    });
                }
            }

            // Привязка на просмотр покупателей по списку и/или группе
            if ($this->viewed_type->is(ViewedType::ByList)
                || $this->viewed_type->is(ViewedType::ByGroupsAndList)) {
                $id = $this->id;
                $query->orWhereIn('id', function ($q) use ($id) {
                    $q->select('customer_id')->from('manager_customers')
                        ->where('manager_id', $id);
                });
            }
            return $query;
        });
    }

    public function counterpartyCustomers()
    {
        if (! $this->is_admin){
            // обычный пользователь контрагента
            return $this->newQuery()->whereId($this->id);
        }

        // Админ контрагента
        $sub = $this->counterparties()->select('id')->toRawSql();
        return $this->newQuery()
            ->whereHas('counterparties', fn($q) => $q->whereInRaw('id', $sub));
    }

    public function getBonusAttribute()
    {
        return 9876;
    }

    public function mailboxEmails(): HasMany
    {
        return $this->hasMany(MailboxEmail::class, 'customer_id', 'id');
    }
}
