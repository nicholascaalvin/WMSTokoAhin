{{--
    MUST HAVE :
    1. moduleName   .... list
    2. addNewRoute  route...getIndex
    3. deleteFunction  function delete
    4. detailFunction function edit
    5. data         query get dari table
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
</style>

<div class="card">
    <div class="card-header" style="border-bottom: none">
        <div class="header-content d-flex justify-content-between align-items-center">
            <h1>{{$moduleName}}</h1>
            <a class="btn btn-info" href="{{$addNewRoute}}"><i class="bi bi-plus-square-fill"></i> Add New</a>
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
