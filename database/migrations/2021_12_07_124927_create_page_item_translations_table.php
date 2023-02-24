<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePageItemTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_item_translations', function (Blueprint $table) {
            $table->id();
            $table->biginteger('page_item__id')->unsigned();
            $table->string('locale')->index();
            $table->string('title')->nullable();
            $table->string('img')->nullable();
            $table->text('description')->nullable();
            $table->text('body')->nullable();
            $table->text('value')->nullable();
            $table->string('url')->nullable();
            $table->string('h1')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();

            $table->unique(['page_item__id', 'locale']);
            $table->foreign('page_item__id')->references('id')
                    ->on('page_items')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('page_item_translations');
    }
}
