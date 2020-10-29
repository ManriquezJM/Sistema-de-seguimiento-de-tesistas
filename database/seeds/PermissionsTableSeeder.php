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
        //Semillas modulo administracion de usuarios
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
        //Semillas modulo administracion de roles y permisos
        DB::table('permissions')->insert([
            'name' => 'Permisos Usuarios',
            'slug' => 'usuarios.permisos'
        ]);
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
         //semillas modulo administracion de Vinculaciones
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
        //semillas modulo administracion formulario de inscripcion de tesis
        DB::table('permissions')->insert([
        'name' => 'Sitios de interes',
        'slug' => 'sitios.interes'
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
        //Semillas modulos de avances de tesis
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
        //Semillas Botones y funcionas exclusivas 
        DB::table('permissions')->insert([
            'name' => 'Aprobar Fit',
            'slug' => 'tesis.aprobar'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Avances por usuario',
            'slug' => 'avances.listaralumnos'
        ]);  
        //Semillas administracion de notas pendientes
        DB::table('permissions')->insert([
            'name' => 'Navegar notas pendientes',
            'slug' => 'notaspendientes.index'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Ingresar nota pendiente',
            'slug' => 'notaspendientes.crear'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Editar nota pendiente',
            'slug' => 'notaspendientes.editar'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Ingresar Prorrogas',
            'slug' => 'notaspendientes.prorroga'
        ]);    
        //Semillas administracion de notas pendientes  
        DB::table('permissions')->insert([
            'name' => 'Navegar Bitacoras',
            'slug' => 'bitacoras.index'
        ]); 
        DB::table('permissions')->insert([
            'name' => 'Crear Bitacoras',
            'slug' => 'bitacoras.crear'
        ]); 
        DB::table('permissions')->insert([
            'name' => 'Editar Bitacoras',
            'slug' => 'bitacoras.editar'
        ]);
        //Semillas administracion de Comisiones
        DB::table('permissions')->insert([
            'name' => 'Navegar Comisiones',
            'slug' => 'comisiones.index'
        ]); 
        DB::table('permissions')->insert([
            'name' => 'Crear Comisiones',
            'slug' => 'comisiones.crear'
        ]); 
        DB::table('permissions')->insert([
            'name' => 'Editar Comisiones',
            'slug' => 'comisiones.editar'
        ]);
        //Semillas administracion documentos secretaria 
        DB::table('permissions')->insert([
            'name' => 'Navegar documentos alumnos',
            'slug' => 'actadefensa.index'
        ]); 
        DB::table('permissions')->insert([
            'name' => 'Subir acta de defensa',
            'slug' => 'actadefensa.subiracta'
        ]); 
        DB::table('permissions')->insert([
            'name' => 'Subir nota de tesis',
            'slug' => 'actadefensa.subirnota'
        ]); 
        DB::table('permissions')->insert([
            'name' => 'Documentos alumnos',
            'slug' => 'documentos.index'
        ]); 
        DB::table('permissions')->insert([
            'name' => 'EsAlumno',
            'slug' => 'EsAlumno'
        ]);
        DB::table('permissions')->insert([
            'name' => 'EsProfesor',
            'slug' => 'EsProfesor'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Detalles avances alumno',
            'slug' => 'reportes.detallesavances'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Detalles avances alumno',
            'slug' => 'reportes.detallesbitacoras'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Subir version final de tesis',
            'slug' => 'avances.subirfinalpdf'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Registrar tesis finalizada',
            'slug' => 'registrar.tesis'
        ]);
    }
}

