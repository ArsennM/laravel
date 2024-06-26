<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\Notification;
use App\Models\Post;

class LikeController extends Controller
{

    public function like(Request $request, $postId)
    {
        $user = auth()->user();

        $existingLike = Like::where('user_id', $user->id)
                            ->where('post_id', $postId)
                            ->first();

        if ($existingLike) {
            $existingLike->delete();
            return redirect()->back()->with('success', 'Лайк удален.');
        }

        $like = new Like();
        $like->user_id = $user->id;
        $like->post_id = $postId;
        $like->save();

        $post = Post::find($postId);

        if ($post) {
            $notification = new Notification();
            $notification->sender_id = $user->id; 
            $notification->receiver_id = $post->user_id; 
            $notification->message_id = 1;

            $notification->save();
        } else {
        }

        return redirect()->back()->with('success', 'Пост лайкнут.');
    }

}
