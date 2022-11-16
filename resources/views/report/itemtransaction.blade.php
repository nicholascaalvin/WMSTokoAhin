@extends("layout")

@section('header')
<style type="text/css">
    body{
        background-color: #fafafa;
    }
    .card{
        margin: 10px;
        border: none;
        border-radius: 0.6em;
    }
    .form-input{
        width: 20em;
        border-radius: 5px;
        border: 1px solid lightgray;
        height: 2.2em;
        display: block;
    }
</style>
@endsection

@section('content')

<div class="card shadow mb-3 bg-body">
    <div class="card-body" style="margin-left: 1em">
      <h1>Item Transaction</h1>
    </div>
</div>

<div class="card shadow mb-3 bg-body">
    <div class="card-body">
        {{-- <form action="/historytransaction/search" method="get"> --}}
        <div class="mb-3">
            <label for="item_name" class="form-label">Item Name</label>
            <input type="text" class="form-input" id="item_name" name="item_name">
        </div>
        <div class="mb-3">
            <label for="transaction_date" class="form-label">Transaction Date</label>
            <input type="password" class="form-input date" id="transaction_date" name="transaction_date">
        </div>

        <button type="submit" class="btn btn-primary" id="searchHT">Search</button>
        {{-- </form> --}}

        {{-- <div class="">
            <table class="table table-borderless">
            <tbody>
                <tr>
                <td>
                    <form action="{{(new \App\Helpers\Helper)->getFullUrl()}}" method="get" class="d-flex align-items-center">
                        <button id="searchHT" type="submit" class="btn btn-primary">Search</button>
                    </form>
                </td>
                </tr>
                <tr>
                <td>
                    <form action="{{(new \App\Helpers\Helper)->getFullUrl()}}" method="get" class="d-flex align-items-center">
                        <div class="mb-3">
                            <label for="transaction_date" class="form-label">Transaction Date</label>
                            <input type="email" class="form-input date" id="transaction_date">
                        </div>
                        <button id="searchHT" type="submit" class="btn btn-primary">Search</button>
                    </form>
                </td>
                </tr>
            </tbody>
            </table>
        </div> --}}

        {{-- <div class="dropdown ">
            <select class="form-select form-input" aria-label="Default select example">
                <option selected>Month</option>
                <option value="1">January</option>
                <option value="2">February</option>
                <option value="3">March</option>
                <option value="4">April</option>
                <option value="5">May</option>
                <option value="6">June</option>
                <option value="7">July</option>
                <option value="8">August</option>
                <option value="9">September</option>
                <option value="10">October</option>
                <option value="11">November</option>
                <option value="12">December</option>
            </select>
        </div> --}}
        <div>
            <table class="table item-transaction-table">
                <thead>
                    <tr>
                    <th scope="col">NO.</th>
                    <th scope="col">Item Name</th>
                    <th scope="col">Date</th>
                    {{-- <th scope="col">Type</th> --}}
                    {{-- <th scope="col">Item Name</th> --}}
                    <th scope="col">Type</th>
                    <th scope="col">Aisle</th>
                    <th scope="col">Qty</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@section('footer')
<script type="text/javascript">

    $(document).ready(function() {
        $(".date").flatpickr({
            dateFormat: "Y-m-d",
            mode: "range",
        });
    });

    $('#searchHT').on('click', function(){
        var item_name = $('#item_name').val();
        var transaction_date = $('#transaction_date').val();
        $.ajax({
            url: 'itemtransaction/search',
            data: {
                'item_name': item_name,
                'transaction_date': transaction_date,
            },
            success: function(data){
                console.log(data);
                var total=0;
                var row = "";
                $('.item-transaction-table').find('tbody').empty();
                $.each(data, function(key, value){
                    row += "<tr>";
                        row += "<td>";
                            row += key + 1;
                        row += "</td>";
                        row += "<td>";
                            row += value.name;
                        row += "</td>";
                        row += "<td>";
                            row += value.transaction_date;
                        row += "</td>";
                        row += "<td>";
                            row += value.type;
                        row += "</td>";
                        row += "<td>";
                            row += value.aisle_name;
                        row += "</td>";
                        row += "<td>";
                            row += value.qty;
                        row += "</td>";
                    //     row += "<td>";
                    //         row += value.qty;
                    //     row += "</td>";
                    row += "</tr>";
                    if(value.type=="Incoming"){
                        total+=value.qty;
                    }else{
                        total-=value.qty;
                    }
                    // console.log(value);
                });

                row += "<tr>";
                    row += "<td colspan='5' class='text-end'>";
                        row += "<b>TOTAL</b>";
                    row += "</td>";
                    row += "<td>";
                        row += total;
                    row += "</td>";
                row += "</tr>";


                $('.item-transaction-table').find('tbody').append(row);
                // console.log(data);
            }
        });
        // console.log(transaction_no);
        // console.log(transaction_date);
        event.preventDefault();
    });
    // $('.detail-btn').on('click', function(){
    //     var row = this.parentNode.parentNode.parentNode.parentNode.parentNode;
    //     var id = $(row).find('input#id').val();
    // });
</script>
@endsection
