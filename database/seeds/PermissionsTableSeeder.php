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
            'name' => 'Dashboard',
            'slug' => 'dashboard.index'
        ]);
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
            'name' => 'Permisos Usuarios',
            'slug' => 'usuarios.permisos'
        ]);
        //Semillas modulo administracion de roles
        DB::table('permissions')->insert([
            'name' => 'Navegar Roles',
            'slug' => 'roles.index'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Crear Roles',
            'slug' => 'roles.crear'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Editar Roles',
            'slug' => 'roles.editar'
        ]);
        //semillas modulo administracion de permisos
        DB::table('permissions')->insert([
            'name' => 'Navegar Permisos',
            'slug' => 'permisos.index'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Crear Permisos',
            'slug' => 'permisos.crear'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Editar Permisos',
            'slug' => 'permisos.editar'
        ]);
       //semillas modulo administracion de Escuelas
        DB::table('permissions')->insert([
        'name' => 'Navegar Escuelas',
        'slug' => 'escuelas.index'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Crear Escuelas',
            'slug' => 'escuelas.crear'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Editar Permisos',
            'slug' => 'escuelas.editar'
        ]);
        //semillas modulo administracion de Areas de tesis
        DB::table('permissions')->insert([
        'name' => 'Navegar Temas de tesis',
        'slug' => 'areatesis.index'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Crear Temas de tesis',
            'slug' => 'areatesis.crear'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Editar Temas de tesis',
            'slug' => 'areatesis.editar'
        ]);
        //semillas modulo administracion de alumno
        DB::table('permissions')->insert([
        'name' => 'Sitios de interes',
        'slug' => 'sitios.interes'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Navegar Vinculaciones',
            'slug' => 'vinculacion.index'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Crear Vinculacion',
            'slug' => 'vinculacion.crear'
        ]);
        DB::table('permissions')->insert([
        'name' => 'Editar Vinculacion',
        'slug' => 'vinculacion.editar'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Formulario de inscripcion',
            'slug' => 'tesis.fit'
        ]);
        DB::table('permissions')->insert([
            'name' => 'crear tesis',
            'slug' => 'tesis.crear'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Ver FIT',
            'slug' => 'tesis.ver'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Editar FIT',
            'slug' => 'tesis.editar'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Crear reporte FIT',
            'slug' => 'reportes.reportefit'
        ]);
        /******permisos avances de tesis */
        DB::table('permissions')->insert([
            'name' => 'Navegar Avances',
            'slug' => 'avances.index'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Crear Avances',
            'slug' => 'avances.crear'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Editar Avances',
            'slug' => 'avances.editar'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Aprobar Fit',
            'slug' => 'tesis.aprobar'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Avances por usuario',
            'slug' => 'avances.listaralumnos'
        ]);  
        DB::table('permissions')->insert([
            'name' => 'Navegar notas pendientes',
            'slug' => 'notaspendientes.index'
        ]);  
    }
}

