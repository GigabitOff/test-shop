<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_translations', function (Blueprint $table) {
            $table->id();
            $table->biginteger('menu_id')->unsigned();
            $table->string('locale')->index();
            $table->string('url')->nullable();
            $table->string('img')->nullable();
            $table->text('gallery')->nullable();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->text('body')->nullable();
            $table->string('h1')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();

            $table->unique(['menu_id', 'locale']);
            $table->foreign('menu_id')->references('id')
                    ->on('menus')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu_translations');
    }
}
