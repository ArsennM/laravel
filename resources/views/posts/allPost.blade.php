<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/allPost.css') }}" rel="stylesheet">

    <title>All Posts</title>
</head>
<body>
@include('layouts.header')

<div class="allPost">
    @foreach($posts as $post)
        <div>
            @if ($post->postUrls->isNotEmpty())
                @foreach($post->postUrls as $postUrl)
                    <a href="{{ route('post.show', $post->id) }}">
                        <div>
                            <img src="{{ asset('storage/uploads/' . $postUrl->url) }}" style="width:200px;height:200px;border:solid 2px">
                        </div>
                    </a>
                @endforeach
            @endif
        </div>
    @endforeach
</div>
</body>
</html>
