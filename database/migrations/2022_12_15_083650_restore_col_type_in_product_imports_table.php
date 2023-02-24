<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class RestoreColTypeInProductImportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_imports', function (Blueprint $table) {
            $table->string('type')->nullable()->after('id');
        });

        DB::table('product_imports')
            ->update(['type' => 'undefined']);

        Schema::table('product_imports', function (Blueprint $table) {
            $table->string('type')->nullable(false)->index()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_imports', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
}
