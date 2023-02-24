<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\CounterpartyType;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CounterpartyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (CounterpartyType::count() < 1) {
            $city = new CounterpartyType([
                'name:en' => 'Shop',
                'name:uk' => 'Магазин',
                'name:ru' => 'Магазин',
            ]);
            $city->save();

            $city = new CounterpartyType([
                'name:en' => 'Installer',
                'name:uk' => 'Монтажник',
                'name:ru' => 'Монтажник',
            ]);
            $city->save();

            $city = new CounterpartyType([
                'name:en' => 'Roofer',
                'name:uk' => 'Покрівля',
                'name:ru' => 'Кровельщик',
            ]);
            $city->save();

            $city = new CounterpartyType([
                'name:en' => 'Facade',
                'name:uk' => 'Фасадник',
                'name:ru' => 'Фасадчик',
            ]);
            $city->save();

            $city = new CounterpartyType([
                'name:en' => 'Furniture maker',
                'name:uk' => 'Мебляр',
                'name:ru' => 'Мебельщик',
            ]);
            $city->save();

            $city = new CounterpartyType([
                'name:en' => 'Union',
                'name:uk' => 'Об\'єднання',
                'name:ru' => 'Объединение',
            ]);
            $city->save();

            $city = new CounterpartyType([
                'name:en' => 'Network',
                'name:uk' => 'Мережа',
                'name:ru' => 'Сеть',
            ]);
            $city->save();

        }
    }
}
