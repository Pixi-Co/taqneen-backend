<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTriger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

     /*  
     
 
     */
    public function up()
    {
        Schema::create('tr_names', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });
        Schema::create('tr_integrations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });
        Schema::create('tr_names_tags', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('triger_name_id');

            $table->foreign("triger_name_id")->references('id')->on('tr_names')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('tr_trigers', function (Blueprint $table) {
            $table->increments('id'); 
            $table->unsignedInteger('business_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('triger_name_id');

            $table->foreign("triger_name_id")->references('id')->on('tr_names')->onDelete('cascade');
            $table->foreign("business_id")->references('id')->on('business')->onDelete('cascade');
            $table->foreign("user_id")->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('tr_triger_integrations', function (Blueprint $table) {
            $table->increments('id'); 
            $table->longText('message');
            $table->unsignedInteger('triger_id');
            $table->unsignedInteger('integration_id');

            $table->foreign("triger_id")->references('id')->on('tr_trigers')->onDelete('cascade');
            $table->foreign("integration_id")->references('id')->on('tr_integrations')->onDelete('cascade');
            $table->timestamps();
        }); 
        Schema::create('tr_triger_users', function (Blueprint $table) {
            $table->increments('id');  
            $table->unsignedInteger('triger_id');
            $table->unsignedInteger('integration_id');
            $table->unsignedInteger('user_id');

            $table->foreign("triger_id")->references('id')->on('tr_trigers')->onDelete('cascade');
            $table->foreign("integration_id")->references('id')->on('tr_integrations')->onDelete('cascade');
            $table->foreign("user_id")->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('tr_triger_contacts', function (Blueprint $table) {
            $table->increments('id');  
            $table->unsignedInteger('triger_id');
            $table->unsignedInteger('integration_id');
            $table->unsignedInteger('contact_id');

            $table->foreign("triger_id")->references('id')->on('tr_trigers')->onDelete('cascade');
            $table->foreign("integration_id")->references('id')->on('tr_integrations')->onDelete('cascade');
            $table->foreign("contact_id")->references('id')->on('contacts')->onDelete('cascade');
            $table->timestamps();
        });  
        Schema::create('tr_triger_runs', function (Blueprint $table) {
            $table->increments('id');  
            $table->enum('excuted', ['0', '1'])->default('0');  
            $table->unsignedInteger('triger_id');
            $table->unsignedInteger('business_id');
            $table->unsignedInteger('user_id');

            $table->foreign("triger_id")->references('id')->on('tr_trigers')->onDelete('cascade');
            $table->foreign("business_id")->references('id')->on('business')->onDelete('cascade');
            $table->foreign("user_id")->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('tr_names');
        Schema::dropIfExists('tr_names_tags');
        Schema::dropIfExists('tr_integrations');
        Schema::dropIfExists('tr_trigers');
        Schema::dropIfExists('tr_triger_integrations');
        Schema::dropIfExists('tr_triger_users');
        Schema::dropIfExists('tr_triger_contacts');
        Schema::dropIfExists('tr_triger_runs');
    }
}
