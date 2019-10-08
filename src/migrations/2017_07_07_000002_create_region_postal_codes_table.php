<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegionPostalCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('region_postal_codes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('region_id')
                ->nullable(false);
            $table->unsignedInteger('postal_code')
                ->nullable(false)
                ->index();
            $table->timestamps();
    
            /**
             * relation
             */
    
            $table->foreign('region_id')->references('id')->on('regions');
        });
        
        
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('region_postal_codes');
    }
}
