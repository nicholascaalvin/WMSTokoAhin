{{--
    MUST HAVE :
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
    $moduleName = 'Shelf Life List';
    $addNewRoute = route('add-shelflifes');
    $searchRoute = route('search-shelflifes');
    $deleteFunction = 'deleteShelflife(this)';
    $detailFunction = 'showDetailPage(this)';
    $tableHeader = [
        ['label' => 'ID'],
        ['label' => 'testing'],
        ['label' => 'Name'],
    ];
?>

@section('header')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<style type="text/css">
</style>
@endsection

@section('footer')
<script type="text/javascript">
    function deleteShelflife(row){

    }
    function showDetailPage(row){

    }
</script>
@endsection
