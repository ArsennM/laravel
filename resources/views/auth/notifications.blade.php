<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/notifications.css') }}" rel="stylesheet">

    <title>Уведомления</title>
</head>
<body>
@include('layouts.header')
    

<div class="headDiv">
<h2>Follow Requests</h2>

    @if ($followRequests->isNotEmpty())
        @foreach ($followRequests as $request)
                @if ($request->sender)
                        Пользователь : {{ $request->sender->name }} отправил вам запрос на подписку<br> 
                @else
                    <em>Отправитель не найден</em><br>
                @endif

                <form method="POST" action="{{ route('notifications.accept', ['id' => $request->id]) }}">
                 @csrf
                <button type="submit">Принять</button>
            </form>
                <form method="POST" action="{{ route('notifications.reject', $request->id) }}">
                    @csrf
                    <button type="submit">Отклонить</button>
                </form>
        @endforeach

    @endif
    @foreach ($followers as $follower)
    <div style="width:100%;height:100px;border:solid;display:flex;align-items:center;gap:20px">
                 @if ($follower->profile_photo_path)
                <img style="width:80px;height:80px;border-radius:50%;" src="{{ asset('storage/' . $follower->profile_photo_path) }}" alt="Profile Photo">
            @endif
             <h1>{{ $follower->name }}</h1> <h2> подписался на вас </h2>
    </div>
            
    @endforeach

    <h2>Likes</h2>
    @foreach ($likes as $like)
    <div style="width:100%;height:100px;border:solid;display:flex;align-items:center;gap:20px">
    <img style="width:80px;height:80px;border-radius:50%;" src="{{ asset('storage/' . $like->user->profile_photo_path) }}" alt="Profile Photo">
      <h1> {{ $like->user->name }} </h1> <h2> поставил лайк вашему посту </h2>
      @foreach (\App\Models\PostUrl::where('post_id', $like->post->id)->get() as $postUrl)
        <img style="width:80px;height:80px;border-radius:50%;" src="{{ asset('storage/uploads/'. $postUrl->url) }}" >
        @php echo $postUrl->url  @endphp
     @endforeach
     </div>
    @endforeach
</div>
</body>
</html>
