<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatusType extends Model
{
    use HasFactory;
    use Translatable;

    const STATUS_NEW = 1;   // ID статуса новый
    const STATUS_PROCESSING = 2;   // ID статуса в работе (подтвержден)
    const STATUS_ASSEMBLY = 3;   // ID статуса "комплектация"
    const STATUS_SHIPPING = 4;   // ID статуса "доставляется"
    const STATUS_COMPLETED = 5;   // ID статуса "завершен"
    const STATUS_CANCELED = 6;   // ID статуса "отменен"
    const STATUS_DRAFT = 7;   // ID статуса "черновик"
    const STATUS_EDITED = 8;   // ID статуса  "редактируется"

    public $timestamps = false;

    protected $translationForeignKey = 'status_type_id';

    public $translatedAttributes = ['name'];

    protected $fillable = ['id_1c'];

    public function orders($customer_id = 0)
    {
        return $this->hasMany(Order::class, 'status_id');
    }

    public function isNew(): bool
    {
        return $this->id === self::STATUS_NEW;
    }

    public function isNotNew(): bool
    {
        return ! $this->isNew();
    }

    public function isDraft(): bool
    {
        return $this->id === self::STATUS_DRAFT;
    }

    public function isNotDraft(): bool
    {
        return ! $this->isDraft();
    }

    public function isEdited(): bool
    {
        return $this->id === self::STATUS_EDITED;
    }

    public function isNotEdited(): bool
    {
        return ! $this->isEdited();
    }

    public function isProcessing(): bool
    {
        return $this->id === self::STATUS_PROCESSING;
    }

    public function isNotProcessing(): bool
    {
        return ! $this->isProcessing();
    }

    public function isCompleted(): bool
    {
        return $this->id === self::STATUS_COMPLETED;
    }

    public function isNotCompleted(): bool
    {
        return ! $this->isCompleted();
    }

    /** =========== Scopes ========== */

    public function scopeWithoutDraft($query)
    {
        $query->whereNotIn('id', self::STATUS_DRAFT);
    }

    /** =========== Attributes ========== */

    /**
     * Динамическое свойсто названия статуса
     * @return string
     */
    public function getTitleAttribute(): string
    {
        return 'static' === config('app.order_statuses.rank')
            ? __('custom::site.order_status_' . $this->id_1c)
            : $this->name;
    }
}
