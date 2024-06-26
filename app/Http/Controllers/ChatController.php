<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;

class ChatController extends Controller
{
    public function show($userId, $userName)
    {
        $messages = Message::where(function ($query) use ($userId) {
            $query->where('sender_id', auth()->id())->where('receiver_id', $userId);
        })->orWhere(function ($query) use ($userId) {
            $query->where('sender_id', $userId)->where('receiver_id', auth()->id());
        })->orderBy('created_at', 'asc')->get();
        
        return view('message.chat', compact('userId', 'userName', 'messages'));
    }
    
    

    public function store(Request $request, $userId, $userName)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $message = new Message();
        $message->sender_id = auth()->id();
        $message->receiver_id = $userId;
        $message->content = $request->input('content');

        $message->save();

        return redirect()->route('chat.show', ['userId' => $userId, 'userName' => $userName]);
    }
}
