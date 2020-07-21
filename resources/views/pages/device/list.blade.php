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
                                <strong><U>List</U></strong> Device
                            </div>
                            <div class="card-body card-block">
                            <div class="row">
                                <div class="col-md-9">

                                <form action="{{url('showcontracks')}}" method="get" class="form-inline">
                                    <div class="form-group">
                                        <label for="exampleInputName2" class="pr-1  form-control-label">Search Box</label>
                                        <input type="text" id="exampleInputName2" placeholder="Search here" class="form-control" name="s" value="{{isset($s) ? $s : '' }}"></div>
                                </form>
                                
                                </div>
                                <div class="col-md-3">
                                <a href="{{route('Device.create')}}" class="btn btn-info btn-sm pull-right"> Add   </a>

                                </div>
                            </div>
                               

         
                                <hr>
                                 <div class="table-stats order-table ov-h">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="serial">#</th>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Emei</th>
                                            <th>Date</th>
                                            <th>Settings</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($devices as $key => $device)
                                        <tr>
                                            <td class="serial">{{$key+1 }}</td>
                                            <td>  <span class="name">{{$device->id}}</span> </td>
                                            <td>  <span class="name"> <a href="{{route('Device.show',$device->id)}}" class="btn btn-info">{{$device->name}}</a> </span> </td>
                                            <td>  <span class="name">{{$device->imei}}</span> </td>
                                            <td>
                                                <span class="name">{{$device->created_at}}</span>
                                            </td>
                                            <td>   <a href="{{route('Device.edit',$device->id)}}" class="btn btn-warning"> Засах</a> </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div> <!-- /.table-stats -->


                            </div>
                            <div class="card-footer">

                            {{ $devices->links() }}

                            </div>
                        </div>

        </div>

    </div>

 </div>


@endsection
