<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductImportTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_import_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('import_id')
                ->constrained('product_imports')
                ->cascadeOnDelete();
            $table->string('locale')->index();
            $table->string('img')->nullable();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->text('title_description')->nullable();
            $table->longtext('body')->nullable();
            $table->string('seo_decription')->nullable();
            $table->string('seo_url')->nullable();
            $table->string('seo_h1')->nullable();
            $table->string('seo_h2')->nullable();
            $table->string('seo_h3')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('seo_canonical')->nullable();
            $table->text('search_tags')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_import_translations');
    }
}
