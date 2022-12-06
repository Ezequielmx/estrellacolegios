<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicios', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_venta');
            $table->date('fecha_ini_serv');
            $table->date('fecha_fin_serv');
            $table->integer('establecimiento_id');
            $table->string('cont_1');
            $table->string('cel_cont_1');
            $table->string('puesto_cont1');
            $table->string('cont_2');
            $table->string('puesto_cont2');
            $table->string('cel_cont_2');
            $table->integer('matricula_tmj');
            $table->integer('matricula_ttj');
            $table->integer('matricula_tnj');
            $table->integer('matricula_tmp');
            $table->integer('matricula_ttp');
            $table->integer('matricula_tnp');
            $table->integer('matricula_tms');
            $table->integer('matricula_tts');
            $table->integer('matricula_tns');

            $table->integer('servicio_tm');
            $table->integer('servicio_tt');
            $table->integer('servicio_tn');
            
            $table->integer('espacio_montaje');
            $table->integer('precio_alumno');
            $table->integer('precio_total');
            $table->string('observaciones');

            $table->integer('planetario_id');
            $table->integer('asesor_id');
            $table->integer('estado_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('servicios');
    }
}
