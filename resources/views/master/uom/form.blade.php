{{-- COPY PASTE THIS FOR FORM TEMPLATE
    MUST HAVE :
    1. moduleName   Add New {{moduleName}}
    2. saveFunction save{{moduleName}}()
    3. row
--}}

@extends('template.form')

@extends('layout')

<?php
    $moduleName = 'Add New UOM';
    $saveFunction = 'saveUOMs()';
    $row = [
        ['label' => 'Name', 'name' => 'name']
    ];
?>

@section('header')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<style type="text/css">
</style>
@endsection

@section('footer')
<script type="text/javascript">
    function saveUOMs(){
        var uom = $('#name').val();
        if(uom == null || uom == ''){
            alert('Must fill all fields');
        }
        else{
            $.ajax({
                url: '/uoms/add',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'name': uom,
                },
                success: function(data){
                    if(data == 'success'){
                        window.location.replace("/uoms");
                    }
                    else{
                        alert('Country already exists!');
                        $('#name').val('');
                    }
                },
            });
        }
    }
</script>
@endsection
