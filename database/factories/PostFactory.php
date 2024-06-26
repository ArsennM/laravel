<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition()
    {
        $photoPath = 'public/uploads/images.jpeg';

        if (!Storage::exists('public/uploads')) {
            Storage::makeDirectory('public/uploads');
        }


        return [
            'user_id' => \App\Models\User::factory(),
            'title' => $this->faker->sentence,
            'photo_path' => $photoPath, 
        ];
    }
}

