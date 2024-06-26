<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class CreateUsersCommand extends Command
{
    protected $signature = 'users:create {count : Количество пользователей для создания}';

    protected $description = 'Создание заданного количества пользователей';

    public function handle()
    {
        $count = (int) $this->argument('count');

        for ($i = 0; $i < $count; $i++) {
            $name = $this->ask('Введите имя пользователя ' . ($i + 1));
            $email = $this->ask('Введите email пользователя ' . ($i + 1));
            
            if (User::where('email', $email)->exists()) {
                $this->error('Пользователь с таким email уже существует: ' . $email);
                continue; 
            }

            $password = $this->secret('Введите пароль пользователя ' . ($i + 1));

            User::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password),
                'private' => 'public',
                'remember_token' => null, 
            ]);

            $this->info('Пользователь ' . ($i + 1) . ' создан успешно.');
        }
    }
}
