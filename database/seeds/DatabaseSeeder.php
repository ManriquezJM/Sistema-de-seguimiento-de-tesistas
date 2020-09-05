<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([EscuelasTableSeeder::class]);
        $this->call([AreasTesisTableSeeder::class]);
        $this->call([VinculacionesTableSeeder::class]);
        $this->call([PermissionsTableSeeder::class]);
        $this->call([RolesSeeder::class]);
        $this->call([UsersTableSeeder::class]);
        // $this->call(UserSeeder::class);
    }
}
