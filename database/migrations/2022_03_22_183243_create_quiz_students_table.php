<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_students', function (Blueprint $table) {
            $table->unsignedBigInteger('quiz_id')->index();
            $table
                ->foreign('quiz_id')
                ->references('id')
                ->on('quizzes')
                ->onDelete('cascade');

            $table->unsignedBigInteger('student_id')->index();
            $table
                ->foreign('student_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->primary(['quiz_id', 'student_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quiz_students');
    }
};
