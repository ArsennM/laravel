<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Following</title>
</head>
<body>
    <h1>Users {{ $user->name }} is following</h1>
    <ul>
        @foreach($following as $followed)
            <li>{{ $followed->name }}</li>
        @endforeach
    </ul>
</body>
</html>
