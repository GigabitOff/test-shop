<?php

namespace Database\Seeders;

use App\Models\Counterparty;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->seedManagers();

        $step = DatabaseSeeder::STEP;
        $params = DatabaseSeeder::getSeedParameters();
        $qty = $params['customers'];

        $output = new ConsoleOutput();
        $progress = new ProgressBar($output, $qty);
        $output->writeln('Seed Customers qty:' . $qty) ;
        $progress->start();

        while ($qty > 0) {
            $chunk = $qty >= $step ? $step : $qty;
            $qty -= $chunk;

            User::factory()->count($chunk)->create()
                ->each(function ($user) {
                    $user->assignRole('customer');
                });

            $progress->advance($chunk);
        }

        $progress->finish();
        $output->writeln(PHP_EOL) ;
    }

    protected function seedManagers()
    {
        if (!User::wherePhone('380123456789')->first()) {
            $user = new User(array(
                'name' => 'admin',
                'email' => 'admin@mail.com',
                'email_verified_at' => '2020-01-01',
                'phone' => '380123456789',
                'phone_verified_at' => '2020-01-01',
                'password' => Hash::make('password'),
            ));
            $user->timestamps = false;
            $user->save();

            $user->assignRole('admin');
        }

        if (!User::wherePhone('380123123123')->first()) {
            $user = new User(array(
                'name' => 'manager',
                'email' => 'manager@mail.com',
                'email_verified_at' => '2020-01-01',
                'phone' => '380123123123',
                'phone_verified_at' => '2020-01-01',
                'password' => Hash::make('password'),
            ));
            $user->timestamps = false;
            $user->save();

            $user->assignRole('manager');
        }

        if (!User::wherePhone('380126126126')->first()) {
            $user = new User(array(
                'name' => 'headmanager',
                'email' => 'headmanager@mail.com',
                'email_verified_at' => '2020-01-01',
                'phone' => '380126126126',
                'phone_verified_at' => '2020-01-01',
                'password' => Hash::make('password'),
            ));
            $user->timestamps = false;
            $user->save();

            $user->assignRole('head_manager');
        }

        if (!User::wherePhone('380125125125')->first()) {
            $user = new User(array(
                'name' => 'director',
                'email' => 'dirtector@mail.com',
                'email_verified_at' => '2020-01-01',
                'phone' => '380125125125',
                'phone_verified_at' => '2020-01-01',
                'password' => Hash::make('password'),
            ));
            $user->timestamps = false;
            $user->save();

            $user->assignRole('director');
        }

        if (!User::wherePhone('380124124124')->first()) {
            $user = new User(array(
                'name' => 'apitester',
                'email' => 'testapi@mail.com',
                'email_verified_at' => '2020-01-01',
                'phone' => '380124124124',
                'phone_verified_at' => '2020-01-01',
                'password' => Hash::make('password'),
            ));
            $user->timestamps = false;
            $user->save();

            $user->assignRole('api_manager');
        }

        
    }
}
