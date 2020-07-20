@extends('layouts.app')

@section('content')

<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Contrack</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Contrack</a></li>
                            <li class="active">Lists</li>
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
                                <strong><U>Search</U></strong> Contrack
                            </div>
                            <div class="card-body card-block">
                                <form action="{{url('showcontracks')}}" method="get" class="form-inline">
                                    <div class="form-group">
                                        <label for="exampleInputName2" class="pr-1  form-control-label">Search Box</label>
                                        <input type="text" id="exampleInputName2" placeholder="Search here" class="form-control" name="s" value="{{isset($s) ? $s : '' }}"></div>
                                </form>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="fa fa-dot-circle-o"></i> Search
                                </button>
                            </div>
                        </div>

                 <div class="card">
                            <div class="card-header">
                                <strong><U>List</U></strong> Contrack
                            </div>
                            <div class="card-body card-block">
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
                                                @foreach($devices as $key => $device)
                                                <tr>
                                                    <td class="serial">{{$key+1 }}</td>
                                                    <td>  <span class="name">{{$device->vehiclestatus}}</span> </td>
                                                    <td>  <span class="name">{{$device->email}}</span> </td>
                                                    <td> <span class="product">{{$device->lat}}</span> </td>
                                                    <td><span class="count">{{$device->long}}</span></td>
                                                    <td>
                                                        <span class="name">{{$device->datetime}}</span>
                                                    </td>
                                                     <td>
                                                        <span class="name">{{$device->created_at}}</span>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                </table>
                            </div> <!-- /.table-stats -->


                            </div>
                            <div class="card-footer">


                            </div>
                        </div>

        </div>

    </div>

 </div>


@endsection