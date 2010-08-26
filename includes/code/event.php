<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/code/event.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == "POST") {

		##################################################
		### KEYWORDS
		##################################################
		for ($i=0; $i<count(explode(",", EDIR_LANGUAGES)); $i++) {
			$labelsuffix = "";
			if ($i) $labelsuffix = $i;
			unset($arr_keywords);
			unset($each_keyword);
			unset($aux_kw);
			unset($new_arr_keywords);
			unset($aux_keywords);
			$arr_keywords = explode("\n", ${"keywords".$labelsuffix});
			foreach ($arr_keywords as $each_keyword) {
				$aux_kw = trim($each_keyword);
				if (strlen($aux_kw) > 0) {
					$new_arr_keywords[] = $aux_kw;
				}
			}
			if ($new_arr_keywords) $aux_keywords = implode(" || ", $new_arr_keywords);
			$_POST["keywords".$labelsuffix] = $aux_keywords;
			$_POST["array_keywords".$labelsuffix] = $new_arr_keywords;
		}
		##################################################

		for ($i=0; $i<count(explode(",", EDIR_LANGUAGES)); $i++) {
			$labelsuffix = "";
			if ($i) $labelsuffix = $i;
			// strip \r chars provided by Windows, in order to keep character count standard
			if ($_POST["description".$labelsuffix]) {
				$_POST["description".$labelsuffix] = str_replace("\r", "", $_POST["description".$labelsuffix]);
			}
		}

		$_POST["email"] = trim($_POST["email"]);
		$_POST["url"] = trim($_POST["url"]);

		$_POST["friendly_url"] = str_replace(".htm", "", $_POST["friendly_url"]);
		$_POST["friendly_url"] = str_replace(".html", "", $_POST["friendly_url"]);
		$_POST["friendly_url"] = trim($_POST["friendly_url"]);
		$sqlFriendlyURL = "";
		$sqlFriendlyURL .= " SELECT friendly_url FROM Event WHERE friendly_url = ".db_formatString($_POST["friendly_url"])." ";
		if ($id) $sqlFriendlyURL .= " AND id != $id ";
		$sqlFriendlyURL .= " LIMIT 1 ";
		$dbObjFriendlyURL = db_getDBObject();
		$resultFriendlyURL = $dbObjFriendlyURL->query($sqlFriendlyURL);
		if (mysql_num_rows($resultFriendlyURL) > 0) {
			if ($id) $_POST["friendly_url"] = $_POST["friendly_url"].FRIENDLYURL_SEPARATOR.$id;
			else $_POST["friendly_url"] = $_POST["friendly_url"].FRIENDLYURL_SEPARATOR.uniqid();
		}

		if ((validate_form("event", $_POST, $message_event)) && is_valid_discount_code($_POST["discount_id"], "event", $_POST["id"], $message_event, $discount_error_num)) {

			// fixing url field if needed.
			if (trim($_POST["url"]) != "") {
				if (strpos($_POST["url"], "://") !== false) {
					$aux_url = explode("://", $_POST["url"]);
					$aux_url = $aux_url[1];
					$_POST["url"] = $aux_url;
				}
				$_POST["url"] = $_POST["url_protocol"] . $_POST["url"];
			}

			$upload_image = "no image";

			//Clean Image
			if ($remove_image) {
				$event = new Event($id);
				if ($idm = $event->getNumber("image_id")) {
					$image = new Image($idm);
					if ($image) $image->Delete();
				}
				if ($idm = $event->getNumber("thumb_id")) {
					$image = new Image($idm);
					if ($image) $image->Delete();
				}
				unset($event);
			}

			if (file_exists($_FILES['image']['tmp_name'])) {
				$imageArray = image_uploadForItem($_FILES['image']['tmp_name'], IMAGE_EVENT_FULL_WIDTH, IMAGE_EVENT_FULL_HEIGHT, IMAGE_EVENT_THUMB_WIDTH, IMAGE_EVENT_THUMB_HEIGHT);
				if ($imageArray["success"]) {
					$upload_image = "success";
					$remove_image = false;
				}
				else $upload_image = "failed";
			}

			if ($upload_image != "failed") {

				$status = new ItemStatus();

				$event = new Event($id);

				/* security bug */
				if (strpos($url_base, "/membros") !== false) {
					if ($event->getNumber("id")) {
						if ($event->getNumber("account_id") != sess_getAccountIdFromSession()) {
							header("Location: ".$url_base."/event/".(($search_page) ? "search.php" : "index.php"));
							exit;
						}
					}
				}

				if ($start_time_hour && $start_time_min && $start_time_am_pm) {
					$_POST["has_start_time"] = "y";
					$startTimeStr = "";
					if (($start_time_am_pm == "pm") && ($start_time_hour < 12)) $startTimeStr = 12 + $start_time_hour;
					elseif (($start_time_am_pm == "am") && ($start_time_hour == "12")) $startTimeStr = "00";
					else $startTimeStr = $start_time_hour;
					$startTimeStr .= ":".$start_time_min.":00";
					$_POST["start_time"] = $startTimeStr;
				} else {
					$_POST["has_start_time"] = "n";
					$_POST["start_time"] = "00:00:00";
				}

				if ($end_time_hour && $end_time_min && $end_time_am_pm) {
					$_POST["has_end_time"] = "y";
					$endTimeStr = "";
					if (($end_time_am_pm == "pm") && ($end_time_hour < 12)) $endTimeStr = 12 + $end_time_hour;
					elseif (($end_time_am_pm == "am") && ($end_time_hour == "12")) $endTimeStr = "00";
					else $endTimeStr = $end_time_hour;
					$endTimeStr .= ":".$end_time_min.":00";
					$_POST["end_time"] = $endTimeStr;
				} else {
					$_POST["has_end_time"] = "n";
					$_POST["end_time"] = "00:00:00";
				}

				if (!$event->GetString("id") || $event->GetString("id") == 0){

					$message = system_showText(LANG_MSG_EVENT_SUCCESSFULLY_ADDED);
					$emailNotification = true;
					$event->makeFromRow($_POST);
					$event->setString("status", $status->getDefaultStatus());
					$event->setDate("renewal_date", "00/00/0000");
					$newest = "1";

				} else {

					$message = system_showText(LANG_MSG_EVENT_SUCCESSFULLY_UPDATED);

					$emailNotification = false;
					if ($event->getString("status") != $status->getDefaultStatus()) $emailNotification = true;

					//security issue
					unset($_POST["status"]);
					unset($_POST["renewal_date"]);

					if (!$event->hasRenewalDate()) {
						$_POST["renewal_date"] = "0000-00-00";
					}

					if (strpos($url_base, "/gerenciamento")) {

						$_POST["status"] = $event->getString("status");

						if ($event->getNumber("account_id") != $_POST["account_id"]) {
							// remove relationship if sitemgr change account
							$event->setGalleries();
						}

					}

					if ($event->getNumber("level") != $_POST["level"]) $event->setDate("renewal_date", "00/00/0000");

					$event->makeFromRow($_POST);

				}

				if ($upload_image == "success") {
					$event->updateImage($imageArray);
				}

				if ($remove_image) {
					$event->setNumber("image_id", 0);
					$event->setNumber("thumb_id", 0);
				}

				$levelObjTmp = new EventLevel(EDIR_DEFAULT_LANGUAGE, true);
				$levelsTmp = $levelObjTmp->getLevelValues();
				if (!in_array($event->getNumber("level"), $levelsTmp)) {
					$event->setNumber("level", $levelObjTmp->getDefaultLevel());
				}
				unset($levelObjTmp);
				unset($levelsTmp);

				$event->Save();

				if (ZIPCODE_PROXIMITY == "on") {
					zipproximity_updateDB("Event", $event->getNumber("id"));
				}

				/**
				*
				* E-mail notify
				*
				******************************************************/
				if ($event->getNumber("account_id") > 0) {
					if($message == system_showText(LANG_MSG_EVENT_SUCCESSFULLY_ADDED)) {
						$contactObj = new Contact($event->getNumber("account_id"));
						if($emailNotificationObj = system_checkEmail(SYSTEM_NEW_EVENT, $contactObj->getString("lang"))) {
							setting_get("sitemgr_send_email", $sitemgr_send_email);
							setting_get("sitemgr_email", $sitemgr_email);
							$sitemgr_emails = split(",", $sitemgr_email);
							if ($sitemgr_emails[0]) $sitemgr_email = $sitemgr_emails[0];
							$subject = $emailNotificationObj->getString("subject");
							$body    = $emailNotificationObj->getString("body");
							$body = system_replaceEmailVariables($body,$event->getNumber('id'),'event');
							$subject = system_replaceEmailVariables($subject,$event->getNumber('id'),'event');
							$body    = str_replace("DEFAULT_URL", DEFAULT_URL, $body);
							$body = html_entity_decode($body);
							$subject = html_entity_decode($subject);
							$error = false;
							system_mail($contactObj->getString("email"), $subject, $body, EDIRECTORY_TITLE." <$sitemgr_email>", $emailNotificationObj->getString("content_type"), "", $emailNotificationObj->getString("bcc"), $error);
						}
					}
				}
				if ($emailNotification) {
					if(!strpos($url_base, "/gerenciamento")){
						setting_get("sitemgr_send_email",$sitemgr_send_email);
						setting_get("sitemgr_email",$sitemgr_email);
						$sitemgr_emails = split(",",$sitemgr_email);
						setting_get("sitemgr_event_email",$sitemgr_event_email);
						$sitemgr_event_emails = split(",",$sitemgr_event_email);
						$account = new Account($acctId);
						$contact = new Contact($acctId);
						$sitemgr_msg = "
							<html>
								<head>
									<style>
										.email_style_settings{
											font-size:12px;
											font-family:Verdana, Arial, Sans-Serif;
											color:#000;
										}
									</style>
								</head>
								<body>
									<div class=\"email_style_settings\">
										Site Manager,<br /><br />
										The ".EVENT_FEATURE_NAME." \"".$event->getString("title")."\" was ". ((!$id) ? "created" : "changed") ." by the ".EVENT_FEATURE_NAME." administrator \"".system_showAccountUserName($account->getString("username"))."\" and needs to be revised by you.<br /><br />
										<a href=\"".DEFAULT_URL."/gerenciamento/event/view.php?id=".$event->getNumber("id")."\" target=\"_blank\">".DEFAULT_URL."/gerenciamento/event/view.php?id=".$event->getNumber("id")."</a><br /><br />
									</div>
								</body>
							</html>";
						// sending e-mail to site manager
						$error = false;
						if ($sitemgr_send_email == "on") {
							if ($sitemgr_emails[0]) {
								foreach ($sitemgr_emails as $sitemgr_email) {
									system_mail($sitemgr_email, "[".EDIRECTORY_TITLE."] ".ucwords(EVENT_FEATURE_NAME)." Notification", $sitemgr_msg, EDIRECTORY_TITLE." <$sitemgr_email>", "text/html", '', '', $error);
								}
							}
						}
						if ($sitemgr_event_emails[0]) {
							foreach ($sitemgr_event_emails as $sitemgr_event_email) {
								system_mail($sitemgr_event_email, "[".EDIRECTORY_TITLE."] ".ucwords(EVENT_FEATURE_NAME)." Notification", $sitemgr_msg, EDIRECTORY_TITLE." <$sitemgr_event_email>", "text/html", '', '', $error);
							}
						}
					}
				}
				/******************************************************/

				// setting categories
				$return_categories_array = explode(",", $return_categories);
				$event->setCategories($return_categories_array);

				header("Location: $url_redirect/".(($search_page) ? "search.php" : "index.php")."?process=".$process."&newest=".$newest."&message=".urlencode($message)."&screen=$screen&letra=$letra".(($url_search_params) ? "&$url_search_params" : ""));
				exit;

			} elseif ($upload_image == "failed") {
				$message_event .= "<br />".system_showText(LANG_SITEMGR_MSGERROR_INVALIDIMAGEPLEASEINSERTJPGORGIF);
			}
		}

		// removing slashes added if required
		$_POST = format_magicQuotes($_POST);
		$_GET  = format_magicQuotes($_GET);

		extract($_POST);
		extract($_GET);

	}
	
	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------
	$id = $_GET["id"] ? $_GET["id"] : $_POST["id"];

	if ($id) {

		if (strpos($url_base, "/membros")) {
			$by_key = array("id", "account_id");
			$by_value = array(db_formatNumber($id), sess_getAccountIdFromSession());
			$event = db_getFromDB("event", $by_key, $by_value);
		} else {
			$event = db_getFromDB("event", "id", db_formatNumber($id));
		}

		if ((sess_getAccountIdFromSession() != $event->getNumber("account_id")) && (!strpos($url_base, "/gerenciamento"))) {
			header("Location: $url_redirect/".(($search_page) ? "search.php" : "index.php")."?message=".urlencode($message)."&screen=$screen&letra=$letra".(($url_search_params) ? "&$url_search_params" : "" )."");
			exit;
		}

		$event->extract();

		// Location defines begin for edit event
		$countryObj = new LocationCountry();
		$countries  = $countryObj->retrieveAllCountries();

		if($estado_id) {
			$stateObj = new LocationState();
			$stateObj->SetString("estado_id",$estado_id);
			$selected_states = $stateObj->retrieveStatesByCountry();
		}

		if($cidade_id) {
			$regionObj = new LocationRegion();
			$regionObj->SetString("cidade_id",$cidade_id);
			$selected_regions = $regionObj->retrieveRegionsByState();
		}

		if($bairro_id) {
			$cityObj = new LocationCity();
			$cityObj->SetString("bairro_id",$bairro_id);
			$selected_cities = $cityObj->retrieveCitiesByRegion();
		}

		if($city_id) {
			$areaObj = new LocationArea();
			$areaObj->SetString("city_id",$city_id);
			$selected_areas = $areaObj->retrieveAreasByCity();
		}

		$selected_country = ($estado_id) ? new LocationCountry($estado_id) : FALSE;
		$selected_state   = ($cidade_id)   ? new LocationState($cidade_id)     : FALSE;
		$selected_region  = ($bairro_id)  ? new LocationRegion($bairro_id)   : FALSE;
		$selected_city    = ($city_id)    ? new LocationCity($city_id)       : FALSE;
		$selected_area    = ($area_id)    ? new LocationArea($area_id)       : FALSE;

	} else {

		$event = new Event($id);
		$event->makeFromRow($_POST);

		if ($acctId) $account_id = $acctId; else $account_id = $account_id;

		// Location defines begin for add event
		$countryObj = new LocationCountry();
		$countries  = $countryObj->retrieveAllCountries();

		if($_POST["estado_id"]) {
			$stateObj = new LocationState();
			$stateObj->SetString("estado_id",$_POST["estado_id"]);
			$selected_states = $stateObj->retrieveStatesByCountry();
		}

		if($_POST["cidade_id"]) {
			$regionObj = new LocationRegion();
			$regionObj->SetString("cidade_id",$_POST["cidade_id"]);
			$selected_regions = $regionObj->retrieveRegionsByState();
		}

		if($_POST["bairro_id"]) {
			$cityObj = new LocationCity();
			$cityObj->SetString("bairro_id",$_POST["bairro_id"]);
			$selected_cities = $cityObj->retrieveCitiesByRegion();
		}

		if($_POST["city_id"]) {
			$areaObj = new LocationArea();
			$areaObj->SetString("city_id",$_POST["city_id"]);
			$selected_areas = $areaObj->retrieveAreasByCity();
		}

		$selected_country = ($_POST["estado_id"]) ? new LocationCountry($_POST["estado_id"]) : FALSE;
		$selected_state   = ($_POST["cidade_id"])   ? new LocationState($_POST["cidade_id"])     : FALSE;
		$selected_region  = ($_POST["bairro_id"])  ? new LocationRegion($_POST["bairro_id"])   : FALSE;
		$selected_city    = ($_POST["city_id"])    ? new LocationCity($_POST["city_id"])       : FALSE;
		$selected_area    = ($_POST["area_id"])    ? new LocationArea($_POST["area_id"])       : FALSE;

	}

	extract($_POST);
	extract($_GET);

	// level
	$levelObj = new EventLevel(EDIR_DEFAULT_LANGUAGE, true);
	if ($level) {
		$levelArray[$levelObj->getLevel($level)] = $level;
	} else {
		$levelArray[$levelObj->getLevel($levelObj->getDefaultLevel())] = $levelObj->getDefaultLevel();
	}

	$langIndex = language_getIndex(EDIR_LANGUAGE);
	$categories = "";
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		if ($return_categories) {
			$return_categories_array = explode(",", $return_categories);
			foreach ($return_categories_array as $each_category) {
				$categories[] = new EventCategory($each_category);
			}
		}
	} else {
		if (!$categories) if ($event) $categories = $event->getCategories();
	}
	if ($categories) {
		for ($i=0; $i<count($categories); $i++) {
			if ($categories[$i]->getString("title".$langIndex)) $arr_category[$i]["name"] = $categories[$i]->getString("title".$langIndex);
			else $arr_category[$i]["name"] = $categories[$i]->getString("title");
			$arr_category[$i]["value"] = $categories[$i]->getNumber("id");
			$arr_return_categories[] = $categories[$i]->getNumber("id");
		}
		if ($arr_return_categories) $return_categories = implode(",", $arr_return_categories);
		array_multisort($arr_category);
		$feedDropDown = "<select name='feed' multiple size='5' style=\"width:500px\">";
		if ($arr_category) foreach ($arr_category as $each_category) {
			$feedDropDown .= "<option value='".$each_category["value"]."'>".$each_category["name"]."</option>";
		}
		$feedDropDown .= "</select>";
	} else {
		if ($return_categories) {
			$return_categories_array = explode(",", $return_categories);
			if ($return_categories_array) {
				foreach ($return_categories_array as $each_category) {
					$categories[] = new EventCategory($each_category);
				}
			}
		}
		$feedDropDown = "<select name='feed' multiple size='5' style=\"width:500px\">";
		if ($categories) {
			foreach ($categories as $category) {
				if ($category->getString("title".$langIndex)) $name = $category->getString("title".$langIndex);
				else $name = $category->getString("title");
				$feedDropDown .= "<option value='".$category->getNumber("id")."'>$name</option>";
			}
		}
		$feedDropDown .= "</select>";
	}

	if ($has_start_time == "y") {
		$startTimeStr = explode(":", $start_time);
		if ($startTimeStr[0] > "12") {
			$start_time_hour = $startTimeStr[0] - 12;
			$start_time_am_pm = "pm";
		} elseif ($startTimeStr[0] == "12") {
			$start_time_hour = 12;
			$start_time_am_pm = "pm";
		} elseif ($startTimeStr[0] == "00") {
			$start_time_hour = 12;
			$start_time_am_pm = "am";
		} else {
			$start_time_hour = $startTimeStr[0];
			$start_time_am_pm = "am";
		}
		if ($start_time_hour < 10) $start_time_hour = "0".$start_time_hour;
		$start_time_min = $startTimeStr[1];
	}

	if ($has_end_time == "y") {
		$endTimeStr = explode(":", $end_time);
		if ($endTimeStr[0] > "12") {
			$end_time_hour = $endTimeStr[0] - 12;
			$end_time_am_pm = "pm";
		} elseif ($endTimeStr[0] == "12") {
			$end_time_hour = 12;
			$end_time_am_pm = "pm";
		} elseif ($endTimeStr[0] == "00") {
			$end_time_hour = 12;
			$end_time_am_pm = "am";
		} else {
			$end_time_hour = $endTimeStr[0];
			$end_time_am_pm = "am";
		}
		if ($end_time_hour < 10) $end_time_hour = "0".$end_time_hour;
		$end_time_min = $endTimeStr[1];
	}

	$sthArray = Array("01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12");
	$stmArray = Array("00", "05", "10", "15", "20", "25", "30", "35", "40", "45", "50", "55");
	$ethArray = Array("01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12");
	$etmArray = Array("00", "05", "10", "15", "20", "25", "30", "35", "40", "45", "50", "55");
	$start_time_hour_DD = html_selectBox("start_time_hour", $sthArray, $sthArray, $start_time_hour, "", "style='width: 50px;'", "--");
	$start_time_min_DD = html_selectBox("start_time_min", $stmArray, $stmArray, $start_time_min, "", "style='width: 50px;'", "--");
	$end_time_hour_DD = html_selectBox("end_time_hour", $ethArray, $ethArray, $end_time_hour, "", "style='width: 50px;'", "--");
	$end_time_min_DD = html_selectBox("end_time_min", $etmArray, $etmArray, $end_time_min, "", "style='width: 50px;'", "--");

	##################################################
	### KEYWORDS
	##################################################
	for ($i=0; $i<count(explode(",", EDIR_LANGUAGES)); $i++) {
		$labelsuffix = "";
		if ($i) $labelsuffix = $i;
		unset($arr_keywords);
		if ($_POST["keywords".$labelsuffix]) {
			$arr_keywords = explode(" || ", $_POST["keywords".$labelsuffix]);
			${"keywords".$labelsuffix} = implode("\n", $arr_keywords);
		} elseif ($event->getString("keywords".$labelsuffix)) {
			$arr_keywords = explode(" || ", $event->getString("keywords".$labelsuffix));
			${"keywords".$labelsuffix} = implode("\n", $arr_keywords);
		}
	}
	##################################################

?>