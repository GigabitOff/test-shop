<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePageLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_locations', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->foreignId('page_id')->constrained('pages')
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('banner_id')->nullable()->constrained('banners')
                ->cascadeOnUpdate()->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('page_locations');
    }
}
