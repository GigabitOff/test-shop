<?php

namespace App\Http\Livewire\Forms\Auth;

use App\Http\Livewire\Traits\WithFilterableDrop;
use App\Models\City;
use App\Models\Counterparty;
use App\Models\CounterpartyType;
use App\Models\User;
use App\Rules\EdrpouInnRule;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class RegistrationLivewire extends Component
{
    use WithFilterableDrop;

    public string $filterableCity = '';
    public string $filterableCompanyType = '';

    public string $phoneRaw = '';
    public string $phone = '';
//    public $phone_code = '+38';
//    public $code_country;
    public string $email = '';
    public bool $emailSkip = false;
    public string $fio = '';
    public bool $legal_entity = false;
    public bool $with_vat = false;
    public string $company_name = '';

    public string $customCompanyType = '';

    public string $okpoRaw = '';
    public string $okpo = '';
    public string $position = '';
    public bool $privacy_policy = true;

    public bool $do_registration_complete = false;

    protected $listeners = [
        'eventConfirmEmailSkip'
    ];

    public function mount()
    {
        if (auth()->check() && !auth()->user()->isRegistrationCompleted()) {
            $this->do_registration_complete = true;
            $this->email = auth()->user()->email;
        }

//        $this->code_country = settingsDataCategory('code_country') ?? [];
//        if (count($this->code_country)>0) {
//            $this->phone_code = reset($this->code_country);
//        }

    }

    public function render()
    {
        return view('livewire.forms.auth.registration-livewire');
    }

//    public function updated($field)
//    {
//        if ('company_type' === $field) {
//            $this->reset(['company_type_id']);
//            foreach ($this->company_types as $id => $name) {
//                if (strtolower(trim($this->company_type)) === strtolower(trim($name))) {
//                    $this->company_type_id = $id;
//                    $this->company_type = $name;
//                    break;
//                }
//            }
//        }
//
//    }

    public function updatedPhoneRaw($value)
    {
        $this->phone = preg_replace('/\D/', '', $value);
    }

    public function updatedEmail($value)
    {
        $this->email = trim($value);
    }

//    public function changePhoneCode($value)
//    {
//        $this->phone_code = $value;
//        if(isset($this->phone))
//        {
//            $this->updatedPhoneRaw($this->phone_raw);
//        }
//    }

    protected function onSetFilterableCity($id, $name)
    {
        $this->validateOnly('filterableCityId');
    }

    protected function onSetFilterableCompanyType($id, $name)
    {
        $this->validateOnly('filterableCompanyTypeId');
    }

    public function updatedOkpoRaw($value)
    {
        $this->okpo = preg_replace('/\D/', '', $value);
    }

    public function submit()
    {
        $validated = $this->validate();

        if (empty($this->email) && !$this->emailSkip) {
            $this->tryConfirmSkipEmail();
            return;
        }

        try {
            DB::beginTransaction();

            if ($this->legal_entity) {
                $counterparty = new Counterparty();
                $counterparty->name = $validated['company_name'];
                $counterparty->okpo = $validated['okpo'];
                $counterparty->is_nds = $this->with_vat;
                $counterparty->type_id = $this->getCompanyTypeId();
                $counterparty->custom_type = $this->getCustomCompanyType();
                $counterparty->city_id = str_replace('#', '', $validated['filterableCityId']);
                $counterparty->save();
            }

            $password = stringDigit(6);

            if ($this->do_registration_complete) {
                $user = auth()->user();
                $validated['email'] = $this->email;
            } else {
                $user = new User();
                $user->setOption('query_password_change_after_login', true);
            }

            $user->name = $validated['fio'];
            $user->email = $validated['email'] ?? null;
            $user->phone = $validated['phone'];
            $user->city_id = str_replace('#', '', $validated['filterableCityId']);
            $user->lang = app()->getLocale();
            $user->password = bcrypt($password);

            $user->save();
            $user->syncRoles(['simple']);

            if (!empty($counterparty)) {
                $user->position = $this->position;
                $user->is_admin = true;
                $user->is_founder = 1;
                $user->counterparties()->sync($counterparty->id);

                $user->save();
                $user->syncRoles(['legal']);

                $counterparty->founder()->associate($user);
                $counterparty->save();
            }

            smsSend($user->phone, sprintf(__('custom::site.new_password_sms'), $password), 'user registration');

            DB::commit();

            if ($this->do_registration_complete) {
                $this->emit('eventPersonalDataChanged');
            }

            $this->showSuccessModal();
            $this->resetForm();
        } catch (\Exception $e) {
            DB::rollBack();
            logger(__METHOD__ . $e->getMessage());
            session()->flash('registration_fail', __('custom::site.registration_fail'));
        }
    }

    protected function tryConfirmSkipEmail()
    {
        $this->emit('eventShowDialogMessage', [
            'title' => __('custom::site.registration'),
            'message' => __('custom::site.email_skip'),
            'buttons' => [
                [
                    'text' => __('custom::site.agree_close'),
                    'actions' => [
                        [
                            'type' => 'sendEvent',
                            'target' => 'eventConfirmEmailSkip',
                        ],
                        [
                            'type' => 'showModal',
                            'target' => 'm-registration',
                        ]
                    ]
                ]
            ]
        ]);
    }

    protected function showSuccessModal()
    {
        $this->emit('eventShowDialogMessage', [
            'title' => __('custom::site.registration'),
            'message' => __('custom::site.registration_success'),
            'buttons' => [
                [
                    'text' => __('custom::site.to_login_form'),
                    'actions' => [
                        [
                            'type' => 'sendEvent',
                            'target' => 'eventSetLoginPhone',
                            'payload' => $this->phone,
                        ],
                        [
                            'type' => 'showModal',
                            'target' => 'm-login',
                        ]
                    ]
                ]
            ]
        ]);
    }

    public function eventConfirmEmailSkip()
    {
        $this->emailSkip = true;
    }

    public function rules(): array
    {
        $rules = [
            'fio' => 'required|min:3',
            'phone' => 'required|bail|min:12|unique:users,phone',
            'filterableCityId' => 'required',
            'privacy_policy' => 'accepted',
        ];

        if ($this->legal_entity) {
            $rules['okpo'] = ['required', 'bail', 'min:8', 'max:10', new EdrpouInnRule()];
            $rules['company_name'] = 'required';
//            $rules['filterableCompanyTypeId'] = 'required';
//            if ($this->isNotCustomCompanyType()) {
//                $rules['filterableCompanyTypeId'] = 'required|exists:counterparty_types,id';
//            }
            if ($this->isCustomCompanyType()) {
                $rules['customCompanyType'] = 'required';
            }
        }
        if (!empty($this->email) && !$this->do_registration_complete) {
            $rules['email'] = 'sometimes|required|email|unique:users,email';
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'filterableCityId.required' => __('custom::site.choice_value_from_list'),
            'filterableCompanyType.required' => __('custom::site.choice_value_from_list'),
            'phone.unique' => __('custom::site.user_phone_unique'),
            'email.unique' => __('custom::site.user_email_unique'),
        ];
    }

    private function getCompanyTypeId(): ?int
    {
        return $this->isNotCustomCompanyType()
            ? ((int)$this->filterableCompanyTypeId ?: null)
            : null;
    }

    private function getCustomCompanyType(): ?string
    {
        return $this->isCustomCompanyType()
            ? ($this->customCompanyType ?: null)
            : null;
    }

    protected function setFilterableCityList($value): array
    {
        /** @var Collection $cities */
        $cities = $value
            ? City::query()->SearchByName($value)->limit(10)->get()
            : City::query()->RegionCapitals()->get();

        return $cities->keyBy(fn($el) => "#{$el->id}")
            ->map(function ($c) {
                return [
                    'text' => $c->name_uk,
                    'title' => $c->name_uk . " ({$c->district_uk} {$c->region_uk})",
                ];
            })
            ->sortBy('text')
            ->toArray();
    }

    protected function setFilterableCompanyTypeList(): array
    {
        return CounterpartyType::query()
            ->withTranslation()
            ->get()
            ->keyBy('id')
            ->map->name
            ->put('custom', __('custom::site.self_value'))
            ->toArray();
    }

    public function isCustomCompanyType(): bool
    {
        return 'custom' === $this->filterableCompanyTypeId;
    }

    public function isNotCustomCompanyType(): bool
    {
        return !$this->isCustomCompanyType();
    }

    public function resetForm()
    {
        $this->reset([
            'phoneRaw',
            'phone',
//     'phone_code',
//    'code_country',
            'email',
            'emailSkip',
            'fio',
            'legal_entity',
            'with_vat',
            'company_name',
            'customCompanyType',
            'okpoRaw',
            'okpo',
            'position',
            'privacy_policy',
        ]);

        $this->resetFilterable('filterableCity');
        $this->resetFilterable('filterableCompanyType');

        $this->clearValidation();

        $this->dispatchBrowserEvent('restoreRegistrationForm');
    }
}
