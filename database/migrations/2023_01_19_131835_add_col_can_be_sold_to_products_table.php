<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColCanBeSoldToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->boolean('can_be_sold')->default(0)->after('can_bought_auth');
            $table->dropColumn('can_bought_guest');
            $table->dropColumn('can_bought_auth');
        });

        DB::table('products')
            ->update(['can_be_sold' => DB::raw('`on_backorder` > 0 OR `stock` > 0')] );

        DB::table('products')
            ->where('on_backorder', 1)
            ->where('availability', 0)
            ->update(['availability' => 1] );

        DB::table('products')
            ->where('on_backorder', 0)
            ->where('stock', '>', 0)
            ->where('availability', 0)
            ->update(['availability' => 1] );

        DB::table('products')
            ->where('on_backorder', 0)
            ->where('stock', 0)
            ->update(['availability' => 0] );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->boolean('can_bought_auth')->default(0)->after('can_be_sold');
            $table->boolean('can_bought_guest')->default(0)->after('can_be_sold');
            $table->dropColumn('can_be_sold');
        });
    }
}
