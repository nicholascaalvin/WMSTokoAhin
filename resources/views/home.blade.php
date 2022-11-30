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
</style>
@endsection

@section('content')

<div class="card shadow p-3 mb-3 bg-body">
    <div class="card-header" style="border-bottom: none">
        <h1>Dashboard</h1>
    </div>
</div>

<div class="d-flex">

    <div class="card shadow p-3 mb-3 bg-body" style="width: 30em;">
        <div class="card-header" style="border-bottom: none">
            <h4>Total Items</h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 5%">No.</th>
                        <th class="text-center">Item Name</th>
                        <th class="text-center">Item Brand</th>
                        <th class="text-center">Item Quantity</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            <canvas id="myChart" width="400" height="400"></canvas>
        </div>
    </div>

    {{-- <div class="card shadow p-3 mb-3 bg-body" style="width: 500px;">
        <div class="card-body">
        </div>
    </div> --}}
</div>
@endsection

@section('footer')
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
<script type="text/javascript">

    $(document).ready(function(){
        $.ajax({
            url: '{{(new \App\Helpers\Helper)->getMainUrl("/dashboard/data")}}',
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data){
                var newRow = "";
                $.each(data, function(index, value){
                    newRow += "<tr>";
                        newRow += "<td>"+(index + 1)+"</td>";
                        newRow += "<td><a class='edit-btn' style='text-decoration: none; color: #00c3ff'>"+value.item_name+"</a></td>";
                        newRow += "<td style='display: none;' id='item_id'>"+value.id+"</td>";
                        newRow += "<td>"+value.brand_name+"</td>";
                        newRow += "<td>"+value.stock+"</td>";
                    newRow += "</tr>";
                });
                $('.table').find('tbody').append(newRow);
                $('.edit-btn').on('click', function(){
                    var item_id = $(this.parentNode.parentNode).find('td#item_id').text();
                    window.location.assign('items/edit/'+item_id);
                });
                setData(data);
            },
        });
    });

    function setData(d){
        const ctx = document.getElementById('myChart').getContext('2d');
        var item_name = [];
        var item_stock = [];
        d.forEach(element => {
            item_name.push(element.item_name);
            item_stock.push(element.stock);
        });
        const data = {
            labels: item_name,
            datasets: [{
                label: '',
                data: item_stock,
                backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(255, 205, 86)'
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

            /*
            // Ini testing pke label inside chartnya
            type: 'pie',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May'],
                datasets: [
                {
                    data: [50, 60, 70, 180, 190],
                },
                ],
            },
            options: {
                plugins: {
                    datalabels: {
                        display: true,
                        align: 'bottom',
                        backgroundColor: '#ccc',
                        borderRadius: 3,
                        font: {
                            size: 18,
                        },
                    },
                },
            },
            */
        };
        const myChart = new Chart(ctx, config);
    }
    </script>

@endsection
