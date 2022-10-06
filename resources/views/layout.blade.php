<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$title}}</title>
    {{-- bootstrap css --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .bi-person-circle{
            font-size: 2em;
        }
        button{
            height: 2.5em;
        }
        .card-header{
            background-color: white;
        }
    </style>
    @yield('header')
</head>
<body>
    {{-- {{$login}} --}}
    @if ($title == 'Register' || $title == 'Login')
    @else
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{route('dashboard')}}">WMS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Master
                    </a>
                    <ul class="dropdown-menu">
                        {{-- <li><a class="dropdown-item" href="#">User</a></li> --}}
                        <li><a class="dropdown-item" href="{{route('countries')}}">Country</a></li>
                        <li><a class="dropdown-item" href="{{route('uoms')}}">Unit of measurement</a></li>
                        <li><a class="dropdown-item" href="{{route('shelflife')}}">Shelf Life</a></li>
                        <li><a class="dropdown-item" href="{{route('items')}}">Item</a></li>
                        <li><a class="dropdown-item" href="{{route('aisles')}}">Aisle</a></li>
                        <li><a class="dropdown-item" href="{{route('vendors')}}">Vendor</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Transaction
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Incoming</a></li>
                        <li><a class="dropdown-item" href="#">Outgoing</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Report
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">History Transaction</a></li>
                        <li><a class="dropdown-item" href="#">Item Transaction</a></li>
                    </ul>
                </li>
                </ul>
                @if(auth()->user())
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: black">
                            {{-- <i class="bi bi-person-circle fa-lg" style="margin-right: 0.5em; color: black"></i> --}}
                            {{auth()->user()->name}}
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Profile</a></li>
                            <form action="{{route('logout')}}" method="POST">
                                @csrf
                                <li><button class="dropdown-item" href="" type="submit">Logout</button></li>
                            </form>
                        </ul>
                    </li>
                </ul>
                @else
                <form action="{{route('login_page')}}" method="GET">
                    <button class="btn btn-primary">Login</button>
                </form>
                @endif
            </div>
        </div>
    </nav>
    @endif

    <div class="content">
        @yield('content')
    </div>

    {{-- bootstrap js --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    {{-- jquery cdn --}}
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    {{-- select2 js --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @yield('footer')
</body>
</html>
