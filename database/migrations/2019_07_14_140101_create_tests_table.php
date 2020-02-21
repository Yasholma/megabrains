<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_tests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('course_id');
            $table->foreign('course_id')->references('id')->on('courses');
            $table->string('type', 100);
            $table->string('time', 100);
            $table->boolean('published')->default(0);
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
        Schema::dropIfExists('course_tests');
    }
}
