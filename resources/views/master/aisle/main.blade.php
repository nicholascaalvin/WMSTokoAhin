{{-- MUST HAVE :
    1. moduleName   .... list
    2. addNewRout   route...getIndex
    3. data         query get dari table
    4. tableHeader  table head
--}}

@section('header')
<style type="text/css">
</style>
@endsection

@section('footer')
<script type="text/javascript">
</script>
@endsection

@extends('template.main')

@extends('layout')

<?php
    $moduleName = 'Aisle List';
    $addNewRoute = route('add-aisles');
    $data = DB::table('aisle')->get();
    $tableHeader = [
        ['label' => 'Aisle Code', 'col' => 'code'],
        ['label' => 'Aisle Name', 'col' => 'name'],
    ];
?>
