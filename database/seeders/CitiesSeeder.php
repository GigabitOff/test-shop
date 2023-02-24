<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;
use function React\Promise\all;

class CitiesSeeder extends Seeder
{
    protected $exeptions = [
        '8000000000',   // коатуу Киева
        '8500000000',   // коатуу Севастополя
    ];

    protected $all_locations;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = file_get_contents(__DIR__ . '/KOATUU_26112020.json');

        $data = json_decode($file);
        $locations = collect($data->locations)->keyBy('TE');
        $this->all_locations = $locations;

        $output = new ConsoleOutput();
        $output->writeln('Seed Cities');

        $output->writeln('Format district and region');
        $progress = new ProgressBar($output, $locations->count());
        $progress->start();

        $locations->each(function ($location) use ($progress) {
            $location->district = $this->getDistrict($location);
            $location->region = $this->getRegion($location);
            $location->valid = $this->isValid($location);
            $progress->advance(1);
        });
        $progress->finish();
        $output->writeln(PHP_EOL);

        $progress = new ProgressBar($output, City::count());
        $output->writeln('Update existing records');
        $progress->start();

        City::query()
            ->chunk(100, function ($chunk) use ($locations, $progress) {
                $chunk->each(function ($city) use ($locations) {
                    if ($locations->has($city->koatuu)) {
                        $location = $locations->get($city->koatuu);
                        $city->type = $location->NP;
                        $city->name_uk = $location->NU;
                        $city->district_uk = $location->district;
                        $city->region_uk = $location->region;
                        $city->valid = $location->valid;
                        $city->save();
                        $locations->forget($city->koatuu);
                    }
                });
                $progress->advance(100);
            });
        $progress->finish();
        $output->writeln(PHP_EOL);

        $progress = new ProgressBar($output, $locations->count());
        $output->writeln('Add new records');
        $progress->start();

        $locations->chunk(500)
            ->each(function ($chunk) use ($progress) {
                $data = $chunk->map(function ($location) {
                    return [
                        'koatuu' => $location->TE,
                        'type' => $location->NP,
                        'name_uk' => $location->NU,
                        'district_uk' => $location->district,
                        'region_uk' => $location->region,
                        'valid' => $location->valid,
                    ];
                });
                DB::table('cities')->insert($data->toArray());
                $progress->advance(500);
            });
        $progress->finish();
        $output->writeln(PHP_EOL);
    }

    protected function getRegion($location)
    {
        $koatuu = preg_replace('/^(\d\d)[\d]{8}$/', '$1', $location->TE) . '00000000';
        if ($this->all_locations->has($koatuu)){
            $parent = $this->all_locations->get($koatuu);
            $pos = strpos($parent->NU, '/');
            return $pos
                ? substr($parent->NU, 0, $pos)
                : $parent->NU;
        }
        return null;
    }

    protected function getDistrict($location)
    {
        $koatuu = preg_replace('/^([\d]{5})[\d]{5}$/', '$1', $location->TE) . '00000';
        if ($this->all_locations->has($koatuu)){
            $parent = $this->all_locations->get($koatuu);
            $pos = strpos($parent->NU, '/');
            return $pos
                ? substr($parent->NU, 0, $pos)
                : $parent->NU;
        }
        return null;
    }

    protected function isValid($location)
    {
        // города областного значения
        $region_pattern = '/^\d\d1\d[^0]00000$/';

        // города районного значения
        $district_pattern = '/^[\d]{5}1\d[^0]00$/';

        // Внимание "Р" - это символ в русской/украинской раскладке
        return ($location->NP && 'Р' !== $location->NP)
            || (preg_match($region_pattern, $location->TE))
            || (preg_match($district_pattern, $location->TE))
            || (in_array($location->TE, $this->exeptions));
    }
}
