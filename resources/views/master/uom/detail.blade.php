@extends('template.form')

@extends('layout')

<?php
    $moduleName = 'Edit UOM';
    $saveFunction = 'saveUOMs()';
    $company_id = Auth::user()->company_id;
    $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $uom_id = explode('/', $url)[5];
    $data = DB::table('uom')->where('company_id', $company_id)->where('id', $uom_id)->first();
    $row = [
        ['label' => 'UOM Name', 'name' => 'name', 'required' => true],
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
    function saveUOMs(){
        var uom = $('#name').val();
        var uom_id = $('#id').val();
        if(uom == null || uom == ''){
            alert('Must fill all fields');
        }
        else{
            $.ajax({
                url: '/uoms/edit',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'name': uom,
                    'id': uom_id,
                },
                success: function(data){
                    if(data == 'error'){
                        alert('UOM already exists!');
                        $('#name').val('');
                    }
                    else{
                        window.location.replace("/uoms");
                    }
                },
            });
        }
    }
</script>
@endsection
