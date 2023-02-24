<?php

namespace Database\Seeders;

use App\Models\Attribute;
use Illuminate\Database\Seeder;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $step = DatabaseSeeder::STEP;
        $params = DatabaseSeeder::getSeedParameters();
        $qty = $params['attributes'];

        $output = new ConsoleOutput();
        $progress = new ProgressBar($output, $qty);
        $output->writeln('Seed Attributes qty:' . $qty);
        $progress->start();

        while ($qty > 0) {
            $chunk = $qty >= $step ? $step : $qty;
            $qty -= $chunk;

            Attribute::factory()->count($chunk)->create();

            $progress->advance($chunk);
        }

        $progress->finish();
        $output->writeln(PHP_EOL);
    }
}
