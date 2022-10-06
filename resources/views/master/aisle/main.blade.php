{{-- MUST HAVE :
    1. moduleName   .... list
    2. addNewRoute  route...getIndex
    3. searchRoute  route...search
    4. deleteFunction  function delete
    5. detailFunction function edit
    6. tableHeader  table head
--}}

@extends('template.main')

@extends('layout')

<?php
    $moduleName = 'Aisle List';
    $addNewRoute = route('add-aisles');
    $searchRoute = route('search-aisles');
    $deleteFunction = 'deleteAisle(this)';
    $detailFunction = 'detailAisle(this)';
    $tableHeader = [
        ['label' => 'id', 'col' => 'id', 'display' => 'none'],
        ['label' => 'Aisle Code', 'col' => 'code'],
        ['label' => 'Aisle Name', 'col' => 'name'],
    ];
?>

@section('header')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<style type="text/css">
</style>
@endsection

@section('footer')
<script type="text/javascript">
    function deleteAisle(row){
        var thisRow = row.parentNode.parentNode.parentNode.parentNode.parentNode;
        var aisle_id = $(thisRow).find('td.id').text();
        $.ajax({
            url: '/aisles/delete',
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                'id': aisle_id,
            },
            success: function(data){
                window.location.replace("/aisles");
            },
        });
    }
    function detailAisle(row){
        var thisRow = row.parentNode.parentNode.parentNode.parentNode.parentNode;
        var aisle_id = $(thisRow).find('td.id').text();
        window.location.replace("/aisles/edit/"+aisle_id);
    }
</script>
@endsection
