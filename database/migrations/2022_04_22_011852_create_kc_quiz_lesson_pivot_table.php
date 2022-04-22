<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kc_question_lesson', function (Blueprint $table) {

            $table->unsignedBigInteger('kc_id')->index()->nullable();
            $table->foreign('kc_id')->references('id')->on('kcs');

            $table->unsignedBigInteger('question_id')->index()->nullable();
            $table->foreign('question_id')->references('id')->on('quiz_questions');

            $table->unsignedBigInteger('lesson_id')->index()->nullable();
            $table->foreign('lesson_id')->references('id')->on('lessons');

            $table->primary(['kc_id', 'question_id', 'lesson_id']);

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
        Schema::dropIfExists('kc_question_lesson');
    }
};
