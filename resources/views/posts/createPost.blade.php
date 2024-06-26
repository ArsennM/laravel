<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="{{ asset('css/posts_create.css') }}" rel="stylesheet">

    <title>Document</title>
</head>
<body class="createPostBody">
@extends('layouts.app')
@include('layouts.header')

@section('content')
<div class="card-body">
    <form class="formCreatePost" method="POST" action="{{ route('posts-create') }}" enctype="multipart/form-data">
        @csrf
        <div>
            <?php 
            
            ?>
            <input id="image" type="file" name="files[]" required>
        </div>
        <div>
            <label for="title">Title</label>
            <textarea id="title" name="title" required></textarea>
        </div>
        <div>
            <button type="submit">Add Post</button>
        </div>
    </form>
@endsection
</div>
</body>
</html>
