<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/code/promotion_seocenter.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	if ($id) {
		$promotion = new Promotion($id);
		if (!($promotion->getNumber("id")) || ($promotion->getNumber("id") <= 0)) {
			header("Location: ".DEFAULT_URL."/membros/promotion/index.php?screen=$screen&letra=$letra");
			exit;
		}
	} else {
		header("Location: ".DEFAULT_URL."/membros/promotion/index.php?screen=$screen&letra=$letra");
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == "POST") {

		if (validate_form("promotionseocenter", $_POST, $message)) {
			foreach ($_POST as $key=>$value) {
				if (strpos($key, "seo") !== false) {
					$promotion->setString($key, $value);
				}
			}
			$promotion->Save();
			$message = ucwords(system_showText(LANG_MSG_SEOCENTER_ITEMUPDATED));
			header("Location: $url_redirect/".(($search_page) ? "search.php" : "index.php")."?message=".urlencode($message)."&screen=$screen&letra=$letra".(($url_search_params) ? "&$url_search_params" : ""));
			exit;
		}

		$_POST = format_magicQuotes($_POST);
		$_GET  = format_magicQuotes($_GET);
		extract($_POST);
		extract($_GET);

	}

	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------
	$promotion->extract();
	extract($_POST);
	extract($_GET);

?>
