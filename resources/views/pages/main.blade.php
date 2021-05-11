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


       function fixlat(t){
            return (Number(t.slice(0,2)) + (Number(t.slice(2,9))/60))
        }

        function fixlng(g) {
            return (Number(g.slice(0,3)) + (Number(g.slice(3,10))/60))
        }

      // In the following example, markers appear when the user clicks on the map.
		// The markers are stored in an array.
		// The user can then click an option to hide, show or delete the markers.
		let map;
		let markers = [];

		function initMap() {
		  // const haightAshbury = { lat: 37.769, lng: -122.446 };
		  map = new google.maps.Map(document.getElementById("map"), {
		    zoom: 9,
		    center: {
             lat: 47.924300,
             lng: 106.878727
          },
		    mapTypeId: "terrain",
		  });
		  // This event listener will call addMarker() when the map is clicked.
		  map.addListener("click", (event) => {
		    addMarker(event.latLng);
		  });

		  // Adds a marker at the center of the map.
		       setInterval(function(){

		          // console.log('asdasd');

		            $.ajax({
		                  type: "get",
		                  url: "{{url('/getlastdistace')}}",
		              }).done(function (response) {



		                    deleteMarkers();

                            $.each( response, function( key, value ) {

                                var iconurl = "{{asset('images/pulse_dot.gif')}}";
                                var lat = parseFloat(fixlat(value.lat));
                                var lng = parseFloat(fixlng(value.lng));

                                addMarker(lat,lng,value.dev_name);

                            });


		                     // markers = [
		                     //    [response.data.dev_name , lat,lng , 0],
		                     //  ];

		                     // setMarkers(map);

		              }).fail(function () {
		                  alert("Холболт амжилтгүй");
		              });


		         }, 10000);


     //  }
		  // addMarker(haightAshbury);
		}


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

        var shape = {
          coords: [1, 1, 1, 20, 18, 20, 18, 1],
          type: "poly"
        };

        for (let i = 0; i < markers.length; i++) {
          var beach = markers[i];
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
           // markers.push(marker);
        }
      }
		// Adds a marker to the map and push to the array.
		function addMarker(lat,lng,name) {

			var shape = {
	          coords: [1, 1, 1, 20, 18, 20, 18, 1],
	          type: "poly"
	        };
		  const marker = new google.maps.Marker({
		    position: {
              lat: lat,
              lng: lng
            },
		    map: map,
		     icon: {
	            url:"{{asset('images/pulse_dot.gif')}}",
	            scaledSize: new google.maps.Size(30, 30),
	            labelOrigin: new google.maps.Point(55, 12)
	            },
	         shape: shape,
	            title: name,
	            label: {
	                text:name,
	                fontWeight: "bold"
	            }
		  });
		  markers.push(marker);
		}

		// Sets the map on all markers in the array.
		function setMapOnAll(map) {
		  for (let i = 0; i < markers.length; i++) {
		    markers[i].setMap(map);
		  }
		}

		// Removes the markers from the map, but keeps them in the array.
		function clearMarkers() {
		  setMapOnAll(null);
		}

		// Shows any markers currently in the array.
		function showMarkers() {
		  setMapOnAll(map);
		}

		// Deletes all markers in the array by removing references to them.
		function deleteMarkers() {
		  clearMarkers();
		  markers = [];
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
                            <div id="other">


                            </div>
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
