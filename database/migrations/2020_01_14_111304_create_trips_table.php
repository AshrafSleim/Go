<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('bus_id');
            $table->integer('user_id');
            $table->string('start_station');
            $table->string('end_station');
            $table->date('start_date');
            $table->dateTime('driver_start')->nullable();
            $table->dateTime('driver_end')->nullable();
            $table->float('cost')->default(0);
            $table->integer('no_chair')->default(14);



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
        Schema::dropIfExists('trips');
    }
}
