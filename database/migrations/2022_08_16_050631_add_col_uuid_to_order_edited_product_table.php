<?php

use App\Models\OrderEdited;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColUuidToOrderEditedProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        OrderEdited::query()->delete();
        Schema::table('order_edited_product', function (Blueprint $table) {
            $table->uuid('uuid')->index()->after('order_edited_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_edited_product', function (Blueprint $table) {
            $table->dropColumn('uuid');
        });
    }
}
