<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColScheduleLangWhoursLangToShopTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shop_translations', function (Blueprint $table) {
            $table->string('schedule_lang')->after('title')->nullable();
            $table->string('whours_lang')->after('schedule_lang')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shop_translations', function (Blueprint $table) {
            $table->dropColumn('schedule_lang');
            $table->dropColumn('whours_lang');

        });
    }
}
