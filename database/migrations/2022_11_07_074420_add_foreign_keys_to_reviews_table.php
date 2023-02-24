<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('reviews')->delete();

        Schema::table('reviews', function (Blueprint $table) {
            $table->dropColumn('user_id');
            $table->dropColumn('user_confirm');
            $table->dropColumn('product_id');
        });

        Schema::table('reviews', function (Blueprint $table) {
            $table->after('id', function (Blueprint $table) {
                $table->foreignId('product_id')->constrained('products')
                    ->cascadeOnUpdate()->cascadeOnDelete();
                $table->foreignId('user_id')->constrained('users')
                    ->cascadeOnUpdate()->cascadeOnDelete();
                $table->foreignId('user_confirm')->constrained('users')
                    ->cascadeOnUpdate()->cascadeOnDelete();
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('reviews')->delete();

        Schema::table('reviews', function (Blueprint $table) {
            $table->dropConstrainedForeignId('product_id');
            $table->dropConstrainedForeignId('user_id');
            $table->dropConstrainedForeignId('user_confirm');
        });

        Schema::table('reviews', function (Blueprint $table) {
            $table->after('id', function (Blueprint $table){
                $table->integer('product_id')->default(0);
                $table->integer('user_id')->default(0);
                $table->integer('user_confirm')->default(0);
            });
        });
    }
}
