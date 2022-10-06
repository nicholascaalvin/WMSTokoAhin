{{--
    MUST HAVE :
    1. moduleName   .... list
    2. addNewRoute  route...getIndex
    3. searchRoute  route...search
    4. deleteFunction  function delete
    5. detailFunction function edit
    6. tableHeader  table head


@extends('template.main')

@extends('layout')

<?php
?>

@section('header')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<style type="text/css">
</style>
@endsection

@section('footer')
<script type="text/javascript">
    function delete..(row){

    }
    function detail..(row){

    }
</script>
@endsection
--}}

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
</style>

<div class="card">
    <div class="card-header" style="border-bottom: none">
        <div class="header-content d-flex justify-content-between align-items-center">
            <div class="left">
                <h1>{{$moduleName}}</h1>
            </div>
            <div class="right">
                <div class="d-flex justify-content-end" style="margin-bottom: 0.5em;">
                    <a class="btn btn-info" href="{{$addNewRoute}}"><i class="bi bi-plus-square-fill"></i> Add New</a>
                </div>
                <div class="search d-flex align-items-center">
                    <form action="{{$searchRoute}}" method="get">
                        @if (isset($searched))
                            <input type="text" placeholder="Search" class="form-input" name="q" value={{$searched}}>
                        @else
                            <input type="text" placeholder="Search" class="form-input" name="q">
                        @endif
                        <button type="submit" class="btn btn-primary" style="margin-left: 10px;">Search</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="content-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 1%">NO.</th>
                        @foreach ($tableHeader as $item)
                            <th @isset($item['width'])style="width: {{$item['width']}}" @endisset  @isset($item['display']) style="display: none;" @endisset>{{$item['label']}}</th>
                        @endforeach
                        <th style="width: 1%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $i = 1;
                    ?>
                    @foreach ($data as $item)
                        <tr>
                            <td>{{$i}}</td>
                            @foreach ($tableHeader as $td)
                            @if (isset($td['from']))
                                <?php
                                    $country = DB::table($td['from'])->select('name')->where('id', $item->country_id)->pluck('name')->first();
                                ?>
                                <td class="{{$td['col']}}" @isset($td['display']) style="display: none;" @endisset>{{$country}}</td>
                            @else

                                <td class="{{$td['col']}}" @isset($td['display']) style="display: none;" @endisset>{{(@$item->{$td['col']})}}</td>
                            @endif
                            @endforeach
                            <td style="text-align: center">
                                <div class="dropdown">
                                    <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                      <li><a class="dropdown-item" onclick="{{$detailFunction}}">Edit</a></li>
                                      <li><a class="dropdown-item" onclick="{{$deleteFunction}}">Delete</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <?php
                            $i++
                        ?>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
