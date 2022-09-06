<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('month_time', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('vehicle_id');
            $table->foreign('vehicle_id')->references('id')->on('vehicle');
            $table->double('total_min');
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
        Schema::dropIfExists('month_time');
    }
};
