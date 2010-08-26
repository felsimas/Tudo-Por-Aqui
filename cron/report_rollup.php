#!/usr/bin/php -q
<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /cron/report_rollup.php
	# ----------------------------------------------------------------------------------------------------

	////////////////////////////////////////////////////////////////////////////////////////////////////
	// Reports:
	// - Article
	// - Banner
	// - Classified
	// - Event
	// - Listing
	////////////////////////////////////////////////////////////////////////////////////////////////////

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
	@include_once(PATH."/classes/class_setting.php");
	@include_once(PATH."/functions/db_funct.php");
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
	setting_get("last_report_rollup", $last_report_rollup);
	if (!$last_report_rollup) {
		if (!setting_set("last_report_rollup", "0000-00-00")) {
			setting_new("last_report_rollup", "0000-00-00");
			setting_get("last_report_rollup", $last_report_rollup);
		}
	}
	////////////////////////////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////////////////////////////
	// Ddaily rollup
	////////////////////////////////////////////////////////////////////////////////////////////////////
	if (($last_report_rollup == "0000-00-00") || ($last_report_rollup < date("Y-m-d"))) {

		# ----------------------------------------------------------------------------------------------------
		# ARTICLE
		# ----------------------------------------------------------------------------------------------------
		if ($last_report_rollup != "0000-00-00") {
			$from_date = $last_report_rollup;
		} else {
			$sql = "SELECT min(date) FROM Report_Article";
			$result = mysql_query($sql, $link);
			if (mysql_num_rows($result) > 0) {
				$row = mysql_fetch_array($result);
				$from_date = substr($row[0], 0, strpos($row[0], " "));
			} else {
				$from_date = date("Y-m-d");
			}
		}
		if (!$from_date) $from_date = date("Y-m-d");
		$to_date = date("Y-m-d");
		while ($from_date < $to_date) {
			$sql = "SELECT article_id FROM Report_Article WHERE DATE_FORMAT(date, '%Y-%m-%d') = '".$from_date."' ORDER BY article_id";
			$result = mysql_query($sql, $link);
			if (mysql_num_rows($result) > 0) {
				while ($row = mysql_fetch_array($result)) {

					$sqlAux = "SELECT report_amount FROM Report_Article WHERE article_id = '".$row[0]."' AND report_type = '".ARTICLE_REPORT_SUMMARY_VIEW."' AND DATE_FORMAT(date, '%Y-%m-%d') = '".$from_date."'";
					$resultAux = mysql_query($sqlAux, $link);
					$rowAux = mysql_fetch_array($resultAux);
					$summary_view = (int)$rowAux["report_amount"];

					$sqlAux = "SELECT report_amount FROM Report_Article WHERE article_id = '".$row[0]."' AND report_type = '".ARTICLE_REPORT_DETAIL_VIEW."' AND DATE_FORMAT(date, '%Y-%m-%d') = '".$from_date."'";
					$resultAux = mysql_query($sqlAux, $link);
					$rowAux = mysql_fetch_array($resultAux);
					$detail_view = (int)$rowAux["report_amount"];

					$sql = "INSERT INTO Report_Article_Daily (article_id, day, summary_view, detail_view) VALUES ('".$row[0]."', '".$from_date."', ".$summary_view.", ".$detail_view.")";
					mysql_query($sql, $link);

				}
			}
			$from_date = explode("-", $from_date);
			$from_date = date("Y-m-d", mktime(0, 0, 0, (int)$from_date[1], (int)$from_date[2]+1, (int)$from_date[0]));
		}

		# ----------------------------------------------------------------------------------------------------
		# BANNER
		# ----------------------------------------------------------------------------------------------------
		if ($last_report_rollup != "0000-00-00") {
			$from_date = $last_report_rollup;
		} else {
			$sql = "SELECT min(date) FROM Report_Banner";
			$result = mysql_query($sql, $link);
			if (mysql_num_rows($result) > 0) {
				$row = mysql_fetch_array($result);
				$from_date = substr($row[0], 0, strpos($row[0], " "));
			} else {
				$from_date = date("Y-m-d");
			}
		}
		if (!$from_date) $from_date = date("Y-m-d");
		$to_date = date("Y-m-d");
		while ($from_date < $to_date) {
			$sql = "SELECT banner_id FROM Report_Banner WHERE DATE_FORMAT(date, '%Y-%m-%d') = '".$from_date."' ORDER BY banner_id";
			$result = mysql_query($sql, $link);
			if (mysql_num_rows($result) > 0) {
				while ($row = mysql_fetch_array($result)) {

					$sqlAux = "SELECT report_amount FROM Report_Banner WHERE banner_id = '".$row[0]."' AND report_type = '".BANNER_REPORT_VIEW."' AND DATE_FORMAT(date, '%Y-%m-%d') = '".$from_date."'";
					$resultAux = mysql_query($sqlAux, $link);
					$rowAux = mysql_fetch_array($resultAux);
					$view = (int)$rowAux["report_amount"];

					$sqlAux = "SELECT report_amount FROM Report_Banner WHERE banner_id = '".$row[0]."' AND report_type = '".BANNER_REPORT_CLICK_THRU."' AND DATE_FORMAT(date, '%Y-%m-%d') = '".$from_date."'";
					$resultAux = mysql_query($sqlAux, $link);
					$rowAux = mysql_fetch_array($resultAux);
					$click_thru = (int)$rowAux["report_amount"];

					$sql = "INSERT INTO Report_Banner_Daily (banner_id, day, view, click_thru) VALUES ('".$row[0]."', '".$from_date."', ".$view.", ".$click_thru.")";
					//mysql_query($sql, $link);

				}
			}
			$from_date = explode("-", $from_date);
			$from_date = date("Y-m-d", mktime(0, 0, 0, (int)$from_date[1], (int)$from_date[2]+1, (int)$from_date[0]));
		}

		# ----------------------------------------------------------------------------------------------------
		# CLASSIFIED
		# ----------------------------------------------------------------------------------------------------
		if ($last_report_rollup != "0000-00-00") {
			$from_date = $last_report_rollup;
		} else {
			$sql = "SELECT min(date) FROM Report_Classified";
			$result = mysql_query($sql, $link);
			if (mysql_num_rows($result) > 0) {
				$row = mysql_fetch_array($result);
				$from_date = substr($row[0], 0, strpos($row[0], " "));
			} else {
				$from_date = date("Y-m-d");
			}
		}
		if (!$from_date) $from_date = date("Y-m-d");
		$to_date = date("Y-m-d");
		while ($from_date < $to_date) {
			$sql = "SELECT classified_id FROM Report_Classified WHERE DATE_FORMAT(date, '%Y-%m-%d') = '".$from_date."' ORDER BY classified_id";
			$result = mysql_query($sql, $link);
			if (mysql_num_rows($result) > 0) {
				while ($row = mysql_fetch_array($result)) {

					$sqlAux = "SELECT report_amount FROM Report_Classified WHERE classified_id = '".$row[0]."' AND report_type = '".CLASSIFIED_REPORT_SUMMARY_VIEW."' AND DATE_FORMAT(date, '%Y-%m-%d') = '".$from_date."'";
					$resultAux = mysql_query($sqlAux, $link);
					$rowAux = mysql_fetch_array($resultAux);
					$summary_view = (int)$rowAux["report_amount"];

					$sqlAux = "SELECT report_amount FROM Report_Classified WHERE classified_id = '".$row[0]."' AND report_type = '".CLASSIFIED_REPORT_DETAIL_VIEW."' AND DATE_FORMAT(date, '%Y-%m-%d') = '".$from_date."'";
					$resultAux = mysql_query($sqlAux, $link);
					$rowAux = mysql_fetch_array($resultAux);
					$detail_view = (int)$rowAux["report_amount"];

					$sql = "INSERT INTO Report_Classified_Daily (classified_id, day, summary_view, detail_view) VALUES ('".$row[0]."', '".$from_date."', ".$summary_view.", ".$detail_view.")";
					mysql_query($sql, $link);

				}
			}
			$from_date = explode("-", $from_date);
			$from_date = date("Y-m-d", mktime(0, 0, 0, (int)$from_date[1], (int)$from_date[2]+1, (int)$from_date[0]));
		}

		# ----------------------------------------------------------------------------------------------------
		# EVENT
		# ----------------------------------------------------------------------------------------------------
		if ($last_report_rollup != "0000-00-00") {
			$from_date = $last_report_rollup;
		} else {
			$sql = "SELECT min(date) FROM Report_Event";
			$result = mysql_query($sql, $link);
			if (mysql_num_rows($result) > 0) {
				$row = mysql_fetch_array($result);
				$from_date = substr($row[0], 0, strpos($row[0], " "));
			} else {
				$from_date = date("Y-m-d");
			}
		}
		if (!$from_date) $from_date = date("Y-m-d");
		$to_date = date("Y-m-d");
		while ($from_date < $to_date) {
			$sql = "SELECT event_id FROM Report_Event WHERE DATE_FORMAT(date, '%Y-%m-%d') = '".$from_date."' ORDER BY event_id";
			$result = mysql_query($sql, $link);
			if (mysql_num_rows($result) > 0) {
				while ($row = mysql_fetch_array($result)) {

					$sqlAux = "SELECT report_amount FROM Report_Event WHERE event_id = '".$row[0]."' AND report_type = '".EVENT_REPORT_SUMMARY_VIEW."' AND DATE_FORMAT(date, '%Y-%m-%d') = '".$from_date."'";
					$resultAux = mysql_query($sqlAux, $link);
					$rowAux = mysql_fetch_array($resultAux);
					$summary_view = (int)$rowAux["report_amount"];

					$sqlAux = "SELECT report_amount FROM Report_Event WHERE event_id = '".$row[0]."' AND report_type = '".EVENT_REPORT_DETAIL_VIEW."' AND DATE_FORMAT(date, '%Y-%m-%d') = '".$from_date."'";
					$resultAux = mysql_query($sqlAux, $link);
					$rowAux = mysql_fetch_array($resultAux);
					$detail_view = (int)$rowAux["report_amount"];

					$sql = "INSERT INTO Report_Event_Daily (event_id, day, summary_view, detail_view) VALUES ('".$row[0]."', '".$from_date."', ".$summary_view.", ".$detail_view.")";
					mysql_query($sql, $link);

				}
			}
			$from_date = explode("-", $from_date);
			$from_date = date("Y-m-d", mktime(0, 0, 0, (int)$from_date[1], (int)$from_date[2]+1, (int)$from_date[0]));
		}

		# ----------------------------------------------------------------------------------------------------
		# LISTING
		# ----------------------------------------------------------------------------------------------------
		if ($last_report_rollup != "0000-00-00") {
			$from_date = $last_report_rollup;
		} else {
			$sql = "SELECT min(date) FROM Report_Listing";
			$result = mysql_query($sql, $link);
			if (mysql_num_rows($result) > 0) {
				$row = mysql_fetch_array($result);
				$from_date = substr($row[0], 0, strpos($row[0], " "));
			} else {
				$from_date = date("Y-m-d");
			}
		}
		if (!$from_date) $from_date = date("Y-m-d");
		$to_date = date("Y-m-d");
		while ($from_date < $to_date) {
			$sql = "SELECT listing_id FROM Report_Listing WHERE DATE_FORMAT(date, '%Y-%m-%d') = '".$from_date."' ORDER BY listing_id";
			$result = mysql_query($sql, $link);
			if (mysql_num_rows($result) > 0) {
				while ($row = mysql_fetch_array($result)) {

					$sqlAux = "SELECT report_amount FROM Report_Listing WHERE listing_id = '".$row[0]."' AND report_type = '".LISTING_REPORT_SUMMARY_VIEW."' AND DATE_FORMAT(date, '%Y-%m-%d') = '".$from_date."'";
					$resultAux = mysql_query($sqlAux, $link);
					$rowAux = mysql_fetch_array($resultAux);
					$summary_view = (int)$rowAux["report_amount"];

					$sqlAux = "SELECT report_amount FROM Report_Listing WHERE listing_id = '".$row[0]."' AND report_type = '".LISTING_REPORT_DETAIL_VIEW."' AND DATE_FORMAT(date, '%Y-%m-%d') = '".$from_date."'";
					$resultAux = mysql_query($sqlAux, $link);
					$rowAux = mysql_fetch_array($resultAux);
					$detail_view = (int)$rowAux["report_amount"];

					$sqlAux = "SELECT report_amount FROM Report_Listing WHERE listing_id = '".$row[0]."' AND report_type = '".LISTING_REPORT_CLICK_THRU."' AND DATE_FORMAT(date, '%Y-%m-%d') = '".$from_date."'";
					$resultAux = mysql_query($sqlAux, $link);
					$rowAux = mysql_fetch_array($resultAux);
					$click_thru = (int)$rowAux["report_amount"];

					$sqlAux = "SELECT report_amount FROM Report_Listing WHERE listing_id = '".$row[0]."' AND report_type = '".LISTING_REPORT_EMAIL_SENT."' AND DATE_FORMAT(date, '%Y-%m-%d') = '".$from_date."'";
					$resultAux = mysql_query($sqlAux, $link);
					$rowAux = mysql_fetch_array($resultAux);
					$email_sent = (int)$rowAux["report_amount"];

					$sqlAux = "SELECT report_amount FROM Report_Listing WHERE listing_id = '".$row[0]."' AND report_type = '".LISTING_REPORT_PHONE_VIEW."' AND DATE_FORMAT(date, '%Y-%m-%d') = '".$from_date."'";
					$resultAux = mysql_query($sqlAux, $link);
					$rowAux = mysql_fetch_array($resultAux);
					$phone_view = (int)$rowAux["report_amount"];

					$sqlAux = "SELECT report_amount FROM Report_Listing WHERE listing_id = '".$row[0]."' AND report_type = '".LISTING_REPORT_FAX_VIEW."' AND DATE_FORMAT(date, '%Y-%m-%d') = '".$from_date."'";
					$resultAux = mysql_query($sqlAux, $link);
					$rowAux = mysql_fetch_array($resultAux);
					$fax_view = (int)$rowAux["report_amount"];

					$sql = "INSERT INTO Report_Listing_Daily (listing_id, day, summary_view, detail_view, click_thru, email_sent, phone_view, fax_view) VALUES ('".$row[0]."', '".$from_date."', ".$summary_view.", ".$detail_view.", ".$click_thru.", ".$email_sent.", ".$phone_view.", ".$fax_view.")";
					mysql_query($sql, $link);

				}
			}
			$from_date = explode("-", $from_date);
			$from_date = date("Y-m-d", mktime(0, 0, 0, (int)$from_date[1], (int)$from_date[2]+1, (int)$from_date[0]));
		}

	}
	////////////////////////////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////////////////////////////
	// Removing reports from deleted items
	////////////////////////////////////////////////////////////////////////////////////////////////////
	if (($last_report_rollup == "0000-00-00") || ($last_report_rollup < date("Y-m-d"))) {

		# ----------------------------------------------------------------------------------------------------
		# ARTICLE
		# ----------------------------------------------------------------------------------------------------
		$sql = "SELECT id FROM Article ORDER BY id";
		$result = mysql_query($sql, $link);
		if (mysql_num_rows($result) > 0) {
			while ($row = mysql_fetch_assoc($result)) {
				$article_id[] = $row["id"];
			}
		}
		if ($article_id) {
			$sql = "DELETE FROM Report_Article WHERE article_id NOT IN (".implode(",", $article_id).")";
			mysql_query($sql, $link);
			$sql = "DELETE FROM Report_Article_Daily WHERE article_id NOT IN (".implode(",", $article_id).")";
			mysql_query($sql, $link);
		} else {
			$sql = "DELETE FROM Report_Article";
			mysql_query($sql, $link);
			$sql = "DELETE FROM Report_Article_Daily";
			mysql_query($sql, $link);
		}

		# ----------------------------------------------------------------------------------------------------
		# BANNER
		# ----------------------------------------------------------------------------------------------------
		$sql = "SELECT id FROM Banner ORDER BY id";
		$result = mysql_query($sql, $link);
		if (mysql_num_rows($result) > 0) {
			while ($row = mysql_fetch_assoc($result)) {
				$banner_id[] = $row["id"];
			}
		}
		if ($banner_id) {
			$sql = "DELETE FROM Report_Banner WHERE banner_id NOT IN (".implode(",", $banner_id).")";
			mysql_query($sql, $link);
			$sql = "DELETE FROM Report_Banner_Daily WHERE banner_id NOT IN (".implode(",", $banner_id).")";
			mysql_query($sql, $link);
		} else {
			$sql = "DELETE FROM Report_Banner";
			mysql_query($sql, $link);
			$sql = "DELETE FROM Report_Banner_Daily";
			mysql_query($sql, $link);
		}

		# ----------------------------------------------------------------------------------------------------
		# CLASSIFIED
		# ----------------------------------------------------------------------------------------------------
		$sql = "SELECT id FROM Classified ORDER BY id";
		$result = mysql_query($sql, $link);
		if (mysql_num_rows($result) > 0) {
			while ($row = mysql_fetch_assoc($result)) {
				$classified_id[] = $row["id"];
			}
		}
		if ($classified_id) {
			$sql = "DELETE FROM Report_Classified WHERE classified_id NOT IN (".implode(",", $classified_id).")";
			mysql_query($sql, $link);
			$sql = "DELETE FROM Report_Classified_Daily WHERE classified_id NOT IN (".implode(",", $classified_id).")";
			mysql_query($sql, $link);
		} else {
			$sql = "DELETE FROM Report_Classified";
			mysql_query($sql, $link);
			$sql = "DELETE FROM Report_Classified_Daily";
			mysql_query($sql, $link);
		}

		# ----------------------------------------------------------------------------------------------------
		# EVENT
		# ----------------------------------------------------------------------------------------------------
		$sql = "SELECT id FROM Event ORDER BY id";
		$result = mysql_query($sql, $link);
		if (mysql_num_rows($result) > 0) {
			while ($row = mysql_fetch_assoc($result)) {
				$event_id[] = $row["id"];
			}
		}
		if ($event_id) {
			$sql = "DELETE FROM Report_Event WHERE event_id NOT IN (".implode(",", $event_id).")";
			mysql_query($sql, $link);
			$sql = "DELETE FROM Report_Event_Daily WHERE event_id NOT IN (".implode(",", $event_id).")";
			mysql_query($sql, $link);
		} else {
			$sql = "DELETE FROM Report_Event";
			mysql_query($sql, $link);
			$sql = "DELETE FROM Report_Event_Daily";
			mysql_query($sql, $link);
		}

		# ----------------------------------------------------------------------------------------------------
		# LISTING
		# ----------------------------------------------------------------------------------------------------
		$sql = "SELECT id FROM Listing ORDER BY id";
		$result = mysql_query($sql, $link);
		if (mysql_num_rows($result) > 0) {
			while ($row = mysql_fetch_assoc($result)) {
				$listing_id[] = $row["id"];
			}
		}
		if ($listing_id) {
			$sql = "DELETE FROM Report_Listing WHERE listing_id NOT IN (".implode(",", $listing_id).")";
			mysql_query($sql, $link);
			$sql = "DELETE FROM Report_Listing_Daily WHERE listing_id NOT IN (".implode(",", $listing_id).")";
			mysql_query($sql, $link);
		} else {
			$sql = "DELETE FROM Report_Listing";
			mysql_query($sql, $link);
			$sql = "DELETE FROM Report_Listing_Daily";
			mysql_query($sql, $link);
		}

	}
	////////////////////////////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////////////////////////////
	// Removing old reports
	////////////////////////////////////////////////////////////////////////////////////////////////////
	if (($last_report_rollup == "0000-00-00") || ($last_report_rollup < date("Y-m-d"))) {

		# ----------------------------------------------------------------------------------------------------
		# ARTICLE
		# ----------------------------------------------------------------------------------------------------
		$sql = "DELETE FROM Report_Article WHERE DATE_FORMAT(date, '%Y-%m-%d') <= DATE_FORMAT(DATE_SUB(NOW(), INTERVAL 1 DAY), '%Y-%m-%d')";
		mysql_query($sql, $link);

		# ----------------------------------------------------------------------------------------------------
		# BANNER
		# ----------------------------------------------------------------------------------------------------
		$sql = "DELETE FROM Report_Banner WHERE DATE_FORMAT(date, '%Y-%m-%d') <= DATE_FORMAT(DATE_SUB(NOW(), INTERVAL 1 DAY), '%Y-%m-%d')";
		mysql_query($sql, $link);

		# ----------------------------------------------------------------------------------------------------
		# CLASSIFIED
		# ----------------------------------------------------------------------------------------------------
		$sql = "DELETE FROM Report_Classified WHERE DATE_FORMAT(date, '%Y-%m-%d') <= DATE_FORMAT(DATE_SUB(NOW(), INTERVAL 1 DAY), '%Y-%m-%d')";
		mysql_query($sql, $link);

		# ----------------------------------------------------------------------------------------------------
		# EVENT
		# ----------------------------------------------------------------------------------------------------
		$sql = "DELETE FROM Report_Event WHERE DATE_FORMAT(date, '%Y-%m-%d') <= DATE_FORMAT(DATE_SUB(NOW(), INTERVAL 1 DAY), '%Y-%m-%d')";
		mysql_query($sql, $link);

		# ----------------------------------------------------------------------------------------------------
		# LISTING
		# ----------------------------------------------------------------------------------------------------
		$sql = "DELETE FROM Report_Listing WHERE DATE_FORMAT(date, '%Y-%m-%d') <= DATE_FORMAT(DATE_SUB(NOW(), INTERVAL 1 DAY), '%Y-%m-%d')";
		mysql_query($sql, $link);

	}
	////////////////////////////////////////////////////////////////////////////////////////////////////

    ////////////////////////////////////////////////////////////////////////////////////////////////////
    // Move completed months to Report_[module]_Monthly
    ////////////////////////////////////////////////////////////////////////////////////////////////////
    if (($last_report_rollup == "0000-00-00") || ($last_report_rollup < date("Y-m-d"))) {
        # ----------------------------------------------------------------------------------------------------
        # ARTICLE
        # ----------------------------------------------------------------------------------------------------
        $sql = "SELECT article_id , CONCAT(YEAR(day), '-' , MONTH(day), '-', '1') AS period , SUM(summary_view) AS summary , SUM(detail_view) AS detail FROM Report_Article_Daily WHERE ((MONTH(day) < MONTH(NOW()) AND YEAR(day) = YEAR(NOW())) OR (YEAR(day) < YEAR(NOW()))) GROUP BY article_id , period  ORDER BY day DESC";
        $results = mysql_query($sql, $link);
        while($row = mysql_fetch_array($results)) {
            $sqlInsert = "INSERT INTO Report_Article_Monthly VALUES (".$row['article_id'].",'".$row['period']."',".$row['summary'].",".$row['detail'].");";
            mysql_query($sqlInsert, $link);
        }
        $sqlDelete = "DELETE FROM Report_Article_Daily WHERE ((MONTH(day) < MONTH(NOW()) AND YEAR(day) = YEAR(NOW())) OR (YEAR(day) < YEAR(NOW())));";
        mysql_query($sqlDelete, $link);

        # ----------------------------------------------------------------------------------------------------
        # BANNER
        # ----------------------------------------------------------------------------------------------------
        $sql = "SELECT banner_id , CONCAT(YEAR(day), '-' , MONTH(day), '-', '1') AS period , SUM(view) AS view, SUM(click_thru) AS click FROM Report_Banner_Daily WHERE ((MONTH(day) < MONTH(NOW()) AND YEAR(day) = YEAR(NOW())) OR (YEAR(day) < YEAR(NOW()))) GROUP BY banner_id, period  ORDER BY day DESC";
        $results = mysql_query($sql, $link);
        while($row = mysql_fetch_array($results)) {
            $sqlInsert = "INSERT INTO Report_Banner_Monthly VALUES (".$row['banner_id'].",'".$row['period']."',".$row['view'].",".$row['click'].");";
            mysql_query($sqlInsert, $link);
        }
        $sqlDelete = "DELETE FROM Report_Banner_Daily WHERE ((MONTH(day) < MONTH(NOW()) AND YEAR(day) = YEAR(NOW())) OR (YEAR(day) < YEAR(NOW())));";
        mysql_query($sqlDelete, $link);

        # ----------------------------------------------------------------------------------------------------
        # CLASSIFIED
        # ----------------------------------------------------------------------------------------------------
        $sql = "SELECT classified_id , CONCAT(YEAR(day), '-' , MONTH(day), '-', '1') AS period , SUM(summary_view) AS summary , SUM(detail_view) AS detail FROM Report_Classified_Daily WHERE ((MONTH(day) < MONTH(NOW()) AND YEAR(day) = YEAR(NOW())) OR (YEAR(day) < YEAR(NOW()))) GROUP BY classified_id , period  ORDER BY day DESC";
        $results = mysql_query($sql, $link);
        while($row = mysql_fetch_array($results)) {
            $sqlInsert = "INSERT INTO Report_Classified_Monthly VALUES (".$row['classified_id'].",'".$row['period']."',".$row['summary'].",".$row['detail'].");";
            mysql_query($sqlInsert, $link);
        }
        $sqlDelete = "DELETE FROM Report_Classified_Daily WHERE ((MONTH(day) < MONTH(NOW()) AND YEAR(day) = YEAR(NOW())) OR (YEAR(day) < YEAR(NOW())));";
        mysql_query($sqlDelete, $link);
        
        # ----------------------------------------------------------------------------------------------------
        # EVENT
        # ----------------------------------------------------------------------------------------------------
        $sql = "SELECT event_id , CONCAT(YEAR(day), '-' , MONTH(day), '-', '1') AS period , SUM(summary_view) AS summary , SUM(detail_view) AS detail FROM Report_Event_Daily WHERE ((MONTH(day) < MONTH(NOW()) AND YEAR(day) = YEAR(NOW())) OR (YEAR(day) < YEAR(NOW()))) GROUP BY event_id , period  ORDER BY day DESC";
        $results = mysql_query($sql, $link);
        while($row = mysql_fetch_array($results)) {
            $sqlInsert = "INSERT INTO Report_Event_Monthly VALUES (".$row['event_id'].",'".$row['period']."',".$row['summary'].",".$row['detail'].");";
            mysql_query($sqlInsert, $link);
        }
        $sqlDelete = "DELETE FROM Report_Event_Daily WHERE ((MONTH(day) < MONTH(NOW()) AND YEAR(day) = YEAR(NOW())) OR (YEAR(day) < YEAR(NOW())));";
        mysql_query($sqlDelete, $link);
        
        # ----------------------------------------------------------------------------------------------------
        # LISTING
        # ----------------------------------------------------------------------------------------------------
        $sql = "SELECT listing_id , CONCAT(YEAR(day), '-' , MONTH(day), '-', '1') AS period , SUM(summary_view) AS summary , SUM(detail_view) AS detail , SUM(click_thru) AS click , SUM(email_sent) AS email , SUM(phone_view) AS phone , SUM(fax_view) AS fax FROM Report_Listing_Daily WHERE ((MONTH(day) < MONTH(NOW()) AND YEAR(day) = YEAR(NOW())) OR (YEAR(day) < YEAR(NOW()))) GROUP BY listing_id , period  ORDER BY day DESC";
        $results = mysql_query($sql, $link);
        while($row = mysql_fetch_array($results)) {
            $sqlInsert = "INSERT INTO Report_Listing_Monthly VALUES (".$row['listing_id'].",'".$row['period']."',".$row['summary'].",".$row['detail'].",".$row['click'].",".$row['email'].",".$row['phone'].",".$row['fax'].");";
            mysql_query($sqlInsert, $link);
        }
        $sqlDelete = "DELETE FROM Report_Listing_Daily WHERE ((MONTH(day) < MONTH(NOW()) AND YEAR(day) = YEAR(NOW())) OR (YEAR(day) < YEAR(NOW())));";
        mysql_query($sqlDelete, $link);
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////
    
	////////////////////////////////////////////////////////////////////////////////////////////////////
	setting_set("last_report_rollup", date("Y-m-d"));
	////////////////////////////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////////////////////////////
	$time_end = getmicrotime();
	$time = $time_end - $time_start;
	print "Report Rollup - ".date("Y-m-d H:i:s")." - ".round($time, 2)." seconds.\n";
	if (!setting_set("last_datetime_reportrollup", date("Y-m-d H:i:s"))) {
		if (!setting_new("last_datetime_reportrollup", date("Y-m-d H:i:s"))) {
			print "last_datetime_reportrollup error - ".date("Y-m-d H:i:s")."\n";
		}
	}
	////////////////////////////////////////////////////////////////////////////////////////////////////

?>