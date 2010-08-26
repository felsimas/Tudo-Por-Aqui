<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /functions/db_funct.php
	# ----------------------------------------------------------------------------------------------------

	function db_getDBObject($name = DEFAULT_DB) {
		static $dbObj;
		if($dbObj == null) {
			$dbObj = new mysql($name);
		}
		return $dbObj;
	}

	/*
	* Check if a given string needs addslashes. Shoul be used before database operation.
	**************************************************************************************/
	function db_stringNeedsAddslashes($str) {
		if (($qp = strpos($str,"'")) !== false || ($qp = strpos($str,"\"")) !== false) {
		if ($str[$qp-1] != "\\")
			return true;
		else
			return db_stringNeedsAddslashes(substr($str,$qp+1,strlen($str)));
		}
		return false;
	}

	function db_formatString($string, $default = "") {
		if (empty($string) && $string != "0") {
			$string = $default;
		}
		if (($string[0]=="'" && $string[strlen($string)-1]=="'") || ($string[0]=='"' && $string[strlen($string)-1]=='"')) {
			$string = substr($string, 1, strlen($string)-2);
		}
		if (db_stringNeedsAddslashes($string)) {
			$string = addslashes($string);
		}
		return "'".$string."'";
	}

	function db_formatNumber($number, $default = 0) {
		if (is_numeric($number)) return $number;
		else return $default;
	}

	function db_formatBoolean($bool) {
		if($bool) return 1;
		else return 0;
	}

	function db_formatDate($date, $default = "0000-00-00") {
		$aux = explode("/", $date);
		if (count($aux) == 3) {
			if (DEFAULT_DATE_FORMAT == "m/d/Y") {
				$date = $aux[2]."-".$aux[0]."-".$aux[1];
			} elseif (DEFAULT_DATE_FORMAT == "d/m/Y") {
				$date = $aux[2]."-".$aux[1]."-".$aux[0];
			}
		}
		$aux = explode("-", $date);
		if (count($aux) == 3) {
			if (DEFAULT_DATE_FORMAT == "m/d/Y") {
				$dateaux = $aux[1]."/".$aux[2]."/".$aux[0];
			} elseif (DEFAULT_DATE_FORMAT == "d/m/Y") {
				$dateaux = $aux[2]."/".$aux[1]."/".$aux[0];
			}
			if (validate_date($dateaux)) {
				return "'".$date."'";
			}
		}
		return "'".$default."'";
	}

	function db_getFromDB($table, $by_key="", $by_value="", $number=1, $orderby="", $return="object") {

		switch ($table) {
			case 'account'				: $obj = "Account";					break;
			case 'smaccount'			: $obj = "SMAccount";				break;
			case 'contact'				: $obj = "Contact";					break;
			case 'listing'				: $obj = "Listing";					break;
			case 'gallery'				: $obj = "Gallery";					break;
			case 'promotion'			: $obj = "Promotion";				break;
			case 'listingcategory'		: $obj = "ListingCategory";			break;
			case 'classifiedcategory'	: $obj = "ClassifiedCategory";		break;
			case 'classified'			: $obj = "Classified";				break;
			case 'articlecategory'		: $obj = "ArticleCategory";			break;
			case 'article'				: $obj = "Article";					break;
			case 'eventcategory'		: $obj = "EventCategory";			break;
			case 'event'				: $obj = "Event";					break;
			case 'banner'				: $obj = "Banner";					break;
			case 'invoice'				: $obj = "Invoice";					break;
			case 'editor_choice'		: $obj = "Editor_Choice";			break;
			case 'listing_choice'		: $obj = "Listing_Choice";			break;
			case 'payment_log'			: $obj = "Payment_Log";				break;
			case 'custominvoice'		: $obj = "CustomInvoice";			break;
			case 'listingtemplate'		: $obj = "ListingTemplate";			break;
		}

		$db = db_getDBObject();
		$sql = "SELECT * FROM $obj ";
		if (strlen($by_key) && strlen($by_value)) {
			if ((count($by_key) == count($by_value)) && (count($by_key) > 1)) {
				for($i=0; $i<count($by_key); $i++) {
					$where[] .= "$by_key[$i] = $by_value[$i]";
				}
			} else {
				$where[] = "$by_key = $by_value";
			}
		}

		if ($where) $sWhere = implode(" AND ", $where);

		if ($sWhere) $sql .= "WHERE $sWhere ";

		if ($orderby) $sql .= "ORDER BY $orderby ";

		if (is_numeric($number)) $sql .= "LIMIT $number ";

		$r = $db->query($sql);

		if ($number == 1) {
			$row = mysql_fetch_array($r);
			if ($return == "array") $res = $row;
			else if ($return == "object") {
				if ($obj == "Gallery") $res = new $obj($row["id"]);
				else {
					$obj = str_replace("_", "", $obj);
					$res = new $obj($row);
				}
			}
		} else {
			$res = Array();
			while ($row = mysql_fetch_array($r)) {
				if ($return == "array") $res[] = $row; 
				else if ($return == "object") {
					if ($obj == "Gallery") $res[] = new $obj($row["id"]);
					else {
						$obj = str_replace("_", "", str_replace("MM_", "", $obj));
						$res[] = new $obj($row);
					}
				}
			}
		}

		return $res;

	}

	function db_getFromDBBySQL($table, $sql, $return="object") {

		switch ($table) {
			case 'account'				: $obj = "Account";				break;
			case 'smaccount'			: $obj = "SMAccount";			break;
			case 'contact'				: $obj = "Contact";				break;
			case 'listing'				: $obj = "Listing";				break;
			case 'gallery'				: $obj = "Gallery";				break;
			case 'promotion'			: $obj = "Promotion";			break;
			case 'listingcategory'		: $obj = "ListingCategory";		break;
			case 'classifiedcategory'	: $obj = "ClassifiedCategory";	break;
			case 'classified'			: $obj = "Classified";			break;
			case 'articlecategory'		: $obj = "ArticleCategory";		break;
			case 'article'				: $obj = "Article";				break;
			case 'eventcategory'		: $obj = "EventCategory";		break;
			case 'event'				: $obj = "Event";				break;
			case 'banner'				: $obj = "Banner";				break;
			case 'image'				: $obj = "Image";				break;
			case 'invoice'				: $obj = "Invoice";				break;
			case 'custominvoice'		: $obj = "CustomInvoice";		break;
			case 'listingtemplate'		: $obj = "ListingTemplate";		break;
			default						: $obj = $table;				break;
		}

		$db = db_getDBObject();
		$r = $db->query($sql);

		$res = Array();

		if ($r) while ($row = mysql_fetch_array($r)) {
			if ($return == "array") $res[] = $row;
			else {
				if ($obj == "Gallery") $res[] = new $obj($row["id"]);
				else $res[] = new $obj($row);
			}
		}

		return $res;

	}

	/*
	 * getLocationString(format)
	 * @tableObject = instance of a table object wich contains location id fields like estado_id and so on
	 * @format:
	 * C - country  (will use estado_id for location_country)
	 * s - state    (will use cidade_id for location_state)
	 * r - region   (will use regiony_id for location_region)
	 * c - city     (will use city_id for location_city)
	 * a - area     (will use area_id for location_area)
	 * z - zip_code (caution - only for tables with zip_code field);
	 * A - address  (caution - the same as zip_code)
	 * t - maptuning
	 * other chars will be parsed as literals
	 * to use characters above as literals, escape them
	 * $autoFormat:
	 * used to not include literal chars if the return string is still empty or contains only spaces.
	*/
	function db_getLocationString($tableObject, $format, $autoFormat = true){
		$length = strlen($format); /* optmization: skip "for loop" to always avail strlen*/
		$locationString = "";
		$spaces = 0;
		for($i = 0; $i < $length; $i++){
			$char = substr($format, $i, 1);
			$obj = 0;
			switch($char){
				case "\\":
					$char = substr($format, ++$i, 1);
					$locationString .= htmlspecialchars($char);
					break;
				case "C":
					$obj = "LocationCountry";
					$obj_id = $tableObject->estado_id; 
					break;
				case "s":
					$obj = "LocationState";
					$obj_id = $tableObject->cidade_id;
					break;
				case "r":
					$obj = "LocationRegion";
					$obj_id = $tableObject->bairro_id;
					break;
				case "c":
					$obj = "LocationCity";
					$obj_id = $tableObject->city_id;
					break;
				case "a":
					$obj = "LocationArea";
					$obj_id = $tableObject->area_id;
					break;
				case "z":
					$locationString .= $tableObject->zip_code;
					break;
				case "A":
					$locationString .= $tableObject->address;
					break;
				case "t":
					if(isset($tableObject->maptuning)) {
                        $locationString .= $tableObject->maptuning;
                    }
					break;
				default:
					if($autoFormat){
						if(strlen($locationString) - $spaces > 0) $locationString .= htmlspecialchars($char);
					} else {
						$locationString .= htmlspecialchars($char);
					}
			}
			if($obj){
				$locationManager =& $tableObject->getLocationManager();
				if($locationManager){
					$locationObject = $locationManager->getLocationObject($obj, $obj_id);
				} else {
					$locationObject = new $obj($obj_id);
				}
				$locationString .= $locationObject->name;
			}
			if($char === " ") $spaces++;
		}
		return $locationString;
	}
?>