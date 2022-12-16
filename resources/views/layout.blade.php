<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{$title}}</title>
    {{-- bootstrap css --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    {{-- select2 css --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    {{-- flatpickr date  css--}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    {{-- datatables css --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">

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
        .navbar{
            background-color: #1746A2 !important;
            color: white !important;
        }
        .navbar-brand{
            color: white !important;
        }
        @media only screen and (max-width: 700px) {
            .language{
                text-align: start !important;
            }
            .profile{
                margin-left: -12px;
            }
            .dropdown-menu.show{
                position: static;
            }
        }
    </style>
    @yield('header')
</head>
<body>

    @if ($title == 'Register' || $title == 'Login')
    @else


    {{-- <div class="sidebar">
        <a class="navbar-brand" href="{{route('dashboard')}}">WMS</a>
        <ul class="navbar-nav">
            <div class="dropdown text-end">
                <button class="btn btn-outline-dark dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                  {{strtoupper(session('locale') ?? config('app.locale'))}}
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                  <li><a class="dropdown-item" href="{{url('/dashboard/switch/en')}}">EN</a></li>
                  <li><a class="dropdown-item" href="{{url('/dashboard/switch/id')}}">ID</a></li>
                </ul>
            </div>
        </ul>
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Master
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="{{route('countries')}}">{{__('form.Country')}}</a></li>
                    <li><a class="dropdown-item" href="{{route('uoms')}}">{{__('form.Unit of Measurement')}}</a></li>
                    <li><a class="dropdown-item" href="{{route('brands')}}">{{__('form.Brand')}}</a></li>
                    <li><a class="dropdown-item" href="{{route('aisles')}}">{{__('form.Aisle')}}</a></li>
                    <li><a class="dropdown-item" href="{{route('customers')}}">{{__('form.Customer')}}</a></li>
                    <li><a class="dropdown-item" href="{{route('vendors')}}">{{__('form.Vendor')}}</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="{{route('items')}}">{{__('form.Item')}}</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    {{__('form.Transaction')}}
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="{{route('incomings')}}">{{__('form.Incoming')}}</a></li>
                    <li><a class="dropdown-item" href="{{route('outgoings')}}">{{__('form.Outgoing')}}</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    {{__('form.Report')}}
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#">{{__('form.History Transaction')}}</a></li>
                    <li><a class="dropdown-item" href="#">{{__('form.Item Transaction')}}</a></li>
                </ul>
            </li>
        </ul>
        @if(auth()->user())
            <ul class="navbar-nav profile">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: black">
                        <i class="bi bi-person-circle fa-lg" style="margin-right: 0.5em; color: black"></i>
                        {{auth()->user()->name}}
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{url('/profile/edit').'/'.auth()->user()->id}}">{{__('form.Profile')}}</a></li>
                        <form action="{{route('logout')}}" method="POST">
                            @csrf
                            <li><button class="dropdown-item" href="" type="submit">{{__('form.Logout')}}</button></li>
                        </form>
                    </ul>
                </li>
            </ul>
            @else
            <form action="{{route('login_page')}}" method="GET">
                <button class="btn btn-primary">{{__('form.Login')}}</button>
            </form>
        @endif
    </div> --}}

    <nav class="navbar navbar-expand-lg navbar-light bg-light d-flex">
        <div class="container-fluid">
          <a class="navbar-brand" href="{{route('dashboard')}}" style="font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif">MNP</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          @if (Helper::getCompanyId() != 1)
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: white">
                        Master
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{route('countries')}}">{{__('form.Country')}}</a></li>
                        <li><a class="dropdown-item" href="{{route('uoms')}}">{{__('form.Unit of Measurement')}}</a></li>
                        <li><a class="dropdown-item" href="{{route('brands')}}">{{__('form.Brand')}}</a></li>
                        <li><a class="dropdown-item" href="{{route('aisles')}}">{{__('form.Aisle')}}</a></li>
                        <li><a class="dropdown-item" href="{{route('customers')}}">{{__('form.Customer')}}</a></li>
                        <li><a class="dropdown-item" href="{{route('vendors')}}">{{__('form.Vendor')}}</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{route('items')}}">{{__('form.Item')}}</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: white">
                        {{__('form.Transaction')}}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{route('incomings')}}">{{__('form.Incoming')}}</a></li>
                        <li><a class="dropdown-item" href="{{route('outgoings')}}">{{__('form.Outgoing')}}</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: white">
                        {{__('form.Report')}}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{route('historytransaction')}}">{{__('form.History Transaction')}}</a></li>
                        <li><a class="dropdown-item" href="{{route('itemtransaction')}}">{{__('form.Item Transaction')}}</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="navbar-nav language text-end">
                <div class="dropdown">
                    <button class="btn btn-outline-dark dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="color: white;">
                      {{strtoupper(session('locale') ?? config('app.locale'))}}
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                      <li><a class="dropdown-item" href="{{url('/dashboard/switch/en')}}">EN</a></li>
                      <li><a class="dropdown-item" href="{{url('/dashboard/switch/id')}}">ID</a></li>
                    </ul>
                </div>
            </ul>
            @if(auth()->user())
                <div class="btn-group profile">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: white">
                        {{-- <i class="bi bi-person-circle fa-lg" style="margin-right: 0.5em; color: black"></i> --}}
                        {{auth()->user()->name}}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="{{url('/profile/edit').'/'.auth()->user()->id}}">{{__('form.Profile')}}</a></li>
                        <form action="{{route('logout')}}" method="POST">
                            @csrf
                            <li><button class="dropdown-item" href="" type="submit">{{__('form.Logout')}}</button></li>
                        </form>
                    </ul>
                </div>
            @else
                <form action="{{route('login_page')}}" method="GET">
                    <button class="btn btn-primary">{{__('form.Login')}}</button>
                </form>
            @endif
          </div>
          @endif
          @if (Helper::getCompanyId() == 1)
          <div class="d-flex text-end">
            <ul class="navbar-nav">
                <div class="dropdown text-end">
                    <button class="btn btn-outline-dark dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="color: white;">
                      {{strtoupper(session('locale') ?? config('app.locale'))}}
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                      <li><a class="dropdown-item" href="{{url('/dashboard/switch/en')}}">EN</a></li>
                      <li><a class="dropdown-item" href="{{url('/dashboard/switch/id')}}">ID</a></li>
                    </ul>
                </div>
            </ul>
            @if(auth()->user())
                <div class="btn-group" style="text-align: right">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: white">
                        {{-- <i class="bi bi-person-circle fa-lg" style="margin-right: 0.5em; color: black"></i> --}}
                        {{auth()->user()->name}}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="{{url('/profile/edit').'/'.auth()->user()->id}}">{{__('form.Profile')}}</a></li>
                        <form action="{{route('logout')}}" method="POST">
                            @csrf
                            <li><button class="dropdown-item" href="" type="submit">{{__('form.Logout')}}</button></li>
                        </form>
                    </ul>
                </div>
            @else
                <form action="{{route('login_page')}}" method="GET">
                    <button class="btn btn-primary">{{__('form.Login')}}</button>
                </form>
            @endif
          </div>
          @endif
        </div>
    </nav>

    @endif

    <div class="content">
        @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin: 1em;">
                {{session('success')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin: 1em;">
                {{session('error')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @yield('content')
    </div>

    {{-- bootstrap js --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    {{-- jquery cdn --}}
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    {{-- select2 js --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
    {{-- sweetalert2 js --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- flatpickr date js --}}
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    {{-- datatables js --}}
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript">
        @isset($js)
            {!! $js !!}
        @endisset

        if($(window).width() < 700){
            $('.language').removeClass('text-end');
        }
    </script>
    @yield('footer')
</body>
</html>
