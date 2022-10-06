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
    $moduleName = 'Vendors List';
    $addNewRoute = route('add-vendors');
    $deleteFunction = 'deleteVendor(this)';
    $detailFunction = 'detailVendor(this)';
    $data = DB::table('vendor')->get();
    $tableHeader = [
        ['label' => 'Code', 'col' => 'code'],
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
    function deleteVendor(row){

    }
    function detailVendor(row){

    }
</script>
@endsection
