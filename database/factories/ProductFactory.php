<?php

namespace Database\Factories;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{

    protected static array $slugs = [];

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->sentence(3);
        $description = $this->faker->sentence();
        $brand = Brand::query()->inRandomOrder()->first();
        $slug = $this->checkSlug(createUniqueSlug($name, Brand::class));

        return [
            'id_1c' => 'tmp_' . Str::random(10),
            'slug' => $slug,
            'name:ru' => $name,
            'name:uk' => $name,
            'name:en' => $name,
            'description:ru' => $description,
            'description:uk' => $description,
            'description:en' => $description,
            'brand_id' => $brand->id,
            'brand_search' => $brand->title,
            'articul' => 'sku_' . Str::random(4),
            'price_init' => $this->faker->randomFloat(2, 1, 10),
        ];
    }

    protected function checkSlug(string $slug): string
    {
        if (in_array($slug, self::$slugs)){
            $slug .= '_' . count(self::$slugs);
        }
        self::$slugs[] = $slug;

        return $slug;
    }
}
