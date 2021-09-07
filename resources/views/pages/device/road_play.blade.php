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

        function initMap() {
			var map = new google.maps.Map(document.getElementById("map"), {
			  center: {lat: pathCoords[0].lat, lng: pathCoords[0].lng},
			  zoom: 14,
			  mapTypeId: google.maps.MapTypeId.ROADMAP
			});
			
			autoRefresh(map);
            // google.maps.event.addDomListener(window, 'load', initialize);
		}

		function moveMarker(map, marker, latlng) {
			marker.setPosition(latlng);
			map.panTo(latlng);
		}

		function autoRefresh(map) {
			var i, route, marker;
			
			route = new google.maps.Polyline({
				path: [],
				geodesic : true,
				strokeColor: '#FF0000',
				strokeOpacity: 1.0,
				strokeWeight: 2,
				editable: false,
				map:map
			});
			
			marker=new google.maps.Marker(
            {
            map:map,
            icon: 
                {
	            url:"{{asset('images/pulse_dot.gif')}}",
	            origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(20, 20),
                scaledSize: new google.maps.Size(30, 30),
                labelOrigin: new google.maps.Point(9, 8)
	            }
            },
            );
           
            let contentString =
                        '<div id="show_marker">' +
                            "<p>Нэр : <b>"+ 0 +"</b></p>" +
                            "<p>Хурд : <b>"+ "parseInt(speed)" + "km/h" +"</b></p>" +
                            "<p>Төлөв : <b>"+ "status" +"</b></p>" +
                            "<p>Огноо : <b>"+ "datetime" +"</b></p>" +
                        "</div>";
           
            
            let infowindow = new google.maps.InfoWindow({
                        content: contentString,
                    });
            infowindow.open({
                anchor: marker,
                map,
                shouldFocus: false,
            });

			for (i = 0; i < pathCoords.length; i++) {
				setTimeout(function (coords)
				{
					var latlng = new google.maps.LatLng(coords.lat, coords.lng);
					route.getPath().push(latlng);
                   
                    newText = '<div id="show_marker">' +
                            "<p>Нэр : <b>"+ '{{$device->name}}' +"</b></p>" +
                            "<p>Хурд : <b>"+ parseInt(coords.speed) + "km/h" +"</b></p>" +
                            "<p>Төлөв : <b>"+ coords.status +"</b></p>" +
                            "<p>Огноо : <b>"+ coords.date +"</b></p>" +
                        "</div>";
                    // console.log(coords);
                    infowindow.setContent(newText);
                        // infowindow.content = contentString;
					moveMarker(map, marker, latlng);
				}, 200 * i, pathCoords[i]);
			}
            
		}

		
     
		var pathCoords = [
            @foreach($locations as $location)
            {
            "lat": lat("{{$location->lat}}"),
            "lng": lng("{{$location->lng}}"),
            "speed": "{{$location->speed}}",
            "status": "@php if(0 < (0 + $location->speed)){echo 'явж байна'; }else{ echo 'Зогсож байна'; }  @endphp",
            "date": "{{$location->datetime}}",

            },
             @endforeach
        ];
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

                            <form action="{{url('Device/playroad',$device->id)}}" method="get" class="form-inline">
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