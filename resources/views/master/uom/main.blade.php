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
    $moduleName = 'Unit of Measurements List';
    $addNewRoute = route('add-uoms');
    $searchRoute = route('search-uoms');
    $deleteFunction = 'deleteUOMs(this)';
    $detailFunction = 'detailUOMs(this)';
    $tableHeader = [
        ['label' => 'id', 'col' => 'id', 'display' => 'none'],
        ['label' => 'Name', 'col' => 'name'],
    ];
?>

@section('header')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<style type="text/css">
</style>
@endsection

@section('footer')
<script type="text/javascript">
    function deleteUOMs(row){
        var thisRow = row.parentNode.parentNode.parentNode.parentNode.parentNode;
        var uom_id = $(thisRow).find('td.id').text();
        $.ajax({
            url: '/uoms/delete',
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                'id': uom_id,
            },
            success: function(data){
                window.location.replace("/uoms");
            },
        });
    }
    function detailUOMs(row){
        var thisRow = row.parentNode.parentNode.parentNode.parentNode.parentNode;
        var uom_id = $(thisRow).find('td.id').text();
        window.location.replace("/uoms/edit/"+uom_id);
    }
</script>
@endsection
