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
        Schema::create('kc_lessons', function (Blueprint $table) {

            $table->unsignedBigInteger('kc_id')->index()->nullable();
            $table->foreign('kc_id')->references('id')->on('kcs')->onDelete('cascade');

            $table->unsignedBigInteger('lesson_id')->index()->nullable();
            $table->foreign('lesson_id')->references('id')->on('lessons')->onDelete('cascade');

            $table->primary(['kc_id', 'lesson_id']);

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
        Schema::dropIfExists('kc_lessons');
    }
};
