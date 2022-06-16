<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('status_id');
            $table->foreign('status_id')->references('id')->on('ticket_statuses');

            $table->unsignedBigInteger('department_id');
            $table->foreign('department_id')->references('id')->on('ticket_departments');

            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->unsignedInteger('agent_id');
            $table->foreign('agent_id')->references('id')->on('users');

            $table->longText('description');


            $table->timestamp('completed_at')->nullable();



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
        Schema::dropIfExists('tickets');
    }
}
