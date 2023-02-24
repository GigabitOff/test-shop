<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_id')->default(0);
            $table->string('key')->unique();
            $table->string('category')->nullable();
            $table->string('category_phone')->nullable();
            $table->string('status_phone')->nullable();
            $table->string('display_name')->nullable();
            $table->text('value')->nullable();
            $table->text('details')->nullable()->default(null);
            $table->string('type')->nullable();
            $table->string('lang')->nullable();
            $table->longtext('json')->nullable();
            $table->integer('order')->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
