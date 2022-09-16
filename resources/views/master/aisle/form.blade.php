{{-- COPY PASTE THIS FOR FORM TEMPLATE
    MUST HAVE :
    1. moduleName   Add New {{moduleName}}
    2. saveFunction save{{moduleName}}()
    3. row
--}}

@extends('template.form')

@extends('layout')

<?php
    $moduleName = 'Add New Aisle';
    $saveFunction = 'saveAisle(this)';
    $row = [
        ['label' => 'Aisle Code', 'name' => 'code'],
        ['label' => 'Aisle Name', 'name' => 'name'],
    ]
?>

@section('header')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<style type="text/css">
</style>
@endsection

@section('footer')
<script type="text/javascript">
    function saveAisle(){
        var code = $('#code').val();
        var name = $('#name').val();
        if(code == '' || code == null || name == '' || name == null){
            alert('Must fill all fields');
        }
        else{
            $.ajax({
                url: '/aisles/add',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'code': code,
                    'name': name,
                },
                success: function(data){
                    if(data == 'success'){
                        window.location.replace("/aisles");
                    }
                    else{
                        alert('Aisle code already exists!');
                        $('#code').val('');
                        $('#name').val('');
                    }
                }
            })
            console.log(code, name);
        }
    }
</script>
@endsection
