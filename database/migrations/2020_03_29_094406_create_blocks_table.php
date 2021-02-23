<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blocks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('page_id');
            $table->string('style_class', 255)->nullable();
            $table->string('style_id', 255)->nullable();
            $table->string('link', 255)->nullable();
            $table->timestamps();
        });

        Schema::create('block_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('block_id');
            $table->string('locale')->index();
            $table->string('title', 255)->nullable();
            $table->string('subtitle', 255)->nullable();
            $table->string('text_link', 255)->nullable();
            $table->text('text')->nullable();
        });

        Schema::table('block_translations', function (Blueprint $table) {
            $table->foreign('block_id')->references('id')->on('blocks')->onDelete('cascade');
        });

        Schema::table('blocks', function (Blueprint $table) {
            $table->foreign('page_id')->references('id')->on('pages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blocks');
    }
}
