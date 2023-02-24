<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\OrderStatusType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (OrderStatusType::count() < 1) {
            $item = new OrderStatusType([
                'id_1c' => 'status_' . Str::random(5),
                'name:en' => 'New',
                'name:uk' => 'Новий',
                'name:ru' => 'Новий',
            ]);
            $item->save();

            $item = new OrderStatusType([
                'id_1c' => 'status_' . Str::random(5),
                'name:en' => 'Processing',
                'name:uk' => 'В роботі',
                'name:ru' => 'В работе',
            ]);
            $item->save();

            $item = new OrderStatusType([
                'id_1c' => 'status_' . Str::random(5),
                'name:en' => 'Completion',
                'name:uk' => 'Комплектація',
                'name:ru' => 'Комплектация',
            ]);
            $item->save();

            $item = new OrderStatusType([
                'id_1c' => 'status_' . Str::random(5),
                'name:en' => 'Delivered',
                'name:uk' => 'Даставляется',
                'name:ru' => 'Даставляется',
            ]);
            $item->save();

            $item = new OrderStatusType([
                'id_1c' => 'status_' . Str::random(5),
                'name:en' => 'Completed',
                'name:uk' => 'Завершено',
                'name:ru' => 'Завершен',
            ]);
            $item->save();

            $item = new OrderStatusType([
                'id_1c' => 'status_' . Str::random(5),
                'name:en' => 'Canceled',
                'name:uk' => 'Скасовано',
                'name:ru' => 'Отменено',
            ]);
            $item->save();

            $item = new OrderStatusType([
                'id_1c' => 'status_' . Str::random(5),
                'name:en' => 'Draft',
                'name:uk' => 'Чернетка',
                'name:ru' => 'Черновик',
            ]);
            $item->save();

            $item = new OrderStatusType([
                'id_1c' => 'status_' . Str::random(5),
                'name:en' => 'Edit',
                'name:uk' => 'Редагуется',
                'name:ru' => 'Правится',
            ]);
            $item->save();
        }
    }
}
