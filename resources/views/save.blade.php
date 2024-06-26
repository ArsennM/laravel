<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/save.css') }}" rel="stylesheet">
    <title>Saved Photos</title>
</head>
<body>
    @include('layouts.header')

    <div class="saved-photos">
        @foreach ($savedPhotos as $savedPhoto)
            <div class="saved-photo-item">
                @php
                    $postUrl = $savedPhoto->post->postUrls->first()->url;
                @endphp
                <a href="{{ route('post.show', ['post' => $savedPhoto->post_id]) }}">
                    <img style="width:200px;height:200px" src="{{ asset('storage/uploads/' . $postUrl) }}" alt="Saved Photo">
                </a>
            </div>
        @endforeach
    </div>
</body>
</html>

