<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolePermissionAlumnoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles_permissions')->insert([
            'id_role' => 2,
            'id_permission' => 1
        ]);
        DB::table('roles_permissions')->insert([
            'id_role' => 2,
            'id_permission' => 19
        ]);
        DB::table('roles_permissions')->insert([
            'id_role' => 2,
            'id_permission' => 22
        ]);
        DB::table('roles_permissions')->insert([
            'id_role' => 2,
            'id_permission' => 23
        ]);
        DB::table('roles_permissions')->insert([
            'id_role' => 2,
            'id_permission' => 24
        ]);
        DB::table('roles_permissions')->insert([
            'id_role' => 2,
            'id_permission' => 25
        ]);
        DB::table('roles_permissions')->insert([
            'id_role' => 2,
            'id_permission' => 26
        ]);
        DB::table('roles_permissions')->insert([
            'id_role' => 2,
            'id_permission' => 28
        ]);
        DB::table('roles_permissions')->insert([
            'id_role' => 2,
            'id_permission' => 29
        ]);
        DB::table('roles_permissions')->insert([
            'id_role' => 2,
            'id_permission' => 30
        ]);
        DB::table('roles_permissions')->insert([
            'id_role' => 2,
            'id_permission' => 33
        ]);
        DB::table('roles_permissions')->insert([
            'id_role' => 2,
            'id_permission' => 34
        ]);
        DB::table('roles_permissions')->insert([
            'id_role' => 2,
            'id_permission' => 35
        ]);
        DB::table('roles_permissions')->insert([
            'id_role' => 2,
            'id_permission' => 36
        ]);
        DB::table('roles_permissions')->insert([
            'id_role' => 2,
            'id_permission' => 37
        ]);
        DB::table('roles_permissions')->insert([
            'id_role' => 2,
            'id_permission' => 47
        ]);
        DB::table('roles_permissions')->insert([
            'id_role' => 2,
            'id_permission' => 51
        ]);
    }
}
