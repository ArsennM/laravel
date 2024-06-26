<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/showFollowers.css') }}" rel="stylesheet">
    
    <title>Following</title>
</head>
@include('layouts.header')

<body class="body">
    <div id="headDiv">


    @foreach($following as $followed)
    <div class="cont">
        <img class="profile_photo" src="{{ asset('storage/' . $followed->profile_photo_path) }}" style="width:50px;height:50px;border-radius:50%">
        @if($followed->id === auth()->id())
            <a href="{{ route('profile') }}">
                {{ $followed->name }}
            </a>
        @else
            <a href="{{ route('profile_show', $followed->id) }}">
                {{ $followed->name }}
            </a>
        @endif
    </div>
@endforeach



    </div>
</body>
</html>
