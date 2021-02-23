<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sliders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type', 100);
            $table->string('url', 150)->nullable();
            $table->timestamps();
        });

        Schema::create('slider_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('slider_id');
            $table->string('locale')->index();
            $table->string('title', 255)->nullable();
            $table->string('subtitle', 255)->nullable();
            $table->string('text_link', 150)->nullable();
        });

        Schema::table('slider_translations', function (Blueprint $table) {
            $table->foreign('slider_id')
                ->references('id')
                ->on('sliders')
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
        Schema::dropIfExists('slider_translations');
        Schema::dropIfExists('sliders');
    }
}
