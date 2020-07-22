@extends('layouts.app')

@section('content')

<style>

#map {
        height: 700px;
      }

</style>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCdgtiUyPEhWlBACw4ii3ldb2KiJOV5i9U&callback=initMap&libraries=&v=weekly"
      defer
    ></script>
    
<script>
        function lat(t){
        return (Number(t.slice(0,2)) + (Number(t.slice(2,9))/60))
        }

        function lng(g) {
        return (Number(g.slice(0,3)) + (Number(g.slice(3,10))/60))
        }

      (function(exports) {
        "use strict";

        // This example creates a 2-pixel-wide red polyline showing the path of
        // the first trans-Pacific flight between Oakland, CA, and Brisbane,
        // Australia which was made by Charles Kingsford Smith.
        function initMap() {
          var map = new google.maps.Map(document.getElementById("map"), {
            zoom: 3,
            center: {
              lat: 0,
              lng: -180
            },
            mapTypeId: "terrain"
          });
          var flightPlanCoordinates = [
            { 
            @foreach($locations as $location)
              lat: lat("{{$location->lat}}"),
              lng: lng("{{$location->lng}}")
            @endforeach  
            }
          ];
          var flightPath = new google.maps.Polyline({
            path: flightPlanCoordinates,
            geodesic: true,
            strokeColor: "#FF0000",
            strokeOpacity: 1.0,
            strokeWeight: 2
          });
          flightPath.setMap(map);
        }

        exports.initMap = initMap;
      })((this.window = this.window || {}));
    </script>

<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Device / <strong><U>{{$device->name }}</U></strong> </h1> 
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
                
               <div class="row">
               
                    <div class="col-md-7">
                        <div class="card">

                            <div id="map"></div>
                            
                        </div>

                    </div>
               

                <div class="col-md-5">
                <div class="card">
                            <div class="card-header">
                                Data  
                            </div>
                            <div class="card-body card-block">

                            <form action="{{route('Device.show',$device->id)}}" method="get" class="form-inline">
                                    <div class="form-group">
                                        <label for="exampleInputName2" class="pr-1  form-control-label">Start date</label>
                                        <input type="date" id="exampleInputName2" placeholder="Search here" class="form-control" name="s" value="{{isset($start_date) ? $end_date : '' }}">

                                        <label for="exampleInputName" class="pr-1  form-control-label">End date</label>
                                        <input type="date" id="exampleInputName" placeholder="Search here" class="form-control" name="s" value="{{isset($end_date) ? $end_date : '' }}">
                                        <button class="btn btn-info"> <i class="fa fa-search"></i> </button>
                                    </div>
                                </form>
                                <hr>
                                 <div class="table-stats order-table ov-h">

                                 <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="serial">#</th>
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
                                {{ $datas->links() }}
                                </div> <!-- /.table-stats -->


                            </div>
                            <div class="card-footer">

                           

                            </div>
                        </div>
                </div>
                </div>
                 

       
        </div>

    </div>

 </div>


@endsection