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

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->index('user_id');
            $table->text('notes');
            $table->text('wind');
            $table->text('temperature');
            $table->text('cloud');

            $table->unsignedBigInteger('photo_id')->nullable();
            $table->foreign('photo_id')->references('id')->on('photos')->onDelete('cascade');
            $table->index('photo_id');

            $table->unsignedBigInteger('transect_id')->nullable();
            $table->foreign('transect_id')->references('id')->on('transects')->onDelete('cascade');
            $table->index('transect_id');
            
            $table->unsignedBigInteger('flower_id')->nullable();
            $table->foreign('flower_id')->references('id')->on('species')->onDelete('cascade');
            $table->index('flower_id');

            $table->unsignedBigInteger('method_id')->nullable();
            $table->foreign('method_id')->references('id')->on('methods')->onDelete('cascade');
            $table->index('method_id');
        });

        DB::statement("ALTER TABLE visits ADD CONSTRAINT check_location CHECK (status = 1 OR (status = 2 AND location is not null));");
        DB::statement("ALTER TABLE visits ADD CONSTRAINT check_enddate CHECK (status = 1 OR (status = 2 AND countingmethod_id = 1 AND enddate is null) OR (status = 2 AND countingmethod_id = 2 AND enddate is not null) OR (status = 2 AND countingmethod_id = 3 AND enddate is null) OR (status = 2 AND countingmethod_id = 4 AND enddate is null));");
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