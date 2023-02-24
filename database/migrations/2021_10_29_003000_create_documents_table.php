<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function(Blueprint $table) {
            $table->id();
            $table->string('id_1c')->nullable();
            $table->foreignId('order_id')->nullable()
                ->constrained('orders')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('counterparty_id')->nullable()
                ->constrained('counterparties')->cascadeOnUpdate()->cascadeOnDelete();
            $table->unsignedInteger('status');
            $table->unsignedInteger('type');
            $table->string('registry_no')->nullable();
            $table->dateTime('date_at')->nullable();
            $table->string('related_id')->nullable(); // Идентификатор расходной накладной, по которой создан Акт рекламации или Возвратная накладная
            $table->dateTime('related_date')->nullable(); // Дата расходной накладной, по которой создан Акт рекламации или Возвратная накладная
            $table->string('customer_doc_id')->nullable();  // Номер документа, введенный пользователем при создании возвратной накладной на сайте
            $table->dateTime('customer_doc_date')->nullable(); // Дата документа, введенная пользователем при создании возвратной накладной на сайте
            $table->string('counterparty_okpo')->nullable();  // окпо контрагента /
            $table->string('delivery_address_id')->nullable();   // ID элемента справочника адреса
            $table->string('storage_id_1c')->nullable();    // Для расходной накладной - id склада отгрузки, для других документов - id склада приема (указывает пользователь при создании)
            $table->double('total_with_nds')->default(0);
            $table->text('response')->nullable(); //  "Response text..."
            $table->string('filename')->nullable();
            $table->string('path')->nullable();
            $table->double('debit')->nullable();
            $table->dateTime('debit_date_at')->nullable();
            $table->double('credit')->nullable();
            $table->dateTime('credit_date_at')->nullable();
            $table->double('debt')->nullable();
            $table->boolean('transferred')->default(false);
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
        Schema::dropIfExists('documents');
    }
}
