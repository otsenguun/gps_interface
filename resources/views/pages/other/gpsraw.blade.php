@extends('layouts.app')

@section('content')

<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Raw Data</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">Нүүр хуудас</a></li>
                            <li><a href="#">Raw Data</a></li>
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
                                <strong><U>Raw</U></strong> Data
                            </div>
                            <div class="card-body card-block">
                            <div class="row">
                                <div class="col-md-9">

                                <form action="{{url('/RawData')}}" method="get" class="form-inline">
                                    <div class="form-group">
                                        <label for="exampleInputName2" class="pr-1  form-control-label">Start date</label>
                                        <input type="text" id="exampleInputName2" placeholder="YYYY-MM-DD HH:MM:SS" class="form-control" name="start_date" value="{{isset($start_date) ? $start_date : date("Y-m-d")." 00:00:00" }}">

                                        <label for="exampleInputName" class="pr-1  form-control-label">End date</label>
                                        <input type="text" id="exampleInputName" placeholder="YYYY-MM-DD HH:MM:SS" class="form-control" name="end_date" value="{{isset($end_date) ? $end_date :  date("Y-m-d")." 23:59:59" }}">

                                        <label for="exampleInputName2" class="pr-1  form-control-label">Imei</label>
                                        <input type="text" id="exampleInputName2" placeholder="Imei" class="form-control" name="s" value="{{isset($s) ? $s : '' }}"></div>
                                        <input type="submit" value="Хайх" class="btn btn-primary">
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
                                            <th>imei</th>
                                            <th>vehiclestatus</th>
                                            <th>datetime</th>
                                            <th>batvoltage</th>
                                            <th>supvoltage</th>
                                            <th>tempa</th>
                                            <th>tempb</th>
                                            <th>gpssatellites</th>
                                            <th>gsmsignal</th>
                                            <th>angle</th>
                                            <th>speed</th>
                                            <th>hdop</th>
                                            <th>mileage</th>
                                            <th>lat</th>
                                            <th>ns</th>
                                            <th>lng</th>
                                            <th>ew</th>
                                            <th>serialnumber</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($datas as $key => $data)
                                        <tr>
                                            <td class="serial">{{$key+1 }}</td>
                                            <td>  <span class="name">{{$data->id}}</span> </td>
                                            <td>  <span class="name">{{$data->imei}}</span></td>
                                            <td>  <span class="name">{{$data->vehiclestatus}}</span> </td>
                                            <td>  <span class="name">{{$data->datetime}}</span> </td>
                                            <td>  <span class="name">{{$data->batvoltage}}</span> </td>
                                            <td>  <span class="name">{{$data->supvoltage}}</span> </td>
                                            <td>  <span class="name">{{$data->tempa}}</span></td>
                                            <td>  <span class="name">{{$data->tempb}}</span> </td>
                                            <td>  <span class="name">{{$data->gpssatellites}}</span></td>
                                            <td>  <span class="name">{{$data->gsmsignal}}</span> </td>
                                            <td>  <span class="name">{{$data->speed}}</span></td>
                                            <td>  <span class="name">{{$data->hdop}}</span> </td>
                                            <td>  <span class="name">{{$data->mileage}}</span></td>
                                            <td>  <span class="name">{{$data->lat}}</span> </td>
                                            <td>  <span class="name">{{$data->ns}}</span></td>
                                            <td>  <span class="name">{{$data->lng}}</span> </td>
                                            <td>  <span class="name">{{$data->ew}}</span></td>
                                            <td>  <span class="name">{{$data->serialnumber}}</span> </td>
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
