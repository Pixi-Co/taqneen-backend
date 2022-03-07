<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaqneenPackage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taqneen_package', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('type');
            $table->string('interval_type');
            $table->integer('interval_number');
            $table->float('from')->nullable();;
            $table->float('to')->nullable();;
            $table->float('price');
            $table->unsignedInteger('service_id');
            $table->unsignedInteger('business_id');

            $table->foreign("service_id")->references("id")->on('categories')->onDelete('cascade');
            $table->foreign("business_id")->references("id")->on('business')->onDelete('cascade');
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
        Schema::dropIfExists('taqneen_package');
    }
}
