<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCatalogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalogs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('parent_id')->default(0);
            $table->string('slug', 255)->index();
            $table->timestamps();
        });

        Schema::create('catalog_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('catalog_id');
            $table->string('locale')->index();
            $table->string('name', 255);
            $table->text('description')->nullable();
            $table->string('m_title', 255)->nullable();
            $table->text('m_description')->nullable();
        });

        Schema::table('catalog_translations', function (Blueprint $table) {
            $table->foreign('catalog_id')->references('id')
                ->on('catalogs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('catalog_translations');
        Schema::dropIfExists('catalogs');
    }
}
