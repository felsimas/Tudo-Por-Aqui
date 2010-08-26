#!/usr/bin/php -q
<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /cron/count_listing_category.php
	# ----------------------------------------------------------------------------------------------------

	##################################################
	# THIS SCRIPT IS ONLY NECESSARY TO COUNT LISTINGS BY CATEGORY
	# WHEN LISTINGS ARE INSERTED/UPDATED OUT OF EDIRECTORY PROCCESS.
	# IF IT HAPPENED, RUN THIS SCRIPT ONLY ONE TIME. THE CODE ALREADY
	# HANDLES THE NUMBER OF ACTIVE LISTINGS BY CATEGORY. TO RUN THIS
	# SCRIPT, REMOVE THE EXIT COMMAND BELOW.
	##################################################
	exit;
	##################################################

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
	@include_once(PATH."/functions/db_funct.php");
	@include_once(PATH."/functions/system_funct.php");
	////////////////////////////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////////////////////////////
	function getmicrotime() {
		list($usec, $sec) = explode(" ", microtime());
		return ((float)$usec + (float)$sec);
	}
	$time_start = getmicrotime();
	////////////////////////////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////////////////////////////
	system_countActiveListingByCategory();
	////////////////////////////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////////////////////////////
	$time_end = getmicrotime();
	$time = $time_end - $time_start;
	print "Count ".ucwords(LISTING_FEATURE_NAME)." Category Update - ".date("Y-m-d H:i:s")." - ".round($time, 2)." seconds.\n";
	////////////////////////////////////////////////////////////////////////////////////////////////////

?>
