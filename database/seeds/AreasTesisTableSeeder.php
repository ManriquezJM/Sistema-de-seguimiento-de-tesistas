<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreasTesisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('areatesis')->insert([
            'id_escuela' => '1',
            'nombre' => 'Inteligencia Artificial'
        ]);
        DB::table('areatesis')->insert([
            'id_escuela' => '1',
            'nombre' => 'Tratamiento de Imagenes'
        ]);
        DB::table('areatesis')->insert([
            'id_escuela' => '2',
            'nombre' => 'Diseño Sustentable'
        ]);
    }
}
