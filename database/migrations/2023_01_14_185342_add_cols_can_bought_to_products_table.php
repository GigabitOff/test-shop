<?php

use App\Models\Product;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;

class AddColsCanBoughtToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->after('availability_supplier', function (Blueprint $table) {
                $table->boolean('can_bought_guest')->index()->default(false);
                $table->boolean('can_bought_auth')->index()->default(false);
            });
        });

        Product::query()
            ->orderBy('id')
            ->chunk(100, function (Collection $chunk) {
                $chunk
                    ->each(function (Product $product) {
                        $product->can_bought_guest =
                            $product->availability != Product::AVAILABILITY_OUT_OF_STOCK;
                        $product->can_bought_auth =
                            $product->on_backorder
                            || ($product->show_stock && $product->stock > 0)
                            || (!$product->show_stock && $product->availability != Product::AVAILABILITY_OUT_OF_STOCK);

                        $product->save();
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
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('can_bought_guest');
            $table->dropColumn('can_bought_auth');
        });
    }
}
