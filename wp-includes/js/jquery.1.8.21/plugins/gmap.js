var GeocoderStatusDescription = {
	"OK": "The request did not encounter any errors",
	"UNKNOWN_ERROR": "A geocoding or directions request could not be successfully processed, yet the exact reason for the failure is not known",
	"OVER_QUERY_LIMIT": "The webpage has gone over the requests limit in too short a period of time",
	"REQUEST_DENIED": "The webpage is not allowed to use the geocoder for some reason",
	"INVALID_REQUEST": "This request was invalid",
	"ZERO_RESULTS": "The request did not encounter any errors but returns zero results",
	"ERROR": "There was a problem contacting the Google servers"
};

var map, geocoder, 
	markers = [],
	markersArray = [];
$(function() {
	if ( $("#map_canvas").length ) {
		var script = document.createElement("script");
		script.type = "text/javascript";
		script.src = "http://maps.googleapis.com/maps/api/js?key=AIzaSyB6b9ZrB6-Sla34kfflhuB7b4CL58Tzw0g&sensor=false&callback=initialize";
		document.body.appendChild(script);
	} else if ($("#show-google-map").length) {
        var script = document.createElement("script");
        script.type = "text/javascript";
        script.src = "http://maps.googleapis.com/maps/api/js?key=AIzaSyB6b9ZrB6-Sla34kfflhuB7b4CL58Tzw0g&sensor=false&callback=initialize_show";
        document.body.appendChild(script);
    }
});

function initialize () {
    var x, y, z;
    x = 40.181005; y = 44.516044; z = 14;
	
	var coord = $("#coordinates");
	if (coord.length && coord.val() != '') {
		coord = coord.val();
		var arr = coord.split(" ");
        x = arr[0]; y = arr[1]; z = parseInt(arr[2]);
		var place_marker = true;
	}
	
	var myOptions = {
		center: new google.maps.LatLng(x,y),
		zoom: z,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	map = new google.maps.Map(document.getElementById("map_canvas"),
		myOptions);

    google.maps.event.addListener(map, 'click', function(event) {
        placeMarker(event.latLng);
    });
    geocoder = new google.maps.Geocoder();
	
	if (place_marker) {
		placeMarker(new google.maps.LatLng(x,y));
	}
	
}
function initialize_show() {
    var coord = $("#show-google-map").data('coord');
    if (coord) {
        var arr = coord.split(" ");
        x = arr[0]; y = arr[1]; z = parseInt(arr[2]);

        var myOptions = {
            center: new google.maps.LatLng(x,y),
            zoom: z,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        map = new google.maps.Map(document.getElementById("show-google-map"),
            myOptions);
        placeMarker(new google.maps.LatLng(x,y));
    }
}
function searchLocation(region,location) {
	var request = {
		address: region + ", " + location,
		region: "AM"
	};
	geocoder.geocode(request, showResults);
}
function showResults(results, status) {
	if (results && status == google.maps.GeocoderStatus.OK) {
		console.log(GeocoderStatusDescription[status]);
		map.fitBounds(results[0].geometry.viewport);		
	}
}

function placeMarker(location) {
	var marker = new google.maps.Marker({
		position: location,
		map: map
	});
	deleteOverlays();
	markersArray.push(marker);
	var str = marker.position.lat() + ' ' + marker.position.lng() + ' ' + map.getZoom();
	$("#coordinates").val(str);
}
function deleteOverlays() {
    if (markersArray) {
    	for (i in markersArray) {
    	  	markersArray[i].setMap(null);
      	}
      	markersArray.length = 0;
    }
}