<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/code/article.php
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
			if ($_POST["abstract".$labelsuffix]) {
				$_POST["abstract".$labelsuffix] = str_replace("\r", "", $_POST["abstract".$labelsuffix]);
			}
		}

		$_POST["friendly_url"] = str_replace(".htm", "", $_POST["friendly_url"]);
		$_POST["friendly_url"] = str_replace(".html", "", $_POST["friendly_url"]);
		$_POST["friendly_url"] = trim($_POST["friendly_url"]);
		$sqlFriendlyURL = "";
		$sqlFriendlyURL .= " SELECT friendly_url FROM Article WHERE friendly_url = ".db_formatString($_POST["friendly_url"])." ";
		if ($id) $sqlFriendlyURL .= " AND id != $id ";
		$sqlFriendlyURL .= " LIMIT 1 ";
		$dbObjFriendlyURL = db_getDBObject();
		$resultFriendlyURL = $dbObjFriendlyURL->query($sqlFriendlyURL);
		if (mysql_num_rows($resultFriendlyURL) > 0) {
			if ($id) $_POST["friendly_url"] = $_POST["friendly_url"].FRIENDLYURL_SEPARATOR.$id;
			else $_POST["friendly_url"] = $_POST["friendly_url"].FRIENDLYURL_SEPARATOR.uniqid();
		}

		if (validate_form("article", $_POST, $message_article) && is_valid_discount_code($_POST["discount_id"], "article", $_POST["id"], $message_article, $discount_error_num)) {

			$upload_image = "no image";

			// fixing url field if needed.
			if (trim($_POST["author_url"]) != "") {
				if (strpos($_POST["author_url"], "://") !== false) {
					$aux_author_url = explode("://", $_POST["author_url"]);
					$aux_author_url = $aux_author_url[1];
					$_POST["author_url"] = $aux_author_url;
				}
				$_POST["author_url"] = $_POST["author_url_protocol"] . $_POST["author_url"];
			} 

			//Clean the image
			if ($remove_image) {
				$article = new Article($id);
				if ($idm = $article->getNumber("image_id")) {
					$image = new Image($idm);
					if ($image) $image->Delete();
				}
				if ($idm = $article->getNumber("thumb_id")) {
					$image = new Image($idm);
					if ($image) $image->Delete();
				}
				unset($article);
			}

			if (file_exists($_FILES['image']['tmp_name'])) {
				$imageArray = image_uploadForItem($_FILES['image']['tmp_name'], IMAGE_ARTICLE_FULL_WIDTH, IMAGE_ARTICLE_FULL_HEIGHT, IMAGE_ARTICLE_THUMB_WIDTH, IMAGE_ARTICLE_THUMB_HEIGHT);
				if ($imageArray["success"]) {
					$upload_image = "success";
					$remove_image = false;
				}
				else $upload_image = "failed";
			}

			if ($upload_image != "failed") {

				$status = new ItemStatus();

				$article = new Article($id);

				if (!$article->getString("id") || $article->getString("id") == 0){

					$message = system_showText(LANG_MSG_ARTICLE_SUCCESSFULLY_ADDED);

					$article->makeFromRow($_POST);

					$emailNotification = true;
					$newest = "1";
					$article->setString("status", $status->getDefaultStatus());

					$article->setDate("renewal_date", "00/00/0000");

					$article->setDate("publication_date", $publication_date);

				} else {

					$message = system_showText(LANG_MSG_ARTICLE_SUCCESSFULLY_UPDATED);

					$emailNotification = false;
					if ($article->getString("status") != $status->getDefaultStatus()) $emailNotification = true;

					//security issue
					unset($_POST["status"]);
					unset($_POST["renewal_date"]);

					if (!$article->hasRenewalDate()) {
						$_POST["renewal_date"] = "0000-00-00";
					}

					if (strpos($url_base, "/gerenciamento")) {

						$_POST["status"] = $article->getString("status");

						if ($article->getNumber("account_id") != $_POST["account_id"]) {
							// remove relationship if sitemgr change account
							$article->setGalleries();
						}

					}

					$article->makeFromRow($_POST);

					$article->setDate("publication_date", $publication_date);

				}

				if ($upload_image == "success") {
					$article->updateImage($imageArray);
				}

				if ($remove_image) {
					$article->setNumber("image_id", 0);
					$article->setNumber("thumb_id", 0);
				}

				$levelObjTmp = new ArticleLevel(EDIR_DEFAULT_LANGUAGE, true);
				$levelsTmp = $levelObjTmp->getLevelValues();
				if (!in_array($article->getNumber("level"), $levelsTmp)) {
					$article->setNumber("level", $levelObjTmp->getDefaultLevel());
				}

				if (!$_POST["publication_date"]) {
					$_POST["publication_date"] = date(DEFAULT_DATE_FORMAT);
					$article->setDate("publication_date", $_POST["publication_date"]);
				}

				unset($levelObjTmp);
				unset($levelsTmp);

				$article->Save();

				/**
				*
				* E-mail notify
				*
				***************************************************************************************************/
				if ($article->getNumber("account_id") > 0) {
					if($message == system_showText(LANG_MSG_ARTICLE_SUCCESSFULLY_ADDED)) {
						$contactObj = new Contact($article->getNumber("account_id"));
						if($emailNotificationObj = system_checkEmail(SYSTEM_NEW_ARTICLE, $contactObj->getString("lang"))) {
							setting_get("sitemgr_send_email", $sitemgr_send_email);
							setting_get("sitemgr_email", $sitemgr_email);
							$sitemgr_emails = split(",", $sitemgr_email);
							if ($sitemgr_emails[0]) $sitemgr_email = $sitemgr_emails[0];
							$subject = $emailNotificationObj->getString("subject");
							$body    = $emailNotificationObj->getString("body");
							$body = system_replaceEmailVariables($body,$article->getNumber('id'),'article');
							$subject = system_replaceEmailVariables($subject,$article->getNumber('id'),'article');
							$body    = str_replace("DEFAULT_URL", DEFAULT_URL, $body);
							$body = html_entity_decode($body);
							$subject = html_entity_decode($subject);
							$error = false;
							//system_mail($contactObj->getString("email"), $subject, $body, EDIRECTORY_TITLE." <$sitemgr_email>", $emailNotificationObj->getString("content_type"), "", $emailNotificationObj->getString("bcc"), $error);
						}
					}
				}
				if ($emailNotification) {
					if (!strpos($url_base, "/gerenciamento")) {
						setting_get("sitemgr_send_email", $sitemgr_send_email);
						setting_get("sitemgr_email", $sitemgr_email);
						$sitemgr_emails = split(",", $sitemgr_email);
						setting_get("sitemgr_article_email", $sitemgr_article_email);
						$sitemgr_article_emails = split(",", $sitemgr_article_email);
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
										if ($_POST["id"]) $sitemgr_msg .= "The ".ARTICLE_FEATURE_NAME." \"".$article->getString("title")."\" was changed by the administrator \"".system_showAccountUserName($account->getString("username"))."\" and needs to be revised by you.<br /><br />";
										else $sitemgr_msg .= "The ".ARTICLE_FEATURE_NAME." \"".$article->getString("title")."\" was created by the administrator \"".system_showAccountUserName($account->getString("username"))."\" and needs to be revised by you.<br /><br />";
										$sitemgr_msg .= "<a href=\"".DEFAULT_URL."/gerenciamento/article/view.php?id=".$article->getNumber("id")."\" target=\"_blank\">".DEFAULT_URL."/gerenciamento/article/view.php?id=".$article->getNumber("id")."</a><br /><br />
										".EDIRECTORY_TITLE."
									</div>
								</body>
							</html>";
						// sending e-mail to site manager
						$error = false;
						if ($sitemgr_send_email == "on") {
							if ($sitemgr_emails[0]) {
								foreach ($sitemgr_emails as $sitemgr_email) {
									//system_mail($sitemgr_email, "[".EDIRECTORY_TITLE."] ".ucwords(ARTICLE_FEATURE_NAME)." Notification", $sitemgr_msg, EDIRECTORY_TITLE." <$sitemgr_email>", "text/html", '', '', $error);
								}
							}
						}
						if ($sitemgr_article_emails[0]) {
							foreach ($sitemgr_article_emails as $sitemgr_article_email) {
								//system_mail($sitemgr_article_email, "[".EDIRECTORY_TITLE."] ".ucwords(ARTICLE_FEATURE_NAME)." Notification", $sitemgr_msg, EDIRECTORY_TITLE." <$sitemgr_article_email>", "text/html", '', '', $error);
							}
						}
					}
				}
				/**************************************************************************************************/

				// setting categories
				$return_categories_array = explode(",", $return_categories);
				$article->setCategories($return_categories_array);

				header("Location: $url_redirect/".(($search_page) ? "search.php" : "index.php")."?process=".$process."&newest=".$newest."&message=".urlencode($message)."&screen=$screen&letra=$letra".(($url_search_params) ? "&$url_search_params" : ""));
				exit;

			} else if ($upload_image == "failed") $message_article .= "<br />".system_showText(LANG_MSG_INVALID_IMAGE_TYPE);

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
			$article = db_getFromDB("article", $by_key, $by_value);
		} else {
			$article = db_getFromDB("article", "id", db_formatNumber($id));
		}

		if ((sess_getAccountIdFromSession() != $article->getNumber("account_id")) && (!strpos($url_base, "/gerenciamento"))) {
			header("Location: $url_redirect/index.php?message=".urlencode($message)."&screen=$screen&letra=$letra");
			exit;
		}

		$article->extract();

	} else {

		$article = new Article($id);
		$article->makeFromRow($_POST);

		if ($acctId) $account_id = $acctId; else $account_id = $account_id;

	}

	extract($_POST);
	extract($_GET);

	// level
	$levelObj = new ArticleLevel(EDIR_DEFAULT_LANGUAGE, true);
	if ($level) {
		$levelArray[$levelObj->getLevel($level)] = $level;
	} else {
		$levelArray[$levelObj->getLevel($levelObj->getDefaultLevel())] = $levelObj->getDefaultLevel();
	}

	// if no publication date, prefill the field within the current date
	if (!$publication_date) {
		$publication_date = date(DEFAULT_DATE_FORMAT);
	}

	$langIndex = language_getIndex(EDIR_LANGUAGE);
	$categories = "";
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		if ($return_categories) {
			$return_categories_array = explode(",", $return_categories);
			foreach ($return_categories_array as $each_category) {
				$categories[] = new ArticleCategory($each_category);
			}
		}
	} else {
		if (!$categories) if ($article) $categories = $article->getCategories();
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
					$categories[] = new ArticleCategory($each_category);
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
		} elseif ($article->getString("keywords".$labelsuffix)) {
			$arr_keywords = explode(" || ", $article->getString("keywords".$labelsuffix));
			${"keywords".$labelsuffix} = implode("\n", $arr_keywords);
		}
	}
	##################################################

?>
