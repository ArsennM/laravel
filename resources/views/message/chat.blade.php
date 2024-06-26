<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/chat.css') }}" rel="stylesheet">
    <title>Document</title>
</head>
<body>
@include('layouts.header')
@extends('layouts.app')
<div class="chatsPart">
    <h1>Chat with {{ $recipient->name }}</h1>
    <div class="messageDiv">
        <div class="chatDiv">
    <div id="messages">
        @foreach($messages as $message)
            <p><strong>{{ $message->sender_id == auth()->id() ? 'You' : $recipient->name }}:</strong> {{ $message->content }}</p>
        @endforeach
    </div>

    <form action="{{ route('chat.sendMessage', ['userId' => $recipient->id, 'userName' => $recipient->name]) }}" method="POST">
        @csrf
        <textarea name="content" id="content" cols="30" rows="3" required></textarea>
        <button type="submit">Send</button>
    </form>
</div>
</div>
</div>
</body>
</html>
