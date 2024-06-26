
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/showFollowers.css') }}" rel="stylesheet">

    <title>Followers</title>
</head>
@include('layouts.header')

<body>
<div id="headDiv">

@foreach($followers as $follower)
    <div class="cont">
        <img class="profile_photo" src="{{ asset('storage/' . $follower->profile_photo_path) }}" style="width:50px;height:50px;border-radius:50%">
        @if($follower->id === auth()->id())
            <a href="{{ route('profile') }}">
                {{ $follower->name }}
            </a>
        @else
            <a href="{{ route('profile_show', $follower->id) }}">
                {{ $follower->name }}
            </a>
        @endif
    </div>
@endforeach

</div>
</body>
</html>
