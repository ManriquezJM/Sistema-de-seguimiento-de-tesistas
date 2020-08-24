<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'Administrador',
            'slug' => 'rol.administrador'
        ]);
        DB::table('roles')->insert([
            'name' => 'Alumno',
            'slug' => 'rol.alumno'
        ]);
        DB::table('roles')->insert([
            'name' => 'Profesor',
            'slug' => 'rol.profesor'
        ]);
        DB::table('roles')->insert([
            'name' => 'Secretaria',
            'slug' => 'rol.secretaria'
        ]);
        DB::table('roles')->insert([
            'name' => 'Coordinador',
            'slug' => 'rol.coordinador'
        ]);
        DB::table('roles')->insert([
            'name' => 'Director',
            'slug' => 'rol.director'
        ]);
    }
}
