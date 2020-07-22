<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            'name' => 'Navegar Usuarios',
            'slug' => 'usuarios.index'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Crear Usuarios',
            'slug' => 'usuarios.crear'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Editar Usuarios',
            'slug' => 'usuarios.editar'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Ver Usuarios',
            'slug' => 'usuarios.ver'
        ]);
        DB::table('permissions')->insert([
            'name' => 'activar Usuarios',
            'slug' => 'usuarios.activar'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Desactivar Usuarios',
            'slug' => 'usuarios.desactivar'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Navegar Roles',
            'slug' => 'roll.index'
        ]);
    }
}
