<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilterAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filter_attributes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('filter_id')->constrained('filters')
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('attribute_id')->default(0)->constrained('filters')
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('column_product')->nullable();
            $table->string('order_type')->nullable();
            $table->string('show_type')->nullable();
            $table->string('show_method')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('basic')->default(false);
            $table->boolean('status')->default(true);
            $table->boolean('collapsed')->default(true);
            $table->boolean('show_title')->default(false);
            $table->boolean('expanded_list')->default(false);
            $table->boolean('search')->default(false);
            $table->boolean('registered_user')->default(true);
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
        Schema::dropIfExists('filter_attributes');
    }
}
