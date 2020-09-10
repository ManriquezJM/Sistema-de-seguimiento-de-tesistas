<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users_roles')->insert([
            'id_user' => 1,
            'id_roles' => 1
        ]);
        DB::table('users_roles')->insert([
            'id_user' => 2,
            'id_roles' => 2
        ]);
        DB::table('users_roles')->insert([
            'id_user' => 3,
            'id_roles' => 3
        ]);
        DB::table('users_roles')->insert([
            'id_user' => 4,
            'id_roles' => 4
        ]);
        DB::table('users_roles')->insert([
            'id_user' => 5,
            'id_roles' => 6
        ]);
        DB::table('users_roles')->insert([
            'id_user' => 6,
            'id_roles' => 5
        ]);
    }
}
