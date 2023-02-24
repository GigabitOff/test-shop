<?php

namespace Database\Factories;

use App\Models\Attribute;
use App\Models\City;
use App\Models\Contract;
use App\Models\Counterparty;
use App\Models\CounterpartyType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class ContractFactory extends Factory
{
    protected $model = Contract::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_1c' => 'tmp_' . Str::random(10),
            'counterparty_id' => 1,
            'registry_no' => 'no_'. strtoupper(Str::random(3)) . '_' . $this->faker->randomNumber(),
            'signing_at' => $this->faker->dateTimeInInterval('-2 years', '+2 years'),
            'address' =>  $this->faker->address(),
            'phone' => '380' . $this->faker->randomNumber(9, true),
        ];
    }
}
