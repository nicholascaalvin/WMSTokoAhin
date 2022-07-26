{{-- COPY PASTE THIS FOR FORM TEMPLATE
    MUST HAVE :
    1. moduleName
    2. saveFunction
    3. row
--}}

@extends('template.form')

@extends('layout')

<?php
    $moduleName = 'Add New Item';
    $saveFunction = 'saveItems()';
    $row = [
        ['label' => 'Item Code', 'name' => 'code'],
        ['label' => 'Item Name', 'name' => 'name'],
        ['label' => 'Unit of Measurements', 'name' => 'uom_id', 'select2' => 'uom'],
        ['label' => 'Country', 'name' => 'country_id', 'select2' => 'countries'],
        ['label' => 'Description', 'name' => 'description', 'textarea' => true],
    ]
?>

@section('header')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<style type="text/css">
</style>
@endsection

@section('footer')
<script type="text/javascript">
    function saveItems(){
        alert('save item');
        // var country = $('#name').val();
        // if(country == null || country == ''){
        //     alert('Must fill all fields');
        // }
        // else{
        //     $.ajax({
        //         url: '/countries/add',
        //         type: 'POST',
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         },
        //         data: {
        //             'name': country,
        //         },
        //         success: function(data){
        //             if(data == 'success'){
        //                 window.location.replace("/countries");
        //             }
        //             else{
        //                 alert('Country already exists!');
        //                 $('#name').val('');
        //             }
        //         },
        //     });
        // }
    }
</script>
@endsection
