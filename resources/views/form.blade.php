@extends('layout')

@section('header')
    <style type="text/css">
    .content{
        margin: 10px;
    }
    label{
        width: 20em;
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
    <h1>Add New Item</h1>
    <div class="card">
        <div class="card-body">
            <form action="{{route('add-items')}}" method="post">
                @csrf
                <div class="">
                    <label for="itemCode">Item Code : </label>
                    <input class="form-input" type="text" name="itemCode" id="itemCode">
                </div>
                <br>
                <div class="">
                    <label for="itemName">Item Name : </label>
                    <input class="form-input" type="text" name="itemName" id="itemName">
                </div>
                <br>
                <div class="">
                    <label for="uom">Unit of Measurement : </label>
                    <input class="form-input" type="text" name="uom" id="uom">
                </div>
                <br>
                <div class="">
                    <label for="qty">Quantity : </label>
                    <input class="form-input" type="number" name="qty" id="qty">
                </div>
                <br>
                <button class="btn btn-success" type="submit">Save</button>
            </form>
        </div>
    </div>
@endsection
