<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::create([
            'name'             => 'administrador',
            'username'         => 'admin',
            'password'         => Hash::make('12345678'),
            'identificacion'   => '1000000001',
            'nombre_completo'  => 'Administrador del Sistema',
            'correo'           => 'admin@biblioteca.com',
            'telefono'         => '3001234567',
        ]);
    }
}
