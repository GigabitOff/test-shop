<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    const STEP = 15;

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        $this->call([
            CitiesSeeder::class,
            RolesSeeder::class,
            PaymentTypeSeeder::class,
            PaymentTypeAvailableSeeder::class,
            BrandSeeder::class,
            UserSeeder::class,
            PageSeeder::class,
            PageLocationSeeder::class,
            DeliveryTypeSeeder::class,
            CounterpartyTypeSeeder::class,
//            CounterpartySeeder::class,
//            ContractSeeder::class,
//            CustomerContractSeeder::class,
            AttributeSeeder::class,
            CategorySeeder::class,
//            ProductGroupSeeder::class,
            ProductSeeder::class,
            OrderStatusSeeder::class,
        ]);
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

    static function getSeedParameters()
    {
        // Run [SEED_BIG=1 php artisan db:seed]  to seed big data
        $big = env('SEED_BIG', 0);

        return [
            'customers' => $big ? 5000 : 10,
            'attributes' => $big ? 100 : 10,
            'categories' => $big ? 100 : 5,
            'brands' => $big ? 100 : 10,
            'product_groups' => $big ? 100 : 5,
            'contracts' => [
                'per_counterparty' => $big ? 100 : 5,
            ],
            // глубина вложений для иерархических структур
            'deep' => $big ? 20 : 5,
            'products' => [
                'count' => $big ? 5000 : 20,
                'attributes' => $big ? 100 : 10,
                'categories' => $big ? 100 : 5,
                'groups' => $big ? 100 : 5,
            ]
        ];
    }
}
