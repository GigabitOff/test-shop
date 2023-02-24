<?php

namespace App\Models;

use App\Enums\TypePayment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Cart extends Model
{

    use HasFactory;

    protected $casts = [
        'type_payment' => TypePayment::class,
    ];

    protected $fillable = [
        'counterparty_id',
        'type_payment',
        'comment',
    ];

    protected $attributes = [
        'type_payment' => TypePayment::PaymentCash,
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)->withTimestamps()
            ->withPivot('uuid', 'uniq', 'quantity', 'checked', 'price_added');
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function counterparty(): BelongsTo
    {
        return $this->belongsTo(Counterparty::class);
    }

    public function paymentType(): BelongsTo
    {
        return $this->belongsTo(PaymentType::class);
    }

    public function deliveryAddress(): BelongsTo
    {
        return $this->belongsTo(DeliveryAddress::class);
    }

    public function deliveryAddressDynamic(): MorphOne
    {
        return $this->morphOne(DeliveryAddress::class, 'owner');
    }

}
