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
    $moduleName = 'Incoming List';
    $addNewRoute = route('add-incoming');
    $deleteFunction = 'deleteIncoming(this)';
    $detailFunction = 'detailIncoming(this)';
    $data = DB::table('incoming')->get();
    $tableHeader = [
        ['label' => 'Voucher No', 'col' => 'voucher_no'],
        ['label' => 'Vendor', 'col' => 'vendor'],
        ['label' => 'Created At', 'col' => 'created_at'],
        ['label' => 'Status', 'col' => 'status'],
    ]
?>

@section('header')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<style type="text/css">
</style>
@endsection

@section('footer')
<script type="text/javascript">
    function deleteIncoming(row){

    }
    function detailIncoming(row){

    }
</script>
@endsection
