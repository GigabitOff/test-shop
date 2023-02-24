<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColsSeoToPageItemTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('page_item_translations', function (Blueprint $table) {
            $table->string('seo_url')->nullable();
            $table->string('seo_h1')->nullable();
            $table->string('seo_h2')->nullable();
            $table->string('seo_h3')->nullable();
            $table->text('seo_canonical')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('page_item_translations', function (Blueprint $table) {
            $table->dropColumn('seo_url');
            $table->dropColumn('seo_h1');
            $table->dropColumn('seo_h2');
            $table->dropColumn('seo_h3');
            $table->dropColumn('seo_canonical');
        });
    }
}
