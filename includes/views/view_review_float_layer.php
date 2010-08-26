<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/views/view_review_float_layer.php
	# ----------------------------------------------------------------------------------------------------

?>

<script type="text/javascript">

	document.onmousemove = captureMousePosition;
	var xMousePos = 0; // Horizontal position of the mouse on the screen
	var yMousePos = 0; // Vertical position of the mouse on the screen

	function captureMousePosition(e) {
		if (document.layers) { // Netscape 4 but honestly who cares at this point
			xMousePos = e.pageX;
			yMousePos = e.pageY;
		} else if (document.all) { // IE
			xMousePos = window.event.x+document.body.scrollLeft;
			yMousePos = window.event.y+document.body.scrollTop;
		} else if (document.getElementById) { // Netscape Mozilla
			xMousePos = e.pageX;
			yMousePos = e.pageY;
		}
	}

	function enablePopupLayer(comment, listing_title){
		var float_layer = document.getElementById("float_layer");
		float_layer.style.visibility = 'visible';
		float_layer.style.left = (xMousePos + 5)+"px";
		float_layer.style.top = (yMousePos + 5)+"px";
		//float_layer.style.left = 0;
		//float_layer.style.top = 0;
		float_layer.innerHTML = ''
								+'<h3>'+listing_title+'</h3>'
								+'<p><strong><?=system_showText(LANG_REVIEW);?>: </strong></p>'
								+'<p>'+comment+'</p>'
								+'';
	}

	function disablePopupLayer(){
		var float_layer = document.getElementById("float_layer");
		float_layer.style.visibility = 'hidden';
		float_layer.innerHTML = '';
	}

</script>

<style>

div.floatLayer {width: 200px; position: absolute; /*top: 0; left: 0;*/ visibility: hidden; background-color: #FFF; border: 2px solid #EEE; height:auto; padding:0 0 3px 0;}

	div.floatLayer * {margin: 0; padding: 0;}

		div.floatLayer h3 {font: bold 12px Verdana, Arial, Helvetica, sans-serif; color: #003F7E; text-align: left; padding:3px;}

		div.floatLayer p {font: normal 10px Verdana, Arial, Helvetica, sans-serif; color: #000; text-align: left; margin: 0; padding: 3px;}

</style>

<div id="float_layer" class="floatLayer"></div>