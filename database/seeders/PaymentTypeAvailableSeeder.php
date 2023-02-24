<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentTypeAvailableSeeder extends Seeder
{
    protected $table = 'payment_types_available';
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (DB::table($this->table)->count() < 1) {

            DB::table($this->table)
                ->insert([
                    [
                        'customer_type_id' => 2, //CustomerType::Legal,
                        'payment_type_id' => 1,     // Касса
                    ],
                    [
                        'customer_type_id' => 2, //CustomerType::Legal,
                        'payment_type_id' => 2,     // Счет (безнал)
                    ],
                    [
                        'customer_type_id' => 2, //CustomerType::Legal,
                        'payment_type_id' => 4,     // Постоплата (дебиторская программа)
                    ],
                ]);

            DB::table($this->table)
                ->insert([
                    [
                        'customer_type_id' => 1, //CustomerType::Simple,
                        'payment_type_id' => 1,     // Касса
                    ],
                    [
                        'customer_type_id' => 1, //CustomerType::Simple,
                        'payment_type_id' => 2,     // Счет (безнал)
                    ],
                    [
                        'customer_type_id' => 1, //CustomerType::Simple,
                        'payment_type_id' => 3,     // LiqPay
                    ],
                ]);
        }
    }
}
