<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComisionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comisiones', function (Blueprint $table) {
            $table->id('id')->unsigned();
            $table->bigInteger('id_tesis')->unsigned()->nullable();
            $table->string('alumno');
            $table->string('profesor_guia');
            $table->string('p_comision_1');
            $table->string('p_comision_2');
            $table->string('p_externo')->nullable();
            $table->string('correo_p_externo')->nullable();
            $table->string('institucion_p_externo')->nullable();

            $table->foreign('id_tesis')->references('id')->on('fit');
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
        Schema::dropIfExists('comisiones');
    }
}
