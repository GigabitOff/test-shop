<?php

namespace Database\Factories;

use App\Models\ProductGroup;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductGroupFactory extends Factory
{
    protected $model = ProductGroup::class;

    protected $parentIds;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = 'cat_' . $this->faker->word();
        return [
            'id_1c' => 'tmp_' . Str::random(10),
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

    protected function getParentId()
    {

        if (is_null($this->parentIds) || $this->parentIds->isEmpty()){
            return 0;
        }

        return collect(range(0,5))->random()
            ? $this->parentIds->random()
            : 0;
    }

}
