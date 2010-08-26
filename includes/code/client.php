<?
	if ($_SERVER['REQUEST_METHOD'] == "POST") {

		$external_item = false;

		if (validate_form("client", $_POST, $message_client)) {

			$client = new Client($id);

			/* security bug */
			if (strpos($url_base, "/membros") !== false) {
				if ($client->getNumber("id")) {
					if ($client->getNumber("account_id") != sess_getAccountIdFromSession()) {
						header("Location: ".$url_base."/client/".(($search_page) ? "search.php" : "index.php"));
						exit;
					}
				}
			}

			if ($id) {
				if (strpos($url_base, "/gerenciamento")) {
					if ($client->getNumber("account_id") != $_POST["account_id"]) {
						// remove relationship if sitemgr change account
						$dbREL = db_getDBObject();
						$sqlREL = "DELETE FROM Client_Item WHERE client_id = ".db_formatNumber($id)."";
						$resultREL = $dbREL->query($sqlREL);
					}
				}
			}

			if (!$client->getNumber("id") || $client->getNumber("id") == 0) {
				$message = system_showText(LANG_MSG_GALLERY_SUCCESSFULLY_ADDED);
				$client->makeFromRow($_POST);
				if ($item_type && $item_id && $item_id>0) $external_item = true;
			} else {
				$message = system_showText(LANG_MS_GALLERY_SUCCESSFULLY_UPDATED);
				$client->makeFromRow($_POST);
			}

			$client->Save();                                                                                             
			$client->setClient($client->id,$item_id);

			//if ($external_item) {
			//	$itemObj = new Listing($item_id);
			//	$destiny = "listing";
			//	if ($itemObj && $itemObj->getNumber("id")>0) {
			//		$client->setNumber("account_id", $itemObj->getNumber("account_id"));
			//		$client->Save();
			//		header("Location: //".$url_base."/".$destiny."/client.php?item_type=".$item_type."&item_id=".$item_id."&message_client=".urlencode($message)."&screen=$screen&letra=$lett//er".(($url_search_params) ? "&$url_search_params" : ""));
			//		exit;
			//	}
			//}

		

			header("Location: $url_redirect/images.php?id=".$client->getNumber("id")."&message=".urlencode($message)."&screen=$screen&letra=$letra".(($url_search_params) ? "&$url_search_params" : ""));
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
			$client = db_getFromDB("client", $by_key, $by_value);
		} else {
			$client = db_getFromDB("client", "id", db_formatNumber($id));
		}

		if ((sess_getAccountIdFromSession() != $client->getNumber("account_id")) && (!strpos($url_base, "/gerenciamento"))) {
			header("Location: $url_redirect/".(($search_page) ? "search.php" : "index.php")."?message=".urlencode($message)."&screen=$screen&letra=$letra".(($url_search_params) ? "&$url_search_params" : "" )."");
			exit;
		}

		$client->extract();

	} else {
		$client = new Client($id);
		$client->makeFromRow($_POST);
		if ($acctId) $account_id = $acctId; else $account_id = $account_id;

	}

	extract($_POST);
	extract($_GET);

?>