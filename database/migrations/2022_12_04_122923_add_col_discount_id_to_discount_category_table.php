<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColDiscountIdToDiscountCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('discount_category', function (Blueprint $table) {

            $table->foreignId('discount_id')->nullable()->after('category_id')
                ->constrained('discounts')
                ->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('discount_category', function (Blueprint $table) {
            $table->dropForeign(['discount_id']);
        });
    }
}
