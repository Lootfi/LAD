<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_response', function (Blueprint $table) {
            $table->unsignedBigInteger('question_id')->index();
            $table
                ->foreign('question_id')
                ->references('id')
                ->on('quiz_questions')
                ->onDelete('cascade');
            $table->unsignedBigInteger('student_id')->index();
            $table
                ->foreign('student_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->unsignedBigInteger('answer_id')->index();
            $table
                ->foreign('answer_id')
                ->references('id')
                ->on('quiz_answers')
                ->onDelete('cascade');

            $table->primary(['question_id', 'student_id', 'answer_id']);

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
        Schema::dropIfExists('quiz_response');
    }
};
