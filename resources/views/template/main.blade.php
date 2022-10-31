@section('header')
<style type="text/css">
    .card{
        margin: 10px;
        /* border: none; */
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
            <div class="header-content">
                <div class="">
                    <h1>{{__('form.'.$title)}}</h1>
                </div>
                <div class=" d-flex justify-content-between align-items-center">
                    <div class="search d-flex align-items-center">
                        <form action="{{(new \App\Helpers\Helper)->getFullUrl()}}" method="get">
                            <input type="text" placeholder="Search" class="form-input" name="q">
                            <button type="submit" class="btn btn-primary" style="margin-left: 10px;">Search</button>
                        </form>
                    </div>
                    <div class="right">
                        <div class="d-flex justify-content-end" style="margin-bottom: 0.5em;">
                            <a class="btn btn-info" href="{{$add}}"><i class="bi bi-plus-square-fill"></i> Add New</a>
                        </div>
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
                                    <th @isset($th['width'])style="width: {{$th['width']}}" @endisset  @isset($th['display']) style="display: none;" @endisset>{{__('form.'.$th['label'])}}</th>
                                @endif
                            @endforeach
                            <th style="width: 1%">{{__('form.Action')}}</th>
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
                                            <td class="{{$td['col']}} text-center"><a class="edit-btn" style="text-decoration: none; color: #00c3ff">{{(@$item->{$td['col']})}}</a></td>
                                            @else
                                                @if ($td['col'] == 'stock')
                                                    @if ((@$item->{$td['col']}) < 24)
                                                        <td class="{{$td['col']}} text-center" style="color: red">{{(@$item->{$td['col']})}} <i class="bi bi-exclamation-triangle"></i> Low Stock</td>
                                                    @else
                                                        <td class="{{$td['col']}} text-center">{{(@$item->{$td['col']})}}</td>
                                                    @endif
                                                @else
                                                    <td class="{{$td['col']}} text-center">{{(@$item->{$td['col']})}}</td>
                                                @endif
                                            @endif
                                        @endif
                                    @endforeach
                                    <td style="text-align: center">
                                        <div class="dropdown">
                                            <a class="" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="padding: 0;">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item detail-btn">{{__('form.Details')}}</a></li>
                                                <li><button class="dropdown-item delete-btn" type="submit">{{__('form.Delete')}}</button></li>
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
        window.location.assign('{{$table}}/edit/'+id);
    });
    $('.detail-btn').on('click', function(){
        var row = this.parentNode.parentNode.parentNode.parentNode.parentNode;
        var id = $(row).find('input#id').val();
        window.location.assign('{{$table}}/details/'+id);
    });
</script>
@endsection
