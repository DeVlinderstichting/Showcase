<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpeciesgroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('speciesgroups', function (Blueprint $table) 
        {
            $table->id();
            $table->timestamps();
            $table->text('name')->unique();
            $table->text('description');
            $table->boolean('usercancount');
            $table->unsignedBigInteger('defaultspecies_id')->nullable();
            $table->text('imageLocation')->nullable();
            $table->boolean('visibible_for_users')->default('false');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('speciesgroups');
    }
}
