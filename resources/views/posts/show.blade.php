<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/showPost.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Show Post</title>
</head>
<body>
@include('layouts.header')


<div class="showDiv">


    <div class="profilePhoto">
    @if ($post->user->profile_photo_path)
        <img src="{{ asset('storage/' . $post->user->profile_photo_path) }}" alt="User Image" style="width:40px;height:40px;border-radius:50%;">
    @else
        <p>Нет изображения профиля для этого пользователя</p>
    @endif
    <h2>{{ $post->user->name }}</h2>
    </div>


    <div>
        @foreach ($post->postUrls as $upload)
            <img src="{{ asset('storage/uploads/' . $upload->url) }}"  style="width:500px;height:500px;border:solid 2px">
        @endforeach
    </div>

    <div class="likeComm">
    <form style="display:flex" method="POST" action="{{ route('like', ['postId' => $post->id]) }}">
        @csrf
        @php
            $like = App\Models\Like::where('user_id', auth()->id())
                                   ->where('post_id', $post->id)
                                   ->first();
        @endphp
        @if ($like)
            <button type="submit"><i class="fa fa-heart" aria-hidden="true"></i></button>
        @else
            <button type="submit"><i class="fa fa-heart-o" aria-hidden="true"></i></button>
        @endif
    </form>

    <a href="{{ route('comments.create', ['postId' => $post->id]) }}">
        <button><i class="fa fa-comment-o" aria-hidden="true"></i></button>
    </a>
    <form method="POST" action="{{ route('photos.toggleSave', ['postId' => $post->id]) }}">
    @csrf
    {{-- Проверяем, сохранена ли уже фотография --}}
    @php
        $saved = App\Models\SavedPhoto::where('user_id', auth()->id())
                                       ->where('post_id', $post->id)
                                       ->exists();
    @endphp
    {{-- Изменяем иконку в зависимости от сохранения --}}
    @if ($saved)
        <button type="submit"><i class="fa fa-bookmark" aria-hidden="true"></i></button>
    @else
        <button type="submit"><i class="fa fa-bookmark-o" aria-hidden="true"></i></button>
    @endif
</form>



    </div>
    <h2>Title: {{ $post->title }}</h2>

</div>
</body>
</html>
