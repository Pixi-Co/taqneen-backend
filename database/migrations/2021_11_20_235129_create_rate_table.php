<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     *  
     */
    public function up()
    {
        Schema::create('sub_trainer_rate', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('trainer_id');
            $table->string('ip');
            $table->string('comment')->nullable();
            $table->date('date')->nullable();
            $table->integer('rate');
            
            $table->foreign('trainer_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('sub_trainer_rate');
    }
}
