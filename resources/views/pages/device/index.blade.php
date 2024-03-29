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
        var totaldistance = 0;

       function lat(t){
            return (Number(t.slice(0,2)) + (Number(t.slice(2,9))/60))
        }

        function lng(g) {
            return (Number(g.slice(0,3)) + (Number(g.slice(3,10))/60))
        }
        
        var flightPlanCoordinates = [
            @foreach($locations as $location)
                {
                  lat: lat("{{$location->lat}}"),
                  lng: lng("{{$location->lng}}")
                },
            @endforeach

          ];
     

      (function(exports) {
        "use strict";

        // This example creates a 2-pixel-wide red polyline showing the path of
        // the first trans-Pacific flight between Oakland, CA, and Brisbane,
        // Australia which was made by Charles Kingsford Smith.
        function initMap() {
          var map = new google.maps.Map(document.getElementById("map"), {
            zoom: 13,
            center: {
             @foreach($locations as $location)
              lat:  lat("{{$location->lat}}"),
              lng: lng("{{$location->lng}}")
                @break
             @endforeach

            },
            mapTypeId: "terrain"
          });
        
        function haversine_distance(mk1, mk2) {
          var R = 3958.8; // Radius of the Earth in miles
          var rlat1 = mk1.position.lat() * (Math.PI/180); // Convert degrees to radians
          var rlat2 = mk2.position.lat() * (Math.PI/180); // Convert degrees to radians
          var difflat = rlat2-rlat1; // Radian difference (latitudes)
          var difflon = (mk2.position.lng()-mk1.position.lng()) * (Math.PI/180); // Radian difference (longitudes)

          var d = 2 * R * Math.asin(Math.sqrt(Math.sin(difflat/2)*Math.sin(difflat/2)+Math.cos(rlat1)*Math.cos(rlat2)*Math.sin(difflon/2)*Math.sin(difflon/2)));
          return d;
        }
        
        flightPlanCoordinates.forEach(myFunction);

        function myFunction(item, index) {
          
            var before_index = index - 1;

            if(before_index < 0){
                before_index = 0;
            } 

            var location1 = item;
            var location2 = flightPlanCoordinates[before_index];

            // console.log(location2);

            var mk1 = new google.maps.Marker({position: location1});
            var mk2 = new google.maps.Marker({position: location2});
            
            var distance = haversine_distance(mk1, mk2);

            totaldistance = totaldistance + distance;
            // console.log(distance);

        }

        document.getElementById('msg').innerHTML = "Нийт явсан : <b>" + (parseFloat(totaldistance*1.60934)).toFixed(2) + "</b> км";
    
        var lineSymbol = {
            path: google.maps.SymbolPath.FORWARD_CLOSED_ARROW
        }; // Create the polyline and add the symbol via the 'icons' property.

          var flightPath = new google.maps.Polyline({
            path: flightPlanCoordinates,
            geodesic: true,
            strokeColor: "#b753d7",
            strokeOpacity: 2.0,
            strokeWeight: 4,
            icons:[
                    {
                      icon: lineSymbol,
                      offset: "100%"
                    }
                  ],
          });
            var bounds = new google.maps.LatLngBounds();
            for (var i = 0; i < flightPlanCoordinates.length; i++) {
              bounds.extend(flightPlanCoordinates[i]);
            }
            bounds.getCenter();
            map.fitBounds(bounds);

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
                        <h1>Device / <strong><U>{{$device->name }}</U></strong>   <a href="{{url('/Device/playroad',$device->id)}}" class="btn btn-primary btn-xs"> Бичлэг үзэх </a>
               </h1> 
                      
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
                            <div id="msg"></div>
                            <div>Дээд хурд : <b>{{number_format($top_speed)}}</b> km/h </div> 
                            <div>Дундаж хурд : <b>{{number_format($avarage_speed)}}</b> km/h </div>   
                            
                            <div>Явсан цаг : <b>{{$run_time}}</b></div>  
                            <div>Зогссон цаг : <b>{{$stop_time}}</b> </div>    
                            
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
                                        <input type="date" id="exampleInputName2" placeholder="YYYY-MM-DD" class="form-control" name="start_date" value="{{isset($start_date) ? $start_date : '' }}">
                                        <input type="text" id="exampleInputName2" placeholder="Hh:ss:mm" class="form-control" name="start_time" value="{{isset($start_time) ? $start_time : '' }}">
                                       
                                      
                                    </div>
                                    <div class="form-group">
                                      
                                        <label for="exampleInputName" class="pr-1  form-control-label">End date</label>
                                        <input type="date" id="exampleInputName" placeholder="YYYY-MM-DD" class="form-control" name="end_date" value="{{isset($end_date) ? $end_date : '' }}">
                                        <input type="text" id="exampleInputName2" placeholder="Hh:ss:mm" class="form-control" name="end_time" value="{{isset($end_time) ? $end_time : '' }}">
                                       
                                        
                                    </div>
                                    <button class="btn btn-info"> <i class="fa fa-search"></i> </button>
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
                                            <th>Speed</th>
                                            <th>#</th>
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
                                            <td> {{ (0 + $data->speed)."km/h" }} </td>
                                            <td> <a href="{{url('delete_data',$data->id)}}" class="btn btn-xs">  <i class="fa fa-trash-o"></i>  </a> </td>
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