<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/code/email_generate.php
	# ----------------------------------------------------------------------------------------------------

	/*
	 * Current support is 16.777.216 emails
	 * (64K rows * 256 cols)
	**/

	if ($_SERVER['REQUEST_METHOD'] == "POST") {

		if ($_POST["eg"] == "all") {
			$sql = "SELECT DISTINCT(email) FROM Listing WHERE email != '' ORDER BY email";
			$listings = db_getFromDBBySQL("listing", $sql, "array");
		}

		if ($_POST["eg"] == "location") {
			if ($_POST["location"]) {
				list($fld_name, $fld_value) = split(":", $_POST["location"]);
				$sql = "SELECT DISTINCT(email) FROM Listing WHERE email != '' AND $fld_name = '$fld_value'";
				$listings = db_getFromDBBySQL("listing", $sql, "array");
			}
		}

		if ($_POST["eg"] == "category") {
			if ($_POST["category_id"]) {
				$sql = "SELECT id AS listing_id FROM Listing WHERE cat_1_id = {$_POST["category_id"]} OR parcat_1_level1_id = {$_POST["category_id"]} OR parcat_1_level2_id = {$_POST["category_id"]} OR parcat_1_level3_id = {$_POST["category_id"]} OR parcat_1_level4_id = {$_POST["category_id"]} OR cat_2_id = {$_POST["category_id"]} OR parcat_2_level1_id = {$_POST["category_id"]} OR parcat_2_level2_id = {$_POST["category_id"]} OR parcat_2_level3_id = {$_POST["category_id"]} OR parcat_2_level4_id = {$_POST["category_id"]} OR cat_3_id = {$_POST["category_id"]} OR parcat_3_level1_id = {$_POST["category_id"]} OR parcat_3_level2_id = {$_POST["category_id"]} OR parcat_3_level3_id = {$_POST["category_id"]} OR parcat_3_level4_id = {$_POST["category_id"]} OR cat_4_id = {$_POST["category_id"]} OR parcat_4_level1_id = {$_POST["category_id"]} OR parcat_4_level2_id = {$_POST["category_id"]} OR parcat_4_level3_id = {$_POST["category_id"]} OR parcat_4_level4_id = {$_POST["category_id"]} OR cat_5_id = {$_POST["category_id"]} OR parcat_5_level1_id = {$_POST["category_id"]} OR parcat_5_level2_id = {$_POST["category_id"]} OR parcat_5_level3_id = {$_POST["category_id"]} OR parcat_5_level4_id = {$_POST["category_id"]}";
				$db = db_getDBObject();
				$r = $db->query($sql);
				while ($row = mysql_fetch_object($r)) {
					$listing_ids .= $row->listing_id.",";
				}
				$listing_ids = substr($listing_ids, 0, strlen($listing_ids)-1);
				if ($listing_ids) {
					$sql = "SELECT DISTINCT(email) FROM Listing Where id IN ($listing_ids) AND email != '' ORDER BY email";
					$db = db_getDBObject();
					$r = $db->query($sql);
					while ($row = mysql_fetch_assoc($r)) {
						$listings[] = $row;
					}
				}
			}
		}

		if ($listings) {
			$listings_total = count($listings);
			$limit_rows = 65536;
			$limit_cols = 256;
			if ($listings_total<$limit_rows) {
				$limit_rows = $listings_total;
			} else {
				$limit_total = $limit_rows * $limit_cols;
				$listings_total = count($listings) < $limit_total ? count($listings) : $limit_total;
			}
			$cols = ceil($listings_total/$limit_rows);
			$emails = "";
			for ($i=0; $i < $limit_rows; $i++) {
				for ($j=0; $j < $cols; $j++) {
					$emails .= $listings[$i]["email"].";";
					$i = $i + $j;
				}
				$emails .= "\r\n";
			}
			header("Expires: Mon, 1 Apr 1974 05:00:00 GMT\r\n");
			header("Last-modified: ".gmdate("D,d M Y H:i:s")." GMT\r\n");
			header("Cache-control: private\r\n");
			header("Content-type: application/csv\r\n");
			header("Content-disposition: attachment; filename=\"emails.csv\"\r\n");
			header("Pragma: public\r\n");
			echo $emails;
			exit;
		} else {
			$error = system_showText(LANG_SITEMGR_EXPORT_PAYMENT_NOEMAILSWEREFOUND);
		}

	}

?>
