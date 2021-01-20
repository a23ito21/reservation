<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservation_data', function (Blueprint $table) {
            $table->id();        
            $table->string('name1');	
            $table->string('name2');
            $table->string('name3');
            $table->string('name4');
            $table->string('email');
            $table->string('date');
            $table->string('reservation_plan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservation_data');
    }
}