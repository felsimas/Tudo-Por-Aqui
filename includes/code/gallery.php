<?
	if ($_SERVER['REQUEST_METHOD'] == "POST") {

		$external_item = false;

		if (validate_form("gallery", $_POST, $message_gallery)) {

			$gallery = new Gallery($id);

			/* security bug */
			if (strpos($url_base, "/membros") !== false) {
				if ($gallery->getNumber("id")) {
					if ($gallery->getNumber("account_id") != sess_getAccountIdFromSession()) {
						header("Location: ".$url_base."/gallery/".(($search_page) ? "search.php" : "index.php"));
						exit;
					}
				}
			}

			if ($id) {
				if (strpos($url_base, "/gerenciamento")) {
					if ($gallery->getNumber("account_id") != $_POST["account_id"]) {
						// remove relationship if sitemgr change account
						$dbREL = db_getDBObject();
						$sqlREL = "DELETE FROM Gallery_Item WHERE gallery_id = ".db_formatNumber($id)."";
						$resultREL = $dbREL->query($sqlREL);
					}
				}
			}

			if (!$gallery->getNumber("id") || $gallery->getNumber("id") == 0) {
				$message = system_showText(LANG_MSG_GALLERY_SUCCESSFULLY_ADDED);
				$gallery->makeFromRow($_POST);
				if ($item_type && $item_id && $item_id>0) $external_item = true;
			} else {
				$message = system_showText(LANG_MS_GALLERY_SUCCESSFULLY_UPDATED);
				$gallery->makeFromRow($_POST);
			}

			$gallery->save();

			if ($external_item) {
				if ($item_type=="listing") {
					$itemObj = new Listing($item_id);
					$destiny = "listing";
				} elseif ($item_type=="event") {
					$itemObj = new Event($item_id);
					$destiny = "event";
				} elseif ($item_type=="classified") {
					$itemObj = new Classified($item_id);
					$destiny = "classified";
				} elseif ($item_type=="article") {
					$itemObj = new Article($item_id);
					$destiny = "article";
				} else {
					header("Location: $url_redirect/".(($search_page) ? "search.php" : "index.php")."?process=".$process."&message=".urlencode($message)."&screen=$screen&letra=$letra".(($url_search_params) ? "&$url_search_params" : ""));
					exit;
				}
				if ($itemObj && $itemObj->getNumber("id")>0) {
					$gallery->setNumber("account_id", $itemObj->getNumber("account_id"));
					$gallery->Save();
					header("Location: ".$url_base."/".$destiny."/gallery.php?item_type=".$item_type."&item_id=".$item_id."&message_gallery=".urlencode($message)."&screen=$screen&letra=$letra".(($url_search_params) ? "&$url_search_params" : ""));
					exit;
				}
			}

			header("Location: $url_redirect/images.php?id=".$gallery->getNumber("id")."&message=".urlencode($message)."&screen=$screen&letra=$letra".(($url_search_params) ? "&$url_search_params" : ""));
			exit;

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
			$gallery = db_getFromDB("gallery", $by_key, $by_value);
		} else {
			$gallery = db_getFromDB("gallery", "id", db_formatNumber($id));
		}

		if ((sess_getAccountIdFromSession() != $gallery->getNumber("account_id")) && (!strpos($url_base, "/gerenciamento"))) {
			header("Location: $url_redirect/".(($search_page) ? "search.php" : "index.php")."?message=".urlencode($message)."&screen=$screen&letra=$letra".(($url_search_params) ? "&$url_search_params" : "" )."");
			exit;
		}

		$gallery->extract();

	} else {

		$gallery = new Gallery($id);
		$gallery->makeFromRow($_POST);

		if ($acctId) $account_id = $acctId; else $account_id = $account_id;

	}

	extract($_POST);
	extract($_GET);

?>