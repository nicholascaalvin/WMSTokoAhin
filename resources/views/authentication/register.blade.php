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
        <h5 class="card-title">Register</h5>
        <form method="POST" action="{{route('register_data')}}">
            @csrf
            <div class="mb-3">
                {{-- <label for="name" class="form-label">{{__('full_name')}}</label> --}}
                <label for="name" class="form-label">@lang('form.0')</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name">
                @error('name')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
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
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation">
                @error('password_confirmation')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
            {{-- <div class="mb-3 form-check">
              <input type="checkbox" class="form-check-input" id="exampleCheck1">
              <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div> --}}
            <div class="d-flex justify-content-between">
                <a href="{{route('login_page')}}">Already have an account?</a>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>
@endsection
