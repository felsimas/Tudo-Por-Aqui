<?
	# ----------------------------------------------------------------------------------------------------
	# * FILE: /location.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("./conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	header("Content-Type: text/xml; charset=".EDIR_CHARSET);

	if($_GET["estado_id"]) {
		$stateObj= new LocationState();
		$stateObj->SetString("estado_id",$_GET["estado_id"]);
		$selected_states    = $stateObj->retrieveStatesByCountry();
	}

	if($_GET["cidade_id"]) {
		$regionObj= new LocationRegion();
		$regionObj->SetString("cidade_id",$_GET["cidade_id"]);
		$selected_regions   = $regionObj->retrieveRegionsByState();
	}

	if($_GET["bairro_id"]) {
		$cityObj= new LocationCity();
		$cityObj->SetString("bairro_id",$_GET["bairro_id"]);
		$selected_cities    = $cityObj->retrieveCitiesByRegion();
	}

	if($_GET["city_id"]) {
		$areaObj= new LocationArea();
		$areaObj->SetString("city_id",$_GET["city_id"]);
		$selected_areas     = $areaObj->retrieveAreasByCity();
	}

	$selected_country = ($_GET["estado_id"]) ? new LocationCountry($_GET["estado_id"]) : FALSE;
	$selected_state   = ($_GET["cidade_id"])   ? new LocationState($_GET["cidade_id"])     : FALSE;
	$selected_region  = ($_GET["bairro_id"])  ? new LocationRegion($_GET["bairro_id"])   : FALSE;
	$selected_city    = ($_GET["city_id"])    ? new LocationCity($_GET["city_id"])       : FALSE;
	$selected_area    = ($_GET["area_id"])    ? new LocationArea($_GET["area_id"])       : FALSE;

	$return = "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n";
	$return .= "<response>\n";

	if ($selected_states) {
		foreach ($selected_states as $each_state) {
			$return .= "<id>{$each_state["id"]}</id>\n";
			$return .= "<name>".htmlspecialchars($each_state["name"])."</name>\n";
			if ($_GET["searchpage"] != 1) $return .= "<obj_name>cidade_id</obj_name>\n";
			else $return .= "<obj_name>search_state</obj_name>\n";
		}
	}

	if ($selected_regions) {
		foreach ($selected_regions as $each_region) {
			$return .= "<id>{$each_region["id"]}</id>\n";
			$return .= "<name>".htmlspecialchars($each_region["name"])."</name>\n";
			if ($_GET["searchpage"] != 1) $return .= "<obj_name>bairro_id</obj_name>\n";
			else $return .= "<obj_name>search_region</obj_name>\n";
		}
	}

	$return .= "</response>\n";

	echo $return;

?>
