{{-- COPY PASTE THIS FOR FORM TEMPLATE
    MUST HAVE :
    1. moduleName   Add New {{moduleName}}
    2. saveFunction save{{moduleName}}()
    3. searchFunction search{{moduleName}}()
    4. row

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
    function save..(){

    }
</script>
@endsection
--}}


@section('header')
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
@endsection

@extends('layout')

@section('content')
    <div class="card">
        <div class="card-header" style="border-bottom: none">
            <div class="header-content d-flex justify-content-between align-items-center">
                <h1>@if($title != 'Profile')Add New @endif {{$title}}</h1>
            </div>
        </div>
        <div class="card-body">
            <form action="{{$url}}/save" method="post">
                @csrf
                @foreach ($forms as $item)
                    <div class="d-flex align-items-center" @isset($item['display']) style="display: none !important;"  @endisset>
                        <div class="label">
                            <label for="{{$item['col']}}" @isset($item['display']) style="display: none !important;" @endisset>
                                {{$item['label']}}
                                @if(isset($item['required']))
                                    <span class='text-danger'>*</span>
                                @endif
                            </label>
                        </div>
                        <div class="inputs" style="width: 20em">
                            @if (isset($item['type']))
                                @if ($item['type'] == 'select2')
                                    <?php
                                        $option = DB::table($item['select2_table'])->where('company_id', Helper::getCompanyId())->get()->toArray();
                                    ?>
                                    <select name="{{$item['col']}}" id="{{$item['col']}}" class="form-input select2">
                                        <option value="0" disabled selected>** Please Select **</option>
                                        @foreach ($option as $list)
                                            <option value="{{$list->id}}" {{old($item['col']) == $list->id ? 'selected' : ''}}>{{$list->name}}</option>
                                        @endforeach
                                    </select>
                                @elseif ($item['type'] == 'textarea')
                                    <textarea name="{{$item['col']}}" id="{{$item['col']}}" class="form-input" @isset($data) placeholder="{{(@$data->{$item['col']})}}" @endisset @isset($item['value']) value="{{old($item['col'])}}" @endisset></textarea>
                                @elseif($item['type'] == 'datetime')
                                    <input class="form-input {{$item['datetime_type']}}" name="{{$item['col']}}" id="{{$item['col']}}" @if (isset($item['type'])) type="{{$item['type']}}"@else type="text"@endif value="{{old($item['col'])}}">
                                @elseif ($item['type'] == 'life')
                                    <input class="form-input" type="number" name="{{$item['col']}}" id="{{$item['col']}}" style="width: 70.5%">
                                    <select class="form-input" name="str{{$item['col']}}" id="str{{$item['col']}}" style="width: 28%">
                                        <option value="Day">Day</option>
                                        <option value="Week">Week</option>
                                        <option value="Year">Year</option>
                                    </select>
                                @else
                                    <input class="form-input" type="{{$item['type']}}" name="{{$item['col']}}" id="{{$item['col']}}" @if (isset($item['readonly']))readonly @endif @isset($data) placeholder="{{(@$data->{$item['name']})}}" @endisset value="{{old($item['col'])}}">
                                @endif
                            @else
                                <input class="form-input" type="text" name="{{$item['col']}}" id="{{$item['col']}}" @if (isset($item['readonly']))readonly @endif @isset($data) placeholder="{{(@$data->{$item['name']})}}" @endisset value="{{old($item['col'])}}">
                            @endif
                        </div>
                    </div>
                    <br>
                @endforeach
                @if (count($details) > 0)
                    <table class="table table-responsive table-bordered" id="{{$table}}-detail">
                        <thead>
                            <tr>
                                @foreach ($details as $item)
                                    @if($item['col'] == 'qty')
                                        <th style="width: 10%">{{$item['label']}}</th>
                                    @else
                                        <th>{{$item['label']}}</th>
                                    @endif
                                @endforeach
                                <th class="text-center" style="width: 5%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="default">
                                @foreach ($details as $item)
                                    <td>
                                        @if (isset($item['select2']))
                                            <?php
                                                $option = DB::table($item['select2'])->where('company_id', Helper::getCompanyId())->get()->toArray();
                                            ?>
                                            <select name="{{$item['col']}}" id="{{$item['col']}}" class="form-input select2">
                                                <option value="0" disabled selected>** Please Select **</option>

                                                @foreach ($option as $list)
                                                    <option value="{{$list->id}}">{{$list->name}}</option>
                                                @endforeach
                                            </select>
                                        @else
                                            @if (isset($item['type']))
                                                <input class="form-input" id="{{$item['col']}}" type="{{$item['type']}}">
                                            @else
                                                <input class="form-input" id="{{$item['col']}}" type="text">
                                            @endif
                                        @endif
                                    </td>
                                @endforeach
                                <td><a class="btn btn-primary" id="add">+</a></td>
                            </tr>
                        </tbody>
                    </table>
                @endif
                <button class="btn btn-success save" type="submit">Save</button>
            </form>
        </div>
    </div>
@endsection

@section('footer')
<script type="text/javascript">
    $(document).ready(function() {
        $('.select2').select2({
            theme: 'bootstrap-5',
        });
        $(".datetime").flatpickr({
            // altInput: true,
            // altFormat: "F j, Y H:i",
            dateFormat: "Y-m-d H:i",
            enableTime: true,
            time_24hr: true
        });
    });

    function deleteRow(row){
        row = row.parentNode.parentNode;
        $(row).remove();
    }

    $('.save').on('click', function(event){
        $.each(<?php echo json_encode($forms); ?>, function(index, value){
            if(value.hasOwnProperty('required') == true){
                var col = $('#'+value.col).val();
                if(col == null || col == ''){
                    Swal.fire(value.label+' cannot be empty!');
                    event.preventDefault();
                }
            }
        });
    });

    $('#add').on('click', function(){
        var table = this.parentNode.parentNode.parentNode;
        var row = this.parentNode.parentNode
        var item_name = $(row).find('#detail_item_id').find(":selected").text();
        var item_id = $(row).find('#detail_item_id').find(":selected").val();
        var item_qty = $(row).find('#detail_item_qty').val();

        var newRow = '';
        if(item_id == null) Swal.fire('You must select an item');
        else if(item_qty < 1) Swal.fire('Item quantity must be bigger than 0');
        else{
            newRow +=
            '<tr>'+
                '<td style="display: none"><input name="item_id[]" value="'+item_id+'"></td>'+
                '<td>'+item_name+'</td>'+
                '<td style="display: none"><input name="item_qty[]" value="'+item_qty+'"></td>'+
                '<td>'+item_qty+'</td>'+
                '<td><button class="btn btn-danger" id="delete" onclick="deleteRow(this)">-</button></td>'+
            '</tr>';
            $(row).find('#detail_item_id').select2("val", "0");
            $(row).find('#detail_item_qty').val('');
        }
        $(table).append(newRow);
    });

</script>
@endsection
