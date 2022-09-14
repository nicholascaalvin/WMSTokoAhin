{{-- MUST HAVE :
    1. moduleName
    2. row
--}}

@section('header')
<style type="text/css">
</style>
@endsection

@section('footer')
<script type="text/javascript">
</script>
@endsection

@extends('template.form')

@extends('layout')

<?php
    $moduleName = 'Add New Aisle';
    $row = [
        ['label' => 'Aisle Code', 'name' => 'code'],
        ['label' => 'Aisle Name', 'name' => 'name'],
    ]
?>
