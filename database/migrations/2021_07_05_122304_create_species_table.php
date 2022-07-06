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
        Schema::create('species', function (Blueprint $table) 
        {
            $table->id();
            $table->timestamps();
            $table->text('genus');
            $table->text('taxon')->nullable();
            $table->text('ndffuri')->nullable();
            $table->unique(['genus', 'taxon']);
            $table->unsignedBigInteger('speciesgroup_id')->nullable();
            $table->foreign('speciesgroup_id')->references('id')->on('speciesgroups');
            $table->text('taxrank'); //species, family, complex
            $table->boolean('diurnal')->default(FALSE);
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->foreign('parent_id')->references('id')->on('species');
            $table->text('description')->nullable();
            $table->text('imagelocation')->nullable();
            $table->text('extrainfolocation')->nullable();
            $table->text('nlname')->nullable();
            $table->text('enname')->nullable();
            $table->text('frname')->nullable();
            $table->text('esname')->nullable();
            $table->text('ptname')->nullable();
            $table->text('itname')->nullable();
            $table->text('dename')->nullable();
            $table->text('dkname')->nullable();
            $table->text('noname')->nullable();
            $table->text('sename')->nullable();
            $table->text('finame')->nullable();
            $table->text('eename')->nullable();
            $table->text('lvname')->nullable();
            $table->text('ltname')->nullable();
            $table->text('plname')->nullable();
            $table->text('czname')->nullable();
            $table->text('skname')->nullable();
            $table->text('huname')->nullable();
            $table->text('auname')->nullable();
            $table->text('chname')->nullable();
            $table->text('siname')->nullable();
            $table->text('hrname')->nullable();
            $table->text('baname')->nullable();
            $table->text('rsname')->nullable();
            $table->text('mename')->nullable();
            $table->text('alname')->nullable();
            $table->text('grname')->nullable();
            $table->text('bgname')->nullable();
            $table->text('roname')->nullable();


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
