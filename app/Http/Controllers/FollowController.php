<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\FollowRequest;
use App\Models\NotificationSent;

class FollowController extends Controller
{

    public function follow(User $user)
{
    $currentUser = auth()->user();

    if ($user->private === 'private') {
        if ($user->requestPending($currentUser)) {
            return back()->with('error', 'Запрос на подписку уже отправлен.');
        }

        $followRequest = new FollowRequest();
        $followRequest->sender_id = $currentUser->id;
        $followRequest->receiver_id = $user->id;
        $followRequest->save();

 

        return back()->with('success', 'Запрос на подписку отправлен.');
    }else if($user->private === 'public'){

    $currentUser->following()->attach($user->id);

    return back()->with('success', 'Вы успешно подписались на пользователя ' . $user->name);

    }


}

    public function cancelRequest(User $user)
    {
        $followRequest = FollowRequest::where('sender_id', auth()->id())
            ->where('receiver_id', $user->id)
            ->first();

        if ($followRequest) {
            $followRequest->delete();
            return back()->with('success', 'Запрос на подписку отменен.');
        }

        return back()->with('error', 'Запрос на подписку не найден.');
    }

    public function unfollow(User $user)
    {
        auth()->user()->following()->detach($user->id);
        
        return back()->with('success', 'Вы успешно отписались от пользователя ' . $user->name);
    }
}
