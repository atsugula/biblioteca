<?php

use App\Models\Categoria;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Leonardo Usuga',
            'username' => 'leo',
            'password' => Hash::make('12345678'),
        ]);

        User::create([
            'name' => 'Alejandra',
            'username' => 'aleja',
            'password' => Hash::make('12345678'),
        ]);
    }
}
