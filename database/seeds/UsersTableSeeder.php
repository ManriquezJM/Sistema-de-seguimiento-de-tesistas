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
        DB::table('users')->insert([
            'id_user'=>'1',
            'nombres'=>'Jose matias',
            'apellidos'=>'Manriquez Troncoso',
            'id_escuela'=>'1',
            'email'=>'manriquez.josematias@gmail.com',
            'password'     =>  Hash::make('12345'),
            'created_by' => '1',
            'updated_by' => '1'

        ]);
        DB::table('users')->insert([
            'id_user'=>'2',
            'nombres'=>'Gabriela',
            'apellidos'=>'Banda',
            'id_escuela'=>'2',
            'email'=>'gabrielabandalagos@gmail.com',
            'password'     =>  Hash::make('12345'),
            'created_by' => '1',
            'updated_by' => '1'

        ]);
        DB::table('users')->insert([
            'id_user'=>'3',
            'nombres'=>'Barbara',
            'apellidos'=>'Retamal',
            'id_escuela'=>'2',
            'email'=>'barbara@gmail.com',
            'password'     =>  Hash::make('12345'),
            'created_by' => '1',
            'updated_by' => '1'

        ]);
    }
}
