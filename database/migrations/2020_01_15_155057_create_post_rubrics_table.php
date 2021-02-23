<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostRubricsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_rubrics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('post_id')->index();

            $table->foreign('post_id')
                ->references('id')->on('posts')
                ->onDelete('cascade');

            $table->unsignedBigInteger('rubric_id')->index();

            $table->foreign('rubric_id')
                ->references('id')->on('rubrics')
                ->onDelete('cascade');
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
        Schema::table('post_rubrics', function (Blueprint $table) {
            $table->dropForeign('post_rubrics_post_id_foreign');
            $table->dropForeign('post_rubrics_rubric_id_foreign');
        });
        Schema::dropIfExists('post_rubrics');
    }
}
