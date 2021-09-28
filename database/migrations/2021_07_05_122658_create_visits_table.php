<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->dateTime('startdate', 0);
            $table->dateTime('enddate', 0)->nullable(); //nullable to accept ongoing visits
            $table->unsignedBigInteger('countobject_id');
            $table->foreign('countobject_id')->references('id')->on('countobjects')->onDelete('cascade');
            $table->index('countobject_id');
            $table->unsignedBigInteger('measurement_id');
            $table->foreign('measurement_id')->references('id')->on('measurements');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visits');
    }
}
