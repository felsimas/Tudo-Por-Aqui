<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /classes/class_handle.php
	# ----------------------------------------------------------------------------------------------------

	class Handle {

		function Handle() {}

		function getString($field, $special_chars=true) {
			$value = $this->$field;
			if (!is_string($value)) return $value;
			$value = ($special_chars) ? htmlspecialchars($value) : $value ;
			return $value;
		}

		function getStringLang($lang=EDIR_DEFAULT_LANGUAGE, $field, $special_chars=true) {
			$array_edir_languages = explode(",", EDIR_LANGUAGES);
			$labelsuffix = "";
			for ($i=0; $i<count($array_edir_languages); $i++) {
				if ($lang == $array_edir_languages[$i]) {
					if ($i) $labelsuffix = $i;
				}
			}
			return $this->getString($field.$labelsuffix, $special_chars);
		}

		function getNumber($field, $special_chars=false) {
			$value = $this->$field;
			if (!is_string($value)) return $value;
			$value = ($special_chars) ? htmlspecialchars($value) : $value ;
			return $value;
		}

		function getNumberLang($lang=EDIR_DEFAULT_LANGUAGE, $field, $special_chars=true) {
			$array_edir_languages = explode(",", EDIR_LANGUAGES);
			$labelsuffix = "";
			for ($i=0; $i<count($array_edir_languages); $i++) {
				if ($lang == $array_edir_languages[$i]) {
					if ($i) $labelsuffix = $i;
				}
			}
			return $this->getNumber($field.$labelsuffix, $special_chars);
		}

		function getDate($field) {
			$aux = explode("-", $this->$field);
			if (count($aux) == 3) {
				if (DEFAULT_DATE_FORMAT == "m/d/Y") {
					return $aux[1]."/".$aux[2]."/".$aux[0];
				} elseif (DEFAULT_DATE_FORMAT == "d/m/Y") {
					return $aux[2]."/".$aux[1]."/".$aux[0];
				}
			} else {
				return "00/00/0000";
			}
		}

		function getBoolean($field) {
			if ($this->$field) return true;
			else return false;
		}

		function setString($field, $string) {
			$this->$field = $string;
		}

		function setNumber($field, $number) {
			if (is_numeric($number)) $this->$field = $number;
			else $this->$field = 0;
		}

		function setBoolean($field, $bool) {
			if ($bool) $this->$field = 1;
			else $this->$field = 0;
		}

		function setDate($field, $date) {

			if (strpos($date, "/")) {

				$aux = explode("/", $date);

				if (count($aux) == 3) {

					if (DEFAULT_DATE_FORMAT == "m/d/Y") {
						$month = $aux[0];
						$day = $aux[1];
						$year = $aux[2];
					} elseif (DEFAULT_DATE_FORMAT == "d/m/Y") {
						$month = $aux[1];
						$day = $aux[0];
						$year = $aux[2];
					}

					if (checkdate((int)$month, (int)$day, (int)$year)) {
						$this->$field = $year."-".$month."-".$day;
					} else {
						$this->$field = "0000-00-00";
					}

				} else {
					$this->$field = "0000-00-00";
				}

			} else if (strpos($date, "-")) {

				$aux = explode("-", $date);

				if (count($aux) == 3) {

					if (checkdate((int)$aux[1], (int)$aux[2], (int)$aux[0])) {
						$this->$field = $date;
					} else {
						$this->$field = "0000-00-00";
					}

				} else {
					$this->$field = "0000-00-00";
				}

			} else {
				$this->$field = "0000-00-00";
			}

		}

		function prepareToSave() {

			## backslashes manage and other stuff manage
			$vars = get_object_vars($this);

			// regular expression to match date
			$regexp_date = "^([0-9]{1,2})/([0-9]{1,2})/([0-9]{4})$";

			for ($i=0; $i<count($vars); $i++) {
				$key = each($vars);
				if ($key['value'] == "NULL") {
					$this->setString($key['key'], "{$key["value"]}");
				} elseif (is_string($key['value'])) {
					if (ereg($regexp_date, $key["value"])) {
						$this->setDate($key["key"], $key["value"]);
						//$this->setString($key["key"], "'".$key["value"]."'");
						$this->setString($key["key"], "'".$this->$key["key"]."'");
					} else {
						if ($this->string_needs_addslashes($key["value"]) || !get_magic_quotes_gpc()) $key["value"] = addslashes($key["value"]);
						if ((strpos($key["value"],"\'") !== false) || (strpos($key["value"],"\\") !== false) || (strpos($key["value"],"\\\"") !== false) || !get_magic_quotes_gpc()) $key["value"] = stripslashes($key["value"]);
						$key["value"]  = addslashes($key["value"]);
						$this->setString($key["key"], "'".$key["value"]."'");
					}
				} elseif (is_numeric($key["value"])) {
					$this->setNumber($key["key"], $key["value"]);
				} else {
					$this->setString($key["key"], "'".$key["value"]."'");
				}
			}

		}

		function prepareToUse() {
			$vars = get_object_vars($this);
			for ($i=0; $i < count($vars); $i++) {
				$key = each($vars);
				if (!is_numeric($key["value"])) $this->setString($key["key"], substr($key["value"], 1, strlen($key["value"])-2));
				$this->setString($key["key"], stripslashes($this->getString($key["key"], false)));
			}
		}

		function string_needs_addslashes($str) {
			if (($qp = strpos($str,"'")) !== false || ($qp = strpos($str,"\"")) !== false) {
				if ($str[$qp-1] != "\\") return true;
				else return $this->string_needs_addslashes(substr($str,$qp+1,strlen($str)));
			}
			return false;
		}

		function extract() {

			// regular expression to match date
			$regexp_date = "^([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})$";

			// regular expression to match decimal.
			$regexp_decimal = "^([0-9]{1,}).([0-9]{2,2})$";

			// getting the variables for this class
			$vars = get_object_vars($this);

			for ($i=0; $i < count($vars); $i++) {

				$key = each($vars);

				global $$key["key"];

				if (ereg($regexp_date, $key["value"])){
					$value = $this->getDate("{$key["key"]}");
					if ($value == "00/00/0000") unset($value);
				} elseif (ereg($regexp_decimal, $key["value"])) {
					$value = $key["value"];
				} else {
					$value = $key["value"];
				}

				$$key["key"] = (isset($value) && (!is_array($value)) && !is_object($value)) ? htmlspecialchars($value) : $value;

			}

		}

	}

?>
