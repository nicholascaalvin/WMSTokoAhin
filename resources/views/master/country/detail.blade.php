@extends('template.form')

@extends('layout')

<?php
    $moduleName = 'Edit Country';
    $saveFunction = 'saveCountries()';
    $company_id = Auth::user()->company_id;
    $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $country_id = explode('/', $url)[5];
    $data = DB::table('countries')->where('company_id', $company_id)->where('id', $country_id)->first();
    $row = [
        ['label' => 'Country Name', 'name' => 'name', 'required' => true],
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
    function saveCountries(){
        var country = $('#name').val();
        var country_id = $('#id').val();
        if(country == null || country == ''){
            alert('Must fill all fields');
        }
        else{
            $.ajax({
                url: '/countries/edit',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'name': country,
                    'id': country_id,
                },
                success: function(data){
                    if(data == 'error'){
                        alert('Country already exists!');
                        $('#name').val('');
                    }
                    else{
                        window.location.replace("/countries");
                    }
                },
            });
        }
    }
</script>
@endsection
