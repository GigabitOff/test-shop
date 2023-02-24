<?php

namespace Database\Factories;

use App\Models\Attribute;
use App\Models\AttributeValue;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AttributeValueFactory extends Factory
{
    protected $model = AttributeValue::class;

    protected int $productId;
    protected int $attributeId;

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
            'product_id' => $this->productId,
            'attribute_id' => $this->attributeId,
            'imported' => (bool)($this->faker->randomDigit()/5),
            'name:ru' => $name,
            'name:uk' => $name,
            'name:en' => $name,
            'slug:ru' => Str::slug($name),
            'slug:uk' => Str::slug($name),
            'slug:en' => Str::slug($name),
        ];
    }

    public function product($productId)
    {
        $this->productId = $productId;
        return $this;
    }

    public function attribute($attributeId)
    {
        $this->attributeId = $attributeId;
        return $this;
    }

}
