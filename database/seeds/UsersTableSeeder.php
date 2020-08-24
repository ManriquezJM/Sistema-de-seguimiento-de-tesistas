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
            'nombres'=>'Jose matias',
            'apellidos'=>'Manriquez Troncoso',
            'id_escuela'=>'1',
            'email'=>'admin@gmail.com',
            'password'     =>  Hash::make('12345')
        ]);
        DB::table('users')->insert([// cuenta de alumno
            'nombres'=>'pepito',
            'apellidos'=>'perez',
            'id_escuela'=>'1',
            'email'=>'alumno@gmail.com',
            'password'     =>  Hash::make('12345')
        ]);
        DB::table('users')->insert([// cuenta de alumno
            'nombres'=>'Gabriela',
            'apellidos'=>'Banda',
            'id_escuela'=>'2',
            'email'=>'alumno1@gmail.com',
            'password'     =>  Hash::make('12345')
        ]);
        DB::table('users')->insert([// cuenta de alumno
            'nombres'=>'Barbara',
            'apellidos'=>'Retamal',
            'id_escuela'=>'2',
            'email'=>'alumno2@gmail.com',
            'password'     =>  Hash::make('12345')
        ]);
        DB::table('users')->insert([// cuenta de secretaria
            'nombres'=>'barbara',
            'apellidos'=>'castro',
            'id_escuela'=>'1',
            'email'=>'secretaria@gmail.com',
            'password'     =>  Hash::make('12345')
        ]);
        DB::table('users')->insert([// cuenta de director
            'nombres'=>'director',
            'apellidos'=>'deEscuela',
            'id_escuela'=>'1',
            'email'=>'director@gmail.com',
            'password'     =>  Hash::make('12345')
        ]);
        DB::table('users')->insert([// cuenta de coordinador
            'nombres'=>'Coordinador',
            'apellidos'=>'DeTesis',
            'id_escuela'=>'2',
            'email'=>'coordinador@gmail.com',
            'password'     =>  Hash::make('12345')
        ]);
        DB::table('users')->insert([// cuenta de profesor 1
            'nombres'=>'Profesor1',
            'apellidos'=>'de informatica',
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
