<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColWholesaleToProductUserPriceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_user_price', function (Blueprint $table) {
            $table->after('init', function (Blueprint $table) {
                $table->float('retail')->default(0);
                $table->float('wholesale')->default(0);
                $table->float('calc_retail')->default(0);
                $table->float('calc_wholesale')->default(0);
            });
        });

        Schema::table('product_user_price', function (Blueprint $table) {
            $table->dropColumn('init');
            $table->dropColumn('current');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_user_price', function (Blueprint $table) {
            $table->after('retail', function (Blueprint $table) {
                $table->float('init')->default(0);
                $table->float('current')->default(0);
            });
        });

        Schema::table('product_user_price', function (Blueprint $table) {
            $table->dropColumn('retail');
            $table->dropColumn('wholesale');
            $table->dropColumn('calc_retail');
            $table->dropColumn('calc_wholesale');
        });
    }
}
