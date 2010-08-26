<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/code/maptuning.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		$itemObj->setMapTuning($_POST["latitude_longitude"]);
		$message = system_showText(LANG_MSG_MAPTUNING_SUCCESSFULLY_UPDATED);
		header("Location: $url_redirect/".(($search_page) ? "search.php" : "index.php")."?message=".urlencode($message)."&screen=$screen&letra=$letra".(($url_search_params) ? "&$url_search_params" : ""));
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# GOOGLE MAPS
	# ----------------------------------------------------------------------------------------------------

	$googlemaps_message = "";
	$googlemaps_code = "";

	$googleSettingObj = new GoogleSettings(GOOGLE_MAPS_SETTING);
	if ($googleSettingObj->getString("value")) {

		/* harcoded key for demodirectory.com */
		if (strpos($_SERVER["HTTP_HOST"], "demodirectory.com") !== false) {
			$googleMapsKey = "ABQIAAAAzBsMWWByBSsWTSual3t_ZBS9W_AcxD5pOPBvEQtLLXj7tzVfJhRvFBYeB717ZkVHSM2PnzhPCIDChQ";
		}

		$latitude_longitude = $itemObj->getString("maptuning");
		$google_city = $itemObj->getLocationString("r", true);
		$google_location = "";
		if ($itemObj->getString("address") && $itemObj->getString("zip_code")) {
			$google_location = $itemObj->getLocationString("A, r, z", true);
		} else {
			$google_location = $itemObj->getLocationString("A, r, s", true);
		}

		$googleMapCode = "";
		$googleMapCode .= "map.setCenter(myPoint, 17);\n";
		$googleMapCode .= "var marker = new GMarker(myPoint, {draggable: true});\n";
		$googleMapCode .= "GEvent.addListener(marker, 'dragend', function() {\n";
		$googleMapCode .= "		var latitude_longitude = marker.getPoint()\n";
		$googleMapCode .= "		document.getElementById('myLatitudeLongitude').value = latitude_longitude.lat() + ', ' + latitude_longitude.lng(); \n";
		$googleMapCode .= "});";
		$googleMapCode .= "map.addOverlay(marker);\n";

		$googlemaps_code .= "
			<script src=\"http://maps.google.com/maps?file=api&amp;v=2&amp;key=".(($googleMapsKey) ? $googleMapsKey : $googleSettingObj->getString("value"))."\" type=\"text/javascript\"></script>\n
			<input type=\"hidden\" id=\"gm_image_path\" value=\"".DEFAULT_URL."/images\" />\n
			<script type=\"text/javascript\">\n
				var map      = null;\n
				var geocoder = null;\n
				var myPoint  = null;\n
				function loadMap() {\n
					if (GBrowserIsCompatible()) {\n
						map = new GMap2(document.getElementById(\"map\"));\n
						map.addControl(new GLargeMapControl());\n
		";
		if ($latitude_longitude) {
			$googlemaps_code .= "
							myPoint = new GLatLng(".$latitude_longitude.");\n
							".$googleMapCode."
			";
		} else {
			$googlemaps_code .= "
							geocoder = new GClientGeocoder();\n
							geocoder.getLatLng('".addslashes($google_location)."',\n
								function(myPoint) {\n
									if (!myPoint) {\n
										geocoder.getLatLng('".addslashes($google_city)."',\n
											function(myPoint) {\n
												if (!myPoint) {\n
													alert(\"".system_showText(LANG_SITEMGR_MAPTUNING_ADDRESSNOTFOUND)."\\n".system_showText(LANG_SITEMGR_MAPTUNING_PLEASEEDITYOURITEM)."\");\n
												} else {\n
													".$googleMapCode."
												}\n
											}\n
										)\n
									} else {\n
										".$googleMapCode."
									}\n
								}\n
							)\n
			";
		}
		$googlemaps_code .= "
					}\n
				}\n
				window.onload = loadMap;\n
				window.onunload = GUnload;\n
			</script>\n
		";

	} else {
		$googlemaps_message = "<p class=\"warning\">".system_showText(LANG_SITEMGR_MAPTUNING_GOOGLEMAPSARENOTAVAIBLE)."<br>".system_showText(LANG_SITEMGR_MAPTUNING_PLEASECONTACTADMIN)."</p>";
	}

?>
