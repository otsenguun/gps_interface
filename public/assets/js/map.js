// JavaScript Document
var FEET=
{
	label:"feet",
	f:function(distance)
	{
		return distance*3.2808399;
	}
};

var MILES=
{
	label:"miles",
	f:function(distance)
	{
		return distance/1609.344;
	}
};

var KMS=
{
	label:"km",
	f:function(distance)
	{
		return distance/1000;
	}
};

var NMILES=
{
	label:"nautical miles",
	f:function(distance)
	{
		return ((distance/1609.344)*(1/1.150779));
	}
};

var METRES=
{
	label:"metres",
	f:function(distance)
	{
		return (distance);
	}
};

var unit_handler=KMS;
//unit_handler


//global varibles
var map;
var map1;
var map2;
var map3;
var map4;
//var localSearch = new GlocalSearch();
var autopan;
var distanceEnable;
var routePoints=new Array(0);
var routeMarkers=new Array(0);
var lines=[];
var lineWidth=1;
var lineColor='#ff0066';
var routePath;
var total_distance=0;
var togglemarkers=1;
var toggleGoogleBar=0;
var markerclickmode=0;

var LastID = 0;
var countdown;
var markers = [];
var RoadPoints = Array();
var MaxIDs = Array();
var Timelines = Array();
var pl = Array();
var directions;
var lastCheckPointSize = 5;
var carhead = Array();
var carmap = Array();
var MapPoints = Array();
var carName = Array();
var carColor = Array();
var lastdata = Array();
var infowindow = null;
var CarDagahID = null;
var CarDagah = false;
var LoadingData = false;
var FirstData = true;
var history_path;
var history_markers = Array();
var history_contents = Array();

//global varibles
//***********************************************************************

function initialize() 
{

	//LoadCookieRoute();
	// document.getElementById("cb_dist2").checked=true;
	LoadPosandSettings();
	
	google.maps.event.addListener(map, "zoomend", function(oldLevel, newLevel) {
	    displayPointNames();
	});
	
	google.maps.event.addListener(map, 'moveend', function()
	{
		SavePosandSettings();
		//displayPointNames();
	});
	
	google.maps.event.addListener(map, 'zoom_changed', function()
	{
		SavePosandSettings();
	});
	
	google.maps.event.addListener(map, 'click', function(event)
	{
		$("input#latbox").val(event.latLng.lat());
		$("input#lngbox").val(event.latLng.lng());
		if (distanceEnable)clickatpoint(event.latLng);
 	});
		
	
	google.maps.event.addListenerOnce(map, 'tilesloaded', function() 
	{
		google.maps.event.addListener(map, 'maptypeid_changed', function()
		{
			SavePosandSettings();
		});
	});
	
		history_path = new google.maps.Polyline({
		strokeColor: "#0000FF",
		strokeOpacity: 0.6,
		strokeWeight: 2,
		clickable: false,
		});
		
}
function ckeckSQRcars(){
	for (i in mapsqr){
	sqrcars[i] =0;
	}
	for (c in carhead ){
		for (i in mapsqr){
		var isWithinPolygon = mapsqr[i].containsLatLng(carhead[c].position);
	
		if ( isWithinPolygon ) sqrcars[i] +=1;
		}
	}
	for (i in mapsqr){
	$("#sqrqty"+i).html( sqrcars[i]);
	}
}

function changeIcon(marker,icon) {
	marker.icon.image = icon;
}
function displayPointNames(){
	for(var index in carhead ){
	var markerOffset = carmap[index].fromLatLngToDivPixel(carhead[index].getLatLng());
	$("#carnumber_"+index).show();
	$("#carnumber_"+index).css({opacity: 0.7 ,display:"normal", top:markerOffset.y - 22, left:markerOffset.x -30});
	}
	for(var index in MapPoints ){
	var markerOffset = map.fromLatLngToDivPixel(MapPoints[index]);
	$("#mappoint_"+index).show();
	$("#mappoint_"+index).css({opacity: 0.7 , top:markerOffset.y - 14, left:markerOffset.x -30});
	}
}
function clearHistoryOverlays() {
  if (history_markers) {
    for (i in history_markers) {
      history_markers[i].setMap(null);
    }
	history_markers.length = 0;
  }
  if (history_path) history_path.setMap(null);
  setArrows.clear();
}
function updateLastData(id){
  $('.show-bus').addClass('hiden-bus');
  $('.show-bus').removeClass('show-bus');
  var this_item = $('#busrow'+id);
  var next_item = this_item.next().addClass('show-bus');
  if(next_item.find('.bus-button-bar button:first-child').hasClass('active-btn')==true){
    next_item.find('td .card .tuluv').removeAttr('style');
  }
  next_item.removeClass('hiden-bus');
  //console.log('Ð¥ÑƒÑ€Ð´: '+lastdata[id].speed);
	next_item.find(".selBusnumber").html('<b>ÐÑÑ€:</b> '+lastdata[id].name);
//   if(lastdata[id].speed != undefined){
//     next_item.find(".selBusspeed").html('Ð¥ÑƒÑ€Ð´: '+lastdata[id].speed);	
//   }
//   else{
//     next_item.find(".selBusspeed").html('Ð¥ÑƒÑ€Ð´: '+ '0 ÐšÐœ/Ð¦Ð°Ð³');	
//   }
  
	next_item.find(".selBusspeed").html('<b>Ð¥ÑƒÑ€Ð´:</b> '+ $('#busspeed'+id).text()+' ÐšÐœ/Ð¦Ð°Ð³');	
	next_item.find(".selBusdistance").html('<b>Ó¨Ð½Ó©Ó©Ð´Ñ€Ð¸Ð¹Ð½ Ð·Ð°Ð¼:</b> '+lastdata[id].distance+' ÐšÐœ');
	next_item.find(".selBuslasttime").html('<b>Ð¡Ò¯Ò¯Ð»Ð¸Ð¹Ð½ Ñ†Ð°Ð³:</b> '+lastdata[id].time);
	next_item.find(".selBusaddinfo").html(lastdata[id].moreinfo);
	next_item.find(".selBusTemp").html('<b>ÐÐ³Ð°Ð°Ñ€Ñ‹Ð½ Ñ…ÑÐ¼:</b> '+lastdata[id].temp);
	//next_item.find(".selBusnextstop").html(lastdata[id].nextstopname);
	next_item.find(".selBusdriver").html(lastdata[id].drivername);
	next_item.find(".selBusTimeout").html('<b>Ð—Ð¾Ð³ÑÑÐ¾Ð½ Ñ…ÑƒÐ³Ð°Ñ†Ð°Ð°:</b> '+lastdata[id].timeout);	
	next_item.find(".selBusAngle").html('<b>Ð§Ð¸Ð³Ð»ÑÐ»:</b> '+lastdata[id].angle);
	next_item.find(".FuelSensorLevelA").html(lastdata[id].fuel_a);
	next_item.find(".FuelSensorLevelB").html(lastdata[id].fuel_b);
  if (lastdata[id].acc < 3) 
    next_item.find(".selBusACC").html("<b>Ð¦ÑÐ½ÑÐ³:</b> <font color=red>"+lastdata[id].acc+"</font>");
	else 
    next_item.find(".selBusACC").html('<b>Ð¦ÑÐ½ÑÐ³:</b> '+lastdata[id].acc);

  
	$("#selBusnumber").html(lastdata[id].name);
	$("#selBusspeed").html(lastdata[id].speed);	
	$("#selBusdistance").html(lastdata[id].distance);
	$("#selBuslasttime").html(lastdata[id].time);
	$("#selBusaddinfo").html(lastdata[id].moreinfo);
	$("#selBusTemp").html(lastdata[id].temp);
	//$("#selBusnextstop").html(lastdata[id].nextstopname);
	$("#selBusdriver").html(lastdata[id].drivername);
	$("#selBusTimeout").html(lastdata[id].timeout);	
	$("#selBusAngle").html(lastdata[id].angle);
	$("#FuelSensorLevelA").html(lastdata[id].fuel_a);
	$("#FuelSensorLevelB").html(lastdata[id].fuel_b);
	$("#selAlti").html(lastdata[id].sl);
	if (lastdata[id].acc < 3) $("#selBusACC").html("<font color=red>"+lastdata[id].acc+"</font>");
	else $("#selBusACC").html(lastdata[id].acc);
	if (typeof(updateCameraBar)!='undefined' ) updateCameraBar(id);
}
function displayPointcenter(index){
	carmap[index].panTo(carhead[index].position);
}
function displayPointcenterSQR(index){
var bounds = new google.maps.LatLngBounds();
for (i in sqrCoords[index]) {
  bounds.extend(sqrCoords[index][i]);
}
map.fitBounds(bounds);
}
function rad(x){return x*Math.PI/180;}

function getAngle(from, to){ 
 function wrapAngle(angle){ 
  if (angle>=360) { 
   angle-=360; 
  } else if (angle<0){ 
   angle+=360; 
  } 
  return angle; 
 } 
 var DEGREE_PER_RADIAN=57.2957795, RADIAN_PER_DEGREE=0.017453; 
 var dLat=to.lat()-from.lat(), dLng=to.lng()-from.lng(); 
 var yaw=Math.atan2(dLng*Math.cos(to.lat()*RADIAN_PER_DEGREE), 
dLat)*DEGREE_PER_RADIAN; 
 return wrapAngle(yaw); 
} 

function getAngle_old(from,to){
	var lat1 = rad(from.lat());
	var lon1 = rad(from.lng());
	var lat2 = rad(to.lat());
	var lon2 = rad(to.lng());
	var angle = Math.atan2(Math.sin(lon1-lon2) * Math.cos(lat2),Math.cos(lat1) * Math.sin(lat2) - Math.sin(lat1) * Math.cos(lat2) * Math.cos(lon1-lon2));
	if (angle< 0.0) angle += Math.PI*2.0;
	//alert(angle);
	return parseInt(angle* 10);
}

function loadlastpos(LineID){
	LoadingData = true; //lastpos/LineID;
	$.post(ajax_page + 'lastpos', {filter:devStrF}, function(data){
		if($.trim(data) == "logout") { window.top.location.href ='https://app.gps.mn'; }
		else{//sesstion timed out
		var mapdata = JSON.parse(data);
		for(var id in mapdata){
			if(parseInt(mapdata[id].updated,10)==1){//shine tseg irsen bol
			if (typeof(lastdata[id]) =='undefined'){
				lastdata[id] = new Array();	
				lastdata[id].active = false;
				lastdata[id].sqrname = '';
			}
			lastdata[id].lastupdate = mapdata[id].lastupdate;
			lastdata[id].distance = mapdata[id].distance;
			lastdata[id].moreinfo = mapdata[id].moreinfo;
			lastdata[id].drivername = mapdata[id].drivername;
			lastdata[id].timeout = mapdata[id].timeout;
			lastdata[id].time = mapdata[id].time;
			lastdata[id].name = mapdata[id].name;		
			lastdata[id].idle = mapdata[id].wait;		
			lastdata[id].fuel_a = mapdata[id].fuel_a;		
			lastdata[id].fuel_b = mapdata[id].fuel_b;
			lastdata[id].acc = mapdata[id].acc;
			lastdata[id].sl = mapdata[id].sl;
			lastdata[id].temp = mapdata[id].temp;
			if (mapdata[id].time != '1970-01-01 07:00:00'){
				carhead[id].setPosition(new google.maps.LatLng(mapdata[id].lat,mapdata[id].lng));
				lastdata[id].active = true;
				if ( id == CarDagahID ) updateLastData(CarDagahID);	
			}
			$("#gpssignal" + id).attr("class", mapdata[id].gs);
			if (mapdata[id].gs =='power_error') $("#gpssignal" + id).attr("title", 'Ð¢Ð¾Ð³Ð½Ð¾Ð¾Ñ ÑÐ°Ð»Ð³Ð°ÑÐ°Ð½!!!');
			else  $("#gpssignal" + id).attr("title", '');
			$("#busspeed"+id).html(mapdata[id].speed + "");
			if (lastdata[id].sqrname == '') {
				$("#busstatus"+id).html( (mapdata[id].speed > 0) ? 'Ð¯Ð²Ð¶ Ð±Ð°Ð¹Ð½Ð°' : 'Ð—Ð¾Ð³ÑÑÐ¾Ð½' );
			}else{
				$("#busstatus"+id).html(lastdata[id].sqrname);
			}
			$("#busdistance"+id).html(mapdata[id].distance);
			if (CarDagah == true && CarDagahID ==id) displayPointcenter(id);
			}else{//tseg ireegui udsan bol
				$("#busstatus"+id).html(mapdata[id].timeout);
			}
			var from = new google.maps.LatLng(mapdata[id].lat0,mapdata[id].lng0);
			var angle = getAngle(from, carhead[id].position );
			angle = parseInt(angle / 10) * 10;
			if (angle < 100) angle = "0"+angle;
			if (angle < 10 || angle >350 ) angle = "000";
			lastdata[id].angle = angle;
			var iconurl = asset_url+'arrows-blue/'+angle+'.png';
			if ( typeof(carColor[id] ) !='undefined' && carColor[id] !='' ) iconurl = asset_url+'arrows-'+carColor[id]+'/'+angle+'.png';
			      
			var image = new google.maps.MarkerImage(iconurl, new google.maps.Size(27, 27), new google.maps.Point(0, 0), new google.maps.Point(14, 14));
			carhead[id].setIcon(image);
			if ( mapdata[id].lat == 0  && mapdata[id].lng == 0 ) {
				$("#busrow" + id).removeClass("wait2").addClass("wait");
			}else if( mapdata[id].wait !=0 && mapdata[id].lat !=0 ){
				 $("#busrow" + id).removeClass("wait").addClass("wait2");
			}else {				
				$("#busrow" + id).removeClass("wait").removeClass("wait2");
			}
 
		}
			//displayPointNames();
			if (FirstData == true) FirstData = false;
		}//sesstion timed out
		LoadingData = false;
	});
}

// google.maps.LatLng.prototype.kmTo = function(a){ 
//     var e = Math, ra = e.PI/180; 
//     var b = this.lat() * ra, c = a.lat() * ra, d = b - c; 
//     var g = this.lng() * ra - a.lng() * ra; 
//     var f = 2 * e.asin(e.sqrt(e.pow(e.sin(d/2), 2) + e.cos(b) * e.cos 
//     (c) * e.pow(e.sin(g/2), 2))); 
//     return f * 6378.137; 
// }

// google.maps.Polyline.prototype.inKm = function(n){ 
//     var a = this.getPath(n), len = a.getLength(), dist = 0; 
//     for (var i=0; i < len-1; i++) { 
//        dist += a.getAt(i).kmTo(a.getAt(i+1)); 
//     }
//     return dist; 
// }
	

function loadhistory(item){
	var historyCarID = CarDagahID;
	LoadingData = true;
	clearHistoryOverlays();
	//var pointString="";
    $('#LoadHistory').attr("disabled", true); 	
	var coordinates = new Array();	
	$.post(ajax_page + 'loadroad', {dev_id:historyCarID,date1: $.trim($(".history_date1").val()), time1:$.trim($(".history_time1").val()), time2:$.trim($(".history_time2").val()) } , function(data){
       $('#LoadHistory').removeAttr("disabled"); 
		var mapdata = JSON.parse(data);
		for(var id in mapdata){
			var ppoints = mapdata[id].Geom;
			for(var ind in ppoints){
				var point = ppoints[ind];
				var ggpoint = new google.maps.LatLng(point.lat,point.lng);
				//if (pointString !='') pointString+="|";
				//pointString+=point.lat+","+point.lng;				
				coordinates.push(ggpoint);
				if (point.st != '') {
					var hisMarker = new MarkerWithLabel({
					position: ggpoint,
					draggable: false,
					clickable: true,
					raiseOnDrag:false ,
					map: map,
					isHidden: false,
					icon: asset_url+'icons/stripes.png',
					labelContent: point.st,
					labelAnchor: new google.maps.Point(22, 0),
					labelClass: "labels", // the CSS class for the label
					labelStyle: {opacity: 1.0},
					html :  point.stt
					});
					history_markers.push(hisMarker);
			    }
				
			}

		var infowindow = null;
		infowindow = new google.maps.InfoWindow({
		content: "holding..."
		});
		//$('#pointString').val(pointString);
		for (var i = 0; i < history_markers.length; i++) {
			var marker = history_markers[i];
			google.maps.event.addListener(marker, 'click', function () {
				// where I have added .html to the marker object.
				infowindow.setContent("<div><font size='2' face='Verdana' color='#000099'>Ð¦Ð°Ð³ : " + this.html + "</font></div>");
				infowindow.open(map, this);
			});
		}

		//set variables
// 		$("#historyCarNumber").html(carName[historyCarID]);
// 		$("#historyMaxSpeed").html(mapdata[id].maxspeed);
// 		$("#historyMidSpeed").html(mapdata[id].midspeed);
// 		$("#historyMinSpeed").html(mapdata[id].minspeed);
// 		$("#historyFreeTime").html(mapdata[id].freetime);
// 		$("#historyWorkTime").html(mapdata[id].worktime);
// 		$("#HistorySpendFuel").html(mapdata[id].spendfuel);
// 		$("#historyfuel100km").html(mapdata[id].fuel100);
      
      
      //new
      var target = $(item).parent().parent();
//       console.log($(item).parent().parent().html());
      	target.find(".historyCarNumber").html(carName[historyCarID]);
        target.find(".historyMaxSpeed").html(mapdata[id].maxspeed);
        target.find(".historyMidSpeed").html(mapdata[id].midspeed);
        target.find(".historyMinSpeed").html(mapdata[id].minspeed);
        target.find(".historyFreeTime").html(mapdata[id].freetime);
        target.find(".historyWorkTime").html(mapdata[id].worktime);
        target.find(".HistorySpendFuel").html(mapdata[id].spendfuel);
        target.find(".historyfuel100km").html(mapdata[id].fuel100);
      //new-end
      
      
	}
	LoadingData = false;
	if (coordinates.length > 2){
		history_path.setPath(coordinates);
		setArrows.load(coordinates, "midline");

		history_path.setMap(map);
		$("#historyDistance").html(parseInt(history_path.inKm()));
	}
	});
}
var togglehistory_markers = 1;
function togglemarkersHistory()
{
	//If they are on
	if (togglehistory_markers==1)
	{
		togglehistory_markers=0;
		if (history_markers) 
		{
			for (i in history_markers) 
			{
				history_markers[i].setMap(null)
			}
		}
	}
	else
	//If thety are off
	{
		togglehistory_markers=1;
		if (history_markers) 
		{
			for (i in history_markers) 
			{
				history_markers[i].setMap(map);
			}
		}
	}
}
var togglehistory_Arrow = 1;
function toggleArrowmarkersHistory()
{
	//If they are on
	if (togglehistory_Arrow==1)
	{
		togglehistory_markers=0;
		if (history_markers) 
		{
			for (i in history_markers) 
			{
				history_markers[i].setMap(null)
			}
		}
	}
	else
	//If thety are off
	{
		togglehistory_markers=1;
		if (history_markers) 
		{
			for (i in history_markers) 
			{
				history_markers[i].setMap(map);
			}
		}
	}
}


function gotomylocation()
{
	var geocoder = new google.maps.Geocoder();
	if (google.loader.ClientLocation) 
	{
		var Lat = google.loader.ClientLocation.latitude;
		var Lng = google.loader.ClientLocation.longitude;
		var latlng = new google.maps.LatLng(Lat,Lng);
		map.panTo(latlng);
	}
	else
	{
		document.getElementById("btn_findlocation").value="Sorry, Location Not Available";
	}
}

function clickatpoint(point)
{
		routePoints.push(point);
		var marker=placeMarker(point,routePoints.length);
		routeMarkers.push(marker);
		if (togglemarkers!=1)
		{
			//now remove it!
			marker.setMap(null);
		}
		
		//remove old polyline first
		if (!(routePath==undefined))
		{
			routePath.setMap(null);
		}
		routePath=getRoutePath();
		routePath.setMap(map);
		 
		updateDisplay();
		
		if (autopan==true)
		{
			map.setCenter(point);
		}	
		
		SaveCookieRoute();
}

//***********************************************************************
function getRoutePath()
{
	var routePath = new google.maps.Polyline({
		path: routePoints,
		strokeColor: lineColor,
		strokeOpacity: 1.0,
		strokeWeight: lineWidth,
		geodesic: true
	});
	return routePath;
}
//***********************************************************************
function deletepoint_pre()
{
	var btn_deletepoint=document.getElementById("btn_deletepoint");
	btn_deletepoint.style.backgroundColor="#ffffff";
	markerclickmode=1;
}

function deletepoint_post()
{
	var btn_deletepoint=document.getElementById("btn_deletepoint");
	btn_deletepoint.style.backgroundColor="#cccccc";
	markerclickmode=0;
}


function clearMap() 
{
	if (routeMarkers) 
	{
		for (i in routeMarkers) 
		{
			routeMarkers[i].setMap(null);
		}
	}
	routePoints=new Array(0);
	routeMarkers=new Array(0);
	//remove polyline
	if (!(routePath==undefined))
	{
		routePath.setMap(null);
	}
	total_distance=0;
	document.getElementById("distance_new").value="";
}

//***********************************************************************
//*****************Quick Find Option*************************************
function ftn_quickfind(address) 
{
	document.getElementById("btn_go").value="Searching...";
	localSearch.setSearchCompleteCallback(null, 
	function() 
	{
		if (localSearch.results[0])
		{		
			var image = new google.maps.MarkerImage(asset_url+'icons/stripes.png',
			// This marker is 20 pixels wide by 32 pixels tall.
			new google.maps.Size(20, 34),
			// The origin for this image is 0,0.
			new google.maps.Point(0,0),
			// The anchor for this image is the base of the flagpole at 0,32.
			new google.maps.Point(9, 33));
			var shadow = new google.maps.MarkerImage(asset_url+'icons/shadow.png',
			// The shadow image is larger in the horizontal dimension
			// while the position and offset are the same as for the main image.
			new google.maps.Size(28, 22),
			new google.maps.Point(0,0),
			new google.maps.Point(1, 22));
	
	
			var resultLat = localSearch.results[0].lat;
			var resultLng = localSearch.results[0].lng;
			var point = new google.maps.LatLng(resultLat,resultLng);
			
			map.setCenter(point);
			
			if (document.getElementById("rb_placedistancemarker1").checked==true)
			{
				clickatpoint(point);
			}
			else
			{
				var marker = new google.maps.Marker({position:point,map:map,shadow:shadow,icon:image,title:address});
				
				var infowindow = new google.maps.InfoWindow(
				{           
						content: "<div><font size='2' face='Verdana' color='#000099'>lat "
							+ resultLat + "</font></div><div><font size='2' face='Verdana' color='#000099'>lng "
							+ resultLng + "</font></div><div><font size='2' face='Verdana' color='#FF0000'>address:"
							+ address + "</font></div>"
				});
							
				infowindow.open(map, marker);
				google.maps.event.addListener(marker, 'click', function() {
					//infowindow.open(map, marker);
					infowindow.close();
					marker.setMap(null);
				});
			}

			document.getElementById("btn_go").value="Found";
		}
		else
		{
			document.getElementById("btn_go").value="Not Found";
		}
	});	
	localSearch.execute(address);
}


//***********************************************************************
function placeMarker(location,number) 
{
	var image = new google.maps.MarkerImage('http://www.daftlogic.com/images/gmmarkersv3/stripes.png',
	// This marker is 20 pixels wide by 32 pixels tall.
	new google.maps.Size(20, 34),
	// The origin for this image is 0,0.
	new google.maps.Point(0,0),
	// The anchor for this image is the base of the flagpole at 0,32.
	new google.maps.Point(9, 33));
	var shadow = new google.maps.MarkerImage('http://www.daftlogic.com/images/gmmarkersv3/shadow.png',
	// The shadow image is larger in the horizontal dimension
	// while the position and offset are the same as for the main image.
	new google.maps.Size(28, 22),
	new google.maps.Point(0,0),
	new google.maps.Point(1, 22));
	
  	var text="(" +(number) + ")" + location;
	
	var marker = new google.maps.Marker({position:location,map:map,shadow:shadow,icon:image,title:text,draggable:true});
	
	google.maps.event.addListener(marker, 'dragend', function(event)
	{
		routePoints[number-1]=event.latLng;
		//remove polyline
		routePath.setMap(null);
		//add new polyline
		routePath=getRoutePath();
		routePath.setMap(map);
		SaveCookieRoute();
		updateDisplay();
	});
	
	google.maps.event.addListener(marker, 'click', function()
	{
		//normal, insert new point at that point
		if (markerclickmode==0)
		{
			clickatpoint(location);
		}
		//delete the marker at that point
		if (markerclickmode==1)
		{
			
			
			//remove marker
			routeMarkers[number-1].setMap(null);

			//update arrays...
			routePoints.splice((number-1),1);


			routeMarkers=new Array(0);
			//recreate routeMarkers
			if (routePoints) 
			{
				var count=1;
				for (i in routePoints) 
				{
					var marker=placeMarker(i,count);
					routeMarkers.push(marker);
					count++;
				}
			}



			//remove old polyline first
			if (!(routePath==undefined))
			{
				routePath.setMap(null);
			}
			
			//add new polyline
			routePath=null;
			routePath=getRoutePath();
			routePath.setMap(map);
				
			updateDisplay();
			SaveCookieRoute();
			
			deletepoint_post();
		}
	});
	
	return marker;
}

function toggledistanceEnable (state)
{
  console.log(state);
	distanceEnable=state;
	if (state){
		$(".custombutton").removeAttr("disabled");
	}else{
		$(".custombutton").attr("disabled",true);
	}
	SavePosandSettings();
}
function autopantoggle(state)
{
	autopan=state;
	SavePosandSettings();
}
function updateDisplay()
{
	var total_distance_m=1000*routePath.inKm();		
	var dist=unit_handler.f(total_distance_m);
	document.getElementById("distance_new").value=dist.toFixed(3);
}
function toggleUnits(arg)
{
	if(arg=="MILES")
	unit_handler=MILES;
	if(arg=="KMS")
	unit_handler=KMS;
	if(arg=="NMILES")
	unit_handler=NMILES;
	if(arg=="FEET")
	unit_handler=FEET;
	if(arg=="METRES")
	unit_handler=METRES;
	
	updateDisplay();
	SavePosandSettings();
}

function togglemarkersbtn()
{
	//If they are on
	if (togglemarkers==1)
	{
		togglemarkers=0;
		if (routeMarkers) 
		{
			for (i in routeMarkers) 
			{
				routeMarkers[i].setMap(null)
			}
		}
	}
	else
	//If thety are off
	{
		togglemarkers=1;
		if (routeMarkers) 
		{
			for (i in routeMarkers) 
			{
				routeMarkers[i].setMap(map);
			}
		}
	}
	SavePosandSettings();
}

function disHalf()
{
	//not used	
}

function ZoomOut()
{
	//map.setZoom(map.getBoundsZoomLevel(bounds)-1);
	//var clat = (bounds.getNorthEast().lat() + bounds.getSouthWest().lat()) /2;
	//var clng = (bounds.getNorthEast().lng() + bounds.getSouthWest().lng()) /2;
	//map.setCenter(new new google.maps.LatLng(clat,clng));
	
	// map: an instance of GMap3
	// latlng: an array of instances of new google.maps.LatLng
	var latlngbounds = new google.maps.LatLngBounds();
	
	if (routePoints) 
	{
		for (i in routePoints) 
		{
			latlngbounds.extend(routePoints[i]);
		}
	}
	
	map.setCenter(latlngbounds.getCenter());
	map.fitBounds(latlngbounds);
	SavePosandSettings();
}

function clearLastLeg()
{
	if(routePoints.length<2)
	return;

	//remove last marker
	routeMarkers[routeMarkers.length-1].setMap(null);
	
	//remove last ployline segment...
	//remove old polyline first
	if (!(routePath==undefined))
	{
		routePath.setMap(null);
	}
	
	routePoints.pop();
	routeMarkers.pop();
	
	// new polyline
	routePath=getRoutePath();
	routePath.setMap(map);
		
	updateDisplay();
	SaveCookieRoute();
}

function SavePosandSettings()
{
	
	var mapzoom=map.getZoom();
	
	var mapcenter=map.getCenter();
	var maplat=mapcenter.lat();
	var maplng=mapcenter.lng();
	
	var cMT=map.getMapTypeId();

	var MT="";
	if (cMT=="roadmap")
	{
		MT=0;	
	}
	if (cMT=="satellite")
	{
		MT=1;	
	}
	if (cMT=="hybrid")
	{
		MT=2;	
	}
	if (cMT=="terrain")
	{
		MT=3;	
	}

	var cookiestring=maplat+"_"+maplng+"_"+mapzoom+"_"+toggleGoogleBar+"_"+togglemarkers+"_"+MT;

	var exp = new Date();     //set new date object
	exp.setTime(exp.getTime() + (1000 * 60 * 60 * 24 * 40));     //set it 40 days ahead
	
	setCookie("DaftLogicGMDCv2",cookiestring, exp);
}


function LoadPosandSettings()
{
	var loadedstring=getCookie("DaftLogicGMDCv2");
	if (loadedstring!="")
	{
		var splitstr;
		splitstr=loadedstring.split("_");

		if ((parseFloat(splitstr[0])!=0)&&(parseFloat(splitstr[1])!=0))
		{
			var point=new google.maps.LatLng(parseFloat(splitstr[0]), parseFloat(splitstr[1]));
			map.panTo(point);
		}
		map.setZoom(parseFloat(splitstr[2]));
	
		toggleGoogleBar=splitstr[3];
		togglemarkers=splitstr[4];
			
			
		if (togglemarkers=="1")
		{
			if (routeMarkers) 
			{
				for (i in routeMarkers) 
				{
					routeMarkers[i].setMap(map);
				}
			}
		}
		else
		{
			if (routeMarkers) 
			{
				for (i in routeMarkers) 
				{
					routeMarkers[i].setMap(null);
				}
			}	
		}
			
			
		//if (toggleGoogleBar==1)
		//{
			//document.getElementById("cb_googlebar").checked=true;
			//map.enableGoogleBar();
		//} 
		//else
		//{
			//document.getElementById("cb_googlebar").checked=false;
			//map.disableGoogleBar();	
		//}
		
		if (splitstr[5] != "")
		{
			if (splitstr[5]==0)
			{
				map.setMapTypeId("roadmap");
			}
			if (splitstr[5]==1)
			{
				map.setMapTypeId("satellite");
			}
			if (splitstr[5]==2)
			{
				map.setMapTypeId("hybrid");	
			}
			if (splitstr[5]==3)
			{
				map.setMapTypeId("terrain");
			}
		}
	}
}

function setCookie(name, value, expires) 
{
	document.cookie = name + "=" + escape(value) + "; path=/" + ((expires == null) ? "" : "; expires=" + expires.toGMTString());
}

function getCookie(c_name)
{
	if (document.cookie.length>0)
  	{
  		c_start=document.cookie.indexOf(c_name + "=");
  		if (c_start!=-1)
    	{ 
    		c_start=c_start + c_name.length+1; 
    		c_end=document.cookie.indexOf(";",c_start);
    		if (c_end==-1) c_end=document.cookie.length;
    		return unescape(document.cookie.substring(c_start,c_end));
    	} 
  	}
	return "";
}

function SaveCookieRoute()
{
if (typeof(frmEditPath) !='undefined' ) $("#points").val("");
	var cookiestring="";
	for(var j=0;j<routePoints.length;++j)
	{
		if (j>0)
		{
			cookiestring+="|";
		}
		var lattosave=routePoints[j].lat();
		var longtosave=routePoints[j].lng();
		cookiestring+=lattosave+","+longtosave;
	}
if (typeof(frmEditPath) !='undefined' ) $("#points").val(cookiestring);
if (typeof(frmDrawPath) !='undefined' ) $("#pointString").val(cookiestring);


	//var exp = new Date();     //set new date object
	//exp.setTime(exp.getTime() + (1000 * 60 * 60 * 24 * 40));     //set it 40 days ahead
	//setCookie("DaftLogicGMDCRoutev2",cookiestring, exp);
}

function LoadCookieRoute()
{
	var loadedstring=getCookie("DaftLogicGMDCRoutev2");
	
	if (loadedstring!="")
	{

		var pointsplit;
		var splitstr= loadedstring.split("|");
		for(i = 0; i < splitstr.length; i++)
		{
			pointsplit=splitstr[i].split(",");
			var point=new google.maps.LatLng(parseFloat(pointsplit[0]), parseFloat(pointsplit[1]));
			
			routePoints.push(point);
		
			var marker=placeMarker(point,routePoints.length);
			routeMarkers.push(marker);
			if (togglemarkers!=1)
			{
				//now remove it!
				marker.setMap(null);
			}
		}
		
		//add polyline
		routePath=getRoutePath();
		routePath.setMap(map);


		if (autopan==true)
		{
			map.panTo(point);
		}
		updateDisplay();
	}
}
function LoadCookieRouteValue(loadedstring)
{
	if (loadedstring!="")
	{

		var pointsplit;
		var splitstr= loadedstring.split("|");
		for(i = 0; i < splitstr.length; i++)
		{
			pointsplit=splitstr[i].split(",");
			var point=new google.maps.LatLng(parseFloat(pointsplit[0]), parseFloat(pointsplit[1]));
			
			routePoints.push(point);
		
			var marker=placeMarker(point,routePoints.length);
			routeMarkers.push(marker);
			if (togglemarkers!=1)
			{
				//now remove it!
				marker.setMap(null);
			}
		}
		
		//add polyline
		routePath=getRoutePath();
		routePath.setMap(map);


		if (autopan==true)
		{
			map.panTo(point);
		}
		updateDisplay();
	}

}


// google.maps.LatLng.prototype.kmTo = function(a)
// {
// 	var e = Math, ra = e.PI/180;
// 	var b = this.lat() * ra, c = a.lat() * ra, d = b - c;
// 	var g = this.lng() * ra - a.lng() * ra;
// 	var f = 2 * e.asin(e.sqrt(e.pow(e.sin(d/2), 2) + e.cos(b) * e.cos(c) * e.pow(e.sin(g/2), 2)));
// 	return f * 6378.137;
// };

// google.maps.Polyline.prototype.inKm = function(n)
// {
// 	var a = this.getPath(n), len = a.getLength(), dist = 0;
// 	for(var i=0; i<len-1; i++)
// 	{
//   		dist += a.getAt(i).kmTo(a.getAt(i+1));
// 	}
// 	return dist;
// };

function submitenter(myfield,e)
{
	var keycode;
	if (window.event) keycode = window.event.keyCode;
	else if (e) keycode = e.which;
	else return true;
	
	if (keycode == 13)
	{
		ftn_quickfind(document.getElementById('goto').value);
		document.getElementById("goto").focus();
		document.getElementById("goto").select();
		return false;
	}
	else
	{
	   return true;
	}
}

