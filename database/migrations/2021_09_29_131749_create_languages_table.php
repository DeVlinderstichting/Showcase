<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('languages', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('key');
            $table->text('nl')->nullable();
            $table->text('en')->nullable();
            $table->text('fr')->nullable();
            $table->text('es')->nullable();
            $table->text('pt')->nullable();
            $table->text('it')->nullable();
            $table->text('de')->nullable();
            $table->text('dk')->nullable();
            $table->text('no')->nullable();
            $table->text('se')->nullable();
            $table->text('fi')->nullable();
            $table->text('ee')->nullable();
            $table->text('lv')->nullable();
            $table->text('lt')->nullable();
            $table->text('pl')->nullable();
            $table->text('cz')->nullable();
            $table->text('sk')->nullable();
            $table->text('hu')->nullable();
            $table->text('au')->nullable();
            $table->text('ch')->nullable();
            $table->text('si')->nullable();
            $table->text('hr')->nullable();
            $table->text('ba')->nullable();
            $table->text('rs')->nullable();
            $table->text('me')->nullable();
            $table->text('al')->nullable();
            $table->text('gr')->nullable();
            $table->text('bg')->nullable();
            $table->text('ro')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('languages');
    }
}
