<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment; 

class CommentController extends Controller
{

    public function index()
    {
        $comments = Comment::all(); 
        return view('auth.notifications', compact('comments'));
    }
    

    public function create($postId)
    {
        $comments = Comment::where('post_id', $postId)->with('user')->get();
        return view('comments.commentCreate', compact('comments', 'postId'));
    }


    public function destroy($commentId)
    {
    $comment = Comment::find($commentId);
    if (!$comment || $comment->user_id !== auth()->id()) {
        return redirect()->back()->with('error', 'Невозможно удалить комментарий.');
    }

    $postId = $comment->post_id;
    $comment->delete();

    return redirect()->route('comments.create', ['postId' => $postId])->with('success', 'Комментарий успешно удален.');
    }


    public function store(Request $request, $postId)
    {
        $request->validate([
            'content' => 'required|string|max:255',
        ]);

        $comment = new Comment();
        $comment->user_id = auth()->id();
        $comment->post_id = $postId;
        $comment->content = $request->input('content');
        $comment->save();

        $comments = Comment::where('post_id', $postId)->with('user')->get();

        return view('comments.commentCreate', compact('comments', 'postId'));
    }

}
