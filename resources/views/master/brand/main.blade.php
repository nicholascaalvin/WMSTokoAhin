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
    $moduleName = 'Brand List';
    $addNewRoute = route('add-brands');
    $searchRoute = route('search-brands');
    $deleteFunction = 'deleteBrand(this)';
    $detailFunction = 'showDetailBrand(this)';
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
    function deleteBrand(row){
        var thisRow = row.parentNode.parentNode.parentNode.parentNode.parentNode;
        var brand_id = $(thisRow).find('td.id').text();
        $.ajax({
            url: '/brands/delete',
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                'id': brand_id,
            },
            success: function(data){
                window.location.replace("/brands");
            },
        });
    }
    function showDetailBrand(row){
        var thisRow = row.parentNode.parentNode.parentNode.parentNode.parentNode;
        var brand_id = $(thisRow).find('td.id').text();
        window.location.replace("/brands/edit/"+brand_id);
    }
</script>
@endsection
