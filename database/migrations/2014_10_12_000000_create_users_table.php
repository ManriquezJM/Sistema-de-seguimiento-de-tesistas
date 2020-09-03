<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('id_user');
            $table->string('nombres');
            $table->string('apellidos');
            $table->bigInteger('id_escuela')->unsigned()->nullable();
            $table->bigInteger('id_files')->unsigned()->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->enum('state',['A','I'])->nullable()->default('A');
            $table->timestamps();

            $table->foreign('id_files')->references('id')->on('files');
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
        Schema::dropIfExists('users');
    }
}
/*
Schema::create('notaspendientes', function (Blueprint $table){
            $table->id('id')->unsigned();
            $table->date('fecha_presentacion')->unsigned();
            $table->date('fecha_propuesta')->unsigned();
            $table->date('fecha_autorizada')->unsigned()->nullable();
            $table->date('fecha_prorroga')->unsigned()->nullable();
            $table->enum('estado',['A','R','V','P'])->nullable()->default('P');
            
            $table->timestamps();
        });


        Schema::create('avancestesis', function (Blueprint $table){
            $table->id('id')->unsigned();
            $table->bigInteger('id_tesis')->unsigned();
            $table->bigInteger('id_archivo')->unsigned();
            $table->string('descripcion')->unsigned();

            $table->foreign('id_tesis')->references('id')->on('fit');
            $table->foreign('id_archivo')->references('id')->on('pdftesis');
            
            $table->timestamps();
        });
*/