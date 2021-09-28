<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegionMeasurementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('region_measurements', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('region_id');
            $table->foreign('region_id')->references('id')->on('regions')->onDelete('cascade');
            $table->index('region_id');
            $table->unsignedBigInteger('measurement_id');
            $table->foreign('measurement_id')->references('id')->on('measurements')->onDelete('cascade');
            $table->index('measurement_id');
            $table->unique(['region_id', 'measurement_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('region_measurements');
    }
}
