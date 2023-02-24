<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeUserIdDefaultToDiscountCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('discount_category');

        Schema::create('discount_category', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->constrained('users')
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('category_id')->nullable()->constrained('categories')
            ->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('discount_id')->constrained('discounts')
            ->cascadeOnUpdate()->cascadeOnDelete();
            $table->float('discount')->default(0);

           // $table->unique(['user_id', 'discount_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
