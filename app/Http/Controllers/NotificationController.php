<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\Follower;
use Illuminate\Support\Facades\Log;
use App\Models\FollowRequest;
use App\Models\Like;
use Illuminate\Support\Facades\DB;
use App\Models\Comment;

class NotificationController extends Controller
{


public function index()
{
    $followers = auth()->user()->followers;

    $likes = Like::whereHas('post', function ($query) {
        $query->where('user_id', auth()->id());
    })
    ->with(['user', 'post'])
    ->get();

    $followRequests = FollowRequest::where('receiver_id', auth()->id())
        ->with('sender')
        ->get();

    $notifications = Notification::whereHas('sender', function ($query) {
        $query->where('private', true);
    })->get();

    return view('auth.notifications', compact('followers', 'likes', 'followRequests', 'notifications'));
}



    public function store(Request $request)
{
    $receiverId = $request->input('receiver_id');
    $senderId = auth()->id();

    if (Follower::where('user_id', $receiverId)->where('follower_id', $senderId)->exists()) {
        return redirect()->route('notifications.index')->with('error', 'У вас уже активный запрос на подписку для этого пользователя.');
    }

    $notification = new Notification();
    $notification->sender_id = $senderId;
    $notification->receiver_id = $receiverId;
    $notification->message_id = Notification::TYPE_FOLLOW; 
    $notification->save();


    return redirect()->route('notifications.index')->with('success', 'Уведомление успешно создано.');
}


    public function accept($id)
    {
        $notification = DB::table('follow_requests')->select('*')->where('id',$id)->first();
        $follower = new Follower();
        $follower->user_id = $notification->receiver_id;
        $follower->follower_id = $notification->sender_id;
        $follower->save();
        DB::table('follow_requests')->where('id', $id)->delete();
    
        return redirect()->route('notifications')->with('success', 'Уведомление принято.');
    }

    public function reject(Request $request, $id)
    {
        $notification = DB::table('follow_requests')->select('*')->where('id',$id)->first();
        DB::table('follow_requests')->where('id', $id)->delete();

        return redirect()->route('notifications')->with('success', 'Уведомление отклонено.');
    }
}
