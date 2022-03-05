<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSessionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void  
     */
    public function up()
    { 
        Schema::create('sub_session', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('description')->nullable();
            $table->integer('group_number')->nullable();
            $table->date('date_from')->nullable();
            $table->date('date_to')->nullable();
            $table->time('sat_from')->nullable();
            $table->time('sat_to')->nullable();
            $table->time('sun_from')->nullable();
            $table->time('sun_to')->nullable();
            $table->time('mon_from')->nullable();
            $table->time('mon_to')->nullable();
            $table->time('tue_from')->nullable();
            $table->time('tue_to')->nullable();
            $table->time('wed_from')->nullable();
            $table->time('wed_to')->nullable();
            $table->time('thu_from')->nullable();
            $table->time('thu_to')->nullable();
            $table->time('fri_from')->nullable();
            $table->time('fri_to')->nullable(); 
            $table->string('repeat')->nullable(); 
            $table->unsignedBigInteger('class_type_id');
            $table->unsignedInteger('trainer_id');
            $table->unsignedInteger('business_id');
            $table->unsignedInteger("customer_group_id")->nullable();

            $table->foreign('class_type_id')->references('id')->on('sub_class_type')->onDelete('cascade');
            $table->foreign('trainer_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('business_id')->references('id')->on('business')->onDelete('cascade');
            $table->foreign("customer_group_id")->references('id')->on('customer_groups')->onDelete('cascade');
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
        Schema::dropIfExists('session');
    }
}
