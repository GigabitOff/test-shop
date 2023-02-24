<?php

namespace Database\Seeders;

use App\Models\Counterparty;
use App\Models\User;
use Illuminate\Database\Seeder;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class CounterpartySeeder extends Seeder
{
    protected $faker;

    public function __construct()
    {
        $this->faker = \Faker\Factory::create('uk_UA');
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $step = DatabaseSeeder::STEP;

        // Получаем кол-во пользователей которые еще не связаны ни с одним контрагентом.
        // Будем использовать 3/4 этого количества.
        $qty = User::whereDoesntHave('counterparty')
            ->count() * 0.75;
        $output = new ConsoleOutput();
        $progress = new ProgressBar($output, $qty);
        $output->writeln('Seed Counterparties qty:' . $qty) ;
        $progress->start();

        while ($qty > 0) {
            $chunk = $qty >= $step ? $step : $qty;
            $qty -= $chunk;

            // Получаем пользователей которые еще не связаны ни с одним контрагентом
            $customers = User::whereDoesntHave('counterparty')
                ->inRandomOrder()
                ->take($chunk)->get();


            foreach ($customers as $customer) {
                if (empty($counterparty)) {
                    $counterparty = Counterparty::factory()->createOne(['city_id' => $customer->city_id]);
                    $customer->is_admin = true;
                }

                $customer->counterparties()->sync($counterparty->id);
                $customer->position = $this->faker->jobTitle();
                $customer->save();
                $customer->syncRoles(['legal']);

                // Веротность контрагента с одним ползователем 25%
                if(! collect(range(0,3))->random()){
                    $counterparty = null;
                }
            }

            $progress->advance($chunk);
        }

        $progress->finish();
        $output->writeln(PHP_EOL) ;

    }
}
