@section('header')
<style type="text/css">
    .content{
        margin: 10px;
    }
    table thead th{
        text-align: center;
    }
</style>
@endsection

@section('content')
{{-- <div class="card">
    <div class="card-header" style="border-bottom: none">
        <div class="header-content d-flex justify-content-between align-items-center">
            <h1>Item List</h1>
            <a class="btn btn-info" href="{{route('add-items')}}">Add New</a>
        </div>
    </div>
    <div class="card-body">
        <div class="content-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 1%">NO.</th>
                        <th style="width: 10%">Item Code</th>
                        <th style="width: 10%">Item Name</th>
                        <th style="width: 1%">Incoming</th>
                        <th style="width: 1%">Outgoing</th>
                        <th style="width: 1%">Stock</th>
                        <th style="width: 3%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($items)
                    <?php
                        $i = 1;
                    ?>
                        @foreach ($items as $item)
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{$item->code}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->incoming}}</td>
                                <td>{{$item->outgoing}}</td>
                                <td>{{$item->stock}}</td>
                                <td>
                                    <div class="dropdown">
                                        <a class="btn btn-sm dropdown-toggle hide-arrow" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-ellipsis-v"></i>
                                        </a>
                                        <ul class="dropdown-menu">
                                          <li><a class="dropdown-item" href="#">Action</a></li>
                                          <li><a class="dropdown-item" href="#">Another action</a></li>
                                          <li><a class="dropdown-item" href="#">Something else here</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <?php
                                $i++;
                            ?>
                        @endforeach
                    @else

                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div> --}}
@endsection

@section('footer')
@endsection

<?php
    $moduleName = 'Item List';
    $addNewRoute = route('add-items');
    $table = DB::table('items')->get();
    $tableHeader = [ ['NO.', 'width: 1%'],
                ['Item Code', 'width: 10%'],
                ['Item Name', 'width: 10%'],
                ['Incoming', 'width: 1%'],
                ['Outgoing', 'width: 1%'],
                ['Stock', 'width: 1%'],
                ['Action', 'width: 1%']];
?>

@extends('detail')

@extends('layout')
