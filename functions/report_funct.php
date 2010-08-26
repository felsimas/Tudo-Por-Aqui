<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /functions/report_funct.php
	# ----------------------------------------------------------------------------------------------------
	function report_newRecord($item_name, $item_id, $report_type) {
		$dbObj = db_getDBObject();
		$sql = "UPDATE Report_".ucwords($item_name)." SET report_amount = report_amount + 1 WHERE ".$item_name."_id = ".db_formatNumber($item_id)." AND report_type = ".db_formatNumber($report_type)." AND DATE_FORMAT(date, '%Y-%m-%d') = DATE_FORMAT(NOW(), '%Y-%m-%d')";
		$dbObj->query($sql);
		if (!mysql_affected_rows()) {
			$sql = "INSERT INTO Report_".ucwords($item_name)." (".$item_name."_id, report_type, report_amount, date) VALUES (".db_formatNumber($item_id).", ".db_formatNumber($report_type).", 1, NOW())";
			$dbObj->query($sql);
		}
	}

    # ----------------------------------------------------------------------------------------------------
    # PERIOD REPORT
    # ----------------------------------------------------------------------------------------------------
    function reportPeriod($data = array()) {
        $keys = array_keys($data);
        list($year2, $month2) = explode('-', $keys[0]);
        list($year1, $month1) = explode('-', $keys[count($keys)-1]);
        return "<strong>" . system_showText(LANG_LABEL_FROM) . "</strong> " . system_showDate('F', mktime(0, 0, 0, $month1, 1, $year1)) . " / " . $year1 . " <strong> " .  system_showText(LANG_LABEL_DATE_TO) . " </strong> " .  system_showDate('F', mktime(0, 0, 0, $month2, 1, $year2)) . " / " . $year2;
    }

	# ----------------------------------------------------------------------------------------------------
	# LISTING REPORTS
	# ----------------------------------------------------------------------------------------------------
    function retrieveListingReport($idIn = 0) {
        $dbObj = db_getDBObject();
        $data = array();

        /* empty */
        $period = date('Y') . '-' . date('n');
        $data[$period]['summary'] = 0;
        $data[$period]['detail']  = 0;
        $data[$period]['click']   = 0;
        $data[$period]['email']   = 0;
        $data[$period]['phone']   = 0;
        $data[$period]['fax']     = 0;

        /* today */
        $sql = "SELECT CONCAT(YEAR(date) , '-', MONTH(date)) AS period, `report_type` , SUM(`report_amount`) AS amount FROM `Report_Listing` WHERE `listing_id` = " . db_formatNumber($idIn) . " GROUP BY period, `report_type`";
        $result = $dbObj->query($sql);
        while($row = mysql_fetch_array($result)) {
            if($row['report_type'] == 1) $data[$row['period']]['summary'] += $row['amount'];
            if($row['report_type'] == 2) $data[$row['period']]['detail']  += $row['amount'];
            if($row['report_type'] == 3) $data[$row['period']]['click']   += $row['amount'];
            if($row['report_type'] == 4) $data[$row['period']]['email']   += $row['amount'];
            if($row['report_type'] == 5) $data[$row['period']]['phone']   += $row['amount'];
            if($row['report_type'] == 6) $data[$row['period']]['fax']     += $row['amount'];
        }

        /* daily */
        $sql = "SELECT CONCAT(YEAR(day), '-', MONTH(day)) AS period, SUM(summary_view) AS summary, SUM(detail_view) AS detail, SUM(click_thru) AS click, SUM(email_sent) AS email, SUM(phone_view) AS phone, SUM(fax_view) AS fax FROM Report_Listing_Daily WHERE listing_id = " . db_formatNumber($idIn) . " GROUP BY period";
        $result = $dbObj->query($sql);
        while($row = mysql_fetch_array($result)) {
            $data[$row['period']]['summary'] += $row['summary'];
            $data[$row['period']]['detail']  += $row['detail'];
            $data[$row['period']]['click']   += $row['click'];
            $data[$row['period']]['email']   += $row['email'];
            $data[$row['period']]['phone']   += $row['phone'];
            $data[$row['period']]['fax']     += $row['fax'];
        }

        /* monthly */
        $sql = "SELECT CONCAT(YEAR(day), '-', MONTH(day)) AS period, SUM(summary_view) AS summary, SUM(detail_view) AS detail, SUM(click_thru) AS click, SUM(email_sent) AS email, SUM(phone_view) AS phone, SUM(fax_view) AS fax FROM Report_Listing_Monthly WHERE listing_id = " . db_formatNumber($idIn) . " GROUP BY period ORDER BY day DESC";
        $result = $dbObj->query($sql);
        while($row = mysql_fetch_array($result)) {
            $data[$row['period']]['summary'] = $row['summary'];
            $data[$row['period']]['detail']  = $row['detail'];
            $data[$row['period']]['click']   = $row['click'];
            $data[$row['period']]['email']   = $row['email'];
            $data[$row['period']]['phone']   = $row['phone'];
            $data[$row['period']]['fax']     = $row['fax'];
        }
        return $data;
    }

	# ----------------------------------------------------------------------------------------------------
	# EVENT REPORTS
	# ----------------------------------------------------------------------------------------------------
    function retrieveEventReport($idIn = 0) {
        $dbObj = db_getDBObject();
        $data = array();

        /* empty */
        $period = date('Y') . '-' . date('n');
        $data[$period]['summary'] = 0;
        $data[$period]['detail']  = 0;

        /* today */
        $sql = "SELECT CONCAT(YEAR(date) , '-', MONTH(date)) AS period, `report_type` , SUM(`report_amount`) AS amount FROM `Report_Event` WHERE `event_id` = " . db_formatNumber($idIn) . " GROUP BY period, `report_type`";
        $result = $dbObj->query($sql);
        while($row = mysql_fetch_array($result)) {
            if($row['report_type'] == 1) $data[$row['period']]['summary'] += $row['amount'];
            if($row['report_type'] == 2) $data[$row['period']]['detail']  += $row['amount'];
        }

        /* daily */
        $sql = "SELECT CONCAT(YEAR(day), '-', MONTH(day)) AS period, SUM(summary_view) AS summary, SUM(detail_view) AS detail FROM Report_Event_Daily WHERE event_id = " . db_formatNumber($idIn) . " GROUP BY period";
        $result = $dbObj->query($sql);
        while($row = mysql_fetch_array($result)) {
            $data[$row['period']]['summary'] += $row['summary'];
            $data[$row['period']]['detail']  += $row['detail'];
        }

        /* monthly */
        $sql = "SELECT CONCAT(YEAR(day), '-', MONTH(day)) AS period, SUM(summary_view) AS summary, SUM(detail_view) AS detail FROM Report_Event_Monthly WHERE event_id = " . db_formatNumber($idIn) . " GROUP BY period ORDER BY day DESC";
        $result = $dbObj->query($sql);
        while($row = mysql_fetch_array($result)) {
            $data[$row['period']]['summary'] = $row['summary'];
            $data[$row['period']]['detail']  = $row['detail'];
        }
        return $data;
    }

	# ----------------------------------------------------------------------------------------------------
	# BANNER REPORTS
	# ----------------------------------------------------------------------------------------------------
    function retrieveBannerReport($idIn = 0) {
        $dbObj = db_getDBObject();
        $data = array();
        
        /* empty */
        $period = date('Y') . '-' . date('n');
        $data[$period]['view'] = 0;
        $data[$period]['click_thru']  = 0;

        /* today */
        $sql = "SELECT CONCAT(YEAR(date) , '-', MONTH(date)) AS period, `report_type` , SUM(`report_amount`) AS amount FROM `Report_Banner` WHERE `banner_id` = " . db_formatNumber($idIn) . " GROUP BY period, `report_type`";
        $result = $dbObj->query($sql);
        while($row = mysql_fetch_array($result)) {
            if($row['report_type'] == 2) $data[$row['period']]['view']        += $row['amount'];
            if($row['report_type'] == 1) $data[$row['period']]['click_thru']  += $row['amount'];
        }

        /* daily */
        $sql = "SELECT CONCAT(YEAR(day), '-', MONTH(day)) AS period, SUM(view) AS view, SUM(click_thru) AS click_thru FROM Report_Banner_Daily WHERE banner_id = " . db_formatNumber($idIn) . " GROUP BY period";
        $result = $dbObj->query($sql);
        while($row = mysql_fetch_array($result)) {
            $data[$row['period']]['view']        += $row['view'];
            $data[$row['period']]['click_thru']  += $row['click_thru'];
        }

        /* monthly */
        $sql = "SELECT CONCAT(YEAR(day), '-', MONTH(day)) AS period, SUM(view) AS view, SUM(click_thru) AS click_thru FROM Report_Banner_Monthly WHERE banner_id = " . db_formatNumber($idIn) . " GROUP BY period ORDER BY day DESC";
        $result = $dbObj->query($sql);
        while($row = mysql_fetch_array($result)) {
            $data[$row['period']]['view'] = $row['view'];
            $data[$row['period']]['click_thru']  = $row['click_thru'];
        }
        return $data;
    }

	# ----------------------------------------------------------------------------------------------------
	# CLASSIFIED REPORTS
	# ----------------------------------------------------------------------------------------------------
    function retrieveClassifiedReport($idIn = 0) {
        $dbObj = db_getDBObject();
        $data = array();

        /* empty */
        $period = date('Y') . '-' . date('n');
        $data[$period]['summary'] = 0;
        $data[$period]['detail']  = 0;

        /* today */
        $sql = "SELECT CONCAT(YEAR(date) , '-', MONTH(date)) AS period, `report_type` , SUM(`report_amount`) AS amount FROM `Report_Classified` WHERE `classified_id` = " . db_formatNumber($idIn) . " GROUP BY period, `report_type`";
        $result = $dbObj->query($sql);
        while($row = mysql_fetch_array($result)) {
            if($row['report_type'] == 1) $data[$row['period']]['summary'] += $row['amount'];
            if($row['report_type'] == 2) $data[$row['period']]['detail']  += $row['amount'];
        }
        
        /* daily */
        $sql = "SELECT CONCAT(YEAR(day), '-', MONTH(day)) AS period, SUM(summary_view) AS summary, SUM(detail_view) AS detail FROM Report_Classified_Daily WHERE classified_id = " . db_formatNumber($idIn) . " GROUP BY period";
        $result = $dbObj->query($sql);
        while($row = mysql_fetch_array($result)) {
            $data[$row['period']]['summary'] += $row['summary'];
            $data[$row['period']]['detail']  += $row['detail'];
        }

        /* monthly */
        $sql = "SELECT CONCAT(YEAR(day), '-', MONTH(day)) AS period, SUM(summary_view) AS summary, SUM(detail_view) AS detail FROM Report_Classified_Monthly WHERE classified_id = " . db_formatNumber($idIn) . " GROUP BY period ORDER BY day DESC";
        $result = $dbObj->query($sql);
        while($row = mysql_fetch_array($result)) {
            $data[$row['period']]['summary'] = $row['summary'];
            $data[$row['period']]['detail']  = $row['detail'];
        }
        return $data;
    }

	# ----------------------------------------------------------------------------------------------------
	# ARTICLE REPORTS
	# ----------------------------------------------------------------------------------------------------
    function retrieveArticleReport($idIn = 0) {
        $dbObj = db_getDBObject();
        $data = array();

        /* empty */
        $period = date('Y') . '-' . date('n');
        $data[$period]['summary'] = 0;
        $data[$period]['detail']  = 0;

        /* today */
        $sql = "SELECT CONCAT(YEAR(date) , '-', MONTH(date)) AS period, `report_type` , SUM(`report_amount`) AS amount FROM `Report_Article` WHERE `article_id` = " . db_formatNumber($idIn) . " GROUP BY period, `report_type`";
        $result = $dbObj->query($sql);
        while($row = mysql_fetch_array($result)) {
            if($row['report_type'] == 1) $data[$row['period']]['summary'] += $row['amount'];
            if($row['report_type'] == 2) $data[$row['period']]['detail']  += $row['amount'];
        }
        
        /* daily */
        $sql = "SELECT CONCAT(YEAR(day), '-', MONTH(day)) AS period, SUM(summary_view) AS summary, SUM(detail_view) AS detail FROM Report_Article_Daily WHERE article_id = " . db_formatNumber($idIn) . " GROUP BY period";
        $result = $dbObj->query($sql);
        while($row = mysql_fetch_array($result)) {
            $data[$row['period']]['summary'] += $row['summary'];
            $data[$row['period']]['detail']  += $row['detail'];
        }

        /* monthly */
        $sql = "SELECT CONCAT(YEAR(day), '-', MONTH(day)) AS period, SUM(summary_view) AS summary, SUM(detail_view) AS detail FROM Report_Article_Monthly WHERE article_id = " . db_formatNumber($idIn) . " GROUP BY period ORDER BY day DESC";
        $result = $dbObj->query($sql);
        while($row = mysql_fetch_array($result)) {
            $data[$row['period']]['summary'] = $row['summary'];
            $data[$row['period']]['detail']  = $row['detail'];
        }
        return $data;
    }
?>