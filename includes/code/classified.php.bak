<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/code/classified.php
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
			if ($_POST["summarydesc".$labelsuffix]) {
				$_POST["summarydesc".$labelsuffix] = str_replace("\r", "", $_POST["summarydesc".$labelsuffix]);
			}
		}

		$_POST["friendly_url"] = str_replace(".htm", "", $_POST["friendly_url"]);
		$_POST["friendly_url"] = str_replace(".html", "", $_POST["friendly_url"]);
		$_POST["friendly_url"] = trim($_POST["friendly_url"]);
		$sqlFriendlyURL = "";
		$sqlFriendlyURL .= " SELECT friendly_url FROM Classified WHERE friendly_url = ".db_formatString($_POST["friendly_url"])." ";
		if ($id) $sqlFriendlyURL .= " AND id != $id ";
		$sqlFriendlyURL .= " LIMIT 1 ";
		$dbObjFriendlyURL = db_getDBObject();
		$resultFriendlyURL = $dbObjFriendlyURL->query($sqlFriendlyURL);
		if (mysql_num_rows($resultFriendlyURL) > 0) {
			if ($id) $_POST["friendly_url"] = $_POST["friendly_url"].FRIENDLYURL_SEPARATOR.$id;
			else $_POST["friendly_url"] = $_POST["friendly_url"].FRIENDLYURL_SEPARATOR.uniqid();
		}

		if (validate_form("classified", $_POST, $message_classified) && is_valid_discount_code($_POST["discount_id"], "classified", $_POST["id"], $message_classified, $discount_error_num)) {

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

			//Clean the image
			if ($remove_image) {
				$classified = new Classified($id);
				if ($idm = $classified->getNumber("image_id")) {
					$image = new Image($idm);
					if ($image) $image->Delete();
				}
				if ($idm = $classified->getNumber("thumb_id")) {
					$image = new Image($idm);
					if ($image) $image->Delete();
				}
				unset($classified);
			}

			if (file_exists($_FILES['image']['tmp_name'])) {
				$imageArray = image_uploadForItem($_FILES['image']['tmp_name'], IMAGE_CLASSIFIED_FULL_WIDTH, IMAGE_CLASSIFIED_FULL_HEIGHT, IMAGE_CLASSIFIED_THUMB_WIDTH, IMAGE_CLASSIFIED_THUMB_HEIGHT);
				if ($imageArray["success"]) {
					$upload_image = "success";
					$remove_image = false;
				}
				else $upload_image = "failed";
			}

			if ($upload_image != "failed") {

				$status = new ItemStatus();

				$classified = new Classified($id);

				if (!$classified->GetString("id") || $classified->GetString("id") == 0){

					$message = system_showText(LANG_MSG_CLASSIFIED_SUCCESSFULLY_ADDED);

					$classified->makeFromRow($_POST);

					$emailNotification = true;
					$newest = "1";
					$classified->setString("status", $status->getDefaultStatus());

					$classified->setDate("renewal_date", "00/00/0000");

				} else {

					$message = system_showText(LANG_MSG_CLASSIFIED_SUCCESSFULLY_UPDATED);

					$emailNotification = false;
					if ($classified->getString("status") != $status->getDefaultStatus()) $emailNotification = true;

					//security issue
					unset($_POST["status"]);
					unset($_POST["renewal_date"]);

					if (!$classified->hasRenewalDate()) {
						$_POST["renewal_date"] = "0000-00-00";
					}

					if (strpos($url_base, "/gerenciamento")) {

						$_POST["status"] = $classified->getString("status");

						if ($classified->getNumber("account_id") != $_POST["account_id"]) {
							// remove relationship if sitemgr change account
							$classified->setGalleries();
						}

					}

					$classified->makeFromRow($_POST);

				}

				if ($upload_image == "success") {
					$classified->updateImage($imageArray);
				}

				if ($remove_image) {
					$classified->setNumber("image_id", 0);
					$classified->setNumber("thumb_id", 0);
				}

				$levelObjTmp = new ClassifiedLevel(EDIR_DEFAULT_LANGUAGE, true);
				$levelsTmp = $levelObjTmp->getLevelValues();
				if (!in_array($classified->getNumber("level"), $levelsTmp)) {
					$classified->setNumber("level", $levelObjTmp->getDefaultLevel());
				}
				unset($levelObjTmp);
				unset($levelsTmp);

				$classified->Save();

				if (ZIPCODE_PROXIMITY == "on") {
					zipproximity_updateDB("Classified", $classified->getNumber("id"));
				}

				/**
				*
				* E-mail notify
				*
				***************************************************************************************************/
				$error = false;
				if ($classified->getNumber("account_id") > 0) {
					if($message == system_showText(LANG_MSG_CLASSIFIED_SUCCESSFULLY_ADDED)) {
						$contactObj = new Contact($classified->getNumber("account_id"));
						if($emailNotificationObj = system_checkEmail(SYSTEM_NEW_CLASSIFIED, $contactObj->getString("lang"))) {
							setting_get("sitemgr_send_email", $sitemgr_send_email);
							setting_get("sitemgr_email", $sitemgr_email);
							$sitemgr_emails = split(",", $sitemgr_email);
							if ($sitemgr_emails[0]) $sitemgr_email = $sitemgr_emails[0];
							$subject = $emailNotificationObj->getString("subject");
							$body    = $emailNotificationObj->getString("body");
							$body = system_replaceEmailVariables($body,$classified->getNumber('id'),'classified');
							$subject = system_replaceEmailVariables($subject,$classified->getNumber('id'),'classified');
							$body    = str_replace("DEFAULT_URL", DEFAULT_URL, $body);
							$body = html_entity_decode($body);
							$subject = html_entity_decode($subject);
							system_mail($contactObj->getString("email"), $subject, $body, EDIRECTORY_TITLE." <$sitemgr_email>", $emailNotificationObj->getString("content_type"), "", $emailNotificationObj->getString("bcc"), $error);
						}
					}
				}
				if ($emailNotification) {
					if (!strpos($url_base, "/gerenciamento")) {
						setting_get("sitemgr_send_email", $sitemgr_send_email);
						setting_get("sitemgr_email", $sitemgr_email);
						$sitemgr_emails = split(",", $sitemgr_email);
						setting_get("sitemgr_classified_email", $sitemgr_classified_email);
						$sitemgr_classified_emails = split(",", $sitemgr_classified_email);
						$account = new Account($acctId);
						$sitemgr_msg = "
							<html>
								<head>
									<style>
										.email_style_settings{
											font-size:11px;
											font-family:Verdana, Arial, Sans-Serif;
											color:#000;
										}
									</style>
								</head>
								<body>
									<div class=\"email_style_settings\">
										Site Manager,<br /><br />";
										if ($_POST["id"]) $sitemgr_msg .= "The ".CLASSIFIED_FEATURE_NAME." \"".$classified->getString("title")."\" was changed by the administrator \"".system_showAccountUserName($account->getString("username"))."\" and needs to be revised by you.<br /><br />";
										else $sitemgr_msg .= "The ".CLASSIFIED_FEATURE_NAME." \"".$classified->getString("title")."\" was created by the administrator \"".system_showAccountUserName($account->getString("username"))."\" and needs to be revised by you.<br /><br />";
										$sitemgr_msg .= "<a href=\"".DEFAULT_URL."/gerenciamento/classified/view.php?id=".$classified->getNumber("id")."\" target=\"_blank\">".DEFAULT_URL."/gerenciamento/classified/view.php?id=".$classified->getNumber("id")."</a><br /><br />
										".EDIRECTORY_TITLE."
									</div>
								</body>
							</html>";
						// sending e-mail to site manager
						if ($sitemgr_send_email == "on") {
							if ($sitemgr_emails[0]) {
								foreach ($sitemgr_emails as $sitemgr_email) {
									system_mail($sitemgr_email, "[".EDIRECTORY_TITLE."] ".ucwords(CLASSIFIED_FEATURE_NAME)." Notification", $sitemgr_msg, EDIRECTORY_TITLE." <$sitemgr_email>", "text/html", '', '', $error);
								}
							}
						}
						if ($sitemgr_classified_emails[0]) {
							foreach ($sitemgr_classified_emails as $sitemgr_classified_email) {
								system_mail($sitemgr_classified_email, "[".EDIRECTORY_TITLE."] ".ucwords(CLASSIFIED_FEATURE_NAME)." Notification", $sitemgr_msg, EDIRECTORY_TITLE." <$sitemgr_classified_email>", "text/html", '', '', $error);
							}
						}
					}
				}
				/**************************************************************************************************/

				// setting categories
				$return_categories_array[] = $_POST["cat_1_id"];
				$classified->setCategories($return_categories_array);

				header("Location: $url_redirect/".(($search_page) ? "search.php" : "index.php")."?process=".$process."&newest=".$newest."&message=".urlencode($message)."&screen=$screen&letra=$letra".(($url_search_params) ? "&$url_search_params" : "" )."");
				exit;

			} else if ($upload_image == "failed") $message_classified .= "<br />".system_showText(LANG_MSG_INVALID_IMAGE_TYPE);

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
			$classified = db_getFromDB("classified", $by_key, $by_value);
		} else {
			$classified = db_getFromDB("classified", "id", db_formatNumber($id));
		}

		if ((sess_getAccountIdFromSession() != $classified->getNumber("account_id")) && (!strpos($url_base, "/gerenciamento"))) {
			header("Location: $url_redirect/index.php?message=".urlencode($message)."&screen=$screen&letra=$letra");
			exit;
		}

		$classified->extract();

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

		$classified = new Classified($id);
		$classified->makeFromRow($_POST);

		if ($acctId) $account_id = $acctId; else $account_id = $account_id;

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
	$levelObj = new ClassifiedLevel(EDIR_DEFAULT_LANGUAGE, true);
	if ($level) {
		$levelArray[$levelObj->getLevel($level)] = $level;
	} else {
		$levelArray[$levelObj->getLevel($levelObj->getDefaultLevel())] = $levelObj->getDefaultLevel();
	}

	$langIndex = language_getIndex(EDIR_LANGUAGE);
	$categories = "";
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		if ($_POST["cat_1_id"]) {
			$return_categories_array[] = $_POST["cat_1_id"];
			foreach ($return_categories_array as $each_category) {
				$categories[] = new ClassifiedCategory($each_category);
			}
		}
	} else {
		if (!$categories) if ($classified) $categories = $classified->getCategories();
	}
	if ($categories) {
		$cat_1_id = $categories[0]->getNumber("id");
	}
	unset($nameArray);
	unset($valueArray);
	$sql = "SELECT * FROM ClassifiedCategory WHERE category_id = 0 ORDER BY title";
	$categories = db_getFromDBBySQL("classifiedcategory", $sql);
	if ($categories) foreach ($categories as $category) {
		$valueArray[] = $category->getNumber("id");
		if ($category->getString("title".$langIndex)) $thisCategoryName = $category->getString("title".$langIndex);
		else $thisCategoryName = $category->getString("title");
		$nameArray[] = $thisCategoryName;
		$subcategories = db_getFromDBBySQL("classifiedcategory", "SELECT * FROM ClassifiedCategory WHERE category_id = ".db_formatNumber($category->getNumber("id"))." ORDER BY title");
		if ($subcategories) foreach ($subcategories as $subcategory) {
			$valueArray[] = $subcategory->getNumber("id");
			if ($subcategory->getString("title".$langIndex)) $thisSubCategoryName = $subcategory->getString("title".$langIndex);
			else $thisSubCategoryName = $subcategory->getString("title");
			$nameArray[] = $thisCategoryName." -> ".$thisSubCategoryName;
		}
	}
	$categoryDropDown = html_selectBox("cat_1_id", $nameArray, $valueArray, $cat_1_id, "", "class='input-dd-form-classifieds'", "-- ".system_showText(LANG_LABEL_SELECT_CATEGORY)." --");

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
		} elseif ($classified->getString("keywords".$labelsuffix)) {
			$arr_keywords = explode(" || ", $classified->getString("keywords".$labelsuffix));
			${"keywords".$labelsuffix} = implode("\n", $arr_keywords);
		}
	}
	##################################################

?>
