<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTranslationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('translation', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('key');
            $table->bigInteger('language_id')->unsigned();
            $table->integer('business_type_id')->unsigned();
            $table->longText('trans');

            
            //$table->foreign('language_id')->references('id')->on('language')->onDelete('cascade'); 
            //$table->foreign('business_type_id')->references('id')->on('business_types')->onDelete('cascade');

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
        Schema::dropIfExists('translation');
    }
}
