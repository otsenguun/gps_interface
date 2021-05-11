@extends('layouts.app')

@section('content')

<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Төхөөрөмж</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">Нүүр хуудас</a></li>
                            <li><a href="#">Төхөөрөмж</a></li>
                            <li class="active">Жагсаалт</li>
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
                                <strong><U>Жагсаалт</U></strong> Төхөөрөмж
                            </div>
                            <div class="card-body card-block">
                            <div class="row">
                                <div class="col-md-9">

                                <form action="{{url('listDevices')}}" method="get" class="form-inline">
                                    <div class="form-group">
                                        <label for="exampleInputName2" class="pr-1  form-control-label">Search Box</label>
                                        <input type="text" id="exampleInputName2" placeholder="Search here" class="form-control" name="s" value="{{isset($s) ? $s : '' }}"></div>
                                </form>

                                </div>
                                <div class="col-md-3">

                                </div>
                            </div>



                                <hr>
                                 <div class="table-stats order-table ov-h">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="serial">#</th>
                                            <th>ID</th>
                                            <th>Нэр</th>
                                            <th>Emei</th>
                                            <th>Утасний дугаар</th>
                                            <th>Жолоочийн тухай</th>
                                            <th>Төлөв</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($devices as $key => $device)
                                        <tr>
                                            <td class="serial">{{$key+1 }}</td>
                                            <td>  <span class="name">{{$device->id}}</span> </td>
                                            <td>  <span class="name"> <a href="{{url('Device/show',$device->id)}}" class="btn btn-info">{{$device->name}}</a> </span> </td>
                                            <td>  <span class="name">{{$device->imei}}</span> </td>
                                            <td>  <span class="name">{{$device->phone}}</span> </td>
                                            <td>  <span class="name">{{$device->driver_name}}</span> </td>

                                            <td>
                                                <span class="name">{{$device->status}}</span>
                                            </td>
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
