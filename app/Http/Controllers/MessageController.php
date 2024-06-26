<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class MessageController extends Controller
{
public function create(User $recipient)
{
    $existingMessage = Message::where('sender_id', auth()->id())
        ->where('receiver_id', $recipient->id)
        ->first();

    return view('message.message', compact('recipient', 'existingMessage'));
}

public function allChats()
{

    $user = auth()->user();
    
    $chats = Message::where('sender_id', $user->id)
                    ->orWhere('receiver_id', $user->id)
                    ->selectRaw('CASE WHEN sender_id = ? THEN receiver_id ELSE sender_id END AS user_id', [$user->id])
                    ->distinct()
                    ->get()
                    ->pluck('user_id');

        Log::channel('single')->info('chasts: ' . $chats );

    $users = User::whereIn('id', $chats)->select('id', 'name')->get();

    Log::channel('single')->info('users: ' . $users );

    return view('message.allChats', ['users' => $users]);
}
 

public function showChat($userId, $userName)
{
    $currentUser = Auth::user();
    
    Log::channel('single')->info('User ID: ' . $userId . ', User Name: ' . $userName);

    $recipient = User::findOrFail($userId);
    Log::channel('single')->info('____________________________ ');

    Log::channel('single')->info('____________________________ ' . print_r($recipient, true));

    Log::channel('single')->info('Debugging message: My variable value is ' . print_r($recipient, true));
    $messages = Message::where(function($query) use ($currentUser, $recipient) {
        $query->where('sender_id', $currentUser->id)
              ->where('receiver_id', $recipient->id);
    })->orWhere(function($query) use ($currentUser, $recipient) {
        $query->where('sender_id', $recipient->id)
              ->where('receiver_id', $currentUser->id);
    })->orderBy('created_at', 'asc')
      ->get();

    return view('message.chat', ['recipient' => $recipient, 'messages' => $messages]);
}



public function sendMessage(Request $request, $userId, $userName)
{
    $request->validate([
        'content' => 'required|string',
    ]);

    $recipient = User::findOrFail($userId);

    $message = new Message();
    $message->sender_id = auth()->id();
    $message->receiver_id = $userId;
    $message->content = $request->input('content');
    $message->save();

    $request->session()->flash('success', 'Message sent successfully.');

    return redirect()->route('chat.show', ['userId' => $userId, 'userName' => $userName]);
}

    public function store(Request $request, User $recipient)
    {
        $request->validate([
            'content' => 'required|string',
        ]);
    
        $existingMessage = Message::where('sender_id', auth()->id())
            ->where('receiver_id', $recipient->id)
            ->first();
    
        if ($existingMessage) {
            return redirect()->back()->with('error', 'Вы уже отправили сообщение этому пользователю.');
        }
    
        $message = new Message();
        $message->sender_id = auth()->id();
        $message->receiver_id = $recipient->id;
        $message->content = $request->input('content');
        $message->save();
    
        $request->session()->flash('success', 'Сообщение успешно отправлено.');
    
        return redirect()->route('profile_show', $recipient->id);
    }
    
    
    
}
