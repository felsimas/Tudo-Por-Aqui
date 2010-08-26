<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /functions/zipproximity_funct.php
	# ----------------------------------------------------------------------------------------------------

	// ---------------------------------------------------------------------------------------------------- \\
	// PRIVATE FUNCTIONS                                                                                    \\
	// ---------------------------------------------------------------------------------------------------- \\

	function zipproximity_getZip5($zip, &$zip5) {

		$zip = trim($zip);
		$zip5 = "";

		if (($zip) && (strlen($zip) > 0)) {

			##################################################
			# United States ZipCode (US)
			##################################################
			if (ZIPCODE_US == "on") {
				if (ereg("(^[0-9])", substr($zip, 0, 1))) {
					while (ereg("(^[0-9])", substr($zip, 0, 1))) {
						$zip5 .= substr($zip, 0, 1);
						$zip = substr($zip, 1);
					}
					if (($zip5) && (strlen($zip5) > 0)) {
						if (strlen($zip5) > 5) {
							$zip5 = substr($zip5, 0, 5);
						}
						$zip5 = $zip5 + 0;
						if (($zip5) && ($zip5 > 0)) {
							while (strlen($zip5) < 5) {
								$zip5 = "0" . $zip5;
							}
							$zip5 = strtoupper($zip5);
							return true;
						}
					}
				}
			}
			##################################################

			##################################################
			# Canada ZipCode (CA)
			##################################################
			if (ZIPCODE_CA == "on") {
				if (ereg("(^[a-zA-Z])", substr($zip, 0, 1))) {
					if (!ereg("([\" \"]{1})", substr($zip, 3, 1))) {
						$zip = substr($zip, 0, 3)." ".substr($zip, 3);
					}
					if (!ereg("([0-9])", substr($zip, 4, 1))) {
						$zip = substr($zip, 0, 4).substr($zip, 5);
					}
					$zip5 = substr($zip, 0, 7);
					if (ereg("([a-zA-Z]{1})([0-9]{1})([a-zA-Z]{1})([\" \"]{1})([0-9]{1})([a-zA-Z]{1})([0-9]{1})", $zip5)) {
						$zip5 = strtoupper($zip5);
						return true;
					}
				}
			}
			##################################################

			##################################################
			# United Kingdom ZipCode (UK)
			##################################################
			if (ZIPCODE_UK == "on") {
				if (ereg("(^[0-9a-zA-Z])", substr($zip, 0, 1))) {
					while (ereg("(^[0-9a-zA-Z])", substr($zip, 0, 1))) {
						$zip5 .= substr($zip, 0, 1);
						$zip = substr($zip, 1);
					}
					if (($zip5) && (strlen($zip5) > 0)) {
						if (strlen($zip5) > 4) {
							$zip5 = substr($zip5, 0, 4);
						}
						if (($zip5) && (strlen($zip5) > 0)) {
							$zip5 = strtoupper($zip5);
							return true;
						}
					}
				}
			}
			##################################################

			##################################################
			# Australia ZipCode (AU)
			##################################################
			if (ZIPCODE_AU == "on") {
				if (ereg("(^[0-9])", substr($zip, 0, 1))) {
					while (ereg("(^[0-9])", substr($zip, 0, 1))) {
						$zip5 .= substr($zip, 0, 1);
						$zip = substr($zip, 1);
					}
					if (($zip5) && (strlen($zip5) > 0)) {
						if (strlen($zip5) > 4) {
							$zip5 = substr($zip5, 0, 4);
						}
						$zip5 = $zip5 + 0;
						if (($zip5) && ($zip5 > 0)) {
							while (strlen($zip5) < 4) {
								$zip5 = "0" . $zip5;
							}
							$zip5 = strtoupper($zip5);
							return true;
						}
					}
				}
			}
			##################################################

		}

		return false;

	}

	function zipproximity_validateZip5($zip5) {
		$dbObj = db_getDBObject();
		$sql = "SELECT ZipCode FROM ZipCode_Data WHERE ZipCode = '".$zip5."' LIMIT 1";
		$result = $dbObj->query($sql);
		if ((mysql_num_rows($result)) && (mysql_num_rows($result)) > 0) {
			return true;
		}
		return false;
	}

	function zipproximity_getZip5Fields($zip5, &$latitude, &$longitude) {
		$dbObj = db_getDBObject();
		$sql = "SELECT ZipCode, Latitude, Longitude FROM ZipCode_Data WHERE ZipCode = '".$zip5."' LIMIT 1";
		$r = $dbObj->query($sql);
		if ($row = mysql_fetch_array($r)) {
			$latitude = $row["Latitude"];
			$longitude = $row["Longitude"];
			return true;
		}
		return false;
	}

	function zipproximity_saveZip5($table, $id, $zip5) {
		$dbObj = db_getDBObject();
		if (zipproximity_getZip5Fields($zip5, $latitude, $longitude)) {
			$sql = "UPDATE ".$table." SET zip5 = '".$zip5."', latitude = '".$latitude."', longitude = '".$longitude."' WHERE id = '".$id."'";
			$r = $dbObj->query($sql);
			return true;
		}
		$sql = "UPDATE ".$table." SET zip5 = '0', latitude = '0.000000', longitude = '0.000000' WHERE id = '".$id."'";
		$r = $dbObj->query($sql);
		return false;
	}

	// ---------------------------------------------------------------------------------------------------- \\
	// PUBLIC FUNCTIONS                                                                                     \\
	// ---------------------------------------------------------------------------------------------------- \\

	function zipproximity_validate($zip) {
		if (zipproximity_getZip5($zip, $zip5)) {
			if (zipproximity_validateZip5($zip5)) {
				return true;
			}
		}
		return false;
	}

	function zipproximity_updateDB($table, $id) {
		$dbObj = db_getDBObject();
		$sql = "SELECT zip_code FROM ".$table." WHERE id = '".$id."'";
		$r = $dbObj->query($sql);
		if ($row = mysql_fetch_array($r)) {
			$zip = $row["zip_code"];
			if (zipproximity_getZip5($zip, $zip5)) {
				if (zipproximity_validateZip5($zip5)) {
					zipproximity_saveZip5($table, $id, $zip5);
					return true;
				}
			}
		}
		zipproximity_saveZip5($table, $id, "0");
		return false;
	}

	function zipproximity_getWhereZipCodeProximity($zip, $dist, &$whereZipCodeProximity, &$order_by_zipcode_score) {
		$constMile = 0.014473204925797298063067594227;
		$constKm   = 0.008993232600237922265686778139;
		$order_by_zipcode_score = "";
		if (ZIPCODE_UNIT == "mile") $constDist = $constMile;
		elseif (ZIPCODE_UNIT == "km") $constDist = $constKm;
		$dist = $dist + 0;
		if (zipproximity_getZip5($zip, $zip5)) {
			if (zipproximity_validateZip5($zip5)) {
				if (zipproximity_getZip5Fields($zip5, $latitude, $longitude)) {
					$HighLatitude = $latitude + $dist * $constDist;
					$LowLatitude = $latitude - $dist * $constDist;
					$HighLongitude = $longitude + $dist * $constDist;
					$LowLongitude = $longitude - $dist * $constDist;
					$whereZipCodeProximity = "";
					$whereZipCodeProximity .= "(";
					$whereZipCodeProximity .= "latitude <= ".$HighLatitude;
					$whereZipCodeProximity .= " AND ";
					$whereZipCodeProximity .= "latitude >= ".$LowLatitude;
					$whereZipCodeProximity .= " AND ";
					$whereZipCodeProximity .= "longitude <= ".$HighLongitude;
					$whereZipCodeProximity .= " AND ";
					$whereZipCodeProximity .= "longitude >= ".$LowLongitude;
					$whereZipCodeProximity .= " AND ";
					$whereZipCodeProximity .= "zip5 != 0";
					$whereZipCodeProximity .= " AND ";
					$whereZipCodeProximity .= "zip5 != ''";
					$whereZipCodeProximity .= ")";
					if (ZIPCODE_UNIT == "mile") {
						$order_by_zipcode_score = "SQRT(POW((69.1 * (".$latitude." - latitude)), 2) + POW((53.0 * (".$longitude." - longitude)), 2)) AS zipcode_score";
					} elseif (ZIPCODE_UNIT == "km") {
						$order_by_zipcode_score = "SQRT(POW((69.1 * (".$latitude." - latitude)), 2) + POW((53.0 * (".$longitude." - longitude)), 2)) * 1.609344 AS zipcode_score";
					}
					return true;
				}
			}
		}
		return false;
	}

	function zipproximity_getDistanceLabel($zip, $item, $id, &$distance_label) {
		$distance_label = "";
		if ($zip && $item && $id) {
			if (zipproximity_getZip5($zip, $zip5)) {
				if (zipproximity_validateZip5($zip5)) {
					if (zipproximity_getZip5Fields($zip5, $zip_latitude, $zip_longitude)) {
						$dbObj = db_getDBObject();
						$sql = "SELECT latitude, longitude FROM ".ucwords($item)." WHERE id = '".$id."'";
						$result = $dbObj->query($sql);
						if ($row = mysql_fetch_array($result)) {
							$item_latitude = $row["latitude"];
							$item_longitude = $row["longitude"];
							if (ZIPCODE_UNIT == "mile") {
								$distance_label = (round(sqrt(pow((69.1 * ($zip_latitude - $item_latitude)), 2) + pow((53.0 * ($zip_longitude - $item_longitude)), 2)), 2))." ".ZIPCODE_UNIT_LABEL_PLURAL;
							} elseif (ZIPCODE_UNIT == "km") {
								$distance_label = (round(sqrt(pow((69.1 * ($zip_latitude - $item_latitude)), 2) + pow((53.0 * ($zip_longitude - $item_longitude)), 2)) * 1.609344, 2))." ".ZIPCODE_UNIT_LABEL_PLURAL;
							}
						}
						if ($distance_label) {
							return true;
						}
					}
				}
			}
		}
		return false;
	}

?>
