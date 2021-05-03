@extends('layouts.main')

@section('title', 'Login')

@section('content')
<div class="row">
    <div class="col-6 mx-auto">
    <p>Don't have an account? Please <a class="details-link" href="{{ route('registration.index') }}">register</a>.</p>
    <form method="post" action="{{ route('auth.login') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label" for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control" value="{{old('email')}}">
            @error('email') 
                <small class="text-danger"> {{ $message }} </small>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label" for="password">Password</label>
            <input type="password" id="password" name="password" class="form-control">
        </div>
        <input type="submit" value="Login" class="btn btn-dark">
    </form>
    </div>
</div>
@endsection