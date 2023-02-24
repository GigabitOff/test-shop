<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('type');     // тип сообщения - уникален в пределах пользователя
            $table->string('level');    // уровень сообщения: success, warning, danger ...
            $table->string('event');    // событие которое надо инициировать когда пользователь ответит
            $table->text('message');    // текст сообщения
            $table->text('payload');    // полезная нагрузка для обработчика события
            $table->dateTime('expired_at')->nullable(); // дата окончания
            $table->timestamps();

            $table->unique(['user_id', 'type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_notifications');
    }
}
