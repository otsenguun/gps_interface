@extends('layouts.app')

@section('content')

<style>

#map {
        height: 600px;
      }

</style>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCdgtiUyPEhWlBACw4ii3ldb2KiJOV5i9U&callback=initMap&libraries=&v=weekly"
      defer
    ></script>
    
<script>
      (function(exports) {
        "use strict";

        // This example creates an interactive map which constructs a polyline based on
        // user clicks. Note that the polyline only appears once its path property
        // contains two LatLng coordinates.

        function initMap() {
          exports.map = new google.maps.Map(document.getElementById("map"), {
            zoom: 7,
            center: {
              lat: 41.879,
              lng: -87.624
            } // Center the map on Chicago, USA.
          });
          exports.poly = new google.maps.Polyline({
            strokeColor: "#000000",
            strokeOpacity: 1.0,
            strokeWeight: 3
          });
          exports.poly.setMap(exports.map); // Add a listener for the click event

          exports.map.addListener("click", addLatLng);
        } // Handles click events on a map, and adds a new point to the Polyline.

        function addLatLng(event) {
          var path = exports.poly.getPath(); // Because path is an MVCArray, we can simply append a new coordinate
          // and it will automatically appear.

          path.push(event.latLng); // Add a new marker at the new plotted point on the polyline.

          var marker = new google.maps.Marker({
            position: event.latLng,
            title: "#" + path.getLength(),
            map: exports.map
          });
        }

        exports.addLatLng = addLatLng;
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