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

            $table->unsignedInteger('agent_id')->nullable();
            $table->foreign('agent_id')->references('id')->on('users');

            $table->unsignedInteger('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users');


            $table->unsignedBigInteger('priority_id');
            $table->foreign('priority_id')->references('id')->on('ticket_priorities');

            $table->string('client_email')->nullable();
            $table->string('computer_num')->nullable();
            $table->string('client_name')->nullable();

            $table->longText('description');
            $table->string('file')->nullable();

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
