<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VinculacionesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('vinculaciones')->insert([
            'tipo' => 'Fondo Concursable',
            'nombre' => 'Vinculacion de prueba1',
            'descripcion' => 'Vinculacion de prueba1 '
        ]);
        DB::table('vinculaciones')->insert([
            'tipo' => 'Empresa',
            'nombre' => 'Vinculacion de prueba2 empresa',
            'descripcion' => 'Vinculacion de prueba2 empresa '
        ]);
        DB::table('vinculaciones')->insert([
            'tipo' => 'Comunidad',
            'nombre' => 'Vinculacion de comunidad',
            'descripcion' => 'Vinculacion de prueba2'
        ]);
    }
}
