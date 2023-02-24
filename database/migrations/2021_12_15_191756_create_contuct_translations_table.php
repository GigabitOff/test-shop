<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContuctTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('contuct_translations', function (Blueprint $table) {
            $table->id();
            $table->biginteger('contuct_id')->unsigned();
            $table->string('locale')->index();
            $table->string('title')->nullable();
            $table->string('name')->nullable();
            $table->string('fio')->nullable();
            $table->string('img')->nullable();
            $table->string('posada')->nullable();
            $table->text('description')->nullable();
            $table->text('body')->nullable();
            $table->string('h1')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();

            $table->unique(['contuct_id', 'locale']);
            $table->foreign('contuct_id')->references('id')
                    ->on('contucts')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contuct_translations');
    }
}
