<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCapitulosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('capitulos', function (Blueprint $table) {
            $table->id('id')->unsigned();
            $table->bigInteger('id_tesis')->unsigned()->nullable();
            $table->bigInteger('id_capitulo1')->unsigned()->nullable();
            $table->string('descripcion_c1');
            $table->enum('estado_c1',['A','R','P'])->nullable()->default('P');
            $table->bigInteger('id_capitulo2')->unsigned()->nullable();
            $table->string('descripcion_c2');
            $table->enum('estado_c2',['A','R','P'])->nullable()->default('P');
            $table->bigInteger('id_capitulo3')->unsigned()->nullable();
            $table->string('descripcion_c3');
            $table->enum('estado_c3',['A','R','P'])->nullable()->default('P');
            $table->bigInteger('id_capitulo4')->unsigned()->nullable();
            $table->string('descripcion_c4');
            $table->enum('estado_c4',['A','R','P'])->nullable()->default('P');

            $table->foreign('id_tesis')->references('id')->on('tesis');
            $table->foreign('id_capitulo1')->references('id')->on('pdftesis');
            $table->foreign('id_capitulo2')->references('id')->on('pdftesis');
            $table->foreign('id_capitulo3')->references('id')->on('pdftesis');
            $table->foreign('id_capitulo4')->references('id')->on('pdftesis');
            
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
        Schema::dropIfExists('capitulos');
    }
}
