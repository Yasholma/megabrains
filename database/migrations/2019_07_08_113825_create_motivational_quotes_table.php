<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMotivationalQuotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('motivational_quotes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('quotes', '200')->nullable();
            $table->integer('motivations_id');
            $table->foreign('motivations_id')->references('motivations')->on('id');
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
        Schema::dropIfExists('motivational_quotes');
    }
}
