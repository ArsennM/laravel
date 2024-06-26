<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="{{ asset('css/changeName.css') }}" rel="stylesheet">

    <title>Document</title>
</head>
<body>
    
@extends('layouts.app')
@include('layouts.header')

@section('content')
            <div class="card-body">
                    <div class="div">
                        <form method="POST" action="{{ route('change-name') }}">
                            @csrf

                        <div>
                    <div>
                    <label class="col-md-4 col-form-label text-md-right">{{ __('Old Name') }}</label>

                    </div>

                        <input id="oldName" type="oldName" class="form-control @error('oldName') is-invalid @enderror" name="oldName" required autocomplete="old-name" value="{{$user->name }}">
                        </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('New Name') }}</label>

                                <div class="col-md-6">

                                    <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name" required autocomplete="new-name">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="buttonDiv">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Change Name') }}
                                        <a href=" route{{ 'change-name' }} "></a>
                                        
                                    </button>
            <div class="divChangePassword"><a href="{{route('change-password')}}">Change Password</a></div>

                                </div>
                            </div>
                        </form>

                </div>
</div>
@endsection

</body>
</html>

