@extends('layout')

@section('header')
<style>
    body{
        margin: 10px;
        background-color: darkgray;
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
<div class="dropdown text-end">
    <button class="btn btn-outline-dark dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: white; border: none">
      {{strtoupper(session('locale') ?? config('app.locale'))}}
    </button>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
      <li><a class="dropdown-item" href="{{url('/register/switch/en')}}">EN</a></li>
      <li><a class="dropdown-item" href="{{url('/register/switch/id')}}">ID</a></li>
    </ul>
</div>
<div class="card login-card" style="width: 26em; border-radius: 20px;">
    <div class="card-body">
        <h5 class="card-title">Login</h5>
        <form method="POST" action="{{route('login_data')}}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">{{__('form.Email Address')}}</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email">
                @error('email')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">{{__('form.Password')}}</label>
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
            <button type="submit" class="btn btn-primary" style="width: 5em">
                {{__('form.Login')}}
            </button>
        </form>
    </div>
</div>
@endsection

