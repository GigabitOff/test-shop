<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateConterpartyFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('counterparty_forms', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->timestamps();
        });

        $forms[1] = ['name'=> 'ООО'];
        $forms[2] = ['name'=> 'ФЛП'];
        $forms[3] = ['name'=> 'ЧП'];
        $forms[4] = ['name'=> 'ПК'];
        $forms[5] = ['name'=> 'ОДО'];
        $forms[6] = ['name' => 'ПО'];
        $forms[7] = ['name' => 'КТ'];
        $forms[7] = ['name' => 'АО'];
        foreach ($forms as $key => $value) {
            # code...
            DB::table('counterparty_forms')->insert($value);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('counterparty_forms');
    }
}
