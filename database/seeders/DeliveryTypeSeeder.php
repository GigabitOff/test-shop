<?php

namespace Database\Seeders;

use App\Models\Counterparty;
use App\Models\DeliveryType;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class DeliveryTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!DeliveryType::where('id_1c', 'seed-self-pickup')->first()) {
            $dt = new DeliveryType(array(
                'name:uk' => 'Самовивіз',
                'name:ru' => 'Самовывоз',
                'name:en' => 'Self pickup',
                'id_1c' => 'seed-self-pickup',
            ));
            $dt->save();
        }

        if (!DeliveryType::where('id_1c', 'seed-address-delivery')->first()) {
            $dt = new DeliveryType(array(
                'name:uk' => 'Адресна доставка',
                'name:ru' => 'Адресная доставка',
                'name:en' => 'Address delivery',
                'id_1c' => 'seed-address-delivery',
            ));
            $dt->save();
        }

        if (!DeliveryType::where('id_1c', 'seed-nova-poshta-service')->first()) {
            $dt = new DeliveryType(array(
                'name:uk' => 'Нова пошта',
                'name:ru' => 'Новая почта',
                'name:en' => 'Nova Poshta',
                'id_1c' => 'seed-nova-poshta-service',
            ));
            $dt->save();
        }

        if (!DeliveryType::where('id_1c', 'seed-sat-service')->first()) {
            $dt = new DeliveryType(array(
                'name:uk' => 'САТ',
                'name:ru' => 'САТ',
                'name:en' => 'SAT',
                'id_1c' => 'seed-sat-service',
            ));
            $dt->save();
        }

        if (!DeliveryType::where('id_1c', 'seed-delivery-service')->first()) {
            $dt = new DeliveryType(array(
                'name:uk' => 'Делівері',
                'name:ru' => 'Деливери',
                'name:en' => 'Delivery',
                'id_1c' => 'seed-delivery-service',
            ));
            $dt->save();
        }
    }

}
