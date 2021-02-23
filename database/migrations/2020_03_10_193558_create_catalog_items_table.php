<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCatalogItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalog_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('slug', 255)->index();
            $table->string('cdate', 50)->nullable();
            $table->string('size', 50)->nullable();
            $table->boolean('display_home')->default(0);
            $table->timestamps();
        });

        Schema::create('catalog_item_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('catalog_item_id');
            $table->string('locale')->index();
            $table->string('name', 255);
            $table->text('description')->nullable();
            $table->string('workmanship', 150)->nullable();
            $table->string('execution_technique', 150)->nullable();
            $table->string('m_title', 250)->nullable();
            $table->text('m_description')->nullable();
        });

        Schema::table('catalog_item_translations', function (Blueprint $table) {
            $table->foreign('catalog_item_id')->references('id')
                ->on('catalog_items')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('catalog_item_translations');
        Schema::dropIfExists('catalog_items');
    }
}
