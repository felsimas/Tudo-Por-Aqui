<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/claim/deny.php
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
		if (!$claim->canDeny()) {
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
	$claim->setString("status", "denied");
	$claim->save();

	$listing = new Listing($claim->getNumber("listing_id"));

	$listing->setNumber("account_id", 0);
	$listing->setNumber("promotion_id", 0);

	setting_get("claim_deny", $claim_deny);
	if ($claim_deny) {

		$listing->setString("renewal_date", date("Y-m-d", mktime(0, 0, 0, date("m"), date("d"), date("Y")+5)));
		$listing->setString("status", "A");

	} else {

		$listing->setString("renewal_date", "0000-00-00");
		$listing->setString("status", "P");

	}

	$listing->setString("estado_id", $claim->getNumber("old_estado_id"));
	$listing->setString("cidade_id", $claim->getNumber("old_cidade_id"));
	$listing->setString("bairro_id", $claim->getNumber("old_bairro_id"));
	$listing->setString("city_id", $claim->getNumber("old_city_id"));
	$listing->setString("area_id", $claim->getNumber("old_area_id"));
	$listing->setString("title", $claim->getString("old_title", false));

	$dbObjFriendlyURL = db_getDBObject();
	$sqlFriendlyURL = "SELECT friendly_url FROM Listing WHERE friendly_url = ".db_formatString($claim->getString("old_friendly_url", false))."";
	$resultFriendlyURL = $dbObjFriendlyURL->query($sqlFriendlyURL);
	if ($rowFriendlyURL = mysql_fetch_assoc($resultFriendlyURL)) {
		$listing->setString("friendly_url", $claim->getString("old_friendly_url", false).FRIENDLYURL_SEPARATOR.$listing->getNumber("id"));
	} else {
		$listing->setString("friendly_url", $claim->getString("old_friendly_url", false));
	}

	$listing->setString("email", $claim->getString("old_email", false));
	$listing->setString("url", $claim->getString("old_url", false));
	$listing->setString("display_url", "");
	$listing->setString("phone", $claim->getString("old_phone", false));
	$listing->setString("fax", $claim->getString("old_fax", false));
	$listing->setString("address", $claim->getString("old_address", false));
	$listing->setString("address2", $claim->getString("old_address2", false));
	$listing->setString("zip_code", $claim->getString("old_zip_code", false));
	$listing->setString("level", $claim->getNumber("old_level"));
	$listing->setString("listingtemplate_id", $claim->getNumber("old_listingtemplate_id"));

	$listing->save();

	if (ZIPCODE_PROXIMITY == "on") {
		zipproximity_updateDB("Listing", $listing->getNumber("id"));
	}

	setting_get("claim_denyemail", $claim_denyemail);
	if ($claim_denyemail) {
		setting_get("sitemgr_email",$sitemgr_email);
		$contact = new Contact($claim->getNumber("account_id"));
		if ($emailNotificationObj = system_checkEmail(SYSTEM_CLAIM_DENIED, $contact->getString("lang"))) {
			$subject = $emailNotificationObj->getString("subject");
			$body = $emailNotificationObj->getString("body");
			$body = str_replace("ACCOUNT_NAME",$contact->getString("first_name").' '.$contact->getString("last_name"),$body);
			$body = system_replaceEmailVariables($body, $listing->getNumber('id'), 'listing');
			$subject = system_replaceEmailVariables($subject, $listing->getNumber('id'), 'listing');
			$body = html_entity_decode($body);
			$subject = html_entity_decode($subject);
			system_mail($contact->getString("email"), $subject, $body, EDIRECTORY_TITLE." <$sitemgr_email>", $emailNotificationObj->getString("content_type"), "", $emailNotificationObj->getString("bcc"), $error);
		}
	}

	header("Location: ".DEFAULT_URL."/gerenciamento/claim/".(($search_page) ? "search.php" : "index.php")."?message=".urlencode(system_showText(LANG_SITEMGR_MENU_CLAIMED)." ".system_showText(LANG_SITEMGR_LISTING)." \"".$listing->getString("title")."\" ".system_showText(LANG_SITEMGR_CLAIM_WASDENIED))."&screen=$screen&letra=$letra".(($url_search_params) ? "&$url_search_params" : ""));
	exit;

?>
