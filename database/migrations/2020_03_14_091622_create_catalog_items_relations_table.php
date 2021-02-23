<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCatalogItemsRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalog_items_relations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('catalog_id')->index();
            $table->unsignedBigInteger('catalog_item_id')->index();
            $table->timestamps();

            $table->foreign('catalog_id')
                ->references('id')->on('catalogs')
                ->onDelete('cascade');

            $table->foreign('catalog_item_id')
                ->references('id')->on('catalog_items')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('catalog_items_relations', function (Blueprint $table) {
            $table->dropForeign('catalog_items_relations_catalog_id_foreign');
            $table->dropForeign('catalog_items_relations_catalog_item_id_foreign');
        });
        Schema::dropIfExists('catalog_items_relations');
    }
}
