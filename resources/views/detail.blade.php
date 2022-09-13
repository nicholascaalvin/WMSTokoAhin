
<style type="text/css">
    .card{
        margin: 10px;
    }
    table thead th{
        text-align: center;
    }
</style>

<div class="card">
    <div class="card-header" style="border-bottom: none">
        <div class="header-content d-flex justify-content-between align-items-center">
            <h1>{{$moduleName}}</h1>
            <a class="btn btn-info" href="{{$addNewRoute}}">Add New</a>
        </div>
    </div>
    <div class="card-body">
        <div class="content-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        @foreach ($tableHeader as $item)
                        {{-- {{dd($item)}} --}}
                            <th style="{{$item[1]}}">{{$item[0]}}</th>
                        @endforeach
                        {{-- <th style="width: 1%">NO.</th>
                        <th style="width: 10%">Item Code</th>
                        <th style="width: 10%">Item Name</th>
                        <th style="width: 1%">Incoming</th>
                        <th style="width: 1%">Outgoing</th>
                        <th style="width: 1%">Stock</th>
                        <th style="width: 1%">Action</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @if ($table)
                    <?php
                        $i = 1;
                    ?>
                        @foreach ($table as $item)
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{$item->code}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->incoming}}</td>
                                <td>{{$item->outgoing}}</td>
                                <td>{{$item->stock}}</td>
                                <td style="text-align: center">
                                    <div class="dropdown">
                                        <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </a>
                                        <ul class="dropdown-menu">
                                          <li><a class="dropdown-item" href="#">Action</a></li>
                                          <li><a class="dropdown-item" href="#">Another action</a></li>
                                          <li><a class="dropdown-item" href="#">Something else here</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <?php
                                $i++;
                            ?>
                        @endforeach
                    @else

                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
