<?php
    if($searchResults) {
        
        /* create objects */
        $googleMap = new GoogleMap();
        $googleSettings = new GoogleSettings(GOOGLE_MAPS_SETTING);

        /* settings */
        $googleMap->setDivName("resultsMap");
        $googleMap->setCssClass("googleBase");

		/* harcoded key for demodirectory.com */
		if (DEMO_LIVE_MODE) {
			$googleMapsKey = "ABQIAAAAzBsMWWByBSsWTSual3t_ZBS9W_AcxD5pOPBvEQtLLXj7tzVfJhRvFBYeB717ZkVHSM2PnzhPCIDChQ";
		}

        $googleMap->setGoogleMapKey((($googleMapsKey) ? $googleMapsKey : $googleSettings->getString("value")));

        /* address */
        foreach($searchResults as $eachResult) {
            if ((strlen(trim($eachResult->getLocationString("A", true))) > 0) || (strlen(trim($eachResult->getLocationString("s", true))) > 0) || (strlen(trim($eachResult->getLocationString("r", true))) > 0) || (strlen(trim($eachResult->getLocationString("z", true))) > 0)) {
                
                $html = '';
                if(strlen(trim($eachResult->getString("title"))) > 0) {

                    $html  = '<div>';

                    $image = new Image($eachResult->getNumber('thumb_id'));
                    if ($image->imageExists()) {
                        $html .=  "<img style='float:left; margin-right:15px;' width='". (IMAGE_LISTING_THUMB_WIDTH - 25) ."' heigth='". (IMAGE_LISTING_THUMB_HEIGHT - 25) ."'  src='" . IMAGE_URL . "/photo_". $image->getNumber('id') ."." . strtolower($image->getString('type')) . "' />";
                    }

                    if($promotions) {
                        $html .= '<strong>'.$promotionTitle[$eachResult->getNumber('id')].'</strong><br />';
                        $html .= '<i>'.system_showText(LANG_PROMOTION_OFFEREDBY).' '.$eachResult->getString("title").'</i><br />';
                    } else {
                        $html .= '<strong>'.$eachResult->getString("title").'</strong><br />';
                    }

                    $html .= $eachResult->getLocationString("A", true) . ', ' . $eachResult->getLocationString("r", true) . ', ' . $eachResult->getLocationString("s", true) . '<br />' . $eachResult->getLocationString("z", true);

                    $html .= "<br /><br /><a href='#" . $eachResult->getString('friendly_url') ."'>".system_showText(LANG_VIEWSUMMARY)."</a>";
                    
                    if(($eachResult->hasDetail() == 'y') && ((strpos($_SERVER["PHP_SELF"], "promotion/") == false))) {
                        if (MODREWRITE_FEATURE == "on") {
                            if(strpos($_SERVER["PHP_SELF"], LISTING_FEATURE_NAME     . '/') > 0) { $html .= " | <a href='" . LISTING_DEFAULT_URL       . "/" . $eachResult->getString('friendly_url') .".html'>".system_showText(LANG_VIEWDETAIL)."</a>"; }
                            else if(strpos($_SERVER["PHP_SELF"], EVENT_FEATURE_NAME       . '/') > 0) { $html .= " | <a href='" . EVENT_DEFAULT_URL         . "/" . $eachResult->getString('friendly_url') .".html'>".system_showText(LANG_VIEWDETAIL)."</a>"; }
                            else if(strpos($_SERVER["PHP_SELF"], CLASSIFIED_FEATURE_NAME  . '/') > 0) { $html .= " | <a href='" . CLASSIFIED_DEFAULT_URL    . "/" . $eachResult->getString('friendly_url') .".html'>".system_showText(LANG_VIEWDETAIL)."</a>"; }
                            else { $html .= " | <a href='" . LISTING_DEFAULT_URL       . "/" . $eachResult->getString('friendly_url') .".html'>".system_showText(LANG_VIEWDETAIL)."</a>"; }
                        } else {
                            if(strpos($_SERVER["PHP_SELF"], LISTING_FEATURE_NAME     . '/') > 0) { $html .= " | <a href='" . LISTING_DEFAULT_URL       . '/detail.php?id=' . $eachResult->getNumber('id') ."'>".system_showText(LANG_VIEWDETAIL)."</a>"; }
                            else if(strpos($_SERVER["PHP_SELF"], EVENT_FEATURE_NAME       . '/') > 0) { $html .= " | <a href='" . EVENT_DEFAULT_URL         . '/detail.php?id=' . $eachResult->getNumber('id') ."'>".system_showText(LANG_VIEWDETAIL)."</a>"; }
                            else if(strpos($_SERVER["PHP_SELF"], CLASSIFIED_FEATURE_NAME  . '/') > 0) { $html .= " | <a href='" . CLASSIFIED_DEFAULT_URL    . '/detail.php?id=' . $eachResult->getNumber('id') ."'>".system_showText(LANG_VIEWDETAIL)."</a>"; }
                            else { $html .= " | <a href='" . LISTING_DEFAULT_URL       . '/detail.php?id=' . $eachResult->getNumber('id') ."'>".system_showText(LANG_VIEWDETAIL)."</a>"; }
                        }
                    }
                    $html .= '</div>';
                }

                $googleMap->addAddress($eachResult->getLocationString("A", true),
                                       "",
                                       $eachResult->getLocationString("C", true),
                                       $eachResult->getLocationString("s", true),
                                       $eachResult->getLocationString("r", true),
                                       $eachResult->getLocationString("z", true),
                                       $eachResult->getLocationString("t", true), /* maptuning */
                                       $html
                                      );
            }
        }

        /* google map code */
        echo $googleMap->getMapCode();
    }
?>