<?php

namespace App\Traits;

trait HasTansferred
{
    /**
     * Attribute name to control.
     *
     * Will changed to false if values of transferred_scopes are changed
     * or transferred_scopes is empty
     *
     * May be assigned in traited model
     *
     * @var string
     */
    //protected $transferred = 'transferred';

    /**
     * Array of controlled attributes to clear transferred attribute
     *
     * May be assigned in traited model
     *
     * @var array
     */
    //protected $transferredScopes = [];

    protected static function boot()
    {
        parent::boot();

        static::updating([self::class, 'updateTransferred']);

    }

    public function updateTransferred($model)
    {
        if ( $this->isEmptyScopes() || $this->isDirtyScopes($model)){
            $model->{$this->getTransferredKey()} = false;
        };
    }

    /**
     * Check if controlled attributes are changed.
     *
     * @return bool
     */
    protected function isDirtyScopes($model){
        return (bool) array_intersect($this->getTransferredScopes(), array_keys($model->getDirty()));
    }

    protected function isEmptyScopes(){
        return empty($this->getTransferredScopes());
    }

    protected function getTransferredKey(){
        return $this->transferred ?? 'transferred';
    }

    protected function getTransferredScopes(){
        return (array)($this->transferredScopes ?? []);
    }

    public function scopeOnlyTransferred($query)
    {
        return $query->where($this->getTransferredKey(), true);
    }

    public function scopeOnlyNotTransferred($query)
    {
        return $query->where($this->getTransferredKey(), false);
    }

}
