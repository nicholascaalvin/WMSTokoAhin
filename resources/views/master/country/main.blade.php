{{--
    MUST HAVE :
    1. moduleName   .... list
    2. addNewRoute  route...getIndex
    3. deleteFunction  function delete
    4. detailFunction function edit
    5. data         query get dari table
    6. tableHeader  table head
--}}

@extends('template.main')

@extends('layout')

<?php
    $moduleName = 'Country List';
    $addNewRoute = route('add-countries');
    $deleteFunction = 'deleteCountries(this)';
    $detailFunction = 'detailCountries(this)';
    $data = DB::table('countries')->get();
    $tableHeader = [
        ['label' => 'id', 'col' => 'id', 'display' => 'none'],
        ['label' => 'Country', 'col' => 'name'],
];
?>

@section('header')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<style type="text/css">
</style>
@endsection

@section('footer')
<script type="text/javascript">
    function deleteCountries(row){
        var thisRow = row.parentNode.parentNode.parentNode.parentNode.parentNode;
        var country_id = $(thisRow).find('td.id').text();
        $.ajax({
            url: '/countries/delete',
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                'id': country_id,
            },
            success: function(data){
                window.location.replace("/countries");
            },
        });
    }
    function detailCountries(row){
        var thisRow = row.parentNode.parentNode.parentNode.parentNode.parentNode;
        var country_id = $(thisRow).find('td.id').text();
        window.location.replace("/countries/edit/"+country_id);
    }
</script>
@endsection
