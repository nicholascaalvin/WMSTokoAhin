@extends('layout')

@section('header')
    <style type="text/css">
        .card{
            margin: 10px;
            padding: 10px;
        }
    </style>
@endsection

@section('content')

<div class="card">
    <div class="card-header">
        <h1>Dashboard</h1>
    </div>
    <div class="card-body">
        <ul class="nav nav-tabs">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Active</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled">Disabled</a>
            </li>
        </ul>
    </div>
</div>

@endsection
