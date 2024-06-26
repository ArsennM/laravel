
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/users.css') }}" rel="stylesheet">

    <title>Document</title>
</head>
<body>
@include('layouts.header')

@extends('layouts.app')

@section('content')

                    <div class="card-body">
                        <table class="table">
                                @foreach($users as $user)
                                    @if($user->id !== Auth::id())
                                        <div class="profiles">
                                            <img class="profile_photo" src="{{ asset('storage/' . $user->profile_photo_path) }}"  style="width:50px;height:50px">
                                            <a href="{{ route('profile_show', $user->id) }}">{{ $user->name }}</a>
                                        </div>
                                    @endif
                                @endforeach
                        </table>
                    </div>
@endsection

</body>
</html>
