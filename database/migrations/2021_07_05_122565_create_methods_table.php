<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMethodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('methods', function (Blueprint $table) 
        {
            $table->id();
            $table->timestamps();
            $table->text('value')->unique();
        });
        DB::statement("ALTER TABLE methods ADD CONSTRAINT check_value CHECK (value not like '%2%' AND value not like '%3%' AND value not like '%4%'AND value not like '%5%' AND value not like '%6%'AND value not like '%7%'AND value not like '%8%'AND value not like '%9%');");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('methods');
    }
}
