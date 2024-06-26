<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Followers</title>
</head>
<body>
    <h1>Followers of {{ $user->name }}</h1>
    <div>
        @foreach($followers as $follower)
            <li>{{ $follower->name }}</li>
        @endforeach
    </div>
</body>
</html>
