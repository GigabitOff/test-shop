<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_translations', function(Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            $table->string('locale')->index();
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->string('measure')->nullable();
            $table->string('country')->nullable(); //Країна виробник
            $table->string('country_registration')->nullable(); //Країна реєстрації бренду
            $table->string('state')->nullable(); //статус
            $table->text('keywords')->nullable(); //ключові слова для товару
            $table->text('comment')->nullable();
            $table->string('seo_decription')->nullable();
            $table->string('seo_url')->nullable();
            $table->string('seo_h1')->nullable();
            $table->string('seo_h2')->nullable();
            $table->string('seo_h3')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('status_product')->nullable(); //статус продукта
            $table->string('manufacturer')->nullable();
            $table->string('seller')->nullable();
            $table->text('search_tags')->nullable();

            $table->unique(['product_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_translations');
    }
}
