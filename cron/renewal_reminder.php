#!/usr/bin/php -q
<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /cron/renewal_reminder.php
	# ----------------------------------------------------------------------------------------------------

	////////////////////////////////////////////////////////////////////////////////////////////////////
	define(BLOCK, 1000);
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
	@include_once(PATH."/classes/class_eDirMailer.php");
	@include_once(PATH."/classes/phpmailer/class.phpmailer.php");
	@include_once(PATH."/classes/phpmailer/class.smtp.php");
	@include_once(PATH."/classes/phpmailer/class.pop3.php");
	@include_once(PATH."/classes/class_mysql.php");
	@include_once(PATH."/classes/class_handle.php");
	@include_once(PATH."/classes/class_setting.php");
	@include_once(PATH."/classes/class_account.php");
	@include_once(PATH."/classes/class_contact.php");
	@include_once(PATH."/classes/class_itemStatus.php");
	@include_once(PATH."/classes/class_listingLevel.php");
	@include_once(PATH."/classes/class_listing.php");
	@include_once(PATH."/functions/db_funct.php");
	@include_once(PATH."/functions/setting_funct.php");
	@include_once(PATH."/functions/system_funct.php");
	@include_once(PATH."/functions/crypt_funct.php");
	@include_once(PATH."/conf/language.inc.php");
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
	setting_get("default_url", $default_url);
	setting_get("sitemgr_email", $sitemgr_email);
	setting_get("edir_default_language", $edir_default_language);
	setting_get("edir_languages", $edir_languages);
	////////////////////////////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////////////////////////////
	$last_listing_reminder = 0;
	if (!setting_get("last_listing_reminder", $last_listing_reminder)) {
		if (!setting_set("last_listing_reminder", "0")) {
			if (!setting_new("last_listing_reminder", "0")) {
				print "Renewal Reminder - last_listing_reminder error - ".date("Y-m-d H:i:s")."\n";
			}
		}
	}
	if (!$last_listing_reminder) {
		$last_listing_reminder = 0;
	}

	$edirlanguages = explode(",", $edir_languages);

	unset($allNot);
	$sqlNot = "SELECT * FROM Email_Notification WHERE deactivate = '0' AND days > 0 ORDER BY days";
	$resultNot = mysql_query($sqlNot, $link);
	while ($rowNot = mysql_fetch_assoc($resultNot)) {
		$allNot[$rowNot["days"]][$edir_default_language]["body"] = $rowNot["body"];
		$allNot[$rowNot["days"]][$edir_default_language]["subject"] = $rowNot["subject"];
		$allNot[$rowNot["days"]][$edir_default_language]["bcc"] = $rowNot["bcc"];
		$allNot[$rowNot["days"]][$edir_default_language]["content_type"] = $rowNot["content_type"];
		for ($edir_i=0; $edir_i<count($edirlanguages); $edir_i++) {
			if ($edirlanguages[$edir_i] != $edir_default_language) {
				$edir_sql = "SELECT * FROM Email_Notification_Lang WHERE id = ".db_formatNumber($rowNot["id"])." AND lang = ".db_formatString($edirlanguages[$edir_i])." LIMIT 1";
				$edir_result = mysql_query($edir_sql, $link);
				if ($edir_row = mysql_fetch_assoc($edir_result)) {
					$allNot[$rowNot["days"]][$edirlanguages[$edir_i]]["body"] = $edir_row["body"];
					$allNot[$rowNot["days"]][$edirlanguages[$edir_i]]["subject"] = $edir_row["subject"];
				} else {
					$allNot[$rowNot["days"]][$edirlanguages[$edir_i]]["body"] = $allNot[$rowNot["days"]][$edir_default_language]["body"];
					$allNot[$rowNot["days"]][$edirlanguages[$edir_i]]["subject"] = $allNot[$rowNot["days"]][$edir_default_language]["subject"];
				}
				$allNot[$rowNot["days"]][$edirlanguages[$edir_i]]["bcc"] = $allNot[$rowNot["days"]][$edir_default_language]["bcc"];
				$allNot[$rowNot["days"]][$edirlanguages[$edir_i]]["content_type"] = $allNot[$rowNot["days"]][$edir_default_language]["content_type"];
			}
		}
	}

	if ($allNot && (count($allNot) > 0)) {

		$allNotCount = 0;
		$before_days = 0;
		foreach ($allNot as $days=>$this_email_data) {
			if ($allNotCount == 0) {
				$allNotSQL[] = "(DATE_FORMAT(renewal_date, '%Y%m%d') > DATE_FORMAT(NOW(), '%Y%m%d') AND DATE_FORMAT(DATE_SUB(renewal_date, INTERVAL ".$days." DAY), '%Y%m%d') <= DATE_FORMAT(NOW(), '%Y%m%d') AND reminder != ".$days.")";
			} else {
				$allNotSQL[] = "(DATE_FORMAT(DATE_SUB(renewal_date, INTERVAL ".$before_days." DAY), '%Y%m%d') > DATE_FORMAT(NOW(), '%Y%m%d') AND DATE_FORMAT(DATE_SUB(renewal_date, INTERVAL ".$days." DAY), '%Y%m%d') <= DATE_FORMAT(NOW(), '%Y%m%d') AND reminder != ".$days.")";
			}
			$before_days = $days;
			$allNotCount++;
		}

		$sql = 	"".
				" SELECT ".
				" id, account_id, title, renewal_date, reminder ".
				" FROM ".
				" Listing ".
				" WHERE ".
				" account_id > 0 ".
				" AND ".
				" renewal_date != '0000-00-00' ".
				" AND ".
				" ( ".
				implode(" OR ", $allNotSQL).
				" ) ".
				" ORDER BY ".
				" id ".
				" LIMIT ".
				$last_listing_reminder.", ".BLOCK."";
		$result = mysql_query($sql, $link);
		$num_rows = mysql_num_rows($result);

		$today_date = explode("-", date("Y-m-d"));
		$today_year = $today_date[0];
		$today_month = $today_date[1];
		$today_day = $today_date[2];

		while ($row = mysql_fetch_assoc($result)) {

			$renewal_date = explode("-", $row["renewal_date"]);
			$renewal_year = $renewal_date[0];
			$renewal_month = $renewal_date[1];
			$renewal_day = $renewal_date[2];

			$reminder = 0;
			$allNotCount = 0;
			$before_days = 0;
			foreach ($allNot as $days=>$this_email_data) {
				if ($allNotCount == 0) {
					if ((date("Ymd", mktime(0, 0, 0, $renewal_month, $renewal_day, $renewal_year)) > date("Ymd", mktime(0, 0, 0, $today_month, $today_day, $today_year))) && (date("Ymd", mktime(0, 0, 0, $renewal_month, $renewal_day-$days, $renewal_year)) <= date("Ymd", mktime(0, 0, 0, $today_month, $today_day, $today_year)))) {
						$reminder = $days;
					}
				} else {
					if ((date("Ymd", mktime(0, 0, 0, $renewal_month, $renewal_day-$before_days, $renewal_year)) > date("Ymd", mktime(0, 0, 0, $today_month, $today_day, $today_year))) && (date("Ymd", mktime(0, 0, 0, $renewal_month, $renewal_day-$days, $renewal_year)) <= date("Ymd", mktime(0, 0, 0, $today_month, $today_day, $today_year)))) {
						$reminder = $days;
					}
				}
				$before_days = $days;
				$allNotCount++;
			}

			$contactObj = new Contact($row["account_id"]);

			if ($reminder && $contactObj->getString("email")) {

				$email_data["body"]         = $allNot[$reminder][$contactObj->getString("lang")]["body"];
				$email_data["subject"]      = $allNot[$reminder][$contactObj->getString("lang")]["subject"];
				$email_data["bcc"]          = $allNot[$reminder][$contactObj->getString("lang")]["bcc"];
				$email_data["content_type"] = $allNot[$reminder][$contactObj->getString("lang")]["content_type"];

				$email_data["subject"] = str_replace("DEFAULT_URL", $default_url, $email_data["subject"]);
				$email_data["body"]    = str_replace("DEFAULT_URL", $default_url, $email_data["body"]);

				$email_data["subject"] = str_replace("LISTING_RENEWAL_DATE", $row["renewal_date"], $email_data["subject"]);
				$email_data["body"]    = str_replace("LISTING_RENEWAL_DATE", $row["renewal_date"], $email_data["body"]);

				$email_data["subject"] = str_replace("DAYS_INTERVAL", $reminder, $email_data["subject"]);
				$email_data["body"]    = str_replace("DAYS_INTERVAL", $reminder, $email_data["body"]);

				$email_data["subject"] = system_replaceEmailVariables($email_data["subject"], $row["id"], "listing");
				$email_data["body"]    = system_replaceEmailVariables($email_data["body"], $row["id"], "listing");

				$email_data["body"]    = html_entity_decode($email_data["body"]);

				$to           = $contactObj->getString("email");
				$from_email   = $sitemgr_email;
				$from_name    = EDIRECTORY_TITLE;
				$bcc          = $email_data["bcc"];
				$subject      = $email_data["subject"];
				$message      = $email_data["body"];
				$content_type = $email_data["content_type"];

				$message = str_replace("\r\n", "\n", $message);
				$message = str_replace("\n", "\r\n", $message);

				$error = false;
				system_mail($to, $subject, $message, $from_name." <".$from_email.">", $content_type, '', '', $error);
				if ($bcc) {
					system_mail($bcc, $subject, $message, $from_name." <".$from_email.">", $content_type, '', '', $error);
				}

			}

			$sql = "UPDATE Listing SET reminder = ".$reminder." WHERE id = ".$row["id"]."";
			mysql_query($sql, $link);

		}

	}

	if ($num_rows < BLOCK) {
		if (!setting_set("last_listing_reminder", "0")) {
			print "Renewal Reminder - last_listing_reminder error - ".date("Y-m-d H:i:s")."\n";
		}
		$last_listing_reminder = 0;
	} else { 
		if (!setting_set("last_listing_reminder", ($last_listing_reminder + BLOCK))) {
			print "Renewal Reminder - last_listing_reminder error - ".date("Y-m-d H:i:s")."\n";
		}
		$last_listing_reminder = $last_listing_reminder + BLOCK;
	}
	////////////////////////////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////////////////////////////
	$time_end = getmicrotime();
	$time = $time_end - $time_start;
	print "Renewal Reminder - ".date("Y-m-d H:i:s")." - ".round($time, 2)." seconds.\n";
	if (!setting_set("last_datetime_renewalreminder", date("Y-m-d H:i:s"))) {
		if (!setting_new("last_datetime_renewalreminder", date("Y-m-d H:i:s"))) {
			print "last_datetime_renewalreminder error - ".date("Y-m-d H:i:s")."\n";
		}
	}
	////////////////////////////////////////////////////////////////////////////////////////////////////

?>
