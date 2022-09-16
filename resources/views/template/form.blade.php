{{-- COPY PASTE THIS FOR FORM TEMPLATE
    MUST HAVE :
    1. moduleName   Add New {{moduleName}}
    2. saveFunction save{{moduleName}}()
    3. row

@extends('template.form')

@extends('layout')

<?php
?>

@section('header')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<style type="text/css">
</style>
@endsection

@section('footer')
<script type="text/javascript">
</script>
@endsection
--}}


<style type="text/css">
    .card{
        margin: 10px;
    }
    label{
        width: 20em;
    }
    .form-input{
        width: 20em;
        border-radius: 5px;
        border: 1px solid lightgray;
        height: 2.2em;
    }
</style>

<div class="card">
    <div class="card-header" style="border-bottom: none">
        <div class="header-content d-flex justify-content-between align-items-center">
            <h1>{{$moduleName}}</h1>
        </div>
    </div>
    @if (isset($data))
        <div class="card-body">
            @foreach ($row as $item)
                <div class="" @isset($item['display']) style="display: none;"  @endisset>
                    <label for="{{$item['name']}}" @isset($item['display']) style="display: none;" @endisset>{{$item['label']}}</label>
                    <input class="form-input" @if (isset($item['type'])) type="{{$item['type']}}"@else type="text"@endif name="{{$item['name']}}" id="{{$item['name']}}" @if (isset($item['required']))required @endif @if (isset($item['readonly']))readonly @endif @isset($data) placeholder="{{$data->name}}" @endisset @isset($item['value']) value="{{$item['value']}}" @endisset >
                </div>
                <br>
            @endforeach
            <button class="btn btn-success" onclick="{{$saveFunction}}">Save</button>
        </div>
    @else
        <div class="card-body">
            @foreach ($row as $item)
                <div class="d-flex align-items-center">
                    <label for="{{$item['name']}}">{{$item['label']}}</label>
                    @if (isset($item['select2']))
                    <?php
                    $option = DB::table($item['select2'])->get();
                    ?>
                        <select name="{{$item['name']}}" id="{{$item['name']}}" class="form-input select2">
                            <option value="0" selected disabled>** Please Select **</option>
                            @foreach ($option as $list)
                                <option value="{{$list->id}}">{{$list->name}}</option>
                            @endforeach
                        </select>
                    @else
                        @if (isset($item['textarea']))
                            <textarea name="{{$item['name']}}" id="{{$item['name']}}" class="form-input"></textarea>
                        @else
                            <input class="form-input" @if (isset($item['type'])) type="{{$item['type']}}"@else type="text"@endif name="{{$item['name']}}" id="{{$item['name']}}" @if (isset($item['required']))required @endif @if (isset($item['readonly']))readonly @endif>
                        @endif
                    @endif
                </div>
                <br>
            @endforeach
            <button class="btn btn-success" onclick="{{$saveFunction}}">Save</button>
        </div>
    @endif
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
