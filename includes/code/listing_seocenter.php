<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/code/listing_seocenter.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	if ($id) {
		$listing = new Listing($id);
		if (!($listing->getNumber("id")) || ($listing->getNumber("id") <= 0)) {
			header("Location: ".DEFAULT_URL."/membros/listing/index.php?screen=$screen&letra=$letra");
			exit;
		}
	} else {
		header("Location: ".DEFAULT_URL."/membros/listing/index.php?screen=$screen&letra=$letra");
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == "POST") {

		$_POST["friendly_url"] = str_replace(".htm", "", $_POST["friendly_url"]);
		$_POST["friendly_url"] = str_replace(".html", "", $_POST["friendly_url"]);
		$_POST["friendly_url"] = trim($_POST["friendly_url"]);

		if (validate_form("listingseocenter", $_POST, $message)) {
			foreach ($_POST as $key=>$value) {
				if ((strpos($key, "seo") !== false) || (strpos($key, "friendly_url") !== false)) {
					$listing->setString($key, $value);
				}
			}
			$listing->Save();
			$message = system_showText(LANG_MSG_SEOCENTER_ITEMUPDATED);
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
	$listing->extract();
	extract($_POST);
	extract($_GET);

?>
