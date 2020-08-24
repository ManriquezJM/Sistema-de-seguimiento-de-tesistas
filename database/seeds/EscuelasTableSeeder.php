<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EscuelasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('escuelas')->insert([
            'id'=>'1',
            'nombre'=>'Ing. Civil Informatica'
        ]);
        DB::table('escuelas')->insert([
            'id'=>'2',
            'nombre'=>'Arquitectura'
        ]);
        DB::table('escuelas')->insert([
            'id'=>'3',
            'nombre'=>'Ing. Civil'
        ]);
        DB::table('escuelas')->insert([
            'id'=>'4',
            'nombre'=>'Contruccion Civil'
        ]);
        DB::table('escuelas')->insert([
            'id'=>'5',
            'nombre'=>'Ing. Civil Industrial'
        ]);
        DB::table('escuelas')->insert([
            'id'=>'6',
            'nombre'=>'Ing. Civil Electronica'
        ]);
        DB::table('escuelas')->insert([
            'id'=>'7',
            'nombre'=>'Ing. en Contruccion'
        ]);
    }
}
