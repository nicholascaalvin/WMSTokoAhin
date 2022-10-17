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

@extends('layout')

@section('content')
    <div class="card">
        <div class="card-header" style="border-bottom: none">
            <div class="header-content d-flex justify-content-between align-items-center">
                <h1>{{$title}}</h1>
            </div>
        </div>
        {{-- {{ dd(get_defined_vars()) }} --}}
        {{-- @if (isset($data)) --}}
            <div class="card-body">
                <form action="{{$url}}/save" method="post">
                    @csrf
                    @foreach ($forms as $item)
                        <div class="d-flex align-items-center" @isset($item['display']) style="display: none !important;"  @endisset>
                            <label for="{{$item['col']}}" @isset($item['display']) style="display: none !important;" @endisset>
                                {{$item['label']}}
                                @if(@isset($item['required']))
                                    <span class='text-danger'>*</span>
                                @endif
                            </label>
                            @if (isset($item['select2']))
                                <?php
                                    $option = DB::table($item['select2'])->where('company_id', Helper::getCompanyId())->get()->toArray();
                                ?>
                                    <select name="{{$item['col']}}" id="{{$item['col']}}" class="form-input select2">
                                        <option value="0" disabled selected>** Please Select **</option>

                                        @foreach ($option as $list)
                                            <option value="{{$list->id}}" {{old($item['col']) == $list->id ? 'selected' : ''}}>{{$list->name}}</option>
                                        @endforeach
                                    </select>
                            @else
                                @if (isset($item['textarea']))
                                    <textarea name="{{$item['col']}}" id="{{$item['col']}}" class="form-input" @isset($data) placeholder="{{(@$data->{$item['col']})}}" @endisset @isset($item['value']) value="{{old($item['col'])}}" @endisset></textarea>
                                @else
                                    <input class="form-input" @if (isset($item['type'])) type="{{$item['type']}}"@else type="text"@endif name="{{$item['col']}}" id="{{$item['col']}}" @if (isset($item['readonly']))readonly @endif @isset($data) placeholder="{{(@$data->{$item['name']})}}" @endisset value="{{old($item['col'])}}">
                                @endif
                            @endif
                        </div>
                        <br>
                    @endforeach
                    <button class="btn btn-success save" type="submit">Save</button>
                </form>
            </div>
        {{-- @else
            <div class="card-body">
                @foreach ($row as $item)
                    <div class="d-flex align-items-center">
                        <label for="{{$item['name']}}">{{$item['label']}}</label>
                        @if (isset($item['select2']))
                            <?php
                                // $option = DB::table($item['select2'])->get();
                                // $brand = DB::table($item['select2'])->where('id', $data->brand_id)->first();
                                // $uom = DB::table($item['select2'])->where('id', $data->uom_id)->first();
                                // $country = DB::table($item['select2'])->where('id', $data->country_id)->first();
                            ?>
                                <select name="{{$item['name']}}" id="{{$item['name']}}" class="form-input select2">
                                    <option value="0" selected disabled>** Please Select **</option>
                                    @if ($item['select2'] == 'uom')
                                        <option disabled selected>{{$uom->name}}</option>
                                    @elseif ($item['select2'] == 'countries')
                                        <option disabled selected>{{$country->name}}</option>
                                    @elseif ($item['select2'] == 'brands')
                                        <option disabled selected>{{$brand->name}}</option>
                                    @endif
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
        @endif --}}
    </div>
@endsection

@section('footer')
<script type="text/javascript">
    $(document).ready(function() {
        $('.select2').select2({
            theme: 'bootstrap-5',
        });
        // $('.select2').css('width', '20em');
        // $('.select2').css('height', '35px');
        // $('.select2-selection__rendered').css('height', '35px');
        // $('.select2').css('border', '1px solid lightgray');
        // $('.select2').css('border-radius', '5px');
    });

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

</script>
@endsection
