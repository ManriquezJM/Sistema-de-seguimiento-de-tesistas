<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([// cuenta de administrador
            'nombres'=>'Administrador',
            'apellidos'=>'Emperador',
            'id_escuela'=>'1',
            'email'=>'admin@gmail.com',
            'password'     =>  Hash::make('12345')
        ]);
        DB::table('users')->insert([// cuenta de alumno
            'nombres'=>'alumno0',
            'apellidos'=>'estudiante0',
            'id_escuela'=>'1',
            'email'=>'alumno0@gmail.com',
            'password'     =>  Hash::make('12345')
        ]);
        DB::table('users')->insert([// cuenta de alumno
            'nombres'=>'alumno1',
            'apellidos'=>'estudiante1',
            'id_escuela'=>'2',
            'email'=>'alumno1@gmail.com',
            'password'     =>  Hash::make('12345')
        ]);
        DB::table('users')->insert([// cuenta de alumno
            'nombres'=>'alumno2',
            'apellidos'=>'estudiante2',
            'id_escuela'=>'2',
            'email'=>'alumno2@gmail.com',
            'password'     =>  Hash::make('12345')
        ]);
        DB::table('users')->insert([// cuenta de secretaria
            'nombres'=>'secretaria0',
            'apellidos'=>'secretaria0',
            'id_escuela'=>'1',
            'email'=>'secretaria0@gmail.com',
            'password'     =>  Hash::make('12345')
        ]);
        DB::table('users')->insert([// cuenta de secretaria
            'nombres'=>'secretaria1',
            'apellidos'=>'secretaria1',
            'id_escuela'=>'2',
            'email'=>'secretaria1@gmail.com',
            'password'     =>  Hash::make('12345')
        ]);
        DB::table('users')->insert([// cuenta de director
            'nombres'=>'director0',
            'apellidos'=>'deEscuela0',
            'id_escuela'=>'1',
            'email'=>'director0@gmail.com',
            'password'     =>  Hash::make('12345')
        ]);
        DB::table('users')->insert([// cuenta de coordinador
            'nombres'=>'Coordinador',
            'apellidos'=>'DeTesis',
            'id_escuela'=>'1',
            'email'=>'coordinador@gmail.com',
            'password'     =>  Hash::make('12345')
        ]);
        DB::table('users')->insert([// cuenta de profesor 0
            'nombres'=>'Profesor0',
            'apellidos'=>'de informatica0',
            'id_escuela'=>'1',
            'email'=>'profesor0@gmail.com',
            'password'     =>  Hash::make('12345')
        ]);
        DB::table('users')->insert([// cuenta de profesor 0
            'nombres'=>'Profesor1',
            'apellidos'=>'de informatica1',
            'id_escuela'=>'1',
            'email'=>'profesor1@gmail.com',
            'password'     =>  Hash::make('12345')
        ]);
        DB::table('users')->insert([// cuenta de profesor 1
            'nombres'=>'Profesor2',
            'apellidos'=>'de arquitectura',
            'id_escuela'=>'2',
            'email'=>'profesor2@gmail.com',
            'password'     =>  Hash::make('12345')
        ]);
    }
}
