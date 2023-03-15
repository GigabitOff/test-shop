<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMailboxEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mailbox_emails', function (Blueprint $table) {
            $table->id();
            $table->string('uid')->nullable();
            $table->foreignId('customer_id')->constrained('users')
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('popup_id')->constrained('popups')->nullable()
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->unsignedBigInteger('department_id')->nullable();
            $table->boolean('inout')->default(0);
            $table->longText('body')->nullable();
            $table->dateTime('dispatch_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mailbox_emails');
    }
}
