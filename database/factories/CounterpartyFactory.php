<?php

namespace Database\Factories;

use App\Models\Attribute;
use App\Models\City;
use App\Models\Counterparty;
use App\Models\CounterpartyType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class CounterpartyFactory extends Factory
{
    protected $model = Counterparty::class;

    protected $types;
    protected $cities;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_1c' => 'tmp_' . Str::random(10),
            'city_id' => $this->getCity(),
            'type_id' => $this->getType(),
            'phone'=> '380' . $this->faker->randomNumber(9, true),
            'name' => $this->faker->company(),
            'okpo' => $this->faker->randomNumber(8, true),
        ];
    }

    protected function getType()
    {
       $types = CounterpartyType::inRandomOrder()->limit(5)->pluck('id');

        return ($types && collect(range(0,5))->random())
            ? $types->random()
            : null;
    }

    protected function getCity()
    {
        $cities = City::inRandomOrder()->limit(5)->pluck('id');

        return ($cities && collect(range(0,5))->random())
            ? $cities->random()
            : null;
    }
}
