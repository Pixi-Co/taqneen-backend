<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShippingFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipping_fees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('amount', 8,2);
            $table->unsignedBigInteger('shipping_company_id');

            $table->unsignedBigInteger('area_id')->nullable();
            $table->timestamps();

            $table->foreign('shipping_company_id')
                    ->references('id')
                    ->on('shipping_companies')
                    ->onDelete('cascade');

            $table->foreign('area_id')
                    ->references('id')
                    ->on('areas')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shipping_fees');
    }
}
