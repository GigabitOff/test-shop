<?php

namespace App\Traits;

use App\Models\Document;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasDocuments
{
    public function documents(): HasMany
    {
        return $this->hasMany(Document::class);
    }

    public function documentComplaints(): HasMany
    {
        return $this->documents()->where('type', Document::TYPE_COMPLIANT);
    }

    public function documentReverses(): HasMany
    {
        return $this->documents()->where('type', Document::TYPE_REVERSE_INVOICE);
    }

    public function documentWaybills(): HasMany
    {
        return $this->documents()->where('type', Document::TYPE_WAYBILL);
    }

    public function documentInvoices(): HasMany
    {
        return $this->documents()->where('type', Document::TYPE_INVOICE);
    }


    public function scopeWhereHasComplaints($query)
    {
        $query->whereHas('documents', function ($q){
            $q->where('type', Document::TYPE_COMPLIANT);
        });
    }

    public function scopeWhereHasReverses($query)
    {
        $query->whereHas('documents', function ($q){
            $q->where('type', Document::TYPE_REVERSE_INVOICE);
        });
    }

    public function scopeWhereHasWaybills($query)
    {
        $query->whereHas('documents', function ($q){
            $q->where('type', Document::TYPE_WAYBILL);
        });
    }

    /** =========== Attributes ========== */

    protected function getHasReversesAttribute(): bool
    {
        return $this->documentReverses()->exists();
    }



}
