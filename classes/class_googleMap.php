<?php
    class GoogleMap {
        var $divName;
        var $googleMapKey;
        var $cssClass;
        var $address = array();
        var $numbered = true;

        /**
        * constructor
        */
        function GoogleMap() { }

        /**
        * atributes gets and sets
        */
        function getDivName() { return $this->divName; }
        function setDivName($divNameIn) { $this->divName = $divNameIn; }

        function getGoogleMapKey() { return $this->googleMapKey; }
        function setGoogleMapKey($googleMapKeyIn) { $this->googleMapKey = $googleMapKeyIn; }

        function getCssClass() { return $this->cssClass; }
        function setCssClass($cssClassIn) { $this->cssClass = $cssClassIn; }

        function getNumbered() { return $this->numbered; }
        function setNumbered($numberedIn) { $this->numbered = $numberedIn; }

        /**
        * getMapCode
        */
        function getMapCode() {

            $hasAddress = false;
            foreach($this->address as $each_address)
                if ((strlen(trim($each_address['address1'])) > 0) || (strlen(trim($each_address['state'])) > 0) || (strlen(trim($each_address['city'])) > 0) || (strlen(trim($each_address['zip'])) > 0)) $hasAddress = true;

            $returnCode  = "    <script type='text/javascript' src='http://www.google.com/jsapi?key=" . $this->googleMapKey . "'></script>";
            $returnCode .= "    <script type='text/javascript'>";

            $returnCode .= "    var gmarkers = [];";

            $returnCode .= "    function myclick(i) {";
            $returnCode .= "        if(gmarkers[i]) { GEvent.trigger(gmarkers[i], 'click'); } ";
            $returnCode .= "    }";

            $returnCode .= "    function importanceOrder(marker, b) {";
            $returnCode .= "        return marker.importance * -1;";
            $returnCode .= "    }";

            $returnCode .= "    function createMarker(point, number, html) {";
            /* icon */
            $returnCode .= "        var icon = new GIcon(G_DEFAULT_ICON);";
            $returnCode .= "        if(number > 0 && number <= 10 && " . ((!$this->numbered) ? "false" : "true") . ") {";
            $returnCode .= "            icon.image = '".DEFAULT_URL."/images/markers/marker_'+number+'.png';";
            $returnCode .= "        } else {";
            $returnCode .= "            icon.image = '".DEFAULT_URL."/images/markers/marker.png';";
            $returnCode .= "        }";
            $returnCode .= "        icon.shadow = '".DEFAULT_URL."/images/markers/shadow.png';";
            $returnCode .= "        icon.iconSize = new GSize(24.0, 29.0);";
            $returnCode .= "        icon.shadowSize = new GSize(39.0, 29.0);";
            $returnCode .= "        icon.iconAnchor = new GPoint(10.0, 29.0);";
            $returnCode .= "        icon.infoWindowAnchor = new GPoint(12.0, 14.0);";
            /* marker */
            $returnCode .= "        var marker = new google.maps.Marker(point, {icon:icon, zIndexProcess:importanceOrder});";
            $returnCode .= "        GEvent.addListener(marker, 'click', function() { marker.openInfoWindowHtml(html); });";
            $returnCode .= "        gmarkers[number] = marker;";
            $returnCode .= "        return marker;";
            $returnCode .= "    }";

            $returnCode .= "    google.load('maps', '2.x');";
            $returnCode .= "    function initialize() {";
            $returnCode .= "        var geo = new GClientGeocoder();";
            $returnCode .= "        var map = new google.maps.Map2(document.getElementById('" . $this->divName . "'));";
            $returnCode .= "        map.addControl(new GSmallMapControl());";
            $returnCode .= "        map.addControl(new GScaleControl());";
            $returnCode .= "        map.setCenter(new GLatLng(0,0),1);";
            $returnCode .= "        var bounds = new GLatLngBounds();";

            // add all Address in Map
            $pointCount = 0;
            if($hasAddress) {
                foreach($this->address as $each_address) {

                        if(strlen(trim($each_address['optionalLatLng'])) == 0) {
							if ((strlen(trim($each_address['address1'])) > 0) && (strlen(trim($each_address['zipcode'])) > 0)) {
								$returnCode .= "        geo.getLatLng('" . $each_address['address1'] . ", " . $each_address['city'] . ", " . $each_address['zipcode'] . "', function(point) {";
							} elseif (strlen(trim($each_address['address1'])) > 0) {
								$returnCode .= "        geo.getLatLng('" . $each_address['address1'] . ", " . $each_address['city'] . ", " . $each_address['state'] . "', function(point) {";
							} else {
								$returnCode .= "        geo.getLatLng('" . $each_address['city'] . ", " . $each_address['state'] . "', function(point) {";
							}
                        } else {
                            $returnCode .= "          var point = new GLatLng(". $each_address['optionalLatLng'] . ");";
                        }

                        $returnCode .= "            if(point) {";
                        $returnCode .= "                var marker = createMarker(point, ".($pointCount+1).", \"".$each_address['optionalHtml']."\");";
                        $returnCode .= "                marker.importance = ".($pointCount+1).";";
                        $returnCode .= "                map.addOverlay(marker);";
                        $returnCode .= "                bounds.extend(point);";
                        $pointCount++;

                        /* dynamically selecting zoom and center point */
                        if($pointCount == count($this->address)) {
                            $returnCode .= "                map.setZoom(15);";
                            $returnCode .= "                map.setCenter(bounds.getCenter());";
                        }

                        $returnCode .= "            }";
                        if(strlen(trim($each_address['optionalLatLng'])) == 0) {
                            $returnCode .= "        });";
                        }

                }
            }

            $returnCode .= "    }";
            $returnCode .= "    google.setOnLoadCallback(initialize);";
            $returnCode .= "</script>";

            return $returnCode;
        }
        
        /**
        * function addAddress
        */
        function addAddress($address1In, $address2In, $countryIn, $stateIn, $cityIn, $zipcodeIn, $optionalLatLngIn = "", $optionalHtmlIn = "") {
            $this->address[] = array("address1"         => $address1In,
                                     "address2"         => $address2In,
                                     "country"          => $countryIn,
                                     "state"            => $stateIn,
                                     "city"             => $cityIn,
                                     "zipcode"          => $zipcodeIn,
                                     "optionalLatLng"   => $optionalLatLngIn,
                                     "optionalHtml"     => $optionalHtmlIn);
        }

        /**
        * function clearAddress
        */
        function clearAddress() {
            $this->address = array();
            $this->showHTML = array();
        }
    }
?>