#!/usr/bin/php -q
<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /cron/randomizer.php
	# ----------------------------------------------------------------------------------------------------

	////////////////////////////////////////////////////////////////////////////////////////////////////
	define(BLOCK, 10000);
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
	$last_listing_randomizer = 0;
	if (!setting_get("last_listing_randomizer", $last_listing_randomizer)) {
		if (!setting_set("last_listing_randomizer", "0")) {
			if (!setting_new("last_listing_randomizer", "0")) {
				print "Randomizer - last_listing_randomizer error - ".date("Y-m-d H:i:s")."\n";
			}
		}
	}
	if (!$last_listing_randomizer) {
		$last_listing_randomizer = 0;
	}
	$sql = "SELECT id FROM Listing ORDER BY id LIMIT ".$last_listing_randomizer.", ".BLOCK."";
	$result = mysql_query($sql, $link);
	$num_rows = mysql_num_rows($result);
	while ($row = mysql_fetch_assoc($result)) {
		$sql = "UPDATE Listing SET random_number = RAND()*1000000000000000 WHERE id = ".$row["id"]."";
		mysql_query($sql, $link);
	}
	if ($num_rows < BLOCK) {
		if (!setting_set("last_listing_randomizer", "0")) {
			print "Randomizer - last_listing_randomizer error - ".date("Y-m-d H:i:s")."\n";
		}
		$last_listing_randomizer = 0;
	} else { 
		if (!setting_set("last_listing_randomizer", ($last_listing_randomizer + BLOCK))) {
			print "Randomizer - last_listing_randomizer error - ".date("Y-m-d H:i:s")."\n";
		}
		$last_listing_randomizer = $last_listing_randomizer + BLOCK;
	}
	////////////////////////////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////////////////////////////
	$last_promotion_randomizer = 0;
	if (!setting_get("last_promotion_randomizer", $last_promotion_randomizer)) {
		if (!setting_set("last_promotion_randomizer", "0")) {
			if (!setting_new("last_promotion_randomizer", "0")) {
				print "Randomizer - last_promotion_randomizer error - ".date("Y-m-d H:i:s")."\n";
			}
		}
	}
	if (!$last_promotion_randomizer) {
		$last_promotion_randomizer = 0;
	}
	$sql = "SELECT id FROM Promotion ORDER BY id LIMIT ".$last_promotion_randomizer.", ".BLOCK."";
	$result = mysql_query($sql, $link);
	$num_rows = mysql_num_rows($result);
	while ($row = mysql_fetch_assoc($result)) {
		$sql = "UPDATE Promotion SET random_number = RAND()*1000000000000000 WHERE id = ".$row["id"]."";
		mysql_query($sql, $link);
	}
	if ($num_rows < BLOCK) {
		if (!setting_set("last_promotion_randomizer", "0")) {
			print "Randomizer - last_promotion_randomizer error - ".date("Y-m-d H:i:s")."\n";
		}
		$last_promotion_randomizer = 0;
	} else { 
		if (!setting_set("last_promotion_randomizer", ($last_promotion_randomizer + BLOCK))) {
			print "Randomizer - last_promotion_randomizer error - ".date("Y-m-d H:i:s")."\n";
		}
		$last_promotion_randomizer = $last_promotion_randomizer + BLOCK;
	}
	////////////////////////////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////////////////////////////
	$last_event_randomizer = 0;
	if (!setting_get("last_event_randomizer", $last_event_randomizer)) {
		if (!setting_set("last_event_randomizer", "0")) {
			if (!setting_new("last_event_randomizer", "0")) {
				print "Randomizer - last_event_randomizer error - ".date("Y-m-d H:i:s")."\n";
			}
		}
	}
	if (!$last_event_randomizer) {
		$last_event_randomizer = 0;
	}
	$sql = "SELECT id FROM Event ORDER BY id LIMIT ".$last_event_randomizer.", ".BLOCK."";
	$result = mysql_query($sql, $link);
	$num_rows = mysql_num_rows($result);
	while ($row = mysql_fetch_assoc($result)) {
		$sql = "UPDATE Event SET random_number = RAND()*1000000000000000 WHERE id = ".$row["id"]."";
		mysql_query($sql, $link);
	}
	if ($num_rows < BLOCK) {
		if (!setting_set("last_event_randomizer", "0")) {
			print "Randomizer - last_event_randomizer error - ".date("Y-m-d H:i:s")."\n";
		}
		$last_event_randomizer = 0;
	} else { 
		if (!setting_set("last_event_randomizer", ($last_event_randomizer + BLOCK))) {
			print "Randomizer - last_event_randomizer error - ".date("Y-m-d H:i:s")."\n";
		}
		$last_event_randomizer = $last_event_randomizer + BLOCK;
	}
	////////////////////////////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////////////////////////////
	$last_banner_randomizer = 0;
	if (!setting_get("last_banner_randomizer", $last_banner_randomizer)) {
		if (!setting_set("last_banner_randomizer", "0")) {
			if (!setting_new("last_banner_randomizer", "0")) {
				print "Randomizer - last_banner_randomizer error - ".date("Y-m-d H:i:s")."\n";
			}
		}
	}
	if (!$last_banner_randomizer) {
		$last_banner_randomizer = 0;
	}
	$sql = "SELECT id FROM Banner ORDER BY id LIMIT ".$last_banner_randomizer.", ".BLOCK."";
	$result = mysql_query($sql, $link);
	$num_rows = mysql_num_rows($result);
	while ($row = mysql_fetch_assoc($result)) {
		$sql = "UPDATE Banner SET random_number = RAND()*1000000000000000 WHERE id = ".$row["id"]."";
		mysql_query($sql, $link);
	}
	if ($num_rows < BLOCK) {
		if (!setting_set("last_banner_randomizer", "0")) {
			print "Randomizer - last_banner_randomizer error - ".date("Y-m-d H:i:s")."\n";
		}
		$last_banner_randomizer = 0;
	} else { 
		if (!setting_set("last_banner_randomizer", ($last_banner_randomizer + BLOCK))) {
			print "Randomizer - last_banner_randomizer error - ".date("Y-m-d H:i:s")."\n";
		}
		$last_banner_randomizer = $last_banner_randomizer + BLOCK;
	}
	////////////////////////////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////////////////////////////
	$last_classified_randomizer = 0;
	if (!setting_get("last_classified_randomizer", $last_classified_randomizer)) {
		if (!setting_set("last_classified_randomizer", "0")) {
			if (!setting_new("last_classified_randomizer", "0")) {
				print "Randomizer - last_classified_randomizer error - ".date("Y-m-d H:i:s")."\n";
			}
		}
	}
	if (!$last_classified_randomizer) {
		$last_classified_randomizer = 0;
	}
	$sql = "SELECT id FROM Classified ORDER BY id LIMIT ".$last_classified_randomizer.", ".BLOCK."";
	$result = mysql_query($sql, $link);
	$num_rows = mysql_num_rows($result);
	while ($row = mysql_fetch_assoc($result)) {
		$sql = "UPDATE Classified SET random_number = RAND()*1000000000000000 WHERE id = ".$row["id"]."";
		mysql_query($sql, $link);
	}
	if ($num_rows < BLOCK) {
		if (!setting_set("last_classified_randomizer", "0")) {
			print "Randomizer - last_classified_randomizer error - ".date("Y-m-d H:i:s")."\n";
		}
		$last_classified_randomizer = 0;
	} else { 
		if (!setting_set("last_classified_randomizer", ($last_classified_randomizer + BLOCK))) {
			print "Randomizer - last_classified_randomizer error - ".date("Y-m-d H:i:s")."\n";
		}
		$last_classified_randomizer = $last_classified_randomizer + BLOCK;
	}
	////////////////////////////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////////////////////////////
	$last_article_randomizer = 0;
	if (!setting_get("last_article_randomizer", $last_article_randomizer)) {
		if (!setting_set("last_article_randomizer", "0")) {
			if (!setting_new("last_article_randomizer", "0")) {
				print "Randomizer - last_article_randomizer error - ".date("Y-m-d H:i:s")."\n";
			}
		}
	}
	if (!$last_article_randomizer) {
		$last_article_randomizer = 0;
	}
	$sql = "SELECT id FROM Article ORDER BY id LIMIT ".$last_article_randomizer.", ".BLOCK."";
	$result = mysql_query($sql, $link);
	$num_rows = mysql_num_rows($result);
	while ($row = mysql_fetch_assoc($result)) {
		$sql = "UPDATE Article SET random_number = RAND()*1000000000000000 WHERE id = ".$row["id"]."";
		mysql_query($sql, $link);
	}
	if ($num_rows < BLOCK) {
		if (!setting_set("last_article_randomizer", "0")) {
			print "Randomizer - last_article_randomizer error - ".date("Y-m-d H:i:s")."\n";
		}
		$last_article_randomizer = 0;
	} else { 
		if (!setting_set("last_article_randomizer", ($last_article_randomizer + BLOCK))) {
			print "Randomizer - last_article_randomizer error - ".date("Y-m-d H:i:s")."\n";
		}
		$last_article_randomizer = $last_article_randomizer + BLOCK;
	}
	////////////////////////////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////////////////////////////
	$time_end = getmicrotime();
	$time = $time_end - $time_start;
	print "Randomizer - ".date("Y-m-d H:i:s")." - ".round($time, 2)." seconds.\n";
	if (!setting_set("last_datetime_randomizer", date("Y-m-d H:i:s"))) {
		if (!setting_new("last_datetime_randomizer", date("Y-m-d H:i:s"))) {
			print "last_datetime_randomizer error - ".date("Y-m-d H:i:s")."\n";
		}
	}
	////////////////////////////////////////////////////////////////////////////////////////////////////

?>
