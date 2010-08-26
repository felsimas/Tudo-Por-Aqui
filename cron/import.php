#!/usr/bin/php -q
<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /cron/import.php
	# ----------------------------------------------------------------------------------------------------

	////////////////////////////////////////////////////////////////////////////////////////////////////
	define(IMPORT_DEBUG, "off");
	define(IMPORT_MAX_LISTINGS_PERTIME, 100000);
	define(IMPORT_MAX_SECONDS_PERTIME, 60*19);
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
	@include_once(PATH."/conf/phpini.inc.php");
	@include_once(PATH."/conf/config.inc.php");
	@include_once(PATH."/conf/constants.inc.php");
	@include_once(PATH."/conf/language.inc.php");
	@include_once(PATH."/classes/class_eDirMailer.php");
	@include_once(PATH."/classes/phpmailer/class.phpmailer.php");
	@include_once(PATH."/classes/phpmailer/class.smtp.php");
	@include_once(PATH."/classes/phpmailer/class.pop3.php");
	@include_once(PATH."/classes/class_mysql.php");
	@include_once(PATH."/functions/db_funct.php");
	@include_once(PATH."/functions/setting_funct.php");
	@include_once(PATH."/functions/crypt_funct.php");
	@include_once(PATH."/functions/validate_funct.php");
	@include_once(PATH."/functions/system_funct.php");
	@include_once(PATH."/functions/zipproximity_funct.php");
	@include_once(PATH."/classes/class_handle.php");
	@include_once(PATH."/classes/class_setting.php");
	@include_once(PATH."/classes/class_importLog.php");
	@include_once(PATH."/classes/class_itemStatus.php");
	@include_once(PATH."/classes/class_listingLevel.php");
	@include_once(PATH."/classes/class_account.php");
	@include_once(PATH."/classes/class_contact.php");
	@include_once(PATH."/classes/class_listing.php");
	@include_once(PATH."/classes/class_listingCategory.php");
	@include_once(PATH."/classes/class_locationManager.php");
	@include_once(PATH."/classes/class_locationCountry.php");
	@include_once(PATH."/classes/class_locationState.php");
	@include_once(PATH."/classes/class_locationRegion.php");
	@include_once(PATH."/classes/class_locationCity.php");
	@include_once(PATH."/classes/class_locationArea.php");
	////////////////////////////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////////////////////////////
	define(IMPORTFOLDER, str_replace(EDIRECTORY_ROOT, "", IMPORT_FOLDER));
	////////////////////////////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////////////////////////////
	$import_process_id = uniqid("import_");
	define(IMPORT_PROCESS_ID, strtolower($import_process_id));
	////////////////////////////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////////////////////////////
	setting_get("import_from_export", $import_from_export);
	setting_get("import_sameaccount", $import_sameaccount);
	setting_get("import_account_id", $import_account_id);
	setting_get("import_enable_listing_active", $import_enable_listing_active);
	setting_get("import_defaultlevel", $import_defaultlevel);
	setting_get("sitemgr_email", $sitemgr_email);
    setting_get("edir_default_language", $edir_default_language);
    setting_get("edir_languages", $edir_languages);
	////////////////////////////////////////////////////////////////////////////////////////////////////
    $edirlanguages = explode(",", $edir_languages);
    
    ////////////////////////////////////////////////////////////////////////////////////////////////////
    if (!$edir_default_language) $edir_default_language = 'en_us';
    require_once(PATH.'/lang/'.$edir_default_language.'.php');
    require_once(PATH.'/lang/'.$edir_default_language.'_sitemgr.php');
    ////////////////////////////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////////////////////////////
	function import_logDebug($message) {
		if (IMPORT_DEBUG == "on") {
			setting_get("sitemgr_email", $sitemgr_email);
			$filename = PATH.IMPORTFOLDER."/importdebug.log";
			if (!$handle = fopen($filename, "a")) {
				$eDirMailerObj = new EDirMailer(EDIR_ADMIN_EMAIL, "[eDirectory Cron] - Import Process", "Error: file open (".$filename.").", $sitemgr_email);
				$eDirMailerObj->send();
				exit;
			}
			if (fwrite($handle, "(".IMPORT_PROCESS_ID.") ".$message."\n") === false) {
				$eDirMailerObj = new EDirMailer(EDIR_ADMIN_EMAIL, "[eDirectory Cron] - Import Process", "Error: file write (".$filename.").", $sitemgr_email);
				$eDirMailerObj->send();
				exit;
			}
			if (!fclose($handle)) {
				$eDirMailerObj = new EDirMailer(EDIR_ADMIN_EMAIL, "[eDirectory Cron] - Import Process", "Error: file close (".$filename.").", $sitemgr_email);
				$eDirMailerObj->send();
				exit;
			}
		}
	}
	////////////////////////////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////////////////////////////
	$import_stop = false;
	////////////////////////////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////////////////////////////
	function getmicrotime() {
		list($usec, $sec) = explode(" ", microtime());
		return ((float)$usec + (float)$sec);
	}
	$time_start = getmicrotime();
	import_logDebug("++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++");
	import_logDebug("Start Date/Time: ".date("Y-m-d H:i:s"));
	////////////////////////////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////////////////////////////
	$filename_token = PATH.IMPORTFOLDER."/import.token";
	////////////////////////////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////////////////////////////
	$this_token = false;
	if (file_exists($filename_token)) {
		if (!$handle = fopen($filename_token, "r")) {
			$eDirMailerObj = new EDirMailer(EDIR_ADMIN_EMAIL, "[eDirectory Cron] - Import Process", "Error: file open (".$filename_token.").", $sitemgr_email);
			$eDirMailerObj->send();
			exit;
		}
		$import_token = fgets($handle);
		import_logDebug("Another import process is running - ".$import_token." - LINE: ".__LINE__);
		$import_stop = true;
		if (!fclose($handle)) {
			$eDirMailerObj = new EDirMailer(EDIR_ADMIN_EMAIL, "[eDirectory Cron] - Import Process", "Error: file close (".$filename_token.").", $sitemgr_email);
			$eDirMailerObj->send();
			exit;
		}
	} else {
		$this_token = true;
		if (!$handle = fopen($filename_token, "w")) {
			$eDirMailerObj = new EDirMailer(EDIR_ADMIN_EMAIL, "[eDirectory Cron] - Import Process", "Error: file open (".$filename_token.").", $sitemgr_email);
			$eDirMailerObj->send();
			exit;
		}
		if (fwrite($handle, IMPORT_PROCESS_ID) === false) {
			$eDirMailerObj = new EDirMailer(EDIR_ADMIN_EMAIL, "[eDirectory Cron] - Import Process", "Error: file write (".$filename_token.").", $sitemgr_email);
			$eDirMailerObj->send();
			exit;
		}
		import_logDebug("Getting token - LINE: ".__LINE__);
		if (!fclose($handle)) {
			$eDirMailerObj = new EDirMailer(EDIR_ADMIN_EMAIL, "[eDirectory Cron] - Import Process", "Error: file close (".$filename_token.").", $sitemgr_email);
			$eDirMailerObj->send();
			exit;
		}
	}
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
	if (!$import_stop) {
		$no_data_importtemporarytable = false;
		$sql = "SELECT * FROM ImportTemporary";
		$result = mysql_query($sql, $link);
		if (mysql_num_rows($result) <= 0) {
			$no_data_importtemporarytable = true;
			import_logDebug("No data in import temporary table - LINE: ".__LINE__);
		}
		if ($no_data_importtemporarytable) {
			$sql = "SELECT * FROM ImportLog WHERE status = 'P' ORDER BY id LIMIT 1";
			$result = mysql_query($sql, $link);
			if (mysql_num_rows($result) > 0) {
				$row = mysql_fetch_assoc($result);
				$importlog_id = $row["id"];
				$importlogObj = new ImportLog($importlog_id);
				$importlogObj->setString("status", "R");
				$importlogObj->save();
				import_logDebug("Changing status - running - LINE: ".__LINE__);
				$file = PATH.IMPORTFOLDER."/".$importlogObj->getString("phisicalname");
				$handle = fopen(PATH."/gerenciamento/import/edirectory_sample.csv", "r");
				$sample_header = fgets($handle);
				fclose($handle);
				if (file_exists($file)) {
					if (!$handle = fopen($file, "r")) {
						$import_stop = true;
						import_logDebug("Problem with imported file (".$importlogObj->getString("phisicalname").") - LINE: ".__LINE__);
					}
					$imported_header = fgets($handle);
					if (!fclose($handle)) {
						$import_stop = true;
						import_logDebug("Problem with imported file (".$importlogObj->getString("phisicalname").") - LINE: ".__LINE__);
					}
				} else {
					$import_stop = true;
					import_logDebug("File does not exists (".$importlogObj->getString("phisicalname").") - LINE: ".__LINE__);
				}
				if (!$import_stop) {
					$sample_header = explode(",", $sample_header);
					$imported_header = explode(",", $imported_header);
					unset($wrong_imported_header);
					unset($wrong_header_fields);
					if (count($sample_header) < count($imported_header)) {
						$import_stop = true;
						$wrong_imported_header = true;
					}
					for ($i = 0; $i < count($sample_header); $i++) {
						$sample_header[$i] = str_replace("\n\r", "", $sample_header[$i]);
						$sample_header[$i] = str_replace("\r\n", "", $sample_header[$i]);
						$sample_header[$i] = str_replace("\n", "", $sample_header[$i]);
						$sample_header[$i] = str_replace("\r", "", $sample_header[$i]);
						$imported_header[$i] = str_replace("\n\r", "", $imported_header[$i]);
						$imported_header[$i] = str_replace("\r\n", "", $imported_header[$i]);
						$imported_header[$i] = str_replace("\n", "", $imported_header[$i]);
						$imported_header[$i] = str_replace("\r", "", $imported_header[$i]);
						if ($sample_header[$i] != $imported_header[$i]) {
							$import_stop = true;
							$wrong_header_fields[] = ereg_replace("[^A-Za-z0-9 ]", "", $sample_header[$i]);
						}
					}
				}
				if (!$import_stop) {
					$handle = fopen($file, "r");
					$file_header = fgetcsv($handle, 16384);
					$importlogObj->setHistory(system_showText(LANG_SITEMGR_IMPORT_IMPORTINGDATATOTEMPORARYTABLE));
					import_logDebug("Importing data to temporary table - LINE: ".__LINE__);
					$totallines = 0;
					$file_line_number = 2;
					while ($line = fgetcsv($handle, 16384)) {
						$sql = "";
						$sql .= " INSERT INTO ";
						$sql .= " ImportTemporary ";
						// PAY ATTENTION IN ORDER OF FIELDS
						$sql .= " ( import_log_id , file_line_number , account_username , account_password , account_first_name , account_last_name , account_company , account_address , account_address2 , account_country , account_state , account_city , account_zip , account_phone , account_fax , account_email , account_url , listing_title , listing_email , listing_url , listing_address , listing_address2 , listing_country , listing_state , listing_city , listing_zip , listing_phone , listing_fax , listing_description , listing_long_description , listing_keyword , listing_renewal_date , listing_status , listing_level , listing_category_1 , listing_category_2 , listing_category_3 , listing_category_4 , listing_category_5, listing_template ) ";
						$sql .= " VALUES ";
						$sql .= " ( ";
						$sql .= " ".db_formatNumber($importlogObj->getNumber("id"))." ";
						$sql .= " , ";
						$sql .= " ".db_formatNumber($file_line_number)." ";
						$columns_error = false;
						if (count($line) > count($sample_header)) {
							$columns_error = true;
						} else {
							for ($i=0; $i<count($sample_header); $i++) {
								$line[$i] = !$line[$i] ? "" : $line[$i];
								// REMOVING BREAK LINES IN CATEGORIES
								// PAY ATTENTION IN ORDER OF FIELDS
								if ($i >= (count($sample_header)-5)) {
									$line[$i] = str_replace("\r\n", "", $line[$i]);
									$line[$i] = str_replace("\n\r", "", $line[$i]);
									$line[$i] = str_replace("\r", "", $line[$i]);
									$line[$i] = str_replace("\n", "", $line[$i]);
								}
								$sql .= " , ".db_formatString($line[$i])." ";
							}
						}
						if (!$columns_error) {
							$sql .= " ) ";
							mysql_query($sql, $link);
						} else {
							$lines_error[] = $file_line_number;
						}
						$file_line_number++;
						$totallines++;
					}
					if (count($lines_error) > 0) {
						$importlogObj->setHistory(system_showText(LANG_SITEMGR_IMPORT_NUMBEROFCOLUMNSAREWRONG)." ".implode(", ", $lines_error));
					}
					fclose($handle);
					$importlogObj = new ImportLog($importlog_id);
					$importlogObj->setNumber("totallines", $totallines);
					$importlogObj->save();
					$importlogObj->setHistory(system_showText(LANG_SITEMGR_IMPORT_CSVIMPORTEDTOTEMPORARYTABLE));
					import_logDebug("CSV imported to temporary table - LINE: ".__LINE__);
					$importlogObj->setHistory(system_showText(LANG_SITEMGR_IMPORT_TOTALLINESREADY)." ".(int)$importlogObj->getNumber("totallines").".");
					import_logDebug("Total lines read: ".(int)$importlogObj->getNumber("totallines")." - LINE: ".__LINE__);
				}
				if (file_exists($file)) {
					if (!unlink($file)) {
						$importlogObj->setHistory(system_showText(LANG_SITEMGR_IMPORT_PROBLEMWITHIMPORTEDFILE)." (".$importlogObj->getString("phisicalname").").");
						import_logDebug("Problem with imported file (".$importlogObj->getString("phisicalname").") - LINE: ".__LINE__);
					}
				}
				if (!$import_stop) {
					import_logDebug("Removing invalid lines - LINE: ".__LINE__);
					$sqlInvalid = "SELECT id, account_username, account_password, listing_title, file_line_number FROM ImportTemporary ORDER BY id";
					$resultInvalid = mysql_query($sqlInvalid, $link);
					if ($resultInvalid) {
						while ($rowInvalid = mysql_fetch_assoc($resultInvalid)) {
							$username_noowner = false;
							if (($errorInvalid = validate_username($rowInvalid["account_username"]))) {
								if (!$rowInvalid["account_username"]) {
									$username_noowner = true;
								} else {
									$sqlInvalid = "DELETE FROM ImportTemporary WHERE id = ".$rowInvalid["id"]."";
									mysql_query($sqlInvalid, $link);
									$importlogObj->setHistory(system_showText(LANG_SITEMGR_IMPORT_INVALIDUSERNAMELINE)." ".$rowInvalid["file_line_number"].".");
									import_logDebug("Invalid username - line ".$rowInvalid["file_line_number"]." - LINE: ".__LINE__);
								}
							}
							if ((($errorInvalid = validate_password($rowInvalid["account_password"])) || (strpos($rowInvalid["account_password"], "'") !== false)) && (!$username_noowner)) {
								$sqlInvalid = "DELETE FROM ImportTemporary WHERE id = ".$rowInvalid["id"]."";
								mysql_query($sqlInvalid, $link);
								$importlogObj->setHistory(system_showText(LANG_SITEMGR_IMPORT_INVALIDPASSWORDLINE)." ".$rowInvalid["file_line_number"].".");
								import_logDebug("Invalid password - line ".$rowInvalid["file_line_number"]." - LINE: ".__LINE__);
							}
							if (!$rowInvalid["listing_title"]) {
								$sqlInvalid = "DELETE FROM ImportTemporary WHERE id = ".$rowInvalid["id"]."";
								mysql_query($sqlInvalid, $link);
								$importlogObj->setHistory(system_showText(LANG_SITEMGR_IMPORT_INVALIDTITLELINE)." ".$rowInvalid["file_line_number"].".");
								import_logDebug("Invalid title - line ".$rowInvalid["file_line_number"]." - LINE: ".__LINE__);
							}
						}
					}
					import_logDebug("Removed invalid lines - LINE: ".__LINE__);
				}
				if ($import_stop) {
					if ($wrong_imported_header) {
						import_logDebug("CSV header does not match - it has more fields that it is allowed - LINE: ".__LINE__);
					}
					if ($wrong_header_fields) {
						import_logDebug("CSV header does not match at filed(s): ".implode(", ", $wrong_header_fields)." - LINE: ".__LINE__);
					}
					$importlogObj = new ImportLog($importlog_id);
					$importlogObj->setString("status", "F");
					$importlogObj->setString("progress", "100%");
					$importlogObj->save();
					import_logDebug("Changing status - finished - LINE: ".__LINE__);
				}
			} else {
				$import_stop = true;
				import_logDebug("No pending process - LINE: ".__LINE__);
			}
		}
	}
	////////////////////////////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////////////////////////////
	if (!$import_stop) {
		$sql = "SELECT * FROM ImportLog WHERE status = 'R' ORDER BY id LIMIT 1";
		$result = mysql_query($sql, $link);
		if (mysql_num_rows($result) > 0) {
			$row = mysql_fetch_assoc($result);
			$importlog_id = $row["id"];
			$importlogObj = new ImportLog($importlog_id);
			$sql = "SELECT * FROM ImportTemporary WHERE import_log_id = '".$importlogObj->getNumber("id")."' ORDER BY id LIMIT 1";
			$result = mysql_query($sql, $link);
			$current_listing = 0;
			$current_time = getmicrotime() - $time_start;
			$statusObj = new ItemStatus();
			$allStatus = $statusObj->getValueName();
			$defaultStatus = $statusObj->getDefaultStatus();
			$levelObj = new ListingLevel();
			while ((mysql_num_rows($result) > 0) && ($current_listing < IMPORT_MAX_LISTINGS_PERTIME) && ($current_time < IMPORT_MAX_SECONDS_PERTIME)) {
				$row = mysql_fetch_assoc($result);

				####################################################################################################
				### COUNTRY
				####################################################################################################
				$estado_id = 0;
				if ($row["listing_country"]) {
					$sqlCountry = "SELECT * FROM Location_Country WHERE name = ".db_formatString($row["listing_country"])."";
					$resultCountry = mysql_query($sqlCountry, $link);
					if (mysql_num_rows($resultCountry) <= 0) {
						$country_friendly_url = ereg_replace("[^".FRIENDLYURL_VALIDCHARS."]", FRIENDLYURL_SEPARATOR, $row["listing_country"]);
						$country_friendly_url = strtolower(ereg_replace("".FRIENDLYURL_SEPARATOR."{2,}", FRIENDLYURL_SEPARATOR, $country_friendly_url));
						$sqlCountry = "INSERT INTO Location_Country (name, friendly_url, abbreviation, seo_description, seo_keywords) VALUES (".db_formatString($row["listing_country"]).", ".db_formatString($country_friendly_url).", '', '', '')";
						mysql_query($sqlCountry, $link);
						$estado_id = mysql_insert_id();
						$sqlCountry = "SELECT * FROM Location_Country WHERE id != ".$estado_id." AND friendly_url = ".db_formatString($country_friendly_url)."";
						$resultCountry = mysql_query($sqlCountry, $link);
						if (mysql_num_rows($resultCountry) > 0) {
							$country_friendly_url .= FRIENDLYURL_SEPARATOR.$estado_id;
							$sqlCountry = "UPDATE Location_Country SET friendly_url = ".db_formatString($country_friendly_url)." WHERE id = ".$estado_id."";
							mysql_query($sqlCountry, $link);
						}
					} else {
						$rowCountry = mysql_fetch_assoc($resultCountry);
						$estado_id = $rowCountry["id"];
					}
				}
				####################################################################################################

				####################################################################################################
				### STATE
				####################################################################################################
				$cidade_id = 0;
				if ($estado_id > 0) {
					if ($row["listing_state"]) {
						$sqlState = "SELECT * FROM Location_State WHERE estado_id = ".db_formatNumber($estado_id)." AND name = ".db_formatString($row["listing_state"])."";
						$resultState = mysql_query($sqlState, $link);
						if (mysql_num_rows($resultState) <= 0) {
							$state_friendly_url = ereg_replace("[^".FRIENDLYURL_VALIDCHARS."]", FRIENDLYURL_SEPARATOR, $row["listing_state"]);
							$state_friendly_url = strtolower(ereg_replace("".FRIENDLYURL_SEPARATOR."{2,}", FRIENDLYURL_SEPARATOR, $state_friendly_url));
							$sqlState = "INSERT INTO Location_State (estado_id, name, friendly_url, abbreviation, seo_description, seo_keywords) VALUES (".db_formatNumber($estado_id).", ".db_formatString($row["listing_state"]).", ".db_formatString($state_friendly_url).", '', '', '')";
							mysql_query($sqlState, $link);
							$cidade_id = mysql_insert_id();
							$sqlState = "SELECT * FROM Location_State WHERE id != ".$cidade_id." AND estado_id = ".db_formatNumber($estado_id)." AND friendly_url = ".db_formatString($state_friendly_url)."";
							$resultState = mysql_query($sqlState, $link);
							if (mysql_num_rows($resultState) > 0) {
								$state_friendly_url .= FRIENDLYURL_SEPARATOR.$cidade_id;
								$sqlState = "UPDATE Location_State SET friendly_url = ".db_formatString($state_friendly_url)." WHERE estado_id = ".db_formatNumber($estado_id)." AND id = ".$cidade_id."";
								mysql_query($sqlState, $link);
							}
						} else {
							$rowState = mysql_fetch_assoc($resultState);
							$cidade_id = $rowState["id"];
						}
					}
				}
				####################################################################################################

				####################################################################################################
				### REGION
				####################################################################################################
				$bairro_id = 0;
				if ($cidade_id > 0) {
					if ($row["listing_city"]) {
						$sqlRegion = "SELECT * FROM Location_Region WHERE cidade_id = ".db_formatNumber($cidade_id)." AND name = ".db_formatString($row["listing_city"])."";
						$resultRegion = mysql_query($sqlRegion, $link);
						if (mysql_num_rows($resultRegion) <= 0) {
							$region_friendly_url = ereg_replace("[^".FRIENDLYURL_VALIDCHARS."]", FRIENDLYURL_SEPARATOR, $row["listing_city"]);
							$region_friendly_url = strtolower(ereg_replace("".FRIENDLYURL_SEPARATOR."{2,}", FRIENDLYURL_SEPARATOR, $region_friendly_url));
							$sqlRegion = "INSERT INTO Location_Region (cidade_id, name, friendly_url, abbreviation, seo_description, seo_keywords) VALUES (".db_formatNumber($cidade_id).", ".db_formatString($row["listing_city"]).", ".db_formatString($region_friendly_url).", '', '', '')";
							mysql_query($sqlRegion, $link);
							$bairro_id = mysql_insert_id();
							$sqlRegion = "SELECT * FROM Location_Region WHERE id != ".$bairro_id." AND cidade_id = ".db_formatNumber($cidade_id)." AND friendly_url = ".db_formatString($region_friendly_url)."";
							$resultRegion = mysql_query($sqlRegion, $link);
							if (mysql_num_rows($resultRegion) > 0) {
								$region_friendly_url .= FRIENDLYURL_SEPARATOR.$bairro_id;
								$sqlRegion = "UPDATE Location_Region SET friendly_url = ".db_formatString($region_friendly_url)." WHERE cidade_id = ".db_formatNumber($cidade_id)." AND id = ".$bairro_id."";
								mysql_query($sqlRegion, $link);
							}
						} else {
							$rowRegion = mysql_fetch_assoc($resultRegion);
							$bairro_id = $rowRegion["id"];
						}
					}
				}
				####################################################################################################

				####################################################################################################
				### CATEGORY
				####################################################################################################
				unset($categoryIDArray);
				unset($current_listing_categories);
				if ($row["listing_category_1"]) {
					$current_listing_categories[] = $row["listing_category_1"];
				}
				if ($row["listing_category_2"]) {
					$current_listing_categories[] = $row["listing_category_2"];
				}
				if ($row["listing_category_3"]) {
					$current_listing_categories[] = $row["listing_category_3"];
				}
				if ($row["listing_category_4"]) {
					$current_listing_categories[] = $row["listing_category_4"];
				}
				if ($row["listing_category_5"]) {
					$current_listing_categories[] = $row["listing_category_5"];
				}
				$i = 0;
				if ($current_listing_categories) {
					foreach ($current_listing_categories as $current_listing_category) {
						unset($current_category_tree);
						$current_category_tree = explode("->", $current_listing_category);
						while (count($current_category_tree) > LISTING_CATEGORY_LEVEL_AMOUNT) {
							array_pop($current_category_tree);
						}
						for ($count=0; $count<count($current_category_tree); $count++) {
							$current_category_tree[$count] = trim($current_category_tree[$count]);
						}
						$j = 0;
						$last_category_id = 0;
						if ($current_category_tree) {
							foreach ($current_category_tree as $current_category) {
								$sqlCategory = "SELECT * FROM ListingCategory WHERE category_id = ".db_formatNumber($last_category_id)." AND title = ".db_formatString($current_category)."";
								$resultCategory = mysql_query($sqlCategory, $link);
								if (mysql_num_rows($resultCategory) <= 0) {
									$category_friendly_url = ereg_replace("[^".FRIENDLYURL_VALIDCHARS."]", FRIENDLYURL_SEPARATOR, $current_category);
									$category_friendly_url = strtolower(ereg_replace("".FRIENDLYURL_SEPARATOR."{2,}", FRIENDLYURL_SEPARATOR, $category_friendly_url));
									setting_get("edir_default_language", $edir_default_language);
									$sqlCategory = "INSERT INTO ListingCategory (lang, title, title1, title2, title3, title4, category_id, seo_description, seo_description1, seo_description2, seo_description3, seo_description4, friendly_url, friendly_url1, friendly_url2, friendly_url3, friendly_url4, keywords, keywords1, keywords2, keywords3, keywords4, seo_keywords, seo_keywords1, seo_keywords2, seo_keywords3, seo_keywords4, active_listing) VALUES (".db_formatString($edir_default_language).", ".db_formatString($current_category).", '', '', '', '', ".db_formatNumber($last_category_id).", '', '', '', '', '', ".db_formatString($category_friendly_url).", '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0)";
									mysql_query($sqlCategory, $link);
									$current_category_id = mysql_insert_id();
									$sqlCategory = "SELECT * FROM ListingCategory WHERE id != ".$current_category_id." AND category_id = ".db_formatNumber($last_category_id)." AND friendly_url = ".db_formatString($category_friendly_url)."";
									$resultCategory = mysql_query($sqlCategory, $link);
									if (mysql_num_rows($resultCategory) > 0) {
										$category_friendly_url .= FRIENDLYURL_SEPARATOR.$current_category_id;
										$sqlCategory = "UPDATE ListingCategory SET friendly_url = ".db_formatString($category_friendly_url)." WHERE id = ".$current_category_id."";
										mysql_query($sqlCategory, $link);
									}
								} else {
									$rowCategory = mysql_fetch_assoc($resultCategory);
									$current_category_id = $rowCategory["id"];
								}
								$last_category_id = $current_category_id;
								$categoryIDArray[$i][$j] = $current_category_id;
								$j++;
							}
						}
						$i++;
					}
				}
				####################################################################################################

				####################################################################################################
				### ACCOUNT
				####################################################################################################
				$account_id = 0;
				if ($import_sameaccount) {
					$accountObj = new Account($import_account_id);
					$sqlSameAccount = "SELECT history FROM ImportLog WHERE id = ".db_formatNumber($importlogObj->getNumber("id"))."";
					$resultSameAccount = mysql_query($sqlSameAccount, $link);
					$import_sameaccount_message = false;
					if (mysql_num_rows($resultSameAccount) > 0) {
						$rowSameAccount = mysql_fetch_assoc($resultSameAccount);
						if (strpos($rowSameAccount["history"], "same account") === false) {
							$import_sameaccount_message = true;
						}
					}
					if ($accountObj->getNumber("id") > 0) {
						$account_id = $accountObj->getNumber("id");
						if ($import_sameaccount_message) {
							$importlogObj->setHistory(system_showText(LANG_SITEMGR_IMPORT_WILLBEIMPORTEDTOSAMEACCOUNT)." ".$accountObj->getString("username").".");
							import_logDebug("All ".LISTING_FEATURE_NAME_PLURAL." will be imported to same account: ".$accountObj->getString("username")." - LINE: ".__LINE__);
						}
					} else {
						if ($import_sameaccount_message) {
							$importlogObj->setHistory(system_showText(LANG_SITEMGR_IMPORT_IMPORTTOSAMEACCOUNTINVALIDACCOUNTID));
							import_logDebug("Import to same account: invalid account id - LINE: ".__LINE__);
						}
					}
				} else {
					if ($row["account_username"]) {
						$sqlAccount = "SELECT * FROM Account WHERE username = ".db_formatString($row["account_username"])."";
						$resultAccount = mysql_query($sqlAccount, $link);
						if (mysql_num_rows($resultAccount) <= 0) {
							$sqlAccount = "INSERT INTO Account (updated, entered, agree_tou, lastlogin, username, password, importID) VALUES ('".date('Y-m-d H:i:s')."', '".date('Y-m-d H:i:s')."', 1, 0, ".db_formatString($row["account_username"]).", ".db_formatString((((!$import_from_export) && (strtolower(PASSWORD_ENCRYPTION) == "on")) ? md5($row["account_password"]) : $row["account_password"])).", ".db_formatNumber($importlogObj->getNumber("id")).")";
							mysql_query($sqlAccount, $link);
							$account_id = mysql_insert_id();
							$sqlContact = "INSERT INTO Contact (account_id, updated, entered, first_name, last_name, company, address, address2, country, state, city, zip, phone, fax, email, url, importID) VALUES (".db_formatNumber($account_id).", '".date('Y-m-d H:i:s')."', '".date('Y-m-d H:i:s')."', ".db_formatString($row["account_first_name"]).", ".db_formatString($row["account_last_name"]).", ".db_formatString($row["account_company"]).", ".db_formatString($row["account_address"]).", ".db_formatString($row["account_address2"]).", ".db_formatString($row["account_country"]).", ".db_formatString($row["account_state"]).", ".db_formatString($row["account_city"]).", ".db_formatString($row["account_zip"]).", ".db_formatString($row["account_phone"]).", ".db_formatString($row["account_fax"]).", ".db_formatString($row["account_email"]).", ".db_formatString($row["account_url"]).", ".db_formatNumber($importlogObj->getNumber("id")).")";
							mysql_query($sqlContact, $link);
						} else {
							$rowAccount = mysql_fetch_assoc($resultAccount);
							$account_id = $rowAccount["id"];
						}
					}
				}
				####################################################################################################

				####################################################################################################
				### LISTING TEMPLATE
				####################################################################################################
				$listingtemplate_id = 0;
				if ($row["listing_template"]) {
					$sqlTemplate = "SELECT * FROM ListingTemplate WHERE title = ".db_formatString($row["listing_template"])."";
					$resultTemplate = mysql_query($sqlTemplate, $link);
					if (mysql_num_rows($resultTemplate)) {
						$rowTemplate = mysql_fetch_assoc($resultTemplate);
						$listingtemplate_id = $rowTemplate["id"]; 
					}
				}

				####################################################################################################
				### LISTING
				####################################################################################################
				$listing_id = 0;
				if ($row["listing_title"]) {
					if ($import_enable_listing_active) {
						$listing_status = "active";
					} else {
						$listing_status = $row["listing_status"];
					}
					$validStatus = "";
					foreach ($allStatus as $eachStatusValue=>$eachStatusName) {
						if (strpos(strtoupper($eachStatusName), strtoupper($listing_status)) !== false) {
							$validStatus = $eachStatusValue;
						}
					}
					if ($validStatus) {
						$listing_status = $validStatus;
					} else {
						$listing_status = $defaultStatus;
					}
					if (array_search($row["listing_level"], $levelObj->getValueName()) !== false) {
						$listing_level = array_search($row["listing_level"], $levelObj->getValueName());
					} else {
						if ($import_defaultlevel) {
							$listing_level = $import_defaultlevel;
						} else {
							$listing_level = $levelObj->getDefaultLevel();
						}
					}
					$listing_friendly_url = ereg_replace("[^".FRIENDLYURL_VALIDCHARS."]", FRIENDLYURL_SEPARATOR, $row["listing_title"]);
					$listing_friendly_url = strtolower(ereg_replace("".FRIENDLYURL_SEPARATOR."{2,}", FRIENDLYURL_SEPARATOR, $listing_friendly_url));
					$listing_friendly_url = $listing_friendly_url.FRIENDLYURL_SEPARATOR.uniqid();
					$cat_1_id = 0;
					$parcat_1_level1_id = 0;
					$parcat_1_level2_id = 0;
					$parcat_1_level3_id = 0;
					$parcat_1_level4_id = 0;
					$cat_2_id = 0;
					$parcat_2_level1_id = 0;
					$parcat_2_level2_id = 0;
					$parcat_2_level3_id = 0;
					$parcat_2_level4_id = 0;
					$cat_3_id = 0;
					$parcat_3_level1_id = 0;
					$parcat_3_level2_id = 0;
					$parcat_3_level3_id = 0;
					$parcat_3_level4_id = 0;
					$cat_4_id = 0;
					$parcat_4_level1_id = 0;
					$parcat_4_level2_id = 0;
					$parcat_4_level3_id = 0;
					$parcat_4_level4_id = 0;
					$cat_5_id = 0;
					$parcat_5_level1_id = 0;
					$parcat_5_level2_id = 0;
					$parcat_5_level3_id = 0;
					$parcat_5_level4_id = 0;
					if ($categoryIDArray) {
						$count_cat_aux = 1;
						foreach ($categoryIDArray as $category_id_tree) {
							${"cat_".$count_cat_aux."_id"} = $category_id_tree[count($category_id_tree)-1];
							${"parcat_".$count_cat_aux."_level1_id"} = $category_id_tree[count($category_id_tree)-2];
							${"parcat_".$count_cat_aux."_level2_id"} = $category_id_tree[count($category_id_tree)-3];
							${"parcat_".$count_cat_aux."_level3_id"} = $category_id_tree[count($category_id_tree)-4];
							${"parcat_".$count_cat_aux."_level4_id"} = $category_id_tree[count($category_id_tree)-5];
							$count_cat_aux++;
						}
					}
					$sqlListing = "INSERT INTO Listing (account_id, image_id, thumb_id, promotion_id, estado_id, cidade_id, bairro_id, city_id, area_id, updated, entered, renewal_date, discount_id, title, seo_title, friendly_url, email, url, display_url, address, address2, zip_code, phone, fax, description, description1, description2, description3, description4, seo_description, seo_description1, seo_description2, seo_description3, seo_description4, long_description, long_description1, long_description2, long_description3, long_description4, keywords, keywords1, keywords2, keywords3, keywords4, seo_keywords, seo_keywords1, seo_keywords2, seo_keywords3, seo_keywords4, attachment_file, attachment_caption, status, level, fulltextsearch_keyword, fulltextsearch_where, video_snippet, importID, hours_work, locations, cat_1_id, parcat_1_level1_id, parcat_1_level2_id, parcat_1_level3_id, parcat_1_level4_id, cat_2_id, parcat_2_level1_id, parcat_2_level2_id, parcat_2_level3_id, parcat_2_level4_id, cat_3_id, parcat_3_level1_id, parcat_3_level2_id, parcat_3_level3_id, parcat_3_level4_id, cat_4_id, parcat_4_level1_id, parcat_4_level2_id, parcat_4_level3_id, parcat_4_level4_id, cat_5_id, parcat_5_level1_id, parcat_5_level2_id, parcat_5_level3_id, parcat_5_level4_id, listingtemplate_id, custom_text0, custom_text1, custom_text2, custom_text3, custom_text4, custom_text5, custom_text6, custom_text7, custom_text8, custom_text9, custom_short_desc0, custom_short_desc1, custom_short_desc2, custom_short_desc3, custom_short_desc4, custom_short_desc5, custom_short_desc6, custom_short_desc7, custom_short_desc8, custom_short_desc9, custom_long_desc0, custom_long_desc1, custom_long_desc2, custom_long_desc3, custom_long_desc4, custom_long_desc5, custom_long_desc6, custom_long_desc7, custom_long_desc8, custom_long_desc9, custom_checkbox0, custom_checkbox1, custom_checkbox2, custom_checkbox3, custom_checkbox4, custom_checkbox5, custom_checkbox6, custom_checkbox7, custom_checkbox8, custom_checkbox9, custom_dropdown0, custom_dropdown1, custom_dropdown2, custom_dropdown3, custom_dropdown4, custom_dropdown5, custom_dropdown6, custom_dropdown7, custom_dropdown8, custom_dropdown9, maptuning) VALUES (".db_formatNumber($account_id).", 0, 0, 0, ".db_formatNumber($estado_id).", ".db_formatNumber($cidade_id).", ".db_formatNumber($bairro_id).", 0, 0, '".date('Y-m-d H:i:s')."', '".date('Y-m-d H:i:s')."', ".db_formatString($row["listing_renewal_date"]).", '', ".db_formatString($row["listing_title"]).", ".db_formatString($row["listing_title"]).", ".db_formatString($listing_friendly_url).", ".db_formatString($row["listing_email"]).", ".db_formatString($row["listing_url"]).", '', ".db_formatString($row["listing_address"]).", ".db_formatString($row["listing_address2"]).", ".db_formatString($row["listing_zip"]).", ".db_formatString($row["listing_phone"]).", ".db_formatString($row["listing_fax"]).", ".db_formatString($row["listing_description"]).", '', '', '', '', ".db_formatString($row["listing_description"]).", '', '', '', '', ".db_formatString($row["listing_long_description"]).", '', '', '', '', ".db_formatString($row["listing_keyword"]).", '', '', '', '', ".db_formatString($row["listing_keyword"]).", '', '', '', '', '', '', ".db_formatString($listing_status).", ".db_formatString($listing_level).", '', '', '', ".db_formatNumber($importlogObj->getNumber("id")).", '', '', ".db_formatNumber($cat_1_id).", ".db_formatNumber($parcat_1_level1_id).", ".db_formatNumber($parcat_1_level2_id).", ".db_formatNumber($parcat_1_level3_id).", ".db_formatNumber($parcat_1_level4_id).", ".db_formatNumber($cat_2_id).", ".db_formatNumber($parcat_2_level1_id).", ".db_formatNumber($parcat_2_level2_id).", ".db_formatNumber($parcat_2_level3_id).", ".db_formatNumber($parcat_2_level4_id).", ".db_formatNumber($cat_3_id).", ".db_formatNumber($parcat_3_level1_id).", ".db_formatNumber($parcat_3_level2_id).", ".db_formatNumber($parcat_3_level3_id).", ".db_formatNumber($parcat_3_level4_id).", ".db_formatNumber($cat_4_id).", ".db_formatNumber($parcat_4_level1_id).", ".db_formatNumber($parcat_4_level2_id).", ".db_formatNumber($parcat_4_level3_id).", ".db_formatNumber($parcat_4_level4_id).", ".db_formatNumber($cat_5_id).", ".db_formatNumber($parcat_5_level1_id).", ".db_formatNumber($parcat_5_level2_id).", ".db_formatNumber($parcat_5_level3_id).", ".db_formatNumber($parcat_5_level4_id).", ".db_formatNumber($listingtemplate_id).", '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '')";
					mysql_query($sqlListing, $link);
					$listing_id = mysql_insert_id();
					unset($fulltextsearch_keyword);
					unset($fulltextsearch_where);
					if ($row["listing_title"]) {
						$fulltextsearch_keyword[] = $row["listing_title"];
					}
					if ($row["listing_keyword"]) {
						$fulltextsearch_keyword[] = str_replace(" || ", " ", $row["listing_keyword"]);
					}
					if ($row["listing_address"]) {
						$fulltextsearch_where[] = $row["listing_address"];
					}
					if ($row["listing_zip"]) {
						$fulltextsearch_where[] = $row["listing_zip"];
					}
					if ($row["listing_country"]) {
						$fulltextsearch_where[] = $row["listing_country"];
					}
					if ($row["listing_state"]) {
						$fulltextsearch_where[] = $row["listing_state"];
					}
					if ($row["listing_city"]) {
						$fulltextsearch_where[] = $row["listing_city"];
					}
					if ($row["listing_category_1"]) {
						$fulltextsearch_keyword[] = str_replace("->", " ", $row["listing_category_1"]);
					}
					if ($row["listing_category_2"]) {
						$fulltextsearch_keyword[] = str_replace("->", " ", $row["listing_category_2"]);
					}
					if ($row["listing_category_3"]) {
						$fulltextsearch_keyword[] = str_replace("->", " ", $row["listing_category_3"]);
					}
					if ($row["listing_category_4"]) {
						$fulltextsearch_keyword[] = str_replace("->", " ", $row["listing_category_4"]);
					}
					if ($row["listing_category_5"]) {
						$fulltextsearch_keyword[] = str_replace("->", " ", $row["listing_category_5"]);
					}
					if ($row["listing_description"]) {
						$fulltextsearch_keyword[] = substr($row["listing_description"], 0, 100);
					}
					if ($fulltextsearch_keyword) {
						$fulltextsearch_keyword_sql = db_formatString(implode(" ", $fulltextsearch_keyword));
						$sqlFullTextSearch = "UPDATE Listing SET fulltextsearch_keyword = ".$fulltextsearch_keyword_sql." WHERE id = ".db_formatNumber($listing_id)."";
						mysql_query($sqlFullTextSearch, $link);
					}
					if ($fulltextsearch_where) {
						$fulltextsearch_where_sql = db_formatString(implode(" ", $fulltextsearch_where));
						$sqlFullTextSearch = "UPDATE Listing SET fulltextsearch_where = ".$fulltextsearch_where_sql." WHERE id = ".db_formatNumber($listing_id)."";
						mysql_query($sqlFullTextSearch, $link);
					}
					if ($listing_status == "A") system_countActiveListingByCategory($listing_id, "inc");
					if (ZIPCODE_PROXIMITY == "on") {
						zipproximity_updateDB("Listing", $listing_id);
					}
				}
				
                ####################################################################################################
				$importlogObj = new ImportLog($importlogObj->getNumber("id"));
				$importlogObj->setNumber("linesadded", ((int)$importlogObj->getNumber("linesadded")+1));
				$importlogObj->setString("progress", (floor(($row["file_line_number"]-1)/($importlogObj->getString("totallines"))*100))."%");
				$importlogObj->save();
				$sql = "DELETE FROM ImportTemporary WHERE id = '".$row["id"]."' LIMIT 1";
				$result = mysql_query($sql, $link);
				$sql = "SELECT * FROM ImportTemporary WHERE import_log_id = '".$importlogObj->getNumber("id")."' ORDER BY id LIMIT 1";
				$result = mysql_query($sql, $link);
				$current_listing++;
				$current_time = getmicrotime() - $time_start;
			}
			$sql = "SELECT * FROM ImportTemporary WHERE import_log_id = '".$importlogObj->getNumber("id")."' ORDER BY id LIMIT 1";
			$result = mysql_query($sql, $link);
			if (mysql_num_rows($result) <= 0) {
				$importlogObj = new ImportLog($importlogObj->getNumber("id"));
				if ($importlogObj->getString("status") == "R") {
					$importlogObj->setString("status", "F");
					$importlogObj->setString("progress", "100%");
					import_logDebug("Changing status - finished - LINE: ".__LINE__);
				} else {
					import_logDebug("Process not running - LINE: ".__LINE__);
				}
				$importlogObj->save();
			}
		} else {
			$import_stop = true;
			import_logDebug("No running process - LINE: ".__LINE__);
		}
	}
	////////////////////////////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////////////////////////////
	unset($sql);
	unset($result);
	unset($row);
	unset($importObj);
	$sql = "SELECT * FROM ImportLog WHERE status = 'W' ORDER BY id LIMIT 1";
	$result = mysql_query($sql, $link);
	if (mysql_num_rows($result) > 0) {
		$row = mysql_fetch_assoc($result);
		$importObj = new ImportLog($row["id"]);
		$importObj->setString("status", "S");
		$importObj->save();
		$importObj->setHistory(system_showText(LANG_SITEMGR_IMPORT_IMPORTINGPROCESSSTOPPED)." - ".$importObj->getString("progress").".");
		import_logDebug("Import process stopped - ".$importObj->getString("progress")." - LINE: ".__LINE__);
		$sql = "DELETE FROM ImportTemporary WHERE import_log_id = '".$importObj->getNumber("id")."'";
		mysql_query($sql, $link);
	}
	unset($importObj);
	unset($row);
	unset($result);
	unset($sql);
	////////////////////////////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////////////////////////////
	if ($this_token) {
		if (!unlink($filename_token)) {
			$eDirMailerObj = new EDirMailer(EDIR_ADMIN_EMAIL, "[eDirectory Cron] - Import Process", "Error: file delete (".$filename_token.").", $sitemgr_email);
			$eDirMailerObj->send();
			exit;
		}
		import_logDebug("Leaving token - LINE: ".__LINE__);
	}
	////////////////////////////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////////////////////////////
	$time_end = getmicrotime();
	import_logDebug("End Date/Time: ".date("Y-m-d H:i:s"));
	import_logDebug("++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++");
	$time = $time_end - $time_start;
	if (!$import_stop) {
		print "Import Process - ".date("Y-m-d H:i:s")." - ".ucwords(LISTING_FEATURE_NAME_PLURAL).": ".$current_listing." - ".round($time, 2)." seconds.\n";
		if (!setting_set("last_datetime_import", date("Y-m-d H:i:s"))) {
			if (!setting_new("last_datetime_import", date("Y-m-d H:i:s"))) {
				print "last_datetime_import error - ".date("Y-m-d H:i:s")."\n";
			}
		}
	}
	////////////////////////////////////////////////////////////////////////////////////////////////////

?>