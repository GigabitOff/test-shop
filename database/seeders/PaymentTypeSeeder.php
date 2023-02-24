<?php

namespace Database\Seeders;

use App\Models\PaymentType;
use Illuminate\Database\Seeder;

class PaymentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (PaymentType::count() < 1) {
            $type = new PaymentType([
                'name:en' => 'Cash',
                'name:uk' => 'Каса',
                'name:ru' => 'Касса',
            ]);
            $type->save();

            $type = new PaymentType([
                'name:en' => 'Invoice',
                'name:uk' => 'Рахунок (безготівка)',
                'name:ru' => 'Счет (безнал)',
            ]);
            $type->save();

            $type = new PaymentType([
                'name:en' => 'LiqPay',
                'name:uk' => 'LiqPay',
                'name:ru' => 'LiqPay',
            ]);
            $type->save();

            $type = new PaymentType([
                'name:en' => 'Postpaid',
                'name:uk' => 'Постоплата',
                'name:ru' => 'Постоплата',
            ]);
            $type->save();
        }
    }
}
