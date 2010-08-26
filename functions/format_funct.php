<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /functions/format_funct.php
	# ----------------------------------------------------------------------------------------------------

	function format_dateFromDB($datetime, $format) {
		return date($format, mktime((int)substr($datetime, 11, 2), (int)substr($datetime, 14, 2), (int)substr($datetime, 17, 2), (int)substr($datetime, 5, 2), (int)substr($datetime, 8, 2), (int)substr($datetime, 0, 4)));
	}

	function format_printDateStandard() {
		$arrayAux = explode("/", DEFAULT_DATE_FORMAT);
		if (($arrayAux[0] == "m") && ($arrayAux[1] == "d") && ($arrayAux[2] == "Y")) {
			return system_showText(LANG_LETTER_MONTH).system_showText(LANG_LETTER_MONTH)."/".system_showText(LANG_LETTER_DAY).system_showText(LANG_LETTER_DAY)."/".system_showText(LANG_LETTER_YEAR).system_showText(LANG_LETTER_YEAR).system_showText(LANG_LETTER_YEAR).system_showText(LANG_LETTER_YEAR);
		} elseif (($arrayAux[0] == "d") && ($arrayAux[1] == "m") && ($arrayAux[2] == "Y")) {
			return system_showText(LANG_LETTER_DAY).system_showText(LANG_LETTER_DAY)."/".system_showText(LANG_LETTER_MONTH).system_showText(LANG_LETTER_MONTH)."/".system_showText(LANG_LETTER_YEAR).system_showText(LANG_LETTER_YEAR).system_showText(LANG_LETTER_YEAR).system_showText(LANG_LETTER_YEAR);;
		} else {
			return "xx/xx/xxxx";
		}
	}

	//***************************************************
	// format date from mysql data types
	// This "if" added to fix error of "mktime" on PHP 5.x:
	// if ($hour>0 || $minute>0 || $second>0 || $month>0 || $day>0 || $year>0)
	function format_date($value = false, $format = DEFAULT_DATE_FORMAT, $field_type = "date", $pm = false) {
		if (!$value) return false;
		switch ($field_type) {
			case "date":
				list($year,$month,$day) = split ("-",$value);
				if ($month>0 || $day>0 || $year>0) $ts_date = mktime(0,0,0,(int)$month,(int)$day,(int)$year);
				if ($ts_date <= 0) return false;
				return date("$format",$ts_date);
			break;
			case "datetime":
				$date_time = split(" ",$value);
				list($year,$month,$day) = split ("-",$date_time[0]);
				list($hour,$minute,$second) = split (":",$date_time[1]);
				if ($hour>0 || $minute>0 || $second>0 || $month>0 || $day>0 || $year>0)
					$ts_date = mktime((int)$hour,(int)$minute,(int)$second,(int)$month,(int)$day,(int)$year);
				if ($ts_date <= 0) return false;
				return date("$format",$ts_date);
			break;
			case "set_event_datetime":
				$date_time = split(" ",$value);
				list($month,$day,$year) = split ("/",$date_time[0]);
				list($hour,$minute,$second) = split (":",$date_time[1]);
				if ($pm and $hour and $hour < 12) $hour = $hour + 12;
				if (!$pm and $hour and $hour == 12) $hour = $hour - 12;
				$hour = $hour ? $hour : "00";
				$minute = $minute ? $minute : "00";
				$second = $second ? $second : "00";
				if ($hour>0 || $minute>0 || $second>0 || $month>0 || $day>0 || $year>0)
					$ts_date = mktime((int)$hour,(int)$minute,(int)$second,(int)$month,(int)$day,(int)$year);
				if ($ts_date <= 0) return false;
				return date("$format",$ts_date);
			break;
			case "get_event_datetime":
				$year = substr($value,0,4);
				$month = substr($value,5,2);
				$day = substr($value,8,2);
				$hour = substr($value,11,2);
				$minute = substr($value,14,2);
				$second = "00";
				if ($hour >= 12) $data["am_pm"] = "pm";
				elseif ($hour < 12) $data["am_pm"] = "am";
				if ($hour>0 || $minute>0 || $second>0 || $month>0 || $day>0 || $year>0)
					$ts_date = mktime((int)$hour,(int)$minute,(int)$second,(int)$month,(int)$day,(int)$year); 
				$data["date"] = date("$format",$ts_date);
				$data["time"] = date("h:i",$ts_date);
				return $data;
			break;
			case "timestamp":
				return date("$format",$value);
			break;
			case "dbtimestamp":
				$hour	= substr($value, 8, 2);
				$minute	= substr($value, 10, 2);
				$second	= substr($value, 12, 2);
				$month	= substr($value, 4, 2);
				$day	= substr($value, 6, 2);
				$year	= substr($value, 0, 4);
				if ($hour>0 || $minute>0 || $second>0 || $month>0 || $day>0 || $year>0)
					return date($format, mktime((int)substr($value, 8, 2), (int)substr($value, 10, 2), (int)substr($value, 12, 2), (int)substr($value, 4, 2), (int)substr($value, 6, 2), (int)substr($value, 0, 4)));
				else
					return false;
			break;
			case "datetocompare" :
				return substr($value,6,4).substr($value,0,2).substr($value,3,2);
			break;
		}
	}

	// format money from numeric values
	function format_money ($value, $decimal = true) {
		$value = str_replace(",","",$value);
		if (!is_numeric($value)) return "0.00";
		$aux = split("\.",$value);
		$cents = (count($aux) > 1)    ? array_pop($aux)   : "";
		$cents = (strlen($cents) > 2) ? substr($cents,0,2): $cents;
		$cents = str_pad($cents,2,"0",STR_PAD_RIGHT);
		$value = implode("",$aux);
		$formated_money = ($decimal) ? $value.".".$cents : $value ;
		return $formated_money;
	}

	/* replace to work under arrays */
	function format_magicQuotes($aList, $aIsTopLevel = true) {
		$gpcList = array();
		$isMagic = get_magic_quotes_gpc();
		foreach ($aList as $key => $value) {
			$decodedKey = ($isMagic && !$aIsTopLevel) ? stripslashes($key) : $key;
			if (is_array($value)) {
				$decodedValue = format_magicQuotes($value, false);
			} else {
				$decodedValue = ($isMagic) ? stripslashes($value) : $value;
			}
			if (strpos($decodedValue, "\"") !== false) $decodedValue = str_replace("\"", "&quot;", $decodedValue);
			$gpcList[$decodedKey] = $decodedValue;
		}
		return $gpcList;
	}

?>