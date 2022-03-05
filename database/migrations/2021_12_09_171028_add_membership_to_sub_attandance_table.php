<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMembershipToSubAttandanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sub_attandance', function (Blueprint $table) {
            $table->unsignedInteger("membership_id")->nullable();

            $table->foreign("membership_id")->references("id")->on("transaction_sell_lines")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sub_attandance', function (Blueprint $table) {
            //
        });
    }
}
