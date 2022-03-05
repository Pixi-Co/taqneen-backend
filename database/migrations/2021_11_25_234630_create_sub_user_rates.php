<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubUserRates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_user_rates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ip')->nullable();
            $table->unsignedInteger('user_id')->nullable(); 
            $table->unsignedBigInteger('rate_id');
            $table->integer('rate');
            $table->string('comment')->nullable();

            $table->foreign("user_id")->references('id')->on('users')->onDelete('cascade');
            $table->foreign("rate_id")->references('id')->on('sub_rates')->onDelete('cascade');
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
        Schema::dropIfExists('sub_user_rates');
    }
}
