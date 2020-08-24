<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvancestesisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avancestesis', function (Blueprint $table){
            $table->id('id');
            $table->bigInteger('id_tesis')->unsigned()->nullable();
            $table->bigInteger('id_archivo')->unsigned()->nullable();
            $table->string('descripcion')->nullable();

            $table->foreign('id_tesis')->references('id')->on('fit');
            $table->foreign('id_archivo')->references('id')->on('pdftesis');
            
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
        Schema::dropIfExists('avancestesis');
    }
}
