@extends('layout')

@section('header')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<style type="text/css">
    body{
        background-color: #fafafa;
    }
    .card{
        margin: 10px;
        padding: 10px;
        border: none;
        border-radius: 0.6em;
    }
    .edit-btn:hover{
        cursor: pointer;
    }
    #DataTables_Table_0_filter{
        margin-bottom: 1em;
    }
    .dropdown a{
        color: black;
    }
    .dropdown a:active{
        color: black;
    }
</style>
@endsection

@section('content')

<div class="card shadow p-3 mb-3 bg-body">
    <div class="card-header" style="border-bottom: none">
        <h1>Dashboard</h1>
    </div>
</div>

@if (Helper::getCompanyId() == 1)
<?php
$users = DB::table('users')->leftJoin('companies', 'users.company_id', 'companies.id')->select('companies.name as companyName', 'users.name as name', 'users.email as email')->where('users.id', '!=', 1)->get();
?>
<div class="card shadow p-3 mb-3 bg-body">
    <div class="card-header" style="border-bottom: none">
        <div class="header-content">
            <div class="text-end">
                <a class="btn btn-info addNewUser"><i class="bi bi-plus-square-fill"></i> {{__('form.Add New')}}</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Company</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th style="width: 1%">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $item)
                <tr>
                    <td>{{$item->companyName}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->email}}</td>
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
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@else
    <div class="card shadow p-3 mb-3 bg-body">
        <div class="card-header" style="border-bottom: none">
            <h4>Recent Transaction</h4>
        </div>
        <div class="card-body" style="padding-top: 0;">
            <table class="table cell-border table-bordered transaction-table"  style="border-top: 1px solid lightgray">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 2%">NO.</th>
                        <th class="text-center">Transaction No.</th>
                        <th class="text-center">Item Name</th>
                        <th class="text-center">Item Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $key => $value)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td><a class='edit-btn transaction_detail' style='text-decoration: none; color: #00c3ff'>{{$value->transaction_no}}</a></td>
                            {{-- <td style='display: none;' id='header_id'>{{$value->header_id}}</td> --}}
                            <td>{{$value->item_name}}</td>
                            @if ($value->type == 'Incoming')
                            <td style="color: green">{{$value->qty}}</td>
                            @else
                            <td style="color: red">{{$value->qty}}</td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- {{ $transactions->links() }} --}}
        </div>
    </div>

    <div class="d-flex">
        <div class="card shadow p-3 mb-3 bg-body" style="width: 30em;">
            <div class="card-header" style="border-bottom: none">
                <h4>Stock Items</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered total-items-table">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 5%">No.</th>
                            <th class="text-center">Item Name</th>
                            <th class="text-center">Item Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card shadow p-3 mb-3 bg-body" style="width: 30em;">
            <div class="card-header" style="border-bottom: none">
                <h4>Total Items</h4>
            </div>
            <div class="card-body">
                <canvas id="myChart" width="400" height="400"></canvas>
            </div>
        </div>

        {{-- <div class="card shadow p-3 mb-3 bg-body" style="width: 500px;">
            <div class="card-body">
            </div>
        </div> --}}
    </div>
@endif

@endsection

@section('footer')
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
<script type="text/javascript">

    $(document).ready(function(){

        //superadmin

        $('.transaction-table').DataTable({
            "lengthChange": false,
            "pageLength": 5,
            "pagingType": "simple_numbers"
        });
        $.ajax({
            url: '{{(new \App\Helpers\Helper)->getMainUrl("/dashboard/data")}}',
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data){
                var transactionRow = "";
                var itemRow = "";

                $.each(data.items, function(index, value){
                    itemRow += "<tr>";
                        itemRow += "<td class='text-center'>"+(index + 1)+"</td>";
                        itemRow += "<td><a class='edit-btn item_detail' style='text-decoration: none; color: #00c3ff'>"+value.item_name+"</a></td>";
                        itemRow += "<td style='display: none;' id='item_id'>"+value.id+"</td>";
                        itemRow += "<td>"+value.stock+"</td>";
                    itemRow += "</tr>";
                });
                $('.transaction-table').find('tbody').append(transactionRow);
                $('.total-items-table').find('tbody').append(itemRow);
                $('.item_detail').on('click', function(){
                    var item_id = $(this.parentNode.parentNode).find('td#item_id').text();
                    window.location.assign('items/edit/'+item_id);
                });
                setData(data.items);
            },
        });
        // $.ajax({
        //     url: '{{(new \App\Helpers\Helper)->getMainUrl("/dashboard")}}'
        // });
        // setData(data.items);
    });

    $('.addNewUser').on('click', function(){
        window.location.assign('dashboard/add-new-user');
    });

    function setData(d){
        const ctx = document.getElementById('myChart').getContext('2d');
        var avail = 0;
        var low = 0;
        var out = 0;
        d.forEach(element => {
            if(element.stock == 0){
                out++;
            }
            else if(element.stock <= 24){
                low++;
            }
            else if(element.stock > 24){
                avail++;
            }
            // console.log(element);
        });
        const data = {
            labels: ['Available', 'Low Stock', 'Out of Stock'],
            datasets: [{
                label: '',
                data: [avail, low, out],
                backgroundColor: [
                    '#25316D',
                    '#5F6F94',
                    '#97D2EC',
                ],
                hoverOffset: 4,
                borderWidth: 0,
            }]
        };
        const config = {
            type: 'pie',
            data: data,
            options: {
            },
        };
        const myChart = new Chart(ctx, config);
    }
    </script>

@endsection
