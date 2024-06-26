<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="{{ asset('css/register.css') }}" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <h1>Instagram</h1>
    </div>

    <div class="form-group">
        <label for="name">Name</label>
        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required>
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input id="password" type="password" name="password" required autocomplete="new-password">
    </div>

    <div class="form-group">
        <label for="password_confirmation">Confirm Password</label>
        <input id="password_confirmation" type="password" name="password_confirmation" required>
    </div>

    <div class="form-group">
    <label for="profile_visibility">Статус профиля</label>
    <select id="profile_visibility" name="profile_visibility">
        <option value="public">Открытый</option>
        <option value="private">Закрытый</option>
    </select>
    </div>

    <div class="form-group">
        <label for="profile_photo">Profile Photo</label>
        <input id="profile_photo" type="file" name="profile_photo" accept="image/*">
    </div>
            <div>
                    <span>Already have an account? <a href="login">Login</a> </span>
            </div>
    <button type="submit">Register</button>
</form>

@endsection

</body>
</html>

