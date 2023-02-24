<?php

namespace Database\Factories;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BrandFactory extends Factory
{
    protected $model = Brand::class;

    protected static array $slugs = [];


    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = 'cat_' . $this->faker->word();
        $slug = $this->checkSlug(createUniqueSlug($name, Brand::class));
        return [
            'id_1c' => 'tmp_' . Str::random(10),
            'slug' => $slug,
            'title:ru' => $name,
            'title:uk' => $name,
            'title:en' => $name,
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
