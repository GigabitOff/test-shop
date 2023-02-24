<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVacancyTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->down();

        Schema::create('vacancy_translations', function (Blueprint $table) {
            $table->id();
            $table->biginteger('vacancy_id')->unsigned();
            $table->string('locale')->index();
            $table->string('img')->nullable();
            $table->string('title')->nullable();
            $table->string('employment_lang')->nullable();
            $table->string('schedule_lang')->nullable();
            $table->string('whours_lang')->nullable();
            $table->string('img_small')->nullable();
            $table->string('h1')->nullable();
            $table->string('seo_url')->nullable();
            $table->string('seo_h1')->nullable();
            $table->string('seo_h2')->nullable();
            $table->string('seo_h3')->nullable();
            $table->text('description')->nullable();
            $table->text('body')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();

            $table->unique(['vacancy_id', 'locale']);
            $table->foreign('vacancy_id')->references('id')
                    ->on('vacancies')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::dropIfExists('vacancy_translations');
    }
}
