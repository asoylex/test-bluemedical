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
        Schema::create('entrance_exit', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('entrance');
            $table->dateTime('exit')->nullable();
            $table->unsignedInteger('vehicle_id');
            $table->foreign('vehicle_id')->references('id')->on('vehicle');
            $table->boolean('status')->default(false);
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
        Schema::dropIfExists('entrance_exit');
    }
};
