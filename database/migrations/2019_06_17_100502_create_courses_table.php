<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('category_id');
            $table->integer('tutor_id');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('tutor_id')->references('id')->on('admins');
            $table->string('title')->unique();
            $table->string('sub_title');
            $table->decimal('price', 9, '2')->nullable();
            $table->longText('imagePath');
            $table->integer('offer')->default(1); // 1 for Free | 2 for Premium | 3 for Unlimited (User) Account
            $table->longText('description');
            $table->tinyInteger('active')->default(0); // 0 for inactive | 1 for active
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
        Schema::dropIfExists('courses');
    }
}
