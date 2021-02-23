<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRubricsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rubrics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('slug', 255);
            $table->timestamps();
        });

        Schema::create('rubric_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('rubric_id');
            $table->string('locale')->index();
            $table->string('title', 255);
            $table->text('description')->nullable();
            $table->string('meta_title', 255)->nullable();
            $table->text('meta_description')->nullable();
        });

        Schema::table('rubric_translations', function (Blueprint $table) {
            $table->foreign('rubric_id')->references('id')->on('rubrics')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rubric_translations');
        Schema::dropIfExists('rubrics');
    }
}
