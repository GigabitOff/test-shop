<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('review_translations', function (Blueprint $table) {
            $table->id();
            $table->biginteger('review_id')->unsigned();
            $table->string('locale')->index();
            $table->string('title')->nullable();
            $table->string('fio')->nullable();
            $table->text('body')->nullable();

            $table->unique(['review_id', 'locale']);
            $table->foreign('review_id')->references('id')
                    ->on('reviews')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('review_translations');
    }
}
