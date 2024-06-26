<?php


namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Post;
use App\Models\PostUrl;

class CreatePostsCommand extends Command
{
    protected $signature = 'posts:create {count=5}';

    protected $description = 'Create specified number of posts';

    public function handle()
    {
        $count = (int) $this->argument('count');
        
        $posts = Post::factory()->count($count)->create();

        foreach ($posts as $post) {
            $fileName = 'images.jpeg'; 
            $postUrl = new PostUrl(['url' => $fileName]);
            $post->postUrls()->save($postUrl);
        }

        $this->info("$count posts created successfully.");
    }
}
