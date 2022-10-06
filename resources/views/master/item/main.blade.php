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
    $moduleName = 'Item List';
    $addNewRoute = route('add-items');
    $searchRoute = route('search-items');
    $deleteFunction = 'deleteItems(this)';
    $detailFunction = 'showDetailPage(this)';
    $tableHeader = [
        ['label' => 'id', 'col' => 'id', 'display' => 'none'],
        ['label' => 'Item Code', 'width' => '10%', 'col' => 'code'],
        ['label' => 'Item Name', 'width' => '10%', 'col' => 'name'],
        ['label' => 'Origin', 'width' => '10%', 'col' => 'country_id', 'from' => 'countries'],
        ['label' => 'Incoming', 'width' => '1%', 'col' => 'incoming'],
        ['label' => 'Outgoing', 'width' => '1%', 'col' => 'outgoing'],
        ['label' => 'Stock', 'width' => '1%', 'col' => 'stock'],
    ];
?>

@section('header')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<style type="text/css">
</style>
@endsection

@section('footer')
<script type="text/javascript">
    function deleteItems(row){
        var thisRow = row.parentNode.parentNode.parentNode.parentNode.parentNode;
        var item = $(thisRow).find('td.name').text();
        $.ajax({
            url: '/countries/delete',
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                'name': item,
            },
            success: function(data){
                window.location.replace("/items");
            },
        });
    }
    function showDetailPage(row){
        var thisRow = row.parentNode.parentNode.parentNode.parentNode.parentNode;
        var item_id = $(thisRow).find('td.id').text();
        window.location.replace("/items/edit/"+item_id);
    }
</script>
@endsection
