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
        $this->call([
            // RolSeeder::class,
            UserSeeder::class,
            // CategoriaSeeder::class,
            //para los tenant
            // RolTenantSeeder::class,
            // UserTenantSeeder::class,
        ]);
    }
}
