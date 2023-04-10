<?php

namespace App\Models;

use App\Traits\HasDocuments;
use App\Traits\HasTansferred;
use App\Traits\WithMultipleKeysScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{

    use HasFactory;
    use HasTansferred;
    use HasDocuments;
    use WithMultipleKeysScopes;

    /** payment Statuses */
    const PAYMENT_STATUS_UNPAID = 0;
    const PAYMENT_STATUS_PAID = 1;

    /**
     * Указать верный id статуса заказа
     * Должен соответствовать id записи из таблицы OrderStatusTypes
     */
    const ORDER_NEW_STATUS_ID = 1;
    const ORDER_COMPLETED_STATUS_ID = 5;

    protected $fillable = ['customer_id', 'fast_order'];

    protected $attributes = [
        'status_id' => self::ORDER_NEW_STATUS_ID,
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)
            ->using(OrderProductPivot::class)
            ->withPivot('quantity', 'price', 'reserve', 'options');
    }

    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function manager(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function status()
    {
        return $this->belongsTo(OrderStatusType::class);
    }

    public function deliveryAddress()
    {
        return $this->belongsTo(DeliveryAddress::class);
    }

    public function paymentType()
    {
        return $this->belongsTo(PaymentType::class);
    }

    public function documentWaybill()
    {
        return $this->hasMany(Document::class)->where('type', Document::TYPE_WAYBILL)->first();
    }

    public function recipient()
    {
        return $this->belongsTo(CustomerRecipient::class, 'recipient_id', 'id');
    }

    public function counterparty(): BelongsTo
    {
        return $this->belongsTo(Counterparty::class);
    }

    public function editedCopy()
    {
        return $this->hasOne(OrderEdited::class, 'id', 'edited_id');
    }

    /** =========== Scopes ========== */

    public function scopeWhereCustomerId($query, $id)
    {
        $query->whereRelation('customer', 'id', $id);
    }

    public function scopeWhereCounterpartyId($query, $id)
    {
        $query->whereRelation('counterparty', 'id', $id);
    }

    public function scopeWhereProductId($query, $id)
    {
        $query->whereRelation('products', 'id', $id);
    }

    public function scopeWhereStatus($query, $statusId)
    {
        $query->whereRelation('status', 'id', $statusId);
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

    /** =========== Service functions ========== */

    public function isStatusNew(): bool
    {
        return $this->status->isNew();
    }

    public function isStatusCompleted(): bool
    {
        if($this->status){
        return $this->status->isCompleted();
        }else{
            return false;
        }
    }

    public function isStatusProcessing(): bool
    {
        if ($this->status) {
            return $this->status->isProcessing();
        } else {
            return false;
        }
    }

    public function isPaid(): bool
    {
        return $this->payment_status === Order::PAYMENT_STATUS_PAID;
    }
    public function isNotPaid(): bool
    {
        return $this->payment_status === Order::PAYMENT_STATUS_UNPAID;
    }
}
