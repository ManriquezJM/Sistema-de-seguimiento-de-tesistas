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
            $table->bigInteger('id_profesor1')->unsigned()->nullable();
            $table->bigInteger('id_profesor2')->unsigned()->nullable();
            $table->string('p_externo')->nullable();
            $table->string('correo_p_externo')->nullable();
            $table->string('institucion_p_externo')->nullable();

            $table->foreign('id_tesis')->references('id')->on('fit');
            $table->foreign('id_profesor1')->references('id_user')->on('users');
            $table->foreign('id_profesor2')->references('id_user')->on('users');
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
