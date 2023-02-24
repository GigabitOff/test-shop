<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $params = DatabaseSeeder::getSeedParameters();
        $brands = $params['brands'];

        Brand::factory()->count($brands)->create();
    }
}
