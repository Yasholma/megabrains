<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('student_id');
            $table->foreign('student_id')->references('id')->on('students');
            $table->longText('picture');
            $table->string('gender', 6);
            $table->string('phone', 16);
            $table->integer('country_id');
            $table->foreign('country_id')->references('id')->on('countries');
            $table->longText('address');
//            $table->integer('state_id');
//            $table->integer('city_id');
//            $table->integer('postal_code');
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
        Schema::dropIfExists('student_profiles');
    }
}
