<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('category_id')
                ->nullable(false);
            $table->unsignedInteger('parent_id')
                ->nullable(false)
                ->default(0)->index();
            $table->string('name', 191)->index();
            $table->timestamps();
    
            /**
             * relation
             */
    
            $table->foreign('category_id')->references('id')->on('region_categories');
        });
        
        
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('regions');
    }
}
