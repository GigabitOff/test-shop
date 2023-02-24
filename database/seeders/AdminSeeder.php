<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->seedManagers();
    }

    protected function seedManagers()
    {
        if (!Admin::wherePhone('380123456789')->first()) {
            $user = new Admin(array(
                'name' => 'admin',
                'email' => 'admin@mail.com',
                'email_verified_at' => '2020-01-01',
                'phone' => '380123456789',
                'password' => Hash::make('admin'),
            ));
            $user->timestamps = false;
            $user->save();

           // $user->assignRole('superadmin');
        }


    }
}
