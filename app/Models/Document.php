<?php

namespace App\Models;

use App\Contracts\DocumentOwnerContract;
use App\Traits\HasTansferred;
use App\Traits\WithMultipleKeysScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class Document extends Model implements DocumentOwnerContract
{
    use HasFactory;
    use HasTansferred;
    use WithMultipleKeysScopes;

    const TYPE_WAYBILL = 'waybill'; // Расходная накладная  1
    const TYPE_COMPLIANT = 'compliant'; // Акт рекламации   2
    const TYPE_REVERSE_INVOICE = 'reverse'; // Возвратная накладная 3
    const TYPE_RECONCILIATION = 'reconciliation'; // Акт сверки 4
    const TYPE_INVOICE = 'invoice'; // Счет 5

    const STATUS_UNDEFINED = 'undefined'; // не определен
    const STATUS_PROCESSED = 'processed'; // В обработке
    const STATUS_APPROVED = 'approved'; // Принято
    const STATUS_REJECTED = 'rejected'; // Отказано

    protected $fillable = [
        'id_1c',
        'number',
        'type',
        'doc_type',
        'date_at',
        'status_id',
        'related_id',
        'related_date',
        'customer_doc_id',
        'customer_doc_date',
        'counterparty_okpo',
        'delivery_address_id',
        'storage_id_1c',
        'total_with_nds',
        'response',
    ];

    protected $casts = [
        'date_at'  => 'date',
        'related_date'  => 'date:d.m.Y',
        'customer_doc_date'  => 'date:d.m.Y',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->date_at = now();
        });
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity', 'price_nds', 'total_nds', 'reason');
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function contract(): BelongsTo
    {
        return $this->belongsTo(Contract::class);
    }

    public function getStorageUri(): string
    {
        return "document/{$this->id}";
    }

    public function saveFileInfo(string $fileName, string $path)
    {
        $this->filename = $fileName;
        $this->path = $path;
        $this->save();
    }

    public function getUniqueKey(): string
    {
        return $this->id;
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(DocumentAttachment::class);
    }

    public function scopeOnlyComplaints($query)
    {
        $query->where('type', self::TYPE_COMPLIANT);
    }

    public function scopeOnlyReconciliations($query)
    {
        $query->where('type', self::TYPE_RECONCILIATION);
    }

    public function scopeOnlyReverseInvoices($query)
    {
        $query->where('type', self::TYPE_REVERSE_INVOICE);
    }

    public function scopeOnlyWaybillsAndReconciliations($query)
    {
        $query->where(function($q) {
            $q->where('type', self::TYPE_WAYBILL)
                ->orWhere('type', self::TYPE_RECONCILIATION);
        });
    }

    public function scopeOnlyInvoices($query)
    {
        $query->where('type', self::TYPE_INVOICE);
    }

    public function scopeOnlyScores($query)
    {
        $query->where('type', self::TYPE_WAYBILL);
    }

    public function scopeOnlyNew($query)
    {
        $query->where('status', self::STATUS_PROCESSED);
    }

    public function scopeOnlyApproved($query)
    {
        $query->where('status', self::STATUS_APPROVED);
    }

    public function scopeOnlyNotApproved($query)
    {
        $query->where('status', '!=', self::STATUS_APPROVED);
    }

    public function getImagesAttribute()
    {
        return $this->attachments
            ->where('type', DocumentAttachment::TYPE_IMAGE);
    }

    public function getImageUrlsAttribute(): Collection
    {
        return $this->images
            ->map(function ($image){
                return Storage::disk('public')->url($image->path);
            });
    }

    public function getFileUrlAttribute(): string
    {
        return $this->path
            ? Storage::disk('public')->url($this->path)
            : '';
    }

    public function isTypeWaybill(): bool
    {
        return $this->type === self::TYPE_WAYBILL;
    }

    public function isTypeInvoice(): bool
    {
        return $this->type === self::TYPE_INVOICE;
    }

    public function isTypeReverseInvoice(): bool
    {
        return $this->type === self::TYPE_REVERSE_INVOICE;
    }

    public function isTypeReconciliation(): bool
    {
        return $this->type === self::TYPE_RECONCILIATION;
    }

    public function isTypeComplaint(): bool
    {
        return $this->type === self::TYPE_COMPLIANT;
    }

    public function isDocumentStatusProcessing(): bool
    {
        return $this->status === self::STATUS_PROCESSED;
    }

    public function isDocumentStatusApproved(): bool
    {
        return $this->status === self::STATUS_APPROVED;
    }

    public function isDocumentStatusRejected(): bool
    {
        return $this->status === self::STATUS_REJECTED;
    }
}
