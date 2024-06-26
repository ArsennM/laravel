<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/profile_show.css') }}" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    @include('layouts.header')

    <div class="card-body">
        
        <div class="profile">

    

    @if($user->private === 'private' && !(auth()->check() && auth()->user()->isFollowing($user)))
        <p>Этот профиль закрыт.</p>
    @endif
            <img class="profile_photo" src="{{ asset('storage/' . $user->profile_photo_path) }}"  style="width:150px;height:150px">
            <p><strong>Имя:</strong> {{ $user->name }}</p>

            @if(auth()->check() && auth()->user()->id !== $user->id)
                @if(auth()->user()->isFollowing($user))
                    <form action="{{ route('unfollow', $user->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-unfollow">Отписаться</button>
                    </form>
                @else
                    @if($user->private === 'private' && $user->requestPending(auth()->user()))
                        <form action="{{ route('cancelRequest', $user->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-secondary">Отменить запрос</button>
                        </form>
                    @else
                        <form action="{{ route('follow', $user->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success">Подписаться</button>
                        </form>


                    @endif
                @endif
            @endif

            <div>
                @if(auth()->check() && (auth()->user()->isFollowing($user) || $user->private === 'public'))
                    <p>Подписчики: <a href="{{ route('follow.showFollowers', $user->id) }}">{{ $user->followers()->count() }}</a></p>
                @endif

                @if(auth()->check() && (auth()->user()->isFollowing($user) || $user->private === 'public'))
                    <p>Подписки: <a href="{{ route('follow.showFollowing', $user->id) }}">{{ $user->following()->count() }}</a></p>
                @endif
            </div>
            @if(auth()->check() && (auth()->user()->isFollowing($user) || $user->private === 'public'))
        <a href="{{ route('message.create', $user->id) }}" class="btn btn-primary">Отправить сообщение</a>
    @endif
        </div>
    </div>
<!-- 
    @if(auth()->check() && (auth()->user()->isFollowing($user) || $user->private === 'public'))
        <a href="{{ route('message.create', $user->id) }}" class="btn btn-primary">Отправить сообщение</a>
    @endif

    @if($user->private === 'private' && !(auth()->check() && auth()->user()->isFollowing($user)))
        <p>Этот профиль закрыт.</p>
    @endif -->

</body>
</html>
