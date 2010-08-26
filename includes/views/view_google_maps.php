<?
	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/views/view_google_maps.php
	# ----------------------------------------------------------------------------------------------------

	$google_maps = "";

	# ----------------------------------------------------------------------------------------------------
	# * VALIDATION
	# ----------------------------------------------------------------------------------------------------

	$googleSettingObj = new GoogleSettings(GOOGLE_MAPS_SETTING);
	if ($googleSettingObj->getString("value")) {

		/* harcoded key for demodirectory.com */
		if (DEMO_LIVE_MODE) {
		//	$googleMapsKey = "ABQIAAAAzBsMWWByBSsWTSual3t_ZBS9W_AcxD5pOPBvEQtLLXj7tzVfJhRvFBYeB717ZkVHSM2PnzhPCIDChQ";
		} else {
            $googleMapsKey = ($googleSettingObj->getString("value"));
        }

        $img_html = "";
        $imageObj = new Image($google_image_id);
        if ($imageObj->imageExists()) {
            $img_tag = $imageObj->getTag(true, GOOGLE_MAPS_IMAGE_WIDTH, GOOGLE_MAPS_IMAGE_HEIGHT, $google_title);
            $img_html .= "";
            $img_html .= $img_tag;
            $img_html .= "";
            
            $img_html = str_replace('"', "'", $img_html);
        }

        
        $html = "";
        if ($show_html) {
            $html .= "<div class='viewMapInfo'>";
            $html .= "";
            if ($img_html) {
           //     $html .= $img_html;
            }
            $html .= "";
            $html .= "<div class='titulonomapa'>";
            $html .= $google_title;
            $html .= "</div>";
            $html .= "<p>";
            $html .= $google_phone;
            $html .= "<br />";
            $html .= "";
            $html .= $google_address.(($google_address2) ? "<br />".$google_address2 : "");
            $html .= "<br />";
            $html .= "";
            $html .= $google_location;
            $html .= "</p>";
            $html .= "";
            $html .= "</div>";
            $html .= "<br class='clear' />";
             $html="";
        }
        
        $googleMap = new GoogleMap();
        $googleMap->setGoogleMapKey($googleMapsKey);
        $googleMap->setNumbered(false);
        $googleMap->setDivName("map");
        $googleMap->setCssClass("googleBase");
        
		$googleMap->addAddress($google_address, $google_address2, $google_country, $google_state, $google_city, $google_zip, $google_maptuning, $html);
       	$imageObj2 = new Image($google_image_id);
	
 		$imgstr = $imageObj2->getImage();
		if ($imgstr == "".DEFAULT_URL."/custom/image_files/photo_0.0")
		{
			$imgstr = "".DEFAULT_URL."/images/markers/marker.png";
		}
		
		$google_maps = $imgstr;
       $google_maps = $googleMap->getMapCode($imgstr);
		//	$google_maps = $img_html;
	        

    }

?>
