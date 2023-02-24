<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColsToChatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('chats', function (Blueprint $table) {
            $table->after('customer_id', function (Blueprint $table){
                $table->foreignId('department_id')->nullable()
                    ->constrained('departments')->nullOnDelete()->cascadeOnUpdate();
                $table->foreignId('manager_id')->nullable()
                    ->constrained('users')->nullOnDelete()->cascadeOnUpdate();

                $table->string('fio')->nullable();
                $table->string('phone', 25)->nullable();
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
        Schema::table('chats', function (Blueprint $table) {
            $table->dropConstrainedForeignId('department_id');
            $table->dropConstrainedForeignId('manager_id');
            $table->dropColumn('fio');
            $table->dropColumn('phone');
        });
    }
}
