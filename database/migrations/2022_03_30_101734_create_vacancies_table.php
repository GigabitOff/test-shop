<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVacanciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->down();
        Schema::create('vacancies', function (Blueprint $table) {
            $table->id();
            $table->biginteger('page_id')->unsigned()->nullable();
            $table->foreignId('city_id')->nullable()->constrained('cities')->cascadeOnDelete();
            $table->integer('order')->default(0);
            $table->string('image')->nullable();
            $table->string('image_small')->nullable();
            $table->string('slug')->unique();
            $table->boolean('status')->default(true);
            $table->string('schedule')->nullable();
            $table->string('whours')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        /*Schema::table(
            'vacancie_translations',
            function (Blueprint $table) {

                $table->dropForeign(['job_id']);
            }
        );
        Schema::dropIfExists('job_translations');
        Schema::dropIfExists('jobs');*/
        Schema::dropIfExists('vacancies');
    }
}
