<?php

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(PermissionTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(UserTableSeeder::class);

        $this->call(SettingsTableSeeder::class);

        $this->call(InitialDataTableSeeder::class);

        Model::reguard();

    }
}
