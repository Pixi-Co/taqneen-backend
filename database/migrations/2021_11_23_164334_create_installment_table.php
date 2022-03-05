<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstallmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void 
     */
    public function up()
    {
        Schema::create('installments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('business_id');
            $table->unsignedInteger('transaction_id');
            $table->unsignedInteger('contact_id');
            $table->unsignedInteger('user_id');
            $table->float('value');
            $table->date('date');
            $table->string('notes')->nullable();
            $table->enum('paid', ['0', '1'])->default('0');
            $table->timestamps();

            $table->foreign("business_id")->references('id')->on('business')->onDelete('cascade');
            $table->foreign("transaction_id")->references('id')->on('transactions')->onDelete('cascade');
            $table->foreign("contact_id")->references('id')->on('contacts')->onDelete('cascade');
            $table->foreign("user_id")->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('installments');
    }
}
