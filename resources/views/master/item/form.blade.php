{{-- COPY PASTE THIS FOR FORM TEMPLATE
    MUST HAVE :
    1. moduleName   Add New {{moduleName}}
    2. saveFunction save{{moduleName}}()
    3. searchFunction search{{moduleName}}()
    4. row
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
        ['label' => 'Weight in grams', 'name' => 'weight', 'type' => 'number'],
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
        var code = $('#code').val();
        var name = $('#name').val();
        var uom = $('#uom_id').val();
        var weight = $('#weight').val();
        var country = $('#country_id').val();
        var desc = $('#description').val();
        console.log(code, name, uom, country, desc);
        if(code == '' || code == null || name == '' || name == null || uom == '' || uom == null || weight == '' || weight == null || uom == null || uom == 0){
            alert('Must fill all fields');
        }
        else{
            $.ajax({
                url: '/items/add',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'code': code,
                    'name': name,
                    'uom': uom,
                    'weight': weight,
                    'country': country,
                    'desc': desc,
                },
                success: function(data){
                    if(data == 'success'){
                        window.location.replace("/items");
                    }
                    else{
                        alert('Item already exists!');
                        $('#code').val('');
                        $('#name').val('');
                        $('#uom_id').val('0');
                        $('#weight').val('');
                        $('#country_id').val('0');
                        $('#desc').val('');
                    }
                },
            });
        }
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
