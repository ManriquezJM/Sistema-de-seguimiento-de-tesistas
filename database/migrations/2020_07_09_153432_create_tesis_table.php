<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTesisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tesis', function (Blueprint $table) {
            $table->id('id')->unsigned();
            $table->bigInteger('id_alumno')->unsigned()->nullable();
            $table->bigInteger('id_profesorguia')->unsigned()->nullable();
            $table->bigInteger('id_vinculacion')->unsigned()->nullable();
            $table->bigInteger('id_pdftesis')->unsigned()->nullable();
            $table->decimal('nota', 2, 1)->nullable();
            $table->enum('estado',['A','R','D'])->nullable()->default('D');

            $table->foreign('id_alumno')->references('id_user')->on('users');
            $table->foreign('id_profesorguia')->references('id_user')->on('users');
            $table->foreign('id_vinculacion')->references('id')->on('vinculaciones');
            $table->foreign('id_pdftesis')->references('id')->on('pdftesis');
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
        Schema::dropIfExists('tesis');
    }
}
