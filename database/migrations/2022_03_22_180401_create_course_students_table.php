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
        Schema::create('course_students', function (Blueprint $table) {
            $table->unsignedBigInteger('course_id')->index();
            $table
                ->foreign('course_id')
                ->references('id')
                ->on('courses')
                ->onDelete('cascade');

            $table->unsignedBigInteger('student_id')->index();
            $table
                ->foreign('student_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->primary(['course_id', 'student_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_students');
    }
};
