<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Crear usuarios específicos
        $defaultUsers = [
            [
                'username' => 'usuarioprueba',
                'name' => 'Usuario Prueba',
                'first_name' => 'Usuario',
                'last_name' => 'Prueba',
                'email' => 'usuarioprueba@example.com',
                'password' => Hash::make('password'),
                'user_type' => 'user',
            ],
            [
                'username' => 'Samu',
                'name' => 'Samuel',
                'first_name' => 'Peña',
                'last_name' => 'Reyes',
                'email' => 'spenareyes@gmail.com',
                'password' => Hash::make('samuel123'),
                'user_type' => 'user',
            ],
            [
                'username' => 'Matrukkles',
                'name' => 'Enrique',
                'first_name' => 'Lopez',
                'last_name' => 'Rodriguez',
                'email' => 'enrique@gmail.com',
                'password' => Hash::make('enrique123'),
                'user_type' => 'user',
            ],
            [
                'username' => 'sara',
                'name' => 'Sara',
                'first_name' => 'Muñoz',
                'last_name' => 'Moya',
                'email' => 'sara@gmail.com',
                'password' => Hash::make('sara123'),
                'user_type' => 'user',
            ],
            [
                'username' => 'admin',
                'name' => 'Admin',
                'first_name' => 'Admin',
                'last_name' => 'Admin',
                'email' => 'admin@peluq.com',
                'password' => Hash::make('admin123'),
                'user_type' => 'admin',
            ],
        ];

        foreach ($defaultUsers as $user) {
            User::updateOrCreate(
                ['email' => $user['email']], $user);
        }

        User::factory()->count(10)->create();
    }
}
