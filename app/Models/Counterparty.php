<?php

namespace App\Models;

use App\Traits\HasDigitScopes;
use App\Traits\HasTansferred;
use App\Traits\WithMultipleKeysScopes;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Counterparty extends Model implements TranslatableContract
{
    use HasFactory, Translatable;
    use HasTansferred;
    use SoftDeletes;
    use HasDigitScopes;
    use WithMultipleKeysScopes;

    protected $translationModel = 'App\Models\CounterpartyTranslation';
    protected $translationForeignKey = 'counterparty_id';

    protected $hidden = ['translations'];

    public $translatedAttributes = [
        'form',
        'title',
        'description',
        'body',
    ];

    protected $fillable = [
        'shop_id',
        'id_1c',
        'founder_id',
        'parent_id',
        'parent_id_1c',
        'type_id',
        'city_id',
        'manager_id',
        'region_manager_id',
        'name',
        'okpo',
        'phone',
        'email',
        'is_nds',
        'is_payment_cash',
        'is_can_bonus',
        'custom_type',
        'contract',
        'bonus_earned',
        'bonus_used',
        'cashback',
        'moderated',
        'transferred',
        'contruct_file',
        'ustav_file',
        'form_id',
        'activity_type',
        'owner',
        'authorized_capital',
        'inn',
        'date_registration_inn',
        'form_nalog',
        'nds_certificate',
        'post_address',
        'fact_address',
        'ur_address',
        'mfo',
        'bank_name',
        'iban',
        'address_id',
        'created_at',
        'deleted_at'
    ];


    public function type(): BelongsTo
    {
        return $this->belongsTo(CounterpartyType::class, 'type_id', 'id');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->using(CounterpartyUser::class);
    }

    public function usersIn()
    {
        return $this->HasMany(User::class,'counterparty_id','id');
    }

    public function founderCounterparty(): BelongsTo
    {
        return $this->belongsTo(CounterpartyAdditionalUser::class,'founder_id');
    }

    public function founder(): BelongsTo
    {
        return $this->belongsTo(User::class, 'founder_id');
    }

    public function leaders(): BelongsToMany
    {
        return $this->users()->where('users.is_admin', true);
    }

    public function children(): HasMany
    {
        return $this->hasMany(Counterparty::class, 'parent_id');
    }

    public function contracts(): HasMany
    {
        return $this->hasMany(Contract::class);
    }

    public function debt(): HasOne
    {
        return $this->hasOne(CounterpartyDebt::class);
    }

    //public function form(): HasOne
    //{
    //    return $this->hasOne(CounterpartyForm::class,'id','form_id');
    //}

    public function city(): BelongsTo
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

    public function manager(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function main_counterparty(): BelongsTo
    {
        return $this->belongsTo(Counterparty::class,'parent_id', 'id');
    }

    public function regionManager(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function siblings(): HasMany
    {
        return $this->hasMany(Counterparty::class, 'parent_id', 'parent_id');
    }

    public function priceTypes(): BelongsToMany
    {
        return $this->belongsToMany(PriceType::class)->withPivot('cashless');
    }

    public function productsPriceType(): BelongsToMany
    {
        return $this->belongsToMany(PriceType::class, 'counterparty_price_type_products',
            'counterparty_id', 'price_type_id')
            ->withPivot('product_id', 'date_end');
    }

    public function categoriesPriceType(): BelongsToMany
    {
        return $this->belongsToMany(PriceType::class, 'counterparty_price_type_categories',
            'counterparty_id', 'price_type_id')
            ->withPivot('category_id', 'date_end');
    }

    public function scopeOnModeration($query)
    {
        $query->where('moderated', false);
    }

    public function scopeOnlyModerated($query)
    {
        $query->where('moderated', true);
    }

    public function scopeOnlyNew($query)
    {
        $query->where('created_at', '>=', (Carbon::now())->subDay());
    }

    public function scopeOnlyDeleted($query)
    {
        $query->whereNotNull('deleted_at');
    }

    public function getIsCustomTypeAttribute()
    {
        return !$this->type_id;
    }

    public function getLeaderAttribute()
    {
        return User::query()
            ->where([
                'is_admin' => true,
                'counterparty_id' => $this->id,
            ])->first();
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

}
