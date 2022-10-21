@section('header')
<style type="text/css">
    .card{
        margin: 10px;
    }
    table thead th{
        text-align: center;
    }
    .form-input{
        width: 20em;
        border-radius: 5px;
        border: 1px solid lightgray;
        height: 2.2em;
    }
    .dropdown a{
        color: black;
    }
    .dropdown a:active{
        color: black;
    }
    .edit-btn:hover{
        cursor: pointer;
    }
</style>
@endsection

@extends('layout')

@section('content')
    <div class="card">
        <div class="card-header" style="border-bottom: none">
            <div class="header-content d-flex justify-content-between align-items-center">
                <div class="left">
                    <h1>{{__('form.'.$title)}}</h1>
                </div>
                <div class="right">
                    <div class="d-flex justify-content-end" style="margin-bottom: 0.5em;">

                        <a class="btn btn-info" href="{{$add}}"><i class="bi bi-plus-square-fill"></i> Add New</a>
                    </div>
                    <div class="search d-flex align-items-center">
                        {{-- <form action="{{$searchRoute}}" method="get">
                            @if (isset($searched))
                                <input type="text" placeholder="Search" class="form-input" name="q" value={{$searched}}>
                            @else
                                <input type="text" placeholder="Search" class="form-input" name="q">
                            @endif
                            <button type="submit" class="btn btn-primary" style="margin-left: 10px;">Search</button>
                        </form> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="content-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 1%;">NO.</th>
                            @foreach ($main as $th)
                                @if (!isset($th['input']))
                                    <th @isset($th['width'])style="width: {{$th['width']}}" @endisset  @isset($th['display']) style="display: none;" @endisset>{{$th['label']}}</th>
                                @endif
                            @endforeach
                            <th style="width: 1%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contents as $index => $item)
                            <tr>
                                <form method="POST" action="/{{$table}}/delete">
                                    @csrf
                                    @method('delete')
                                    <td class="text-center">{{$index + 1}}</td>
                                    @foreach ($main as $key => $td)
                                        @if (isset($td['input']))
                                            <input type="hidden" id="id" name="id" value="{{(@$item->{$td['col']})}}">
                                        @else
                                            @if ($key == 1)
                                            <td class="{{$td['col']}}"><a class="edit-btn" style="text-decoration: none; color: #00c3ff">{{(@$item->{$td['col']})}}</a></td>
                                            @else
                                            <td class="{{$td['col']}}">{{(@$item->{$td['col']})}}</td>
                                            @endif
                                        @endif
                                    @endforeach
                                    <td style="text-align: center">
                                        <div class="dropdown">
                                            <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="padding: 0;">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item detail-btn">Details</a></li>
                                                <li><button class="dropdown-item delete-btn" type="submit">Delete</button></li>
                                            </ul>
                                        </div>
                                    </td>
                                </form>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('footer')
<script type="text/javascript">
    $('.edit-btn').on('click', function(){
        var row = this.parentNode.parentNode;
        var id = $(row).find('input#id').val();
        window.location.assign('{{(new \App\Helpers\Helper)->getFullUrl()}}/edit/'+id);
    });
    $('.detail-btn').on('click', function(){
        var row = this.parentNode.parentNode.parentNode.parentNode.parentNode;
        var id = $(row).find('input#id').val();
        window.location.assign('{{(new \App\Helpers\Helper)->getFullUrl()}}/details/'+id);
    });
</script>
@endsection
