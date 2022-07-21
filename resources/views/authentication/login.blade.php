@extends('layout')

@section('style')
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
@if(session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{session('success')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
<div class="card login-card" style="width: 26em;">
    <div class="card-body">
        <h5 class="card-title">Login</h5>
        <form method="POST" action="{{route('login_data')}}">
            @csrf
            <div class="mb-3">
              <label for="email" class="form-label">Email address</label>
              <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email">
              <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password">
            </div>
            {{-- <div class="mb-3 form-check">
              <input type="checkbox" class="form-check-input" id="exampleCheck1">
              <label class="form-check-label" for="exampleCheck1">Remember Me</label>
            </div> --}}
            <div class="d-flex justify-content-between">
                <a href="{{route('register_page')}}">Register here now!</a>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
        {{-- <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        <a href="#" class="card-link">Card link</a>
        <a href="#" class="card-link">Another link</a> --}}
    </div>
</div>
@endsection

