<?php

namespace Database\Factories;

use App\Models\Attribute;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AttributeFactory extends Factory
{
    protected $model = Attribute::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->word();
        $uniq = Str::random(10);
        return [
            'id_1c' => 'tmp_' . $uniq,
            'name:ru' => $name,
            'name:uk' => $name,
            'name:en' => $name,
            'slug' => 'attr_' . $uniq,
        ];
    }
}
