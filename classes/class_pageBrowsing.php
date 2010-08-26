<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /classes/class_pageBrowsing.php
	# ----------------------------------------------------------------------------------------------------

	class pageBrowsing extends Handle {

		var $table;
		var $screen;
		var $next_screen;
		var $back_screen;
		var $start;
		var $limit;
		var $letra_field;
		var $letra;
		var $where;
		var $order;
		var $record_amount;
		var $pages;

		function pageBrowsing($table = "Listing", $screen = 1, $limit = false, $order = false, $letra_field = false, $letra = false, $where = false, $return_columns = "*", $return_object = false, $group_by = false) {

			if (!is_numeric($screen) || ($screen <= 0)) $screen = 1;
			if (!$screen) $screen = 1;

			$db_mysqlversion = db_getDBObject();
			$mysqlversion = mysql_get_server_info($db_mysqlversion->link_id);
			$mysqlversion = substr($mysqlversion, 0, strpos($mysqlversion, "."));

			/* Implementation for Mysql 3.23 ********************************/
			if ($mysqlversion <= 3) {

				$db = db_getDBObject();

				$sql = "SELECT $return_columns FROM $table";

				if ($letra && $where) {
					if ($letra == "no") {
						$sql .= " WHERE $letra_field REGEXP '^[^a-zA-Z].*$' AND $where";
					} else {
						if ($table == "Account") {
							$sql .= " WHERE (($letra_field LIKE ".db_formatString($letra."%")." AND $letra_field NOT LIKE ".db_formatString("%::%").") OR $letra_field LIKE ".db_formatString("%::".$letra."%").") AND $where";
						} else {
							$sql .= " WHERE $letra_field LIKE ".db_formatString($letra."%")." AND $where";
						}
					}
				} elseif ($letra) {
					if ($letra == "no") {
						$sql .= " WHERE $letra_field REGEXP '^[^a-zA-Z].*$'";
					} else {
						if ($table == "Account") {
							$sql .= " WHERE (($letra_field LIKE ".db_formatString($letra."%")." AND $letra_field NOT LIKE ".db_formatString("%::%").") OR $letra_field LIKE ".db_formatString("%::".$letra."%").")";
						} else {
							$sql .= " WHERE $letra_field LIKE ".db_formatString($letra."%")."";
						}
					}
				} elseif($where) {
					$sql .= " WHERE $where";
				}

				if ($group_by) $sql .= " GROUP BY $group_by";

				$record_amount = mysql_num_rows($db->query($sql));

			}
			/******************************************************************/

			$this->letras = array("#","a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z");

			$this->table			= $table;
			$this->screen			= $screen;
			$this->limit			= $limit;
			$this->start			= ($screen-1) * $limit;
			$this->order			= $order;
			$this->group_by			= $group_by;
			$this->letra_field		= $letra_field;
			$this->letra			= $letra;
			$this->where			= $where;
			$this->return_columns	= $return_columns;
			$this->return_object	= $return_object;

			/* Implementation for Mysql 3.23 ********************************/
			if ($mysqlversion <= 3) {
				$this->record_amount	= $record_amount;
				$this->pages			= ceil($record_amount/$limit);
				$this->next_screen		= ($screen >= ceil($record_amount/$limit)) ? ceil($record_amount/$limit) : ($screen+1);
				$this->back_screen		= ($screen <= 1) ? 1 : ($screen-1);
				$this->page_jump		= (ceil($record_amount/$limit) > 1000) ? 100 : 1;
			}
			/******************************************************************/

		}

		function retrievePage($return_type = "object") {

			$db_mysqlversion = db_getDBObject();
			$mysqlversion = mysql_get_server_info($db_mysqlversion->link_id);
			$mysqlversion = substr($mysqlversion, 0, strpos($mysqlversion, "."));

			$db = db_getDBObject();

			if ($this->letra) {
				if ($this->letra == "no") {
					$this->where .= (!$this->where) ? " $this->letra_field REGEXP '^[^a-zA-Z].*$'" : " AND $this->letra_field REGEXP '^[^a-zA-Z].*$'";
				} else {
					if ($this->table == "Account") {
						if (!$this->where) {
							$this->where .= " (($this->letra_field LIKE ".db_formatString($this->letra."%")." AND $this->letra_field NOT LIKE ".db_formatString("%::%").") OR $this->letra_field LIKE ".db_formatString("%::".$this->letra."%").")";
						} else {
							$this->where .= " AND (($this->letra_field LIKE ".db_formatString($this->letra."%")." AND $this->letra_field NOT LIKE ".db_formatString("%::%").") OR $this->letra_field LIKE ".db_formatString("%::".$this->letra."%").")";
						}
					} else {
						if (!$this->where) {
							$this->where .= " $this->letra_field LIKE ".db_formatString($this->letra."%")."";
						} else {
							$this->where .= " AND $this->letra_field LIKE ".db_formatString($this->letra."%")."";
						}
					}
				}
			}

			/* Implementation for Mysql 3.23 ********************************/
			if ($mysqlversion <= 3) {
				$sql = "SELECT $this->return_columns FROM $this->table";
			}
			/******************************************************************/

			/* Implementation for Mysql 4.1.x ********************************/
			if ($mysqlversion > 3) {
				$sql = "SELECT SQL_CALC_FOUND_ROWS $this->return_columns FROM $this->table";
			}
			/******************************************************************/

			if ($this->where) $sql .= " WHERE $this->where";

			if ($this->group_by) $sql .= " GROUP BY $this->group_by";

			if ($this->order) $sql .= " ORDER BY $this->order";

			if ($this->limit) $sql .= " LIMIT $this->start,$this->limit";
//echo $sql;
			$r = $db->query($sql);

			/* Implementation for Mysql 4.1.x ********************************/
			if ($mysqlversion > 3) {

				$sql2 = "SELECT FOUND_ROWS() as row_amount";
				$r2 = $db->query($sql2);
				$row = mysql_fetch_assoc($r2);

				$this->record_amount	= $row["row_amount"];
				$this->pages			= ceil($this->record_amount/$this->limit);
				$this->next_screen		= ($this->screen >= ceil($this->record_amount/$this->limit)) ? ceil($this->record_amount/$this->limit) : ($this->screen+1);
				$this->back_screen		= ($this->screen <= 1) ? 1 : ($this->screen-1);
				$this->page_jump		= $this->calculatePageJump();

			}
			/******************************************************************/

			if ($return_type == "object") {
				while ($row = mysql_fetch_assoc($r)) {
					$class = (eregi("_",$this->getString("table"))) ? str_replace("_", "", $this->getString("table")) : $this->getString("table");
					$class = ($this->return_object) ? $this->return_object : $class;
					$result[] = new $class($row["id"]);
				}
			} elseif ($return_type == "array") {
				while ($row = mysql_fetch_assoc($r)) $result[] = $row;
			}

			return $result;

		}

		function calculatePageJump() {
			$amount = $this->record_amount;
			$exponent = 0;
			while ($amount > 1000){
				$amount /= 10;
				$exponent++;
			}
			return pow(10, $exponent);
		}

		function getPagesDropDown ($getData, $pagingUrl, $screen = 1, $defaultText = "Go to page: ", $defaultOnChange = "this.form.submit();") {

			if (!is_numeric($screen) || ($screen <= 0)) $screen = 1;
			if (!$screen) $screen = 1;

		//	$pagesDropDown = "<form name=\"pages\" method=\"get\" action=\"$pagingUrl\" style=\"margin: 0;\">";
			foreach ($getData as $name => $value) {
				if ((is_string($name) || is_numeric($name)) && (is_string($value) || is_numeric($value))) {
					if (($name != "screen") && ($name != "acct_search_company") && ($name != "acct_search_username")) {
						$pagesDropDown .= "<input type=\"hidden\" name=\"".$name."\" value=\"".htmlentities($value)."\" />\n";
					}
				}
			}
		//	$pagesDropDown .= $defaultText . "<select name=\"screen\" onchange='".$defaultOnChange."'>\n";
			$increment = ($this->page_jump <= 0) ? 1 : $this->page_jump;
			$increment2 = $this->page_jump;
			$i = 1;
			while ($i <= $this->pages) {
				if ($screen == $i) {
					$pagesDropDown .= "<span class=\"current\">".$i."</span>\n";
				} elseif (($screen != 1) && ($i > $screen) && (($i-$this->page_jump) < $screen)) {
					$pagesDropDown .= "<span class=\"\">".$screen."</span>\n";
					$pagesDropDown .= "<span class=\"\">".$i."</span>\n";
				} else {
					$pagesDropDown .= "<a href=\"".$pagingUrl."?letra=&screen=$i\"><span>".$i."</span></a>\n";
				}
				if ($i == 1) {
					if ($increment > 1) $i += $increment-1;
					else $i += $increment;
				} else {
					if (($i < $this->pages) && (($i+$increment2) > $this->pages)) {
						$i += ($this->pages)-$i;
					} else {
						$i += $increment2;
					}
				}
			}
		//	$pagesDropDown .= "</select>\n";
		//	$pagesDropDown .= "</form>\n";
			return $pagesDropDown;

		}

	}

?>
