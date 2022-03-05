<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddExpireClassTypeIdsToTransactionSellLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transaction_sell_lines', function (Blueprint $table) {
            $table->enum('is_expire', ['0', '1'])->default('0');
            $table->unsignedBigInteger('class_type_id')->nullable();
            $table->unsignedBigInteger('session_id')->nullable();

            $table->foreign("class_type_id")->references('id')->on('sub_class_type')->onDelete('cascade');
            $table->foreign("session_id")->references('id')->on('sub_session')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transaction_sell_lines', function (Blueprint $table) {
            //
        });
    }
}
