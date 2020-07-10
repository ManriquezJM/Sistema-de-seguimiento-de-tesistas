<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fit', function (Blueprint $table) {
            $table->id('id')->unsigned();
            $table->bigInteger('id_tesis')->unsigned()->nullable();
            $table->string('tipo');
            $table->text('objetivo');
            $table->text('contribucion');
            $table->string('carrera');
            $table->string('nombre_int1');
            $table->string('rut_int1');
            $table->string('email_int1');
            $table->string('ingreso_int1');
            $table->string('telefono_int1');
            $table->string('nombre_int2');
            $table->string('rut_int2');
            $table->string('email_int2');
            $table->string('ingreso_int2');
            $table->string('telefono_int2');
            $table->enum('aprobado_pg',['A','R','P'])->nullable()->default('P');
            $table->enum('aprobado_d',['A','R','P'])->nullable()->default('P');

            $table->foreign('id_tesis')->references('id')->on('tesis');
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
        Schema::dropIfExists('fit');
    }
}
