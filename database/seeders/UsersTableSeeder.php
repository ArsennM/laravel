<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $count = 5; 

        for ($i = 0; $i < $count; $i++) {
            $name = 'User ' . ($i + 1);
            $email = 'user' . ($i + 1) . '@example.com';
            $password = 'aaaaaaaa'; 

            if (User::where('email', $email)->exists()) {
                $this->command->error('Пользователь с таким email уже существует: ' . $email);
                continue;
            }

            User::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password),
                'private' => 'public',
                'remember_token' => null,
            ]);

            $this->command->info('Пользователь ' . ($i + 1) . ' создан успешно.');
        }
    }
}
