<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemberMeasurementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_member_measurement', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('member_id');
            $table->unsignedBigInteger('measurement_id');
            $table->integer('result');
            $table->date('date');
            $table->timestamps();

            $table->foreign('member_id')->references('id')->on('contacts')->onDelete('cascade');
            $table->foreign('measurement_id')->references('id')->on('sub_measurement')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('member_measurement');
    }
}
