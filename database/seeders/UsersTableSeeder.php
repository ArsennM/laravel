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
        $count = 5; // Количество пользователей для создания

        for ($i = 0; $i < $count; $i++) {
            $name = 'User ' . ($i + 1);
            $email = 'user' . ($i + 1) . '@example.com';
            $password = 'aaaaaaaa'; // Ваше стандартное пароль

            if (User::where('email', $email)->exists()) {
                $this->command->error('Пользователь с таким email уже существует: ' . $email);
                continue; // Пропускаем создание пользователя и переходим к следующей итерации цикла
            }

            User::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password),
                'private' => 'public',
                'remember_token' => null, // Вы можете использовать Str::random(10) для генерации случайного токена
            ]);

            $this->command->info('Пользователь ' . ($i + 1) . ' создан успешно.');
        }
    }
}


// namespace Database\Seeders;

// use Illuminate\Database\Seeder;
// use Illuminate\Support\Facades\Hash;
// use App\Models\User;

// class UsersTableSeeder extends Seeder
// {
//     /**
//      * Run the database seeds.
//      */
//     public function run()
//     {
//         $password = 'aaaaaaaa'; // Ваше стандартное пароль

//         for ($i = 0; $i < 5; $i++) {
//             User::create([
//                 'name' => 'User ' . ($i + 1),
//                 'email' => 'user' . ($i + 1) . '@example.com',
//                 'password' => Hash::make($password),
//                 'private' => 'public',
//                 'remember_token' => null, // Вы можете использовать Str::random(10) для генерации случайного токена
//             ]);
//         }
//     }
// }
