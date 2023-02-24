<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCounterpartyUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('counterparty_user', function (Blueprint $table) {
            $table->foreignId('counterparty_id')->constrained('counterparties')
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('user_id')->constrained('users')
                ->cascadeOnDelete()->cascadeOnUpdate();

            $table->unique(['counterparty_id', 'user_id']);
        });

        User::query()
            ->chunk(100, function($users){
                foreach ($users as $user) {
                    if ($user->counterparty) {
                        $user->counterparties()->attach($user->counterparty_id);
                    }
                }
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('counterparty_user');
    }
}
