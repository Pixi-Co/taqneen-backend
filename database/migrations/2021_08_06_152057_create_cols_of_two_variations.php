<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateColsOfTwoVariations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {
            Schema::table('variations', function(Blueprint $table){
                // variation template two (attribute)
                $table->integer('variation_template_id2')->nullable();
                
                // the value of variation template two 
                $table->integer('variation_value_id2')->nullable();
            });
        } catch (\Exception $th) {
            echo "col already exists \n";
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cols_of_two_variations');
    }
}
