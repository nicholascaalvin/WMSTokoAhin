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
    $moduleName = 'Add New Vendors';
    $saveFunction = 'saveVendors()';
    $row = [
        ['label' => 'Code', 'name' => 'code'],
        ['label' => 'Name', 'name' => 'name'],
    ];
?>

@section('header')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<style type="text/css">
</style>
@endsection

@section('footer')
<script type="text/javascript">
    function saveVendors(){
        var code = $('#code').val();
        var name = $('#name').val();
        if(code == null || code == '' || name == null || name == ''){
            alert('Must fill all fields');
        }
        else{
            $.ajax({
                url: '/vendors/add',
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
                        window.location.replace("/vendors");
                    }
                    else{
                        alert('Vendor already exists!');
                        $('#code').val('');
                        $('#name').val('');
                    }
                },
            });
        }
    }
</script>
@endsection

