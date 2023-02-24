<?php

namespace Database\Seeders;

use App\Models\Contract;
use App\Models\Counterparty;
use Illuminate\Database\Seeder;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class ContractSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $step = DatabaseSeeder::STEP;
        $params = DatabaseSeeder::getSeedParameters()['contracts'];
        $perCounterparty = $params['per_counterparty'];

        $qty = Counterparty::whereDoesntHave('contracts')->count();
        $output = new ConsoleOutput();
        $progress = new ProgressBar($output, $qty);
        $output->writeln('Seed Contracts for counterparties:' . $qty) ;
        $progress->start();

        $counter = 0;
        while ($qty > 0) {
            $chunk = $qty >= $step ? $step : $qty;
            $qty -= $chunk;

            $counterparties = Counterparty::query()
                ->whereDoesntHave('contracts')
                ->take($chunk)->get();

            foreach ($counterparties as $counterparty) {
                $admins = $counterparty->leaders;
                if ($admins->isEmpty()){
                    continue;
                }
                $users = $counterparty->customers->except($admins->pluck('id')->toArray());
                $contract_qty = (int)($users->count() * 0.75 + 1);
                while ($contract_qty > 0){
                    $contract = Contract::factory()
                        ->create(['counterparty_id' => $counterparty->id]);

                    $contract->customers()->sync($admins->pluck('id'));

                    if($users->isEmpty()){
                        break;
                    }

                    $ids = $users->pluck('id')->random(collect(range(1, $users->count()))->random());
                    $contract->customers()->syncWithoutDetaching($ids);

                    $contract_qty--;
                }
            }

            $progress->advance($chunk);
            $counter++;
        }

        $progress->finish();
        $output->writeln(PHP_EOL) ;

    }
}
