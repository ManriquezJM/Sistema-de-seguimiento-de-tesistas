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
            'nombre'=>'INGENIERIA CIVIL INFORMATICA'
        ]);
        DB::table('escuelas')->insert([
            'id'=>'2',
            'nombre'=>'ARQUITECTURA'
        ]);
        DB::table('escuelas')->insert([
            'id'=>'3',
            'nombre'=>'INGENIERIA CIVIL'
        ]);
        DB::table('escuelas')->insert([
            'id'=>'4',
            'nombre'=>'CONTRUCCION CIVIL'
        ]);
        DB::table('escuelas')->insert([
            'id'=>'5',
            'nombre'=>'INGENIERIA CIVIL INDUSTRIAL'
        ]);
        DB::table('escuelas')->insert([
            'id'=>'6',
            'nombre'=>'INGENIERIA CIVIL ELECTRONICA'
        ]);
        DB::table('escuelas')->insert([
            'id'=>'7',
            'nombre'=>'INGENIERIA EN CONTRUCCION'
        ]);
    }
}
