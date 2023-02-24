<?php

namespace App\Models;

use App\Traits\HasTansferred;
use App\Traits\WithMultipleKeysScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryAddress extends Model
{
    use HasFactory;
    use HasTansferred;
    use WithMultipleKeysScopes;

    protected $fillable = [
        'id_1c',
        'city_id',
        'delivery_type_id',
        'warehouse_id',
        'address_full',
        'street_type',
        'street_name',
        'dom',
        'korpus',
        'office',
        'city_name',
        'city_guid',
        'otdel_number',
        'otdel_guid',
        'otdel_name',
        'additional_data',
    ];

    public function counterparty()
    {
        return $this->belongsTo(Counterparty::class);
    }

    public function deliveryType()
    {
        return $this->belongsTo(DeliveryType::class);
    }

    public function counterparties()
    {
        return $this->belongsToMany(Counterparty::class);
    }

    public function owner()
    {
        return $this->morphTo();
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function formatFullAddress()
    {
        switch (true){
            case $this->deliveryType->isSelfPickUpService():
                return $this->warehouse->name ?? '';
            case $this->deliveryType->isAddressDeliveryService():
                return $this->city_name . ' ' . $this->address_full;
            case $this->deliveryType->isDeliveryAutoService():
            case $this->deliveryType->isSatService():
            case $this->deliveryType->isNovaPoshtaService():
                if ($this->otdel_guid){
                    return sprintf('%s, № %s, %s',
                        $this->city_name,
                        $this->otdel_number,
                        $this->otdel_name
                    );
                } else {
                    return sprintf('%s, %s, %s/%s, %s',
                        $this->city_name,
                        $this->street_name,
                        $this->dom,
                        $this->korpus,
                        $this->office
                    );
                }
        }
        return '';
    }
}
