<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePageLocationTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_location_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_location_id')->constrained('page_locations')
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('locale')->index();
            $table->string('title')->nullable();

            $table->unique(['locale', 'page_location_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('page_location_translations');
    }
}
