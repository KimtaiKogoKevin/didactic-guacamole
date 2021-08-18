{{--<!DOCTYPE html>--}}
{{--<html>--}}
{{--<head>--}}
{{--    <link href="{{asset('backend/css/style.css')}} "rel="stylesheet">--}}

{{--    <title> CSS Login Screen Tutorial </title>--}}
{{--</head>--}}
{{--<body>--}}
{{--<body>--}}
@extends('layouts.app')

@section('content')
<div class="login-page">
    <div class="form" action="{{route('login')}}" >
        <div class="login">
            <div class="login-header">
                <h3>LOGIN</h3>
                <p>Please enter your credentials to login.</p>
            </div>
        </div>
        <form class="login-form" action="{{ route('login') }}" method="POST">
            @csrf

            <input type="email"  class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email')}}" required autocomplete="email" autofocus  placeholder="Email Address"/>
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <input type="password"  class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="password"/>

            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <button type="submit" class="btn btn-primary">login</button>
            <p class="message">Not registered? <a href="">Create an account</a></p>
        </form>
    </div>
</div>
{{--</body>--}}
{{--</body>--}}
{{--</html>--}}
@endsection

