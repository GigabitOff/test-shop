<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class PersonalOffer extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)
            ->withPivot('price', 'discount', 'min_quantity', 'max_quantity');
    }

    public function selfProduct(): HasOne
    {
        return $this->hasOne(Product::class);
    }

    public function counterparties(): MorphToMany
    {
        return $this->morphedByMany(Counterparty::class, 'owner', 'personal_offer_client');
    }

    public function users(): MorphToMany
    {
        return $this->morphedByMany(User::class, 'owner', 'personal_offer_client');
    }

    public static function extractOfferIdFromUniq(?string $uniq = null): int
    {
        return $uniq
            ? (int)Str::replaceFirst('offer_', '', $uniq)
            : 0;
    }

    public function scopeOnlyValid($query)
    {
        $query
            ->whereNotNull('quantity')
            ->where('quantity', '>', 0)
            ->where(function($q){
                $q->whereNull('date_start')
                ->orWhere('date_start', '<=', Carbon::now()->toDateTimeString());
            })
            ->where(function($q){
                $q->whereNull('date_end')
                ->orWhere('date_end', '>=', Carbon::now()->toDateTimeString());
            });
    }

}
