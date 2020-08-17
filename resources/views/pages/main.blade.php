@extends('layouts.app')

@section('content')

<style>

#map {
        height: 700px;
      }


</style>

<script
  src="https://code.jquery.com/jquery-2.2.4.min.js"
  integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
  crossorigin="anonymous"></script>
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



 "use strict";

      // The following example creates complex markers to indicate beaches near
      // Sydney, NSW, Australia. Note that the anchor is set to (0,32) to correspond
      // to the base of the flagpole.
      function initMap() {
        const map = new google.maps.Map(document.getElementById("map"), {
          zoom: 10,
          center: {
            lat: 47.924300,
            lng: 106.878727
          }
        });
        setMarkers(map);
      } // Data for the markers consisting of a name, a LatLng and a zIndex for the
      // order in which these markers should display on top of each other.

      const beaches = [
      @php $i = 0; @endphp
        @foreach($device_datas as  $dev_data)
        ["{{$dev_data->name}}", lat("{{$dev_data->lat}}"), lng("{{$dev_data->lng}}"),{{$i++}}],
        @endforeach
      ];

      function setMarkers(map) {
        // Adds markers to the map.
        // Marker sizes are expressed as a Size of X,Y where the origin of the image
        // (0,0) is located in the top left of the image.
        // Origins, anchor positions and coordinates of the marker increase in the X
        // direction to the right and in the Y direction down.
        const image = {
          url:
            "https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png",
          // This marker is 20 pixels wide by 32 pixels high.
          size: new google.maps.Size(20, 32),
          // The origin for this image is (0, 0).
          origin: new google.maps.Point(0, 0),
          // The anchor for this image is the base of the flagpole at (0, 32).
          anchor: new google.maps.Point(0, 32)
        }; // Shapes define the clickable region of the icon. The type defines an HTML
        // <area> element 'poly' which traces out a polygon as a series of X,Y points.
        // The final coordinate closes the poly by connecting to the first coordinate.

        const shape = {
          coords: [1, 1, 1, 20, 18, 20, 18, 1],
          type: "poly"
        };

        for (let i = 0; i < beaches.length; i++) {
          const beach = beaches[i];
          new google.maps.Marker({
            position: {
              lat: beach[1],
              lng: beach[2]
            },
            map,
            icon: {
                url:"{{asset('images/pulse_dot.gif')}}",
                scaledSize: new google.maps.Size(30, 30),
                labelOrigin: new google.maps.Point(55, 12)
                },
            shape: shape,
            title: beach[0],
            label: {
                text:beach[0],
                fontWeight: "bold"
            },
            zIndex: beach[3]
          });
        }
      }


   
</script>

<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Main / <strong><U> all devices </U></strong> </h1> 

                        <!-- <img src="{{asset('images/pulse.gif')}}"> -->
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
               
                    <div class="col-md-9">
                        <div class="card">

                            <div id="map"></div>

                        </div>

                    </div>
               

                <div class="col-md-3">
                <div class="card">
                            <div class="card-header">
                                Data  
                            </div>
                            <div class="card-body card-block">
                                
                                 <div class="table-stats order-table ov-h">

                                 <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="serial">#</th>
                                            <th>Name</th>
                                            <th>Last date</th>
                                            <th>Speed</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($devices as $key => $device)
                                        <tr>
                                            <td class="serial">{{$key+1 }}</td>
                                            <td> <span class="product">{{$device->name}}</span> </td>
                                            <td><span class="name">2200220</span></td>
                                            <td> 0 </td>
  
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

    </div>

 </div>


@endsection