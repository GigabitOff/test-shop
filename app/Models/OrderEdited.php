<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderEdited extends Model
{
    protected $table = 'orders_edited';

    protected $fillable = [
        'order_id',
        'status_id',
        'customer_id',
        'manager_id',
        'driver_id',
        'delivery_address_id',
        'payment_type_id',
        'recipient_id',
        'contract_id',
        'counterparty_id',
        'counterparty_okpo',
        'total',
        'total_quantity',
        'total_weight',
        'total_volume',
        'bonus_used',
        'bonus_earned',
        'cashback_used',
        'cashback_earned',
        'debt_sum',
        'debt_end_at',
        'date_registration',
        'date_delivery',
        'departure_at',
        'type_payment',
        'payment_status',
        'fast_order',
        'callback_off',
        'comment',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_edited_product')
            ->using(OrderProductPivot::class)
            ->withPivot('quantity', 'old_qty', 'price', 'reserve', 'options');
    }

    public function customer()
    {
        return $this->belongsTo(User::class);
    }

    public function manager()
    {
        return $this->belongsTo(User::class);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function deliveryAddress()
    {
        return $this->belongsTo(DeliveryAddress::class);
    }

    public function paymentType()
    {
        return $this->belongsTo(PaymentType::class);
    }

    public function recipient()
    {
        return $this->belongsTo(CustomerRecipient::class, 'recipient_id', 'id');
    }

    public function counterparty(): BelongsTo
    {
        return $this->belongsTo(Counterparty::class);
    }

    /** Scopes */

    public function scopeWhereCustomerId($query, $id)
    {
        $query->whereRelation('customer', 'id', $id);
    }

    public function scopeWhereCounterpartyId($query, $id)
    {
        $query->whereRelation('contract.counterparty', 'id', $id);
    }

    public function scopeWhereProductId($query, $id)
    {
        $query->whereRelation('products', 'id', $id);
    }

    public function scopeWhereDateFrom($query, $from)
    {
        $valid_date = strtotime($from ?? '');
        $date_at = $valid_date ? date('Y-m-d', $valid_date) : null;
        if ($date_at) {
            $query->where('created_at', '>=', $date_at);
        }
    }

    public function scopeWhereDateTo($query, $to)
    {
        $valid_date = strtotime($to ?? '');
        $date_at = $valid_date ? date('Y-m-d', $valid_date) : null;
        if ($date_at) {
            $query->where('created_at', '<=', $date_at);
        }
    }

    /** service functions */

    public function isStatusNew()
    {
        return $this->status->isNew();
    }

    public function isPaid()
    {
        return $this->payment_status === Order::PAYMENT_STATUS_PAID;
    }

    public function isNotPaid()
    {
        return $this->payment_status === Order::PAYMENT_STATUS_UNPAID;
    }
}
