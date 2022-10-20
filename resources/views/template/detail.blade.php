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
                <h1>@if ($page == 'details'){{$title}} Details @else Edit {{$title}}@endif </h1>
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
                                @if(@isset($item['required']))
                                    <span class='text-danger'>*</span>
                                @endif
                            </label>
                        </div>
                        <div class="inputs" style="width: 20em">
                            @if (isset($item['type']))
                                @if ($item['type'] == 'select2')
                                    <?php
                                        $option = DB::table($item['select2_table'])->where('company_id', Helper::getCompanyId())->get();
                                        if (isset($contents->brand_id)) {
                                            $brand = DB::table($item['select2_table'])->where('id', $contents->brand_id)->where('company_id', Helper::getCompanyId())->first();
                                        }
                                        if (isset($contents->uom_id)) {
                                            $uom = DB::table($item['select2_table'])->where('id', $contents->uom_id)->where('company_id', Helper::getCompanyId())->first();
                                        }
                                        if (isset($contents->country_id)) {
                                            $country = DB::table($item['select2_table'])->where('id', $contents->country_id)->where('company_id', Helper::getCompanyId())->first();
                                        }
                                        if(isset($contents->vendor_id)){
                                            $vendor = DB::table($item['select2_table'])->where('id', $contents->vendor_id)->where('company_id', Helper::getCompanyId())->first();
                                        }
                                    ?>
                                    <select name="{{$item['col']}}" id="{{$item['col']}}" class="form-input select2" @if ($page == 'details') disabled @endif>
                                        <option value="0" selected disabled>** Please Select **</option>
                                        @foreach ($option as $list)
                                            @if ($item['select2_table'] == 'uoms')
                                                @if ($list->id == $uom->id)
                                                    <option value="{{$list->id}}" selected>{{$list->name}}</option>
                                                @else
                                                    <option value="{{$list->id}}">{{$list->name}}</option>
                                                @endif
                                            @elseif ($item['select2_table'] == 'countries')
                                                @if ($list->id == $country->id)
                                                    <option value="{{$list->id}}" selected>{{$list->name}}</option>
                                                @else
                                                    <option value="{{$list->id}}">{{$list->name}}</option>
                                                @endif
                                            @elseif ($item['select2_table'] == 'brands')
                                                @if ($list->id == $brand->id)
                                                    <option value="{{$list->id}}" selected>{{$list->name}}</option>
                                                @else
                                                    <option value="{{$list->id}}">{{$list->name}}</option>
                                                @endif
                                            @elseif ($item['select2_table'] == 'vendors')
                                                @if ($list->id == $vendor->id)
                                                    <option value="{{$list->id}}" selected>{{$list->name}}</option>
                                                @else
                                                    <option value="{{$list->id}}">{{$list->name}}</option>
                                                @endif
                                            @endif
                                        @endforeach
                                    </select>
                                @elseif ($item['type'] == 'textarea')
                                    <textarea name="{{$item['col']}}" id="{{$item['col']}}" class="form-input" @isset($data) placeholder="{{(@$data->{$item['col']})}}" @endisset @if ($page == 'details') disabled @endif>{{(@$contents->{$item['col']})}}</textarea>
                                @elseif ($item['type'] == 'datetime')
                                    <input class="form-input {{$item['datetime_type']}}" name="{{$item['col']}}" id="{{$item['col']}}" @endif value="{{(@$contents->{$item['col']})}}" @if ($page == 'details') disabled @endif>
                                @elseif ($item['type'] == 'life')
                                    <input class="form-input" type="number" name="{{$item['col']}}" id="{{$item['col']}}" style="width: 70.5%" value="{{(@$contents->{$item['col']})}}" @if ($page == 'details') disabled @endif>
                                    <select class="form-input" name="str{{$item['col']}}" id="str{{$item['col']}}" style="width: 28%" @if ($page == 'details') disabled @endif>
                                        @if ((@$contents->{'str'.$item['col']}) == 'Day')
                                            <option value="Day" selected>Day</option>
                                            <option value="Week">Week</option>
                                            <option value="Year">Year</option>
                                        @elseif ((@$contents->{'str'.$item['col']}) == 'Week')
                                            <option value="Day">Day</option>
                                            <option value="Week" selected>Week</option>
                                            <option value="Year">Year</option>
                                        @else
                                            <option value="Day">Day</option>
                                            <option value="Week">Week</option>
                                            <option value="Year" selected>Year</option>
                                        @endif
                                    </select>
                                @else
                                    <input class="form-input" @if (isset($item['type'])) type="{{$item['type']}}"@else type="text"@endif name="{{$item['col']}}" id="{{$item['col']}}" @if (isset($item['readonly']))readonly @endif @isset($data) placeholder="{{(@$data->{$item['name']})}}" @endisset value="{{(@$contents->{$item['col']})}}" @if ($page == 'details') disabled @endif>
                                @endif
                            @else
                                <input class="form-input" type="text" name="{{$item['col']}}" id="{{$item['col']}}" @if (isset($item['readonly']))readonly @endif @isset($data) placeholder="{{(@$data->{$item['name']})}}" @endisset value="{{(@$contents->{$item['col']})}}" @if ($page == 'details') disabled @endif>
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
                            @if ($page == 'edit')
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
                            @endif
                            @if (isset($row))
                                @foreach ($row as $item)
                                    <tr>
                                        <td style="display: none"><input name="item_id[]" value="{{$item->id}}"></td>
                                        <td>{{$item->name}}</td>
                                        <td style="display: none"><input name="item_qty[]" value="{{$item->qty}}"></td>
                                        <td>{{$item->qty}}</td>
                                        <td><button class="btn btn-danger" id="delete" onclick="deleteRow(this)" @if ($page == 'details') disabled @endif>-</button></td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                @endif
                <button class="btn btn-success save" type="submit" @if ($page == 'details') style="display: none" @endif>Save</button>
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
                '<td><a class="btn btn-danger" id="delete" onclick="deleteRow(this)">-</a></td>'+
            '</tr>';
            $(row).find('#detail_item_id').select2("val", "0");
            $(row).find('#detail_item_qty').val('');
        }
        $(table).append(newRow);
    });

    // var url = window.location.href;
    // url = url.split('/');
    // if(url[4] == 'edit'){
    //     Swal.fire('panggil ajax untuk cek detail');
    // }

</script>
@endsection
