<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class RolePermissionProfesorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles_permissions')->insert([
            'id_role' => 3,
            'id_permission' => 1
        ]);
        DB::table('roles_permissions')->insert([
            'id_role' => 3,
            'id_permission' => 19
        ]);
        DB::table('roles_permissions')->insert([
            'id_role' => 3,
            'id_permission' => 22
        ]);
        DB::table('roles_permissions')->insert([
            'id_role' => 3,
            'id_permission' => 23
        ]);
        DB::table('roles_permissions')->insert([
            'id_role' => 3,
            'id_permission' => 25
        ]);
        DB::table('roles_permissions')->insert([
            'id_role' => 3,
            'id_permission' => 26
        ]);
        DB::table('roles_permissions')->insert([
            'id_role' => 3,
            'id_permission' => 28
        ]);
        DB::table('roles_permissions')->insert([
            'id_role' => 3,
            'id_permission' => 31
        ]);
        DB::table('roles_permissions')->insert([
            'id_role' => 3,
            'id_permission' => 32
        ]);
        DB::table('roles_permissions')->insert([
            'id_role' => 3,
            'id_permission' => 33
        ]);
        DB::table('roles_permissions')->insert([
            'id_role' => 3,
            'id_permission' => 37
        ]);
        DB::table('roles_permissions')->insert([
            'id_role' => 3,
            'id_permission' => 38
        ]);
        DB::table('roles_permissions')->insert([
            'id_role' => 3,
            'id_permission' => 39
        ]);
        DB::table('roles_permissions')->insert([
            'id_role' => 3,
            'id_permission' => 40
        ]);
        DB::table('roles_permissions')->insert([
            'id_role' => 3,
            'id_permission' => 41
        ]);
        DB::table('roles_permissions')->insert([
            'id_role' => 3,
            'id_permission' => 42
        ]);
    }
}
