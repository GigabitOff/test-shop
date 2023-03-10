<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VerificationCode>
 */
class VerificationCodeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'value' => mb_strtoupper($this->faker->unique()->numerify('#####')),
            'target' => '380' . $this->faker->randomNumber(9, true),
            'used_at' => null,
            'expired_at' => now()->addHour(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

