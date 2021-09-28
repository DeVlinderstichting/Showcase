<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitSpeciesgroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visit_speciesgroups', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('visit_id');
            $table->foreign('visit_id')->references('id')->on('visits')->onDelete('cascade');
            $table->index('visit_id');
            $table->unsignedBigInteger('speciesgroup_id');
            $table->foreign('speciesgroup_id')->references('id')->on('speciesgroups')->onDelete('cascade');
            $table->index('speciesgroup_id');
            $table->unique(['visit_id', 'speciesgroup_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('measurements_speciesgroups');
    }
}
