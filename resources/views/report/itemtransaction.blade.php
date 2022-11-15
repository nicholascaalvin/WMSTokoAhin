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
    }
</style>   
@endsection

@section('content')

<!-- <h1>History Transaction</h1> -->

<!-- <div>
    <form action="{{(new \App\Helpers\Helper)->getFullUrl()}}" method="get" class="d-flex align-items-center">
        <div class="mb-3">
            <label for="transaction_no" class="form-label">Transaction No</label>
            <input type="email" class="form-control" id="transaction_no" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="transaction_date" class="form-label">Transaction Date</label>
            <input type="email" class="form-control" id="transaction_date" aria-describedby="emailHelp">
        </div>
        <button id="searchHT" type="submit" class="btn btn-primary">Search</button>
    </form>
</div> -->

<div class="card shadow mb-3 bg-body">
    <div class="card-body" style="margin-left: 1em">
      <h1>Item Transaction</h1>
    </div>
</div>

<div class="card shadow mb-3 bg-body">
    <div class="card-body">
        
    <div class="">
            <table class="table table-borderless">
            <tbody>
                <tr>
                <td>
                    <form action="{{(new \App\Helpers\Helper)->getFullUrl()}}" method="get" class="d-flex align-items-center">
                        <div class="mb-3">
                            <label for="transaction_no" class="form-label">Item No</label>
                            <input type="email" class="form-control" id="transaction_no" aria-describedby="emailHelp">
                        </div> 
                        <button id="searchHT" type="submit" class="btn btn-primary">Search</button>
                    </form>
                </td>
                </tr>
                <tr>
                <td>
                    <form action="{{(new \App\Helpers\Helper)->getFullUrl()}}" method="get" class="d-flex align-items-center">
                        <div class="mb-3">
                            <label for="transaction_date" class="form-label">Transaction Date</label>
                            <input type="email" class="form-control" id="transaction_date" aria-describedby="emailHelp">
                        </div>
                        <button id="searchHT" type="submit" class="btn btn-primary">Search</button>
                    </form>
                </td>
                </tr>
            </tbody>
            </table> 
        </div>

        <div class="dropdown">
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
        </div>
        <div>
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">NO.</th>
                    <th scope="col">Item No.</th>
                    <th scope="col">Date</th>
                    <th scope="col">Stock</th>
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

    $('#searchHT').on('click', function(){
        var transaction_no = $('#transaction_no').val();
        var transaction_date = $('#transaction_date').val();
        console.log(transaction_no);
        console.log(transaction_date);
        event.preventDefault();
        // var row = this.parentNode.parentNode;
        // var id = $(row).find('input#id').val();
    });
    // $('.detail-btn').on('click', function(){
    //     var row = this.parentNode.parentNode.parentNode.parentNode.parentNode;
    //     var id = $(row).find('input#id').val();
    // });
</script>
@endsection
