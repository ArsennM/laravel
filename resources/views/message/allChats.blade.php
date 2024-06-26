<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/allChats.css') }}" rel="stylesheet">
    <title>All Chats</title>
</head>

<body>
@include('layouts.header')

    <h1>All Chats</h1>
    <ul>
    @foreach($users as $user)
            <li><a href="{{ route('chat.show', ['userId' => $user->id , 'userName' => $user->name]) }}">{{ $user->name }}</a></li>
        @endforeach
    </ul>
</body>
</html>
