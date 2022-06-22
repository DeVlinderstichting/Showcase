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
        Schema::create('visits', function (Blueprint $table) 
        {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('countingmethod_id')->nullable();
            $table->foreign('countingmethod_id')->references('id')->on('countingmethods')->onDelete('cascade');
            $table->index('countingmethod_id');
            $table->GEOMETRY('location')->nullable();

            $table->dateTime('startdate', 0);
            $table->dateTime('enddate', 0)->nullable(); //nullable to accept ongoing visits

            $table->dateTime('sendtoserverdate', 0)->nullable();
            $table->integer('status')->default(1); //1=incomplete, 2=completed, 3=sealed (once shipped to server it can only be changed online)

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->index('user_id');
            $table->integer('recorders');
            $table->text('notes')->nullable();
            $table->text('wind')->nullable();
            $table->text('temperature')->nullable();
            $table->text('cloud')->nullable();

            $table->unsignedBigInteger('transect_id')->nullable();
            $table->foreign('transect_id')->references('id')->on('transects')->onDelete('cascade');
            $table->index('transect_id');

            $table->unsignedBigInteger('region_id')->nullable();
            $table->foreign('region_id')->references('id')->on('regions')->onDelete('cascade');
            $table->index('region_id');
            
            $table->integer('flowercount')->nullable();
            $table->unsignedBigInteger('flower_id')->nullable();
            $table->foreign('flower_id')->references('id')->on('species')->onDelete('cascade');
            $table->index('flower_id');

            $table->unsignedBigInteger('method_id')->nullable();
            $table->foreign('method_id')->references('id')->on('methods')->onDelete('cascade');
            $table->index('method_id');

            $table->unsignedBigInteger('landusetype_id')->nullable();
            $table->foreign('landusetype_id')->references('id')->on('landusetypes')->onDelete('cascade');
            $table->unsignedBigInteger('managementtype_id')->nullable();
            $table->foreign('managementtype_id')->references('id')->on('managementtypes')->onDelete('cascade');
        });

        DB::statement("ALTER TABLE visits ADD CONSTRAINT check_location CHECK (status = 1 OR (status = 2 AND location is not null));");
        DB::statement("ALTER TABLE visits ADD CONSTRAINT check_enddate CHECK (status = 1 
            OR (status = 2 AND countingmethod_id = 1 AND enddate is null) 
            OR (status = 2 AND countingmethod_id = 2 AND enddate is not null) 
            OR (status = 2 AND countingmethod_id = 3 AND enddate is not null) 
            OR (status = 2 AND countingmethod_id = 4));");
        DB::statement("ALTER TABLE visits ADD CONSTRAINT check_wind CHECK (status = 1 
            OR (status = 2 AND countingmethod_id = 1 AND wind is null) 
            OR (status = 2 AND countingmethod_id = 2 AND wind is not null) 
            OR (status = 2 AND countingmethod_id = 3 AND wind is not null) 
            OR (status = 2 AND countingmethod_id = 4 AND wind is null));");
        DB::statement("ALTER TABLE visits ADD CONSTRAINT check_temperature CHECK (status = 1 
            OR (status = 2 AND countingmethod_id = 1 AND temperature is null) 
            OR (status = 2 AND countingmethod_id = 2 AND temperature is not null) 
            OR (status = 2 AND countingmethod_id = 3 AND temperature is not null) 
            OR (status = 2 AND countingmethod_id = 4 AND temperature is null));");
        DB::statement("ALTER TABLE visits ADD CONSTRAINT check_cloud CHECK (status = 1 
            OR (status = 2 AND countingmethod_id = 1 AND cloud is null) 
            OR (status = 2 AND countingmethod_id = 2 AND cloud is not null) 
            OR (status = 2 AND countingmethod_id = 3 AND cloud is not null) 
            OR (status = 2 AND countingmethod_id = 4 AND cloud is null));");
        DB::statement("ALTER TABLE visits ADD CONSTRAINT check_transect_id CHECK ((countingmethod_id = 3 AND transect_id is not null) OR (countingmethod_id != 3 AND transect_id is null));");
        DB::statement("ALTER TABLE visits ADD CONSTRAINT check_flower_id CHECK ((countingmethod_id = 4 AND flower_id is not null) OR (countingmethod_id != 4 AND flower_id is null));");
        DB::statement("ALTER TABLE visits ADD CONSTRAINT check_method_id CHECK (status = 1 
            OR (status = 2 AND method_id is not null));");       
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
