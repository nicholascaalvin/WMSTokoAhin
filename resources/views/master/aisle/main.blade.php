{{-- MUST HAVE :
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
    $moduleName = 'Aisle List';
    $addNewRoute = route('add-aisles');
    $deleteFunction = 'deleteAisle(this)';
    $detailFunction = 'detailAisle(this)';
    $data = DB::table('aisle')->get();
    $tableHeader = [
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

    }
    function detailAisle(row){

    }
</script>
@endsection
