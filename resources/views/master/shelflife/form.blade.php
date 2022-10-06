{{-- COPY PASTE THIS FOR FORM TEMPLATE
    MUST HAVE :
    1. moduleName   Add New {{moduleName}}
    2. saveFunction save{{moduleName}}()
    3. searchFunction search{{moduleName}}()
    4. row
--}}

@extends('template.form')

@extends('layout')

<?php
    $moduleName = 'Add New Shelf Life';
    $saveFunction = 'saveShelflife()';
    $searchFunction = 'searchShelflife()';
    $row = [
        ['label' => 'Name', 'name' => 'name'],
    ];
?>

@section('header')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<style type="text/css">
</style>
@endsection

@section('footer')
<script type="text/javascript">
    function saveShelflife(){

    }
</script>
@endsection
