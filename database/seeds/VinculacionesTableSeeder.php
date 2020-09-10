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
    }
}
