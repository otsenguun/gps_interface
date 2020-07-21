@extends('layouts.app')

@section('content')

<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Device</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Device</a></li>
                            <li class="active">Detials</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 <div class="content">

 	 <div class="row">

        <div class="col-md-12">
                
               

                 <div class="card">
                            <div class="card-header">
                                <strong><U>{{$device->name }}</U></strong> / Data  
                            </div>
                            <div class="card-body card-block">

                            <form action="{{route('Device.show',$device->id)}}" method="get" class="form-inline">
                                    <div class="form-group">
                                        <label for="exampleInputName2" class="pr-1  form-control-label">Start date</label>
                                        <input type="date" id="exampleInputName2" placeholder="Search here" class="form-control" name="s" value="{{isset($start_date) ? $end_date : '' }}">

                                        <label for="exampleInputName" class="pr-1  form-control-label">End date</label>
                                        <input type="date" id="exampleInputName" placeholder="Search here" class="form-control" name="s" value="{{isset($end_date) ? $end_date : '' }}">
                                    </div>
                                </form>
                                <hr>
                                 <div class="table-stats order-table ov-h">

                                 <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="serial">#</th>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Emei</th>
                                            <th>Lat</th>
                                            <th>Lng</th>
                                            <th>GPS date</th>
                                            <th>Server date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($datas as $key => $data)
                                        <tr>
                                            <td class="serial">{{$key+1 }}</td>
                                            <td>  <span class="name">{{$data->vehiclestatus}}</span> </td>
                                            <td>  </td>
                                            <td>  <span class="name">{{$data->imei}}</span> </td>
                                            <td> <span class="product">{{$data->lat}}</span> </td>
                                            <td><span class="name">{{$data->lng}}</span></td>
                                            <td>
                                                <span class="name">{{$data->datetime}}</span>
                                            </td>
                                            <td>
                                                <span class="name">{{$data->created_at}}</span>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                        
                                </div> <!-- /.table-stats -->


                            </div>
                            <div class="card-footer">

                            {{ $datas->links() }}

                            </div>
                        </div>

        </div>

    </div>

 </div>


@endsection