@extends('layout')

@section('header')
<style>
    body{
        margin: 10px;
    }
    .login-card{
        position: absolute;
        top: 50%;
        left: 50%;
        -ms-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
    }
    .card-title{
        text-align: center;
        font-weight: bold;
        font-size: 40px;
        margin-bottom: 1em;
    }
</style>
@endsection

@section('content')
<div class="card login-card" style="width: 26em;">
    <div class="card-body">
        <h5 class="card-title">Login</h5>
        <form method="POST" action="{{route('login_data')}}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email">
                @error('email')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                @error('password')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
            {{-- <div class="mb-3 form-check">
              <input type="checkbox" class="form-check-input" id="exampleCheck1">
              <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div> --}}
            <button type="submit" class="btn btn-primary">
                Login
            </button>
        </form>
    </div>
</div>
@endsection

