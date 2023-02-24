<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopCityTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_city_translations', function (Blueprint $table) {
            $table->id();
            $table->biginteger('city_id')->unsigned();
            $table->string('locale')->index();
            $table->string('title')->nullable();
            $table->string('img')->nullable();
            $table->text('description')->nullable();
            $table->text('body')->nullable();
            $table->string('h1')->nullable();
            $table->string('seo_url')->nullable();
            $table->string('seo_h1')->nullable();
            $table->string('seo_h2')->nullable();
            $table->string('seo_h3')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('seo_canonical')->nullable();

            $table->unique(['city_id', 'locale']);
            $table->foreign('city_id')->references('id')
                ->on('shop_cities')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shop_city_translations');
    }
}
