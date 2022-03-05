<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTutorialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     *  
     */
    public function up()
    {
        Schema::create('help_tutorial', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title_ar')->nullable();
            $table->text('description_ar')->nullable();
            $table->string('title_en')->nullable();
            $table->text('description_en')->nullable();
            $table->string('path_content')->nullable();
            $table->string('image')->nullable();
            $table->string('video')->nullable();
            $table->integer('step')->nullable();
            $table->string('related_user_field')->nullable();
            $table->string('animation')->nullable();
            $table->enum('modal', ['l', 'm', 's', 'f'])->default('m');
            $table->enum('is_required', ['0', '1'])->default('1');
            $table->enum('position', ['center', 'topleft', 'topright', 'bottomleft', 'bottomright'])->default('bottomright');
            $table->string('selector')->nullable();
            $table->string('page')->nullable();
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
        Schema::dropIfExists('tutorial');
    }
}
