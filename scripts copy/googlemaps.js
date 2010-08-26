//<![CDATA[ 

/*
* GMaps_load: Load map structure.
*/
var map;
function GMaps_load() {
	if (GBrowserIsCompatible()) {
		map = new GMap2(document.getElementById('map'));
		map.addControl(new GSmallMapControl());
	}
}

/*
* GMaps_showAddress: Send a request to google with a formated address ("Street Number" Street, City, State)
* and receive the latitude and longitude of this address. It needs a callback function since it uses AJAX.
*/
function Gmaps_showAddress(address, html, debug) {
	var geocoder = new GClientGeocoder();
	geocoder.getLatLng(address, function(point) { GMaps_displayMarker(point, address, html, debug) });
}

/*
* GMaps_getMarker: retrieve a marker. Type can be normal (red) or highlighted (yellow).
*/
function GMaps_getMarker(point, type) {
	var icon     = new GIcon();
	var img_path = document.getElementById('gm_image_path').value;

	if(type == 'normal')
		icon.image = img_path+'/icon_gm_marker_red.png';
	else if(type == 'highlighted')
		icon.image = img_path+'/icon_gm_marker_yellow.png';

	icon.shadow           = img_path+'/icon_gm_marker_red_shadow.png';
	icon.iconSize         = new GSize(12, 20);
	icon.shadowSize       = new GSize(22, 20);
	icon.iconAnchor       = new GPoint(6, 20);
	icon.infoWindowAnchor = new GPoint(5, 1);

	return new GMarker(point, icon);
}

/*
* GMaps_displayMarker: Add marker to the map.
*/
function GMaps_displayMarker(point, address, html, debug){
	if (!point) {
		/* address not found => hide map and show message */
		div_map       = document.getElementById('map');
		div_map_error = document.getElementById('map_error');
		div_map.style.display = "none";
		if (debug == "on") {
			alert("GMap point not found for this address");
		}
		div_map_error.style.display = "block";
		div_map_error.innerHTML = "<p class=\"errorMessage\">"+showText(LANG_JS_GOOGLEMAPS_NOTAVAILABLE_ADDRESS)+"</p>";
	} else {
		map.setCenter(point, 17);
		marker = GMaps_getMarker(point, 'normal');
		if (html) {
			GEvent.addListener(marker, 'mouseover', function() { GMaps_showMouseOver(html) } );
			GEvent.addListener(marker, 'mouseout', function() { GMaps_showMouseOut() } );
		}
		map.addOverlay(marker);
	}
}

/*
* GMaps_showMouseOver: Action performed when mouse is over the observed marker.
*/
function GMaps_showMouseOver (html){
	GMaps_enablePopupLayer(html);
}

/*
* GMaps_showMouseOut: Action performed when mouse was over and move out the observed marker.
*/
function GMaps_showMouseOut (){
	GMaps_disablePopupLayer();
}

document.onmousemove = GMaps_captureMousePosition;
var xMousePos = 0; // Horizontal position of the mouse on the screen
var yMousePos = 0; // Vertical position of the mouse on the screen

/*
* GMaps_captureMousePosition: Retrieve x and y coordinates for actual mouse position.
*/
function GMaps_captureMousePosition(e) {
	if (document.layers) { // Netscape 4 but honestly who cares at this point
		xMousePos = e.pageX;
		yMousePos = e.pageY;
	} else if (document.all) { // IE
		xMousePos = window.event.clientX+document.body.scrollLeft;
		yMousePos = window.event.clientY+document.body.scrollTop;
	} else if (document.getElementById) { // Netscape Mozilla
		xMousePos = e.pageX;
		yMousePos = e.pageY;
	}
}

/*
* GMaps_enablePopupLayer: Display a pop up div over mouse position.
*/
function GMaps_enablePopupLayer(html){
	var float_layer = document.getElementById('float_layer');
	float_layer.style.visibility = 'visible';
	//float_layer.style.left = (xMousePos - (float_layer.offsetWidth+250));
	//float_layer.style.top = (yMousePos - (float_layer.offsetHeight+250));
	float_layer.innerHTML = html;
}

/*
* GMaps_disablePopupLayer: Hide the pop up div.
*/
function GMaps_disablePopupLayer(){
	var float_layer = document.getElementById('float_layer');
	float_layer.style.visibility = 'hidden';
	float_layer.innerHTML = '';
}

//]]>