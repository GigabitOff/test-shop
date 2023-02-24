<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('koatuu', 10)->nullable(false)->unique();
            $table->string('type', 5)->nullable();
            $table->boolean('valid')->default(false);
            $table->string('name_uk');
            $table->string('district_uk')->nullable();
            $table->string('region_uk')->nullable();

            $table->index('type');
            $table->index('valid');
            $table->index('name_uk');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cities');
    }
}
