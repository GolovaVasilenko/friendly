<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCollectionToCatItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('catalog_item_translations', function (Blueprint $table) {
            $table->string('collection', 255)->nullable();
        });
        Schema::table('catalog_items', function (Blueprint $table) {
            $table->integer('position')->default(0);
        });
        Schema::table('catalogs', function (Blueprint $table) {
            $table->integer('position')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('catalog_item_translations', function (Blueprint $table) {
            Schema::drop('collection');
        });
        Schema::table('catalog_items', function (Blueprint $table) {
            Schema::drop('position');
        });
        Schema::table('catalogs', function (Blueprint $table) {
            Schema::drop('position');
        });
    }
}
