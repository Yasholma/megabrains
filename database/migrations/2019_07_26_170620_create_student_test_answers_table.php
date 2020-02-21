<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentTestAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_test_answers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('student_id');
            $table->foreign('student_id')->references('id')->on('students');
            $table->integer('test_id');
            $table->foreign('test_id')->references('id')->on('course_tests');
            $table->integer('question_id');
            $table->foreign('question_id')->references('id')->on('questions');
            $table->integer('answer');
            $table->foreign('answer')->references('id')->on('question_options');
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
        Schema::dropIfExists('student_test_answers');
    }
}
