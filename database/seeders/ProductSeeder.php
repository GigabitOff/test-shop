<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $step = DatabaseSeeder::STEP;
        $params = DatabaseSeeder::getSeedParameters()['products'];
        $qty = $params['count'];

        $output = new ConsoleOutput();
        $progress = new ProgressBar($output, $qty);
        $output->writeln('Seed Products qty:' . $qty) ;
        $progress->start();

//        $attributeIds = DB::table('attributes')->select('id')->get()->pluck('id');
        $categoryIds = DB::table('categories')->select('id')->get()->pluck('id');
//        $groupIds = DB::table('product_groups')->select('id')->get()->pluck('id');

        while ($qty > 0) {
            $chunk = $qty >= $step ? $step : $qty;
            $qty -= $chunk;

            $productIds = Product::factory()->count($chunk)->create()->pluck('id');

//            $attribute_product = [];
//            foreach ($productIds as $productId) {
//                for ($i = $params['attributes']; $i > 0; $i--) {
//                    $attribute_product[] = [
//                        'product_id' => $productId,
//                        'attribute_id' => $attributeIds->random(),
//                    ];
//                }
//            }
//            DB::table('attribute_product')->insert($attribute_product);

            $category_product = [];
            foreach ($productIds as $productId) {
                for ($i = $params['categories']; $i > 0; $i--) {
                    $category_product[] = [
                        'product_id' => $productId,
                        'category_id' => $categoryIds->random(),
                    ];
                }
            }
            DB::table('category_product')->upsert($category_product, ['product_id', 'category_id']);

//            $product_in_groups = [];
//            foreach ($productIds as $productId) {
//                for ($i = $params['groups']; $i > 0; $i--) {
//                    $product_in_groups[] = [
//                        'product_id' => $productId,
//                        'group_id' => $groupIds->random(),
//                    ];
//                }
//            }
//            DB::table('product_in_group')->insert($product_in_groups);

            $progress->advance($chunk);
        }

        $progress->finish();
        $output->writeln(PHP_EOL) ;

    }
}
