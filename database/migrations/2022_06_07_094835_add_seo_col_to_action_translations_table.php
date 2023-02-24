<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSeoColToActionTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('action_translations', function (Blueprint $table) {
            $table->string('seo_description')->after('body')->nullable();
            $table->string('seo_url')->after('seo_description')->nullable();
            $table->string('seo_h1')->after('seo_url')->nullable();
            $table->string('seo_h2')->after('seo_h1')->nullable();
            $table->string('seo_h3')->after('seo_h2')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('action_translations', function (Blueprint $table) {
            $table->dropColumn('seo_description');
            $table->dropColumn('seo_url');
            $table->dropColumn('seo_h1');
            $table->dropColumn('seo_h2');
            $table->dropColumn('seo_h3');
        });
    }
}
