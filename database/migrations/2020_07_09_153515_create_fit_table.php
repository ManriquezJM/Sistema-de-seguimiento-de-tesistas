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
            $table->bigInteger('id_alumno')->unsigned()->nullable();
            $table->bigInteger('id_profesorguia')->unsigned()->nullable();
            $table->bigInteger('id_vinculacion')->unsigned()->nullable();
            $table->bigInteger('id_pdftesis')->unsigned()->nullable();
            $table->bigInteger('id_notapendiente')->unsigned()->nullable();
            $table->decimal('nota', 2, 1)->nullable();
            $table->enum('estado',['A','R','D'])->nullable()->default('D');
            $table->string('titulo')->nullable();
            $table->string('tipo');
            $table->text('objetivo');
            $table->text('contribucion');
            $table->string('carrera')->nullable();
            $table->string('nombre_int1');
            $table->string('rut_int1');
            $table->string('email_int1')->nullable();
            $table->string('ingreso_int1')->nullable();
            $table->string('telefono_int1')->nullable();
            $table->string('nombre_int2')->nullable();
            $table->string('rut_int2')->nullable();
            $table->string('email_int2')->nullable();
            $table->string('ingreso_int2')->nullable();
            $table->string('telefono_int2')->nullable();
            $table->enum('aprobado_pg',['A','R','P'])->nullable()->default('P');

            $table->foreign('id_alumno')->references('id_user')->on('users');
            $table->foreign('id_profesorguia')->references('id_user')->on('users');
            $table->foreign('id_vinculacion')->references('id')->on('vinculaciones');
            $table->foreign('id_pdftesis')->references('id')->on('pdftesis');
            $table->foreign('id_notapendiente')->references('id')->on('notaspendientes');
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
