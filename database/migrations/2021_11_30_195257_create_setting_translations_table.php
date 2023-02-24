<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting_translations', function (Blueprint $table) {
            $table->id();
            $table->biginteger('setting_id')->unsigned();
            $table->string('locale')->index();
            $table->string('url')->nullable();
            $table->string('img')->nullable();
            $table->text('value_lang')->nullable();
            $table->text('gallery')->nullable();
            $table->string('title')->nullable();
            $table->text('description')->nullable();

            $table->unique(['setting_id', 'locale']);
            $table->foreign('setting_id')->references('id')
                    ->on('settings')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('setting_translations');
    }
}
