@extends('template.form')

@extends('layout')

<?php
    $moduleName = 'Edit Items';
    $saveFunction = 'saveItems()';
    $company_id = Auth::user()->company_id;
    $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $item_id = explode('/', $url)[5];
    $data = DB::table('items')->where('company_id', $company_id)->where('id', $item_id)->first();
    $row = [
        ['label' => 'Item Code', 'name' => 'code'],
        ['label' => 'Item Name', 'name' => 'name'],
        ['label' => 'Unit of Measurements', 'name' => 'uom_id', 'select2' => 'uom'],
        ['label' => 'Weight in grams', 'name' => 'weight', 'type' => 'number'],
        ['label' => 'Country', 'name' => 'country_id', 'select2' => 'countries'],
        ['label' => 'Description', 'name' => 'description', 'textarea' => true],
    ];
?>

@section('header')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<style type="text/css">
</style>
@endsection

@section('footer')
<script type="text/javascript">
    function saveItems(){
        var uom = $('#name').val();
        var uom_id = $('#id').val();
        if(uom == null || uom == ''){
            alert('Must fill all fields');
        }
        else{
            // $.ajax({
            //     url: '/uoms/edit',
            //     type: 'POST',
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     },
            //     data: {
            //         'name': uom,
            //         'id': uom_id,
            //     },
            //     success: function(data){
            //         if(data == 'error'){
            //             alert('UOM already exists!');
            //             $('#name').val('');
            //         }
            //         else{
            //             window.location.replace("/uoms");
            //         }
            //     },
            // });
        }
    }
</script>
@endsection
