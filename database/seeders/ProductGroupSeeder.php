<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\ProductGroup;
use Illuminate\Database\Seeder;

class ProductGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $params = DatabaseSeeder::getSeedParameters();
        $groups = $params['product_groups'];
        $deep = $params['deep'];

        // создаем родительские категории
        $parentIds = ProductGroup::factory()->count($groups)->create()->pluck('id');

        while ($deep > 0) {
            // создаем дочерние категории deep глубины
            $parentIds = ProductGroup::factory()->count($groups)->parentIds($parentIds)->create()->pluck('id');

            $deep--;
        }

    }
}
