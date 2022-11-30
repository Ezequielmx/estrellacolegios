<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstablecTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('establecimientos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('cue')->index();
            $table->string('nombre');
            $table->string('domicilio')->nullable();
            $table->string('cod_area')->nullable();
            $table->string('tel')->nullable();
            $table->string('email')->nullable();
            $table->string('prov');
            $table->string('depto');
            $table->string('ciudad');
            $table->string('sector')->nullable();
            $table->string('ambito')->nullable();
            $table->string('tipo')->nullable();
            $table->string('niveles')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('establec');
    }
}
