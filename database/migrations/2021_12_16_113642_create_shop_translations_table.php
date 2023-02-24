<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_translations', function (Blueprint $table) {
            $table->id();
            $table->biginteger('shop_id')->unsigned();
            $table->string('locale')->index();
            $table->string('img')->nullable();
            $table->string('title')->nullable();
            $table->string('h1')->nullable();
            $table->text('description')->nullable();
            $table->text('body')->nullable();

            $table->unique(['shop_id', 'locale']);
            $table->foreign('shop_id')->references('id')
                    ->on('shops')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shop_translations');
    }
}
