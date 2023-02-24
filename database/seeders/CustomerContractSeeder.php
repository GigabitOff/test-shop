<?php

namespace Database\Seeders;

use App\Models\Counterparty;
use Illuminate\Database\Seeder;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class CustomerContractSeeder extends Seeder
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

        $qty = Counterparty::count();

        $output = new ConsoleOutput();
        $progress = new ProgressBar($output, $qty);
        $output->writeln('Seed CustomerContract qty:' . $qty);
        $progress->start();

        $offset = 0;
        while ($qty > 0) {
            $chunk = $qty >= $step ? $step : $qty;
            $qty -= $chunk;

            $counterparties = Counterparty::skip($offset)->take($step)->get();

            foreach ($counterparties as $counterparty) {
                $contracts = $counterparty->contracts()->get();

                // для владельца контрагента привязок с контрактами не делаем
                $customers = $counterparty->customers()->wherePivot('is_admin', 0)->get();
                $index = 1;
                foreach ($customers as $customer) {
                    if (1 === $index) {
                        // Первого делаем админом группы
                        $customer->contracts()->syncWithPivotValues($contracts->pluck('id'), ['is_admin' => true]);
                        $customer->syncRoles(['customer', 'customerLegalAdmin']);
                    } else {
                        //Последующих привязываем к произвольному количеству контрактов
                        $attached = $contracts->random(collect(range(1, $contracts->count()))->random());
                        $customer->contracts()->syncWithoutDetaching($attached->pluck('id'));
                        $customer->syncRoles(['customer', 'customerLegalUser']);
                    }
                    $index++;
                }
            }

            $progress->advance($chunk);
            $offset += $chunk;
        }

        $progress->finish();
        $output->writeln(PHP_EOL);

    }

    /**
     * @param $customers
     * @param $contracts
     * @param int $isAdmin
     */
    protected function attachCustomerContract($customers, $contracts, $isAdmin = 1)
    {
        foreach ($customers as $customer) {
            if ($contracts) {
                $customer->contracts()
                    ->attach(($contracts->pop())->id, ['is_admin' => $isAdmin]);
                $customer->save();
            }
        }
    }
}
