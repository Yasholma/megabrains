<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('admin_id');
            $table->foreign('admin_id')
                ->references('id')
                ->on('admins');
            $table->longText('picture');
            $table->string('gender', 6);
            $table->string('phone', 16);
            $table->integer('country_id');
            $table->foreign('country_id')
                ->references('id')
                ->on('countries');
            $table->longText('address');
            $table->longText('biography')->nullable();
            $table->longText('facebook')->nullable();
            $table->longText('twitter')->nullable();
            $table->longText('linkedin')->nullable();
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
        Schema::dropIfExists('admin_profiles');
    }
}
