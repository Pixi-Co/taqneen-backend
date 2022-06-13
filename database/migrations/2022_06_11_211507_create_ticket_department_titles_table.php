<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketDepartmentTitlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_department_titles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('ticket_department_id');
            $table->foreign('ticket_department_id')->references('id')->on('ticket_departments')->onDelete('cascade');
            $table->unsignedBigInteger('ticket_priority_id');
            $table->foreign('ticket_priority_id')->references('id')->on('ticket_priorities')->onDelete(null);
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
        Schema::dropIfExists('ticket_department_titles');
    }
}
