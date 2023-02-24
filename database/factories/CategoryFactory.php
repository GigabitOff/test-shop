<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    protected $parentIds;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = 'cat_' . $this->faker->word();
        $uniq = Str::random(10);
        $slug = Str::slug("{$name}-{$uniq}");
        return [
            'id_1c' => "tmp_{$uniq}",
            'slug' => $slug,
            'name:ru' => $name,
            'name:uk' => $name,
            'name:en' => $name,
            'parent_id' => $this->getParentId(),
        ];
    }

    public function parentIds($parentIds)
    {
        $this->parentIds = collect($parentIds);
        return $this;
    }

    protected function getParentId(): int
    {

        if (is_null($this->parentIds) || $this->parentIds->isEmpty()){
            return 0;
        }

        return collect(range(0,5))->random()
            ? $this->parentIds->random()
            : 0;
    }

}
