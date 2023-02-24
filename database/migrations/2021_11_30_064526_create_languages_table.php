<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->down();
        Schema::create('languages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('lang');
            $table->string('name');
            $table->boolean('status')->default(true);
            $table->boolean('default')->default(false);

        });

        // insert data
        DB::table('languages')->insert(array('lang' => 'uk', 'name'=>'Українська'));
        DB::table('languages')->insert(array('lang' => 'en', 'name'=>'English'));
        DB::table('languages')->insert(array('lang' => 'ru', 'name'=>'Русский'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('languages');
    }
}
