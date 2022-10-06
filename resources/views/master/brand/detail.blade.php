@extends('template.form')

@extends('layout')

<?php
    $moduleName = 'Edit Brand';
    $saveFunction = 'saveBrand()';
    $company_id = Auth::user()->company_id;
    $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $brand_id = explode('/', $url)[5];
    $data = DB::table('brands')->where('company_id', $company_id)->where('id', $brand_id)->first();
    $row = [
        ['label' => 'Brand Name', 'name' => 'name', 'required' => true],
        ['label' => 'id', 'name' => 'id', 'value' => $data->id, 'display' => 'none'],
    ];
?>

@section('header')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<style type="text/css">
</style>
@endsection

@section('footer')
<script type="text/javascript">
    function saveBrand(){
        var brand = $('#name').val();
        var brand_id = $('#id').val();
        if(brand == null || brand == ''){
            alert('Must fill all fields');
        }
        else{
            $.ajax({
                url: '/brands/edit',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'name': brand,
                    'id': brand_id,
                },
                success: function(data){
                    if(data == 'error'){
                        alert('Brand already exists!');
                        $('#name').val('');
                    }
                    else{
                        window.location.replace("/brands");
                    }
                },
            });
        }
    }
</script>
@endsection