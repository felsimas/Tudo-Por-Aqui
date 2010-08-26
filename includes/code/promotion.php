<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/code/promotion.php
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
			if ($_POST["conditions".$labelsuffix]) {
				$_POST["conditions".$labelsuffix] = str_replace("\r", "", $_POST["conditions".$labelsuffix]);
			}
		}

		if (validate_form("promotion", $_POST, $message_promotion) && ($upload_image != "failed")) {

			$upload_image = "no image";

			//Clean Image
			if ($remove_image) {
				$promotion = new Promotion($id);
				if ($idm = $promotion->getNumber("image_id")) {
					$image = new Image($idm);
					if ($image) $image->Delete();
				}
				if ($idm = $promotion->getNumber("thumb_id")) {
					$image = new Image($idm);
					if ($image) $image->Delete();
				}
				unset($promotion);
			}

			if (file_exists($_FILES['image']['tmp_name'])) {
				$imageArray = image_uploadForItem($_FILES['image']['tmp_name'], IMAGE_PROMOTION_FULL_WIDTH, IMAGE_PROMOTION_FULL_HEIGHT, IMAGE_PROMOTION_THUMB_WIDTH, IMAGE_PROMOTION_THUMB_HEIGHT);
				if ($imageArray["success"]) {
					$upload_image = "success";
					$remove_image = false;
				}
				else $upload_image = "failed";
			}

			if ($upload_image != "failed") {

				$promotion = new Promotion($id);

				/* security bug */
				if (strpos($url_base, "/membros") !== false) {
					if ($promotion->getNumber("id")) {
						if ($promotion->getNumber("account_id") != sess_getAccountIdFromSession()) {
							header("Location: ".$url_base."/promotion/".(($search_page) ? "search.php" : "index.php"));
							exit;
						}
					}
				}

				if ($id) {
					if (strpos($url_base, "/gerenciamento")) {
						if ($promotion->getNumber("account_id") != $_POST["account_id"]) {
							// remove relationship if sitemgr change account
							$dbREL = db_getDBObject();
							$sqlREL = "UPDATE Listing SET promotion_id = 0 WHERE promotion_id = ".db_formatNumber($id)."";
							$resultREL = $dbREL->query($sqlREL);
						}
					}
				}

				$promotion->makeFromRow($_POST);

				if ($upload_image == "success") {
					$promotion->updateImage($imageArray);
				}

				if ($remove_image) {
					$promotion->setString("html","yes");
					$promotion->setNumber("image_id", 0);
					$promotion->setNumber("thumb_id", 0);
				}

				$promotion->Save();

				$listing_redirect = false;

				if ($listing_id) {
					$listingObj = new Listing($listing_id);
					if ($listingObj->getNumber("id")) {
						$listingObj->setNumber("promotion_id", $promotion->getNumber("id"));
						$listingObj->Save();
						$promotion->setNumber("account_id", $listingObj->getNumber("account_id"));
						$promotion->Save();
						$listing_redirect = true;
					}
				}

				if ($listing_redirect) {
					$message = system_showText(LANG_MSG_PROMOTION_SUCCESSFULLY_ADDED);
					header("Location: ".$url_base."/listing/".(($search_page) ? "search.php" : "index.php")."?message=".urlencode($message)."&screen=$screen&letra=$letra".(($url_search_params) ? "&$url_search_params" : "")."");
					exit;
				} else {
					$message = ($id ? system_showText(LANG_MSG_PROMOTION_SUCCESSFULLY_UPDATED) : system_showText(LANG_MSG_PROMOTION_SUCCESSFULLY_ADDED));
					header("Location: ".$url_base."/promotion/".(($search_page) ? "search.php" : "index.php")."?message=".urlencode($message).(($id) ? "" : "&newest=1")."&screen=$screen&letra=$letra".(($url_search_params) ? "&$url_search_params" : "").(($id) ? "" : "&extra_message=1"));
					exit;
				}

			} else if ($upload_image == "failed") $message_promotion .= system_showText(LANG_MSG_INVALID_IMAGE_TYPE);

		}

		// removing slashes added if required
		$_POST = format_magicQuotes($_POST);
		$_GET = format_magicQuotes($_GET);
		extract($_POST);
		extract($_GET);

	}

	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------
	if ($id) {

		if (strpos($url_base, "/membros")) {
			$by_key = array("id", "account_id");
			$by_value = array(db_formatNumber($id), sess_getAccountIdFromSession());
			$promotion = db_getFromDB("promotion", $by_key, $by_value);
		} else {
			$promotion = db_getFromDB("promotion", "id", db_formatNumber($id));
		}

		if ((sess_getAccountIdFromSession() != $promotion->getNumber("account_id")) && (!strpos($url_base, "/gerenciamento"))) {
			header("Location: ".$url_base."/promotion/".(($search_page) ? "search.php" : "index.php")."?screen=$screen&letra=$letra".(($url_search_params) ? "&$url_search_params" : "")."");
			exit;
		}

		$promotion->extract();

	} else {

		$promotion = new Promotion($id);
		$promotion->makeFromRow($_POST);

	}

	extract($_POST);
	extract($_GET);

	if ($listing_id) {
		$listingObj = new Listing($listing_id);
		if (strpos($url_base, "/membros")) {
			if ($acctId != $listingObj->getNumber("account_id")) {
				header("Location: ".$url_base."/listing/index.php");
				exit;
			}
		} else {
			$account_id = $listingObj->getNumber("account_id");
		}
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
		} elseif ($promotion->getString("keywords".$labelsuffix)) {
			$arr_keywords = explode(" || ", $promotion->getString("keywords".$labelsuffix));
			${"keywords".$labelsuffix} = implode("\n", $arr_keywords);
		}
	}
	##################################################

?>
