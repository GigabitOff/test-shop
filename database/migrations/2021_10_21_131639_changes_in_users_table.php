<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangesInUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->after('profile_photo_path', function (Blueprint $table) {
                $table->foreignId('city_id')->nullable()
                    ->constrained()->nullOnDelete()->cascadeOnUpdate();
                $table->foreignId('manager_id')->nullable()
                    ->constrained('users')->nullOnDelete();
                $table->string('login')->nullable();
                $table->string('phone')->nullable();
                $table->date('phone_verified_at')->nullable();
                $table->date('password_confirmed_at')->nullable();
                $table->date('birth_date')->nullable();
                $table->string('position')->nullable();     // Должность
                $table->boolean('is_founder')->default(false);
                $table->boolean('is_admin')->default(false);
                $table->unsignedInteger('customer_type')->default(0);
                $table->boolean('is_active')->default(true);        // Статус активен/удален
                $table->string('id_1c')->nullable();
                $table->string('lang')->nullable();
                $table->boolean('can_use_cashback')->default(false);
                $table->double('bonus_available')->default(0);
                $table->double('bonus_accumulated')->default(0);
                $table->string('google_id')->nullable();
                $table->string('avatar_url')->nullable();
                $table->unsignedBigInteger('admin_group_id')->nullable();
                $table->unsignedBigInteger('blocked_ip_id')->default(0);
                $table->boolean('moderated')->default(false);
                $table->unsignedInteger('viewed_type')->default(0);
                $table->string('recovery_code')->nullable();
                $table->boolean('legal_deleted')->default(false);
                $table->boolean('notify')->default(false);
                $table->boolean('transferred')->default(false);
                $table->softDeletes();
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
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['city_id']);
            $table->dropColumn('city_id');
            $table->dropForeign(['manager_id']);
            $table->dropColumn('manager_id');
            $table->dropForeign(['counterparty_id']);
            $table->dropColumn('counterparty_id');
            $table->dropColumn('position');
            $table->dropColumn('phone');
            $table->dropColumn('phone_verified_at');
            $table->dropColumn('birth_date');
            $table->dropColumn('is_active');
            $table->dropColumn('id_1c');
        });
    }
}
