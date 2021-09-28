<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpeciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('species', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('genus');
            $table->text('taxon');
            $table->unique(['genus', 'taxon']);
            $table->unsignedBigInteger('speciesgroup_id')->nullable();
            $table->foreign('speciesgroup_id')->references('id')->on('speciesgroups');
            $table->text('taxrank'); //species, family, complex
            $table->boolean('diurnal')->default(FALSE);
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->foreign('parent_id')->references('id')->on('species');
            $table->text('description')->nullable();
            $table->text('imagelocation')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('species');
    }
}
