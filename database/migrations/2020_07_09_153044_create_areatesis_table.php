<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAreatesisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('areatesis', function (Blueprint $table) {
            $table->id('id')->unsigned();
            $table->bigInteger('id_escuela')->unsigned()->nullable();
            $table->string('nombre');
            $table->timestamps();

            $table->foreign('id_escuela')->references('id')->on('escuelas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('areatesis');
    }
}
