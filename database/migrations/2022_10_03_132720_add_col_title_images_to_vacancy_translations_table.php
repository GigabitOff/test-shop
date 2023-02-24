<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColTitleImagesToVacancyTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vacancy_translations', function (Blueprint $table) {
            //
            $table->string('title_image_1')->after('title')->nullable();
            $table->string('title_image_2')->after('title_image_1')->nullable();
            $table->string('title_image_3')->after('title_image_2')->nullable();
            $table->string('title_image_4')->after('title_image_3')->nullable();

            $table->string('text_image_1')->after('title_image_4')->nullable();
            $table->string('text_image_2')->after('text_image_1')->nullable();
            $table->string('text_image_3')->after('text_image_2')->nullable();
            $table->string('text_image_4')->after('text_image_3')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vacancy_translations', function (Blueprint $table) {
            //
            $table->dropColumn('title_image_1');
            $table->dropColumn('title_image_2');
            $table->dropColumn('title_image_3');
            $table->dropColumn('title_image_4');

            $table->dropColumn('text_image_1');
            $table->dropColumn('text_image_2');
            $table->dropColumn('text_image_3');
            $table->dropColumn('text_image_4');
        });
    }
}
