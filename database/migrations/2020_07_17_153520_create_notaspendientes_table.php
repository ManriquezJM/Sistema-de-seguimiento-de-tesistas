<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotaspendientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notaspendientes', function (Blueprint $table){
            $table->id('id');
            $table->bigInteger('id_tesis')->unsigned()->nullable();
            $table->date('fecha_presentacion');
            $table->date('fecha_propuesta');
            $table->date('fecha_autorizada')->nullable();
            $table->date('fecha_prorroga')->nullable();
            $table->enum('estado',['A','R','V'])->nullable()->default('A');
            
            $table->foreign('id_tesis')->references('id')->on('fit')->onDelete('set null');
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
        Schema::dropIfExists('notaspendientes');
    }
}
