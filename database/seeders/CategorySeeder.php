<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $params = DatabaseSeeder::getSeedParameters();
        $categories = $params['categories'];
        $deep = $params['deep'];

        // создаем родительские категории
        $parentIds = Category::factory()->count($categories)->create()->pluck('id');

        while ($deep > 0) {
            // создаем дочерние категории deep глубины
            $parentIds = Category::factory()->count($categories)->parentIds($parentIds)->create()->pluck('id');

            $deep--;
        }

    }
}
