#!/usr/bin/php -q
<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /cron/daily_maintenance.php
	# ----------------------------------------------------------------------------------------------------

	////////////////////////////////////////////////////////////////////////////////////////////////////
	ini_set("html_errors", FALSE);
	////////////////////////////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////////////////////////////
	$path = "";
	$full_name = "";
	$file_name = "";
	$full_name = $_SERVER["SCRIPT_FILENAME"];
	if (strlen($full_name) > 0) {
		$file_pos = strpos($full_name, "/cron/");
		if ($file_pos !== false) {
			$file_name = substr($full_name, $file_pos);
		}
		$path = substr($full_name, 0, (strlen($file_name)*(-1)));
	}
	if (strlen($path) == 0) $path = "..";
	define(PATH, $path);
	////////////////////////////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////////////////////////////
	@include_once(PATH."/conf/config.inc.php");
	@include_once(PATH."/conf/constants.inc.php");
	@include_once(PATH."/classes/class_mysql.php");
	@include_once(PATH."/classes/class_handle.php");
	@include_once(PATH."/classes/class_itemStatus.php");
	@include_once(PATH."/classes/class_listingLevel.php");
	@include_once(PATH."/classes/class_listingCategory.php");
	@include_once(PATH."/classes/class_listing.php");
	@include_once(PATH."/classes/class_listingTemplate.php");
	@include_once(PATH."/classes/class_locationManager.php");
	@include_once(PATH."/classes/class_locationCountry.php");
	@include_once(PATH."/classes/class_locationState.php");
	@include_once(PATH."/classes/class_locationRegion.php");
	@include_once(PATH."/classes/class_locationCity.php");
	@include_once(PATH."/classes/class_locationArea.php");
	@include_once(PATH."/classes/class_setting.php");
	@include_once(PATH."/functions/db_funct.php");
	@include_once(PATH."/functions/system_funct.php");
	@include_once(PATH."/functions/setting_funct.php");
	////////////////////////////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////////////////////////////
	function getmicrotime() {
		list($usec, $sec) = explode(" ", microtime());
		return ((float)$usec + (float)$sec);
	}
	$time_start = getmicrotime();
	////////////////////////////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////////////////////////////
	$host = _DIRECTORYDB_HOST;
	$db   = _DIRECTORYDB_NAME;
	$user = _DIRECTORYDB_USER;
	$pass = _DIRECTORYDB_PASS;
	////////////////////////////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////////////////////////////
	$link = mysql_connect($host, $user, $pass);
	mysql_select_db($db);
	////////////////////////////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////////////////////////////
	$sql = "DELETE FROM Review WHERE (added <= DATE_SUB(NOW(), INTERVAL '2' YEAR))";
	$result = mysql_query($sql, $link);
	////////////////////////////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////////////////////////////
	$sql = "SELECT * FROM Listing WHERE renewal_date < NOW() AND renewal_date != '0000-00-00' AND status != 'E'";
	$result = mysql_query($sql, $link);
	while ($row = mysql_fetch_assoc($result)) {
		$listingObj = new Listing($row["id"]);
		$listingObj->setString("status", "E");
		$listingObj->Save();
	}
	////////////////////////////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////////////////////////////
	$sql = "UPDATE Event SET status = 'E' WHERE renewal_date < NOW() AND renewal_date != '0000-00-00' AND status != 'E'";
	$result = mysql_query($sql, $link);
	////////////////////////////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////////////////////////////
	$sql = "UPDATE Banner SET status = 'E' WHERE renewal_date < NOW() AND renewal_date != '0000-00-00' AND expiration_setting = ".BANNER_EXPIRATION_RENEWAL_DATE." AND status != 'E'";
	$result = mysql_query($sql, $link);
	////////////////////////////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////////////////////////////
	$sql = "UPDATE Classified SET status = 'E' WHERE renewal_date < NOW() AND renewal_date != '0000-00-00' AND status != 'E'";
	$result = mysql_query($sql, $link);
	////////////////////////////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////////////////////////////
	$sql = "UPDATE Article SET status = 'E' WHERE renewal_date < NOW() AND renewal_date != '0000-00-00' AND status != 'E'";
	$result = mysql_query($sql, $link);
	////////////////////////////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////////////////////////////
	$sql = "UPDATE Discount_Code SET status = 'E' WHERE expire_date < NOW() AND expire_date != '0000-00-00' AND status != 'E'";
	$result = mysql_query($sql, $link);
	////////////////////////////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////////////////////////////
	$sql = "UPDATE Invoice SET status = 'E' WHERE expire_date < NOW() AND expire_date != '0000-00-00' AND status != 'E' AND status != 'R'";
	$result = mysql_query($sql, $link);
	////////////////////////////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////////////////////////////
	$sql = "SELECT id FROM Invoice WHERE status = 'N'";
	$result = mysql_query($sql, $link);
	if (mysql_affected_rows() > 0) {
		while ($row = mysql_fetch_assoc($result)) {
			$invoice_ids[] = $row["id"];
		}
	}
	if ($invoice_ids) {
		$invoice_ids = implode(",",$invoice_ids);
		$sql = "DELETE FROM Invoice WHERE id IN ($invoice_ids)";
		$result = mysql_query($sql, $link);
		$sql = "DELETE FROM Invoice_Listing WHERE invoice_id IN ($invoice_ids)";
		$result = mysql_query($sql, $link);
		$sql = "DELETE FROM Invoice_Event WHERE invoice_id IN ($invoice_ids)";
		$result = mysql_query($sql, $link);
		$sql = "DELETE FROM Invoice_Banner WHERE invoice_id IN ($invoice_ids)";
		$result = mysql_query($sql, $link);
		$sql = "DELETE FROM Invoice_Classified WHERE invoice_id IN ($invoice_ids)";
		$result = mysql_query($sql, $link);
		$sql = "DELETE FROM Invoice_Article WHERE invoice_id IN ($invoice_ids)";
		$result = mysql_query($sql, $link);
	}
	////////////////////////////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////////////////////////////
	$sql = "SELECT COUNT(*) AS total FROM Listing WHERE status = 'P'";
	$result = mysql_query($sql, $link);
	if ($result) {
		if ($row = mysql_fetch_assoc($result)) {
			$this_value = ((int)$row["total"]) ? ("about ".((int)($row["total"]/10)+1)*10) : ("0");
			$sql = "UPDATE ItemStatistic SET value = '".$this_value."' WHERE name = 'l_pending'";
			$result = mysql_query($sql, $link);
			if (mysql_affected_rows() <= 0) {
				$sql = "INSERT INTO ItemStatistic (value, name) VALUES ('".$this_value."', 'l_pending')";
				$result = mysql_query($sql, $link);
			}
		}
	}
	$sql = "SELECT COUNT(*) AS total FROM Listing WHERE renewal_date > NOW() AND renewal_date <= DATE_ADD(NOW(), INTERVAL ".DEFAULT_LISTING_DAYS_TO_EXPIRE." DAY)";
	$result = mysql_query($sql, $link);
	if ($result) {
		if ($row = mysql_fetch_assoc($result)) {
			$this_value = ((int)$row["total"]) ? ("about ".((int)($row["total"]/10)+1)*10) : ("0");
			$sql = "UPDATE ItemStatistic SET value = '".$this_value."' WHERE name = 'l_expiring'";
			$result = mysql_query($sql, $link);
			if (mysql_affected_rows() <= 0) {
				$sql = "INSERT INTO ItemStatistic (value, name) VALUES ('".$this_value."', 'l_expiring')";
				$result = mysql_query($sql, $link);
			}
		}
	}
	$sql = "SELECT COUNT(*) AS total FROM Listing WHERE status = 'E'";
	$result = mysql_query($sql, $link);
	if ($result) {
		if ($row = mysql_fetch_assoc($result)) {
			$this_value = ((int)$row["total"]) ? ("about ".((int)($row["total"]/10)+1)*10) : ("0");
			$sql = "UPDATE ItemStatistic SET value = '".$this_value."' WHERE name = 'l_expired'";
			$result = mysql_query($sql, $link);
			if (mysql_affected_rows() <= 0) {
				$sql = "INSERT INTO ItemStatistic (value, name) VALUES ('".$this_value."', 'l_expired')";
				$result = mysql_query($sql, $link);
			}
		}
	}
	$sql = "SELECT COUNT(*) AS total FROM Listing WHERE status = 'A'";
	$result = mysql_query($sql, $link);
	if ($result) {
		if ($row = mysql_fetch_assoc($result)) {
			$this_value = ((int)$row["total"]) ? ("about ".((int)($row["total"]/10)+1)*10) : ("0");
			$sql = "UPDATE ItemStatistic SET value = '".$this_value."' WHERE name = 'l_active'";
			$result = mysql_query($sql, $link);
			if (mysql_affected_rows() <= 0) {
				$sql = "INSERT INTO ItemStatistic (value, name) VALUES ('".$this_value."', 'l_active')";
				$result = mysql_query($sql, $link);
			}
		}
	}
	$sql = "SELECT COUNT(*) AS total FROM Listing WHERE status = 'S'";
	$result = mysql_query($sql, $link);
	if ($result) {
		if ($row = mysql_fetch_assoc($result)) {
			$this_value = ((int)$row["total"]) ? ("about ".((int)($row["total"]/10)+1)*10) : ("0");
			$sql = "UPDATE ItemStatistic SET value = '".$this_value."' WHERE name = 'l_suspended'";
			$result = mysql_query($sql, $link);
			if (mysql_affected_rows() <= 0) {
				$sql = "INSERT INTO ItemStatistic (value, name) VALUES ('".$this_value."', 'l_suspended')";
				$result = mysql_query($sql, $link);
			}
		}
	}
	$sql = "SELECT COUNT(*) AS total from Listing WHERE entered >= '".date("Y-m-d", mktime(0, 0, 0, date("m")-1 , date("d"), date("Y")))."'";
	$result = mysql_query($sql, $link);
	if ($result) {
		if ($row = mysql_fetch_assoc($result)) {
			$this_value = ((int)$row["total"]) ? ("about ".((int)($row["total"]/10)+1)*10) : ("0");
			$sql = "UPDATE ItemStatistic SET value = '".$this_value."' WHERE name = 'l_added30'";
			$result = mysql_query($sql, $link);
			if (mysql_affected_rows() <= 0) {
				$sql = "INSERT INTO ItemStatistic (value, name) VALUES ('".$this_value."', 'l_added30')";
				$result = mysql_query($sql, $link);
			}
		}
	}
	////////////////////////////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////////////////////////////
	$sql = "SELECT COUNT(*) AS total FROM Event WHERE status = 'P'";
	$result = mysql_query($sql, $link);
	if ($result) {
		if ($row = mysql_fetch_assoc($result)) {
			$this_value = ((int)$row["total"]) ? ("about ".((int)($row["total"]/10)+1)*10) : ("0");
			$sql = "UPDATE ItemStatistic SET value = '".$this_value."' WHERE name = 'e_pending'";
			$result = mysql_query($sql, $link);
			if (mysql_affected_rows() <= 0) {
				$sql = "INSERT INTO ItemStatistic (value, name) VALUES ('".$this_value."', 'e_pending')";
				$result = mysql_query($sql, $link);
			}
		}
	}
	$sql = "SELECT COUNT(*) AS total FROM Event WHERE renewal_date > NOW() AND renewal_date <= DATE_ADD(NOW(), INTERVAL ".DEFAULT_EVENT_DAYS_TO_EXPIRE." DAY)";
	$result = mysql_query($sql, $link);
	if ($result) {
		if ($row = mysql_fetch_assoc($result)) {
			$this_value = ((int)$row["total"]) ? ("about ".((int)($row["total"]/10)+1)*10) : ("0");
			$sql = "UPDATE ItemStatistic SET value = '".$this_value."' WHERE name = 'e_expiring'";
			$result = mysql_query($sql, $link);
			if (mysql_affected_rows() <= 0) {
				$sql = "INSERT INTO ItemStatistic (value, name) VALUES ('".$this_value."', 'e_expiring')";
				$result = mysql_query($sql, $link);
			}
		}
	}
	$sql = "SELECT COUNT(*) AS total FROM Event WHERE status = 'E'";
	$result = mysql_query($sql, $link);
	if ($result) {
		if ($row = mysql_fetch_assoc($result)) {
			$this_value = ((int)$row["total"]) ? ("about ".((int)($row["total"]/10)+1)*10) : ("0");
			$sql = "UPDATE ItemStatistic SET value = '".$this_value."' WHERE name = 'e_expired'";
			$result = mysql_query($sql, $link);
			if (mysql_affected_rows() <= 0) {
				$sql = "INSERT INTO ItemStatistic (value, name) VALUES ('".$this_value."', 'e_expired')";
				$result = mysql_query($sql, $link);
			}
		}
	}
	$sql = "SELECT COUNT(*) AS total FROM Event WHERE status = 'A'";
	$result = mysql_query($sql, $link);
	if ($result) {
		if ($row = mysql_fetch_assoc($result)) {
			$this_value = ((int)$row["total"]) ? ("about ".((int)($row["total"]/10)+1)*10) : ("0");
			$sql = "UPDATE ItemStatistic SET value = '".$this_value."' WHERE name = 'e_active'";
			$result = mysql_query($sql, $link);
			if (mysql_affected_rows() <= 0) {
				$sql = "INSERT INTO ItemStatistic (value, name) VALUES ('".$this_value."', 'e_active')";
				$result = mysql_query($sql, $link);
			}
		}
	}
	$sql = "SELECT COUNT(*) AS total FROM Event WHERE status = 'S'";
	$result = mysql_query($sql, $link);
	if ($result) {
		if ($row = mysql_fetch_assoc($result)) {
			$this_value = ((int)$row["total"]) ? ("about ".((int)($row["total"]/10)+1)*10) : ("0");
			$sql = "UPDATE ItemStatistic SET value = '".$this_value."' WHERE name = 'e_suspended'";
			$result = mysql_query($sql, $link);
			if (mysql_affected_rows() <= 0) {
				$sql = "INSERT INTO ItemStatistic (value, name) VALUES ('".$this_value."', 'e_suspended')";
				$result = mysql_query($sql, $link);
			}
		}
	}
	$sql = "SELECT COUNT(*) AS total from Event WHERE entered >= '".date("Y-m-d", mktime(0, 0, 0, date("m")-1 , date("d"), date("Y")))."'";
	$result = mysql_query($sql, $link);
	if ($result) {
		if ($row = mysql_fetch_assoc($result)) {
			$this_value = ((int)$row["total"]) ? ("about ".((int)($row["total"]/10)+1)*10) : ("0");
			$sql = "UPDATE ItemStatistic SET value = '".$this_value."' WHERE name = 'e_added30'";
			$result = mysql_query($sql, $link);
			if (mysql_affected_rows() <= 0) {
				$sql = "INSERT INTO ItemStatistic (value, name) VALUES ('".$this_value."', 'e_added30')";
				$result = mysql_query($sql, $link);
			}
		}
	}
	////////////////////////////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////////////////////////////
	$sql = "SELECT COUNT(*) AS total FROM Banner WHERE status = 'P'";
	$result = mysql_query($sql, $link);
	if ($result) {
		if ($row = mysql_fetch_assoc($result)) {
			$this_value = ((int)$row["total"]) ? ("about ".((int)($row["total"]/10)+1)*10) : ("0");
			$sql = "UPDATE ItemStatistic SET value = '".$this_value."' WHERE name = 'b_pending'";
			$result = mysql_query($sql, $link);
			if (mysql_affected_rows() <= 0) {
				$sql = "INSERT INTO ItemStatistic (value, name) VALUES ('".$this_value."', 'b_pending')";
				$result = mysql_query($sql, $link);
			}
		}
	}
	$sql = "SELECT COUNT(*) AS total FROM Banner WHERE status = 'E'";
	$result = mysql_query($sql, $link);
	if ($result) {
		if ($row = mysql_fetch_assoc($result)) {
			$this_value = ((int)$row["total"]) ? ("about ".((int)($row["total"]/10)+1)*10) : ("0");
			$sql = "UPDATE ItemStatistic SET value = '".$this_value."' WHERE name = 'b_expired'";
			$result = mysql_query($sql, $link);
			if (mysql_affected_rows() <= 0) {
				$sql = "INSERT INTO ItemStatistic (value, name) VALUES ('".$this_value."', 'b_expired')";
				$result = mysql_query($sql, $link);
			}
		}
	}
	$sql = "SELECT COUNT(*) AS total FROM Banner WHERE status = 'A'";
	$result = mysql_query($sql, $link);
	if ($result) {
		if ($row = mysql_fetch_assoc($result)) {
			$this_value = ((int)$row["total"]) ? ("about ".((int)($row["total"]/10)+1)*10) : ("0");
			$sql = "UPDATE ItemStatistic SET value = '".$this_value."' WHERE name = 'b_active'";
			$result = mysql_query($sql, $link);
			if (mysql_affected_rows() <= 0) {
				$sql = "INSERT INTO ItemStatistic (value, name) VALUES ('".$this_value."', 'b_active')";
				$result = mysql_query($sql, $link);
			}
		}
	}
	$sql = "SELECT COUNT(*) AS total FROM Banner WHERE status = 'S'";
	$result = mysql_query($sql, $link);
	if ($result) {
		if ($row = mysql_fetch_assoc($result)) {
			$this_value = ((int)$row["total"]) ? ("about ".((int)($row["total"]/10)+1)*10) : ("0");
			$sql = "UPDATE ItemStatistic SET value = '".$this_value."' WHERE name = 'b_suspended'";
			$result = mysql_query($sql, $link);
			if (mysql_affected_rows() <= 0) {
				$sql = "INSERT INTO ItemStatistic (value, name) VALUES ('".$this_value."', 'b_suspended')";
				$result = mysql_query($sql, $link);
			}
		}
	}
	$sql = "SELECT COUNT(*) AS total from Banner WHERE entered >= '".date("Y-m-d", mktime(0, 0, 0, date("m")-1 , date("d"), date("Y")))."'";
	$result = mysql_query($sql, $link);
	if ($result) {
		if ($row = mysql_fetch_assoc($result)) {
			$this_value = ((int)$row["total"]) ? ("about ".((int)($row["total"]/10)+1)*10) : ("0");
			$sql = "UPDATE ItemStatistic SET value = '".$this_value."' WHERE name = 'b_added30'";
			$result = mysql_query($sql, $link);
			if (mysql_affected_rows() <= 0) {
				$sql = "INSERT INTO ItemStatistic (value, name) VALUES ('".$this_value."', 'b_added30')";
				$result = mysql_query($sql, $link);
			}
		}
	}
	////////////////////////////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////////////////////////////
	$sql = "SELECT COUNT(*) AS total FROM Classified WHERE status = 'P'";
	$result = mysql_query($sql, $link);
	if ($result) {
		if ($row = mysql_fetch_assoc($result)) {
			$this_value = ((int)$row["total"]) ? ("about ".((int)($row["total"]/10)+1)*10) : ("0");
			$sql = "UPDATE ItemStatistic SET value = '".$this_value."' WHERE name = 'c_pending'";
			$result = mysql_query($sql, $link);
			if (mysql_affected_rows() <= 0) {
				$sql = "INSERT INTO ItemStatistic (value, name) VALUES ('".$this_value."', 'c_pending')";
				$result = mysql_query($sql, $link);
			}
		}
	}
	$sql = "SELECT COUNT(*) AS total FROM Classified WHERE renewal_date > NOW() AND renewal_date <= DATE_ADD(NOW(), INTERVAL ".DEFAULT_CLASSIFIED_DAYS_TO_EXPIRE." DAY)";
	$result = mysql_query($sql, $link);
	if ($result) {
		if ($row = mysql_fetch_assoc($result)) {
			$this_value = ((int)$row["total"]) ? ("about ".((int)($row["total"]/10)+1)*10) : ("0");
			$sql = "UPDATE ItemStatistic SET value = '".$this_value."' WHERE name = 'c_expiring'";
			$result = mysql_query($sql, $link);
			if (mysql_affected_rows() <= 0) {
				$sql = "INSERT INTO ItemStatistic (value, name) VALUES ('".$this_value."', 'c_expiring')";
				$result = mysql_query($sql, $link);
			}
		}
	}
	$sql = "SELECT COUNT(*) AS total FROM Classified WHERE status = 'E'";
	$result = mysql_query($sql, $link);
	if ($result) {
		if ($row = mysql_fetch_assoc($result)) {
			$this_value = ((int)$row["total"]) ? ("about ".((int)($row["total"]/10)+1)*10) : ("0");
			$sql = "UPDATE ItemStatistic SET value = '".$this_value."' WHERE name = 'c_expired'";
			$result = mysql_query($sql, $link);
			if (mysql_affected_rows() <= 0) {
				$sql = "INSERT INTO ItemStatistic (value, name) VALUES ('".$this_value."', 'c_expired')";
				$result = mysql_query($sql, $link);
			}
		}
	}
	$sql = "SELECT COUNT(*) AS total FROM Classified WHERE status = 'A'";
	$result = mysql_query($sql, $link);
	if ($result) {
		if ($row = mysql_fetch_assoc($result)) {
			$this_value = ((int)$row["total"]) ? ("about ".((int)($row["total"]/10)+1)*10) : ("0");
			$sql = "UPDATE ItemStatistic SET value = '".$this_value."' WHERE name = 'c_active'";
			$result = mysql_query($sql, $link);
			if (mysql_affected_rows() <= 0) {
				$sql = "INSERT INTO ItemStatistic (value, name) VALUES ('".$this_value."', 'c_active')";
				$result = mysql_query($sql, $link);
			}
		}
	}
	$sql = "SELECT COUNT(*) AS total FROM Classified WHERE status = 'S'";
	$result = mysql_query($sql, $link);
	if ($result) {
		if ($row = mysql_fetch_assoc($result)) {
			$this_value = ((int)$row["total"]) ? ("about ".((int)($row["total"]/10)+1)*10) : ("0");
			$sql = "UPDATE ItemStatistic SET value = '".$this_value."' WHERE name = 'c_suspended'";
			$result = mysql_query($sql, $link);
			if (mysql_affected_rows() <= 0) {
				$sql = "INSERT INTO ItemStatistic (value, name) VALUES ('".$this_value."', 'c_suspended')";
				$result = mysql_query($sql, $link);
			}
		}
	}
	$sql = "SELECT COUNT(*) AS total from Classified WHERE entered >= '".date("Y-m-d", mktime(0, 0, 0, date("m")-1 , date("d"), date("Y")))."'";
	$result = mysql_query($sql, $link);
	if ($result) {
		if ($row = mysql_fetch_assoc($result)) {
			$this_value = ((int)$row["total"]) ? ("about ".((int)($row["total"]/10)+1)*10) : ("0");
			$sql = "UPDATE ItemStatistic SET value = '".$this_value."' WHERE name = 'c_added30'";
			$result = mysql_query($sql, $link);
			if (mysql_affected_rows() <= 0) {
				$sql = "INSERT INTO ItemStatistic (value, name) VALUES ('".$this_value."', 'c_added30')";
				$result = mysql_query($sql, $link);
			}
		}
	}
	////////////////////////////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////////////////////////////
	$sql = "SELECT COUNT(*) AS total FROM Article WHERE status = 'P'";
	$result = mysql_query($sql, $link);
	if ($result) {
		if ($row = mysql_fetch_assoc($result)) {
			$this_value = ((int)$row["total"]) ? ("about ".((int)($row["total"]/10)+1)*10) : ("0");
			$sql = "UPDATE ItemStatistic SET value = '".$this_value."' WHERE name = 'a_pending'";
			$result = mysql_query($sql, $link);
			if (mysql_affected_rows() <= 0) {
				$sql = "INSERT INTO ItemStatistic (value, name) VALUES ('".$this_value."', 'a_pending')";
				$result = mysql_query($sql, $link);
			}
		}
	}
	$sql = "SELECT COUNT(*) AS total FROM Article WHERE renewal_date > NOW() AND renewal_date <= DATE_ADD(NOW(), INTERVAL ".DEFAULT_ARTICLE_DAYS_TO_EXPIRE." DAY)";
	$result = mysql_query($sql, $link);
	if ($result) {
		if ($row = mysql_fetch_assoc($result)) {
			$this_value = ((int)$row["total"]) ? ("about ".((int)($row["total"]/10)+1)*10) : ("0");
			$sql = "UPDATE ItemStatistic SET value = '".$this_value."' WHERE name = 'a_expiring'";
			$result = mysql_query($sql, $link);
			if (mysql_affected_rows() <= 0) {
				$sql = "INSERT INTO ItemStatistic (value, name) VALUES ('".$this_value."', 'a_expiring')";
				$result = mysql_query($sql, $link);
			}
		}
	}
	$sql = "SELECT COUNT(*) AS total FROM Article WHERE status = 'E'";
	$result = mysql_query($sql, $link);
	if ($result) {
		if ($row = mysql_fetch_assoc($result)) {
			$this_value = ((int)$row["total"]) ? ("about ".((int)($row["total"]/10)+1)*10) : ("0");
			$sql = "UPDATE ItemStatistic SET value = '".$this_value."' WHERE name = 'a_expired'";
			$result = mysql_query($sql, $link);
			if (mysql_affected_rows() <= 0) {
				$sql = "INSERT INTO ItemStatistic (value, name) VALUES ('".$this_value."', 'a_expired')";
				$result = mysql_query($sql, $link);
			}
		}
	}
	$sql = "SELECT COUNT(*) AS total FROM Article WHERE status = 'A'";
	$result = mysql_query($sql, $link);
	if ($result) {
		if ($row = mysql_fetch_assoc($result)) {
			$this_value = ((int)$row["total"]) ? ("about ".((int)($row["total"]/10)+1)*10) : ("0");
			$sql = "UPDATE ItemStatistic SET value = '".$this_value."' WHERE name = 'a_active'";
			$result = mysql_query($sql, $link);
			if (mysql_affected_rows() <= 0) {
				$sql = "INSERT INTO ItemStatistic (value, name) VALUES ('".$this_value."', 'a_active')";
				$result = mysql_query($sql, $link);
			}
		}
	}
	$sql = "SELECT COUNT(*) AS total FROM Article WHERE status = 'S'";
	$result = mysql_query($sql, $link);
	if ($result) {
		if ($row = mysql_fetch_assoc($result)) {
			$this_value = ((int)$row["total"]) ? ("about ".((int)($row["total"]/10)+1)*10) : ("0");
			$sql = "UPDATE ItemStatistic SET value = '".$this_value."' WHERE name = 'a_suspended'";
			$result = mysql_query($sql, $link);
			if (mysql_affected_rows() <= 0) {
				$sql = "INSERT INTO ItemStatistic (value, name) VALUES ('".$this_value."', 'a_suspended')";
				$result = mysql_query($sql, $link);
			}
		}
	}
	$sql = "SELECT COUNT(*) AS total from Article WHERE entered >= '".date("Y-m-d", mktime(0, 0, 0, date("m")-1 , date("d"), date("Y")))."'";
	$result = mysql_query($sql, $link);
	if ($result) {
		if ($row = mysql_fetch_assoc($result)) {
			$this_value = ((int)$row["total"]) ? ("about ".((int)($row["total"]/10)+1)*10) : ("0");
			$sql = "UPDATE ItemStatistic SET value = '".$this_value."' WHERE name = 'a_added30'";
			$result = mysql_query($sql, $link);
			if (mysql_affected_rows() <= 0) {
				$sql = "INSERT INTO ItemStatistic (value, name) VALUES ('".$this_value."', 'a_added30')";
				$result = mysql_query($sql, $link);
			}
		}
	}
	////////////////////////////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////////////////////////////
	$time_end = getmicrotime();
	$time = $time_end - $time_start;
	print "Daily maintenance - ".date("Y-m-d H:i:s")." - ".round($time, 2)." seconds.\n";
	if (!setting_set("last_datetime_dailymaintenance", date("Y-m-d H:i:s"))) {
		if (!setting_new("last_datetime_dailymaintenance", date("Y-m-d H:i:s"))) {
			print "last_datetime_dailymaintenance error - ".date("Y-m-d H:i:s")."\n";
		}
	}
	////////////////////////////////////////////////////////////////////////////////////////////////////

?>
