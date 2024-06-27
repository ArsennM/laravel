<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/profile.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Document</title>
</head>
<body>
@include('layouts.header')
<div class="div">
<div class="info">
    <div class="div1">
    @if($user)
        <img class="profilePhoto" src="{{ asset('storage/' . $user->profile_photo_path) }}">
        <h1>ssss</h1>
        <h1>{{ $user->name }}</h1>
        
        <div>
            <p>Подписчики: <a href="{{ route('follow.showFollowers', $user->id) }}">{{ $user->followers()->count() }}</a></p>
            <p>Подписки: <a href="{{ route('follow.showFollowing', $user->id) }}">{{ $user->following()->count() }}</a></p>
        </div>


        @if($user->posts->isNotEmpty())
    </div>
    <div class="photos">
        <h3>Posts</h3>
        @foreach($user->posts as $post)
            @foreach($post->postUrls as $url)
                <img class="post" src="{{ asset('storage/uploads/' . $url->url) }}" alt="Post Photo">
                <div>
                    <button class="like-btn" data-post-id="{{ $post->id }}">
                        <i class="fa fa-heart-o" aria-hidden="true"></i>
                    </button>
                    <i class="fa fa-comment-o" aria-hidden="true"></i>
                </div>
            @endforeach
        @endforeach
    </div>
    @endif
    @endif
</div>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('.like-btn').click(function() {
            var postId = $(this).data('post-id'); 
            var likeButton = $(this); 

            $.ajax({
                url: '/like/' + postId, 
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) { 
                    if (response.liked) {
                        likeButton.find('i').removeClass('fa-heart-o').addClass('fa-heart');
                    } else {
                        likeButton.find('i').removeClass('fa-heart').addClass('fa-heart-o');
                    }
                },
                error: function(xhr, status, error) { 
                    console.error(error); 
                }
            });
        });
    });
</script>
</body>
</html>


