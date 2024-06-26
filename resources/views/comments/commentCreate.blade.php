
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/comment.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Create Comment</title>
</head>
<body>
    @include('layouts.header')

    <div class="commentDiv">
        <div class="comments-list">
            @foreach($comments as $comment)
                <div class="comment-item">
                    <a href="{{ route('profile_show', ['id' => $comment->user->id]) }}">
                        @if ($comment->user->profile_photo_path)
                            <img src="{{ asset('storage/' . $comment->user->profile_photo_path) }}" alt="User Image" style="width:50px;height:50px;border-radius:50%;">
                        @else
                            <p>No profile image available for this user</p>
                        @endif
                    </a>
                    <h2><strong>{{ $comment->user->name }}:</strong></h2>
                    <p>{{ $comment->content }}</p>

                    @if ($comment->user_id === auth()->id())
                        <form name="delete" method="POST" action="{{ route('comments.destroy', ['commentId' => $comment->id]) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit"><i class="fa fa-trash" aria-hidden="true"></i></button>
                        </form>
                    @endif
                </div>
            @endforeach
        </div>

        <div class="comment">
            <form method="POST" action="{{ route('comments.store', ['postId' => $postId]) }}">
                @csrf
                <textarea name="content" rows="3" cols="45"></textarea><br><br>
                <button type="submit" style="width:80px">Send</button>
            </form>
        </div>
    </div>

</body>
</html>
