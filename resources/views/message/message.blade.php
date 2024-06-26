@extends('layouts.app')

@section('content')
@if ($existingMessage)
    <p>У вас уже есть активное сообщение этому пользователю.</p>
@else
    <!-- Форма для отправки сообщения -->
    <form method="POST" action="{{ route('message.store', $recipient->id) }}">
        @csrf

        <div class="form-group">
            <label for="content">Сообщение:</label>
            <textarea id="content" name="content" class="form-control" rows="5" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Отправить</button>
    </form>
@endif


@endsection
