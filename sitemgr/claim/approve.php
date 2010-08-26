<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/claim/approve.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (CLAIM_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	$url_redirect = "".DEFAULT_URL."/gerenciamento/claim";
	$url_base     = "".DEFAULT_URL."/gerenciamento";

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	$errorPage = DEFAULT_URL."/gerenciamento/claim/".(($search_page) ? "search.php" : "index.php")."?message=".urlencode($message)."&screen=$screen&letra=$letra".(($url_search_params) ? "&$url_search_params" : "");
	if ($id) {
		$claim = new Claim($id);
		if ((!$claim->getNumber("id")) || ($claim->getNumber("id") <= 0)) {
			header("Location: ".$errorPage);
			exit;
		}
		if (!$claim->canApprove()) {
			header("Location: ".$errorPage);
			exit;
		}
	} else {
		header("Location: ".$errorPage);
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	$claim->setString("status", "approved");
	$claim->save();

	$listing = new Listing($claim->getNumber("listing_id"));

	setting_get("claim_approveemail", $claim_approveemail);
	if ($claim_approveemail) {
		setting_get("sitemgr_email",$sitemgr_email);
		$contact = new Contact($claim->getNumber("account_id"));
		if ($emailNotificationObj = system_checkEmail(SYSTEM_CLAIM_APPROVED, $contact->getString("lang"))) {
			$subject = $emailNotificationObj->getString("subject");
			$body = $emailNotificationObj->getString("body");
			$body = system_replaceEmailVariables($body, $listing->getNumber('id'), 'listing');
			$subject = system_replaceEmailVariables($subject, $listing->getNumber('id'), 'listing');
			$body = html_entity_decode($body);
			$subject = html_entity_decode($subject);
			system_mail($contact->getString("email"), $subject, $body, EDIRECTORY_TITLE." <$sitemgr_email>", $emailNotificationObj->getString("content_type"), "", $emailNotificationObj->getString("bcc"), $error);
		}
	}

	header("Location: ".DEFAULT_URL."/gerenciamento/claim/".(($search_page) ? "search.php" : "index.php")."?message=".urlencode(system_showText(LANG_SITEMGR_MENU_CLAIMED)." ".system_showText(LANG_SITEMGR_LISTING)." \"".$listing->getString("title")."\" ".system_showText(LANG_SITEMGR_CLAIM_WASAPPROVED))."&screen=$screen&letra=$letra".(($url_search_params) ? "&$url_search_params" : ""));
	exit;

?>
