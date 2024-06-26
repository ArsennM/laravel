<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\PostUrl;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function create()
    {
        return view('posts.createPost');
    }

        public function showPost($postId)
    {
        $post = Post::findOrFail($postId);
        return view('posts.show', compact('post'));
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'files.*' => 'nullable|image|max:2048',
        ]);

        $post = new Post([
            'user_id' => auth()->user()->id,
            'title' => $validatedData['title'],
        ]);
        $post->save();

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $fileName = $file->getClientOriginalName();
                $file->storeAs('uploads', $fileName, 'public');
                $postUrl = new PostUrl(['url' => $fileName]);
                $post->postUrls()->save($postUrl);
            }
        }

        return redirect()->route('profile', ['id' => auth()->user()->id])->with('success', 'Post added successfully!');
    }

    public function allPost()
    {
        $posts = Post::with(['user', 'postUrls'])
                      ->whereHas('user', function ($query) {
                          $query->where('private', 'public');
                      })
                      ->orderBy('id', 'DESC')
                      ->get();
        
        return view('posts.allPost', compact('posts'));
    }

    public function show($postId)
    {
        $post = Post::with('likes')->find($postId);
        
        return view('posts.show', compact('post'));
    }
}

