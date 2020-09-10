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
        DB::table('users')->insert([// cuenta de profesor
            'nombres'=>'profesor0',
            'apellidos'=>'de informatica',
            'id_escuela'=>'1',
            'email'=>'profesor0@gmail.com',
            'password'     =>  Hash::make('12345')
        ]);
        DB::table('users')->insert([// cuenta de profesor
            'nombres'=>'secretaria0',
            'apellidos'=>'de informatica',
            'id_escuela'=>'1',
            'email'=>'secretaria0@gmail.com',
            'password'     =>  Hash::make('12345')
        ]);
        DB::table('users')->insert([// cuenta de profesor
            'nombres'=>'Director0',
            'apellidos'=>'de informatica',
            'id_escuela'=>'1',
            'email'=>'director0@gmail.com',
            'password'     =>  Hash::make('12345')
        ]);
        DB::table('users')->insert([// cuenta de profesor
            'nombres'=>'Coordinador',
            'apellidos'=>'de informatica',
            'id_escuela'=>'1',
            'email'=>'coordinador@gmail.com',
            'password'     =>  Hash::make('12345')
        ]);
    }
}
