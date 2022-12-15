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
    .mid-content{
        display: flex;
    }
    .transactions-card{
        width: 50%;
    }
    .items-card{
        width: 25%;
    }
    .stock-card{
        width: 25%;
    }
    @media only screen and (max-width: 700px) {
        .mid-content{
            display: block;
        }
        .table-transaction th{
            font-size: 13px;
        }
        .table-transaction td{
            font-size: 10px;
        }
        .transactions-card{
            width: 95%;
        }
        .items-card{
            width: 95%;
        }
        .stock-card{
            width: 95%;
        }
    }
</style>
@endsection

@section('content')

<div class="card shadow p-3 mb-3 bg-body">
    <div class="card-header" style="border-bottom: none">
        <h1 style="margin-bottom: 0">Dashboard</h1>
    </div>
</div>

@if (Helper::getCompanyId() == 1)
<?php
$users = DB::table('users')->leftJoin('companies', 'users.company_id', 'companies.id')->select('users.id', 'companies.name as companyName', 'users.name as name', 'users.email as email')->where('users.id', '!=', 1)->get();
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
                    <th style="display: none">ID</th>
                    <th>Email</th>
                    <th style="width: 1%">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $item)
                <tr>
                    <td>{{$item->companyName}}</td>
                    <td>{{$item->name}}</td>
                    <td style="display: none" class="user-id">{{$item->id}}</td>
                    <td>{{$item->email}}</td>
                    <td style="text-align: center">
                        <div class="dropdown">
                            <a class="" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="padding: 0;">
                                <i class="bi bi-three-dots-vertical"></i>
                            </a>
                            <ul class="dropdown-menu">
                                {{-- <li><a class="dropdown-item detail-btn">{{__('form.Details')}}</a></li> --}}
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
        <div class="card-body" style="padding-top: 0; padding-bottom: 0">
            <table class="table table-responsive table-bordered table-transaction"  style="border-top: 1px solid lightgray">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 2%">NO.</th>
                        <th class="text-center">Transaction No.</th>
                        <th class="text-center">Transaction Date</th>
                        <th class="text-center">Item Name</th>
                        <th class="text-center">Item Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $key => $value)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td id="transaction_no"><a class='edit-btn transaction_detail' style='text-decoration: none; color: #00c3ff'>{{$value->transaction_no}}</a></td>
                            <td id="transaction_date">{{$value->transaction_date}}</td>
                            <td style='display: none;' id='header_id'>{{$value->header_id}}</td>
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
        </div>
    </div>

    <div class="mid-content">
        <div class="card shadow p-3 mb-3 bg-body transactions-card">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                  <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Incomings</button>
                  <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Outgoings</button>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent" style="margin-top: 1em">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
                    <h4>Incomings</h4>
                    <canvas id="IncomingsChart"></canvas>
                </div>
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
                    <h4>Outgoings</h4>
                    <canvas id="OutgoingsChart"></canvas>
                </div>
              </div>
        </div>

        <div class="card shadow p-3 mb-3 bg-body items-card">
            <div class="card-header" style="border-bottom: none; padding-bottom: 0">
                <h4 style="margin-bottom: 0">Total Items</h4>
            </div>
            <div class="card-body">
                <canvas id="totalItemsChart"></canvas>
            </div>
        </div>

        <div class="card shadow p-3 mb-3 bg-body stock-card">
            <div class="card-header" style="border-bottom: none">
                <h4>Stock Items</h4>
            </div>
            <div class="card-body" style="padding-bottom: 0">
                <table class="table cell-border table-bordered total-items-table" style="border-top: 1px solid lightgray">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 5%">No.</th>
                            <th class="text-center">Item Name</th>
                            <th class="text-center" style="display: none">Item Id</th>
                            <th class="text-center">Item Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $key => $item)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td><a class='edit-btn item_detail' style='text-decoration: none; color: #00c3ff'>{{$item->item_name}}</a></td>
                                <td style='display: none;' id='item_id'>{{$item->id}}</td>
                                <td>{{$item->stock}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endif

@endsection

@section('footer')
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
<script type="text/javascript">
    var year = new Date().getFullYear();

    $(document).ready(function(){

        if({{Helper::getCompanyId()}} == 1){
            // $('.detail-btn').on('click', function(){
            //     var userid = $(this.parentNode.parentNode.parentNode.parentNode.parentNode).find('td.user-id').text();
            //     window.location.assign('/dashboard/details/'+userid);
            // });

            $('.delete-btn').on('click', function(){
                var userid = $(this.parentNode.parentNode.parentNode.parentNode.parentNode).find('td.user-id').text();
                window.location.assign('/dashboard/delete/'+userid);
            });
        }

        // $('.table-transaction').DataTable({
        //     "paging": false,
        // });

        $('.total-items-table').DataTable({
            "lengthChange": false,
            "pageLength": 5,
            "pagingType": "simple_numbers"
        });
        $('#DataTables_Table_1_filter').css('margin-bottom', '1em');

        $.ajax({
            url: '{{(new \App\Helpers\Helper)->getMainUrl("/dashboard/data")}}',
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data){
                setTotalItemsChart(data.items);
                setIncomingsChart(data.incomings);
                setOutgoingsChart(data.outgoings);
            },
        });
    });

    $('.transaction_detail').on('click', function(){
        var transaction_no = $(this.parentNode.parentNode).find('td#transaction_no').text();
        var header_id = $(this.parentNode.parentNode).find('td#header_id').text();
        var type = transaction_no.split('/');
        if(type[0] == 'IC'){
            window.location.assign('incomings/edit/'+header_id);
        }
        else{
            window.location.assign('outgoings/edit/'+header_id);
        }
    });

    $('.item_detail').on('click', function(){
        var item_id = $(this.parentNode.parentNode).find('td#item_id').text();
        window.location.assign('items/edit/'+item_id);
    });

    $('.addNewUser').on('click', function(){
        window.location.assign('dashboard/add-new-user');
    });

    function setTotalItemsChart(d){
        const ctx = document.getElementById('totalItemsChart').getContext('2d');
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
                responsive: true,
            },
        };
        const totalItemsChart = new Chart(ctx, config);
    }

    function setIncomingsChart(d){
        var data1 = [];
        for (let index = 0; index < 12; index++) {
            data1.push(0);
        }
        d.forEach(element => {
            data1[element.transaction_date-1] = element.qty;
        });
        const ctx = document.getElementById('IncomingsChart').getContext('2d');
        const data = {
        labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
        datasets: [{
            label: year +' Incomings Transaction',
            data: data1,
            backgroundColor: [
                '#495C83', //jan
                '#6E85B7', //feb
                '#7A86B6', //mar
                '#A8A4CE', //apr
                '#B689C0', //may
                '#C8B6E2', //jun
                '#BAABDA', //nov
                '#B2C8DF', //aug
                '#C4D7E0', //sep
                '#9CB4CC', //okt
                '#C9CBFF', //jul
                '#D6E5FA', //dec
            ],
            borderWidth: 0
        }]
        };
        const config = {
            type: 'bar',
            data: data,
            options: {
                responsive: true,
                scales: {
                y: {
                    beginAtZero: true
                }
                }
            },
        };
        const totalItemsChart = new Chart(ctx, config);
    }

    function setOutgoingsChart(d){
        var data1 = [];
        for (let index = 0; index < 12; index++) {
            data1.push(0);
        }
        d.forEach(element => {
            data1[element.transaction_date-1] = element.qty;
        });
        const ctx = document.getElementById('OutgoingsChart').getContext('2d');
        const data = {
        labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
        datasets: [{
            label: year + ' Outgoings Transaction',
            data: data1,
            backgroundColor: [
                '#495C83', //jan
                '#6E85B7', //feb
                '#7A86B6', //mar
                '#A8A4CE', //apr
                '#B689C0', //may
                '#C8B6E2', //jun
                '#BAABDA', //nov
                '#B2C8DF', //aug
                '#C4D7E0', //sep
                '#9CB4CC', //okt
                '#C9CBFF', //jul
                '#D6E5FA', //dec
            ],
            borderWidth: 0
        }]
        };
        const config = {
            type: 'bar',
            data: data,
            options: {
                responsive: true,
                scales: {
                y: {
                    beginAtZero: true
                }
                }
            },
        };
        const totalItemsChart = new Chart(ctx, config);
    }

    </script>

@endsection
