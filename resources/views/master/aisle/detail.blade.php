@extends('template.form')

@extends('layout')

<?php
    $moduleName = 'Edit Aisle';
    $saveFunction = 'saveAisles()';
    $company_id = Auth::user()->company_id;
    $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $aisle_id = explode('/', $url)[5];
    $data = DB::table('aisle')->where('company_id', $company_id)->where('id', $aisle_id)->first();
    $row = [
        ['label' => 'Aisle Code', 'name' => 'code', 'required' => true],
        ['label' => 'Aisle Name', 'name' => 'name', 'required' => true],
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
    function saveAisles(){
        var code = $('#code').val();
        var name = $('#name').val();
        var aisle_id = $('#id').val();
        if(code == null || code == '' || name == null || name == ''){
            alert('Must fill all fields');
        }
        else{
            $.ajax({
                url: '/aisles/edit',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'code': code,
                    'name': name,
                    'id': aisle_id,
                },
                success: function(data){
                    if(data == 'error'){
                        alert('Aisle already exists!');
                        $('#code').val('');
                        $('#name').val('');
                    }
                    else{
                        window.location.replace("/aisles");
                    }
                },
            });
        }
    }
</script>
@endsection
