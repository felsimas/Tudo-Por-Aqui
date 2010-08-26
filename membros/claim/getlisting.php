<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /membros/claim/getlisting.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_GET);
	extract($_POST);

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSession();
	$acctId = sess_getAccountIdFromSession();
	$accountObject = new Account($acctId);
	$url_redirect = "".DEFAULT_URL."/membros/claim";
	$url_base = "".DEFAULT_URL."/membros";
	$membros = 1;

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (CLAIM_FEATURE != "on") { exit; }
	if (!$claimlistingid) {
		header("Location: ".DEFAULT_URL."/membros/");
		exit;
	}
	$listingObject = new Listing($claimlistingid);
	if (!$listingObject->getNumber("id") || ($listingObject->getNumber("id") <= 0)) {
		header("Location: ".DEFAULT_URL."/membros/");
		exit;
	}
	if ($listingObject->getNumber("account_id")) {
		header("Location: ".DEFAULT_URL."/membros/");
		exit;
	}
	if ($listingObject->getString("claim_disable") != "n") {
		header("Location: ".DEFAULT_URL."/membros/");
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	$status = new ItemStatus();

	$listingObject->setNumber("account_id", $acctId);
	$listingObject->setNumber("promotion_id", 0);
	$listingObject->setGalleries();
	$listingObject->setDate("renewal_date", "00/00/0000");
	$listingObject->setString("status", $status->getDefaultStatus());
	$listingObject->save();

	$dbObjClaim = db_getDBObject();
	$sqlClaim = "UPDATE Claim SET status = 'incomplete' WHERE account_id = '".$accountObject->getNumber("id")."' AND listing_id = '".$listingObject->getNumber("id")."' AND status = 'progress'";
	$dbObjClaim->query($sqlClaim);

	$claimObject = new Claim();

	$claimObject->setNumber("account_id", $accountObject->getNumber("id"));
	$claimObject->setString("username", $accountObject->getString("username"));
	$claimObject->setNumber("listing_id", $listingObject->getNumber("id"));
	$claimObject->setString("listing_title", $listingObject->getString("title", false));
	$claimObject->setString("step", "a");
	$claimObject->setString("status", "progress");

	$claimObject->setString("old_estado_id", $listingObject->getNumber("estado_id"));
	$claimObject->setString("new_estado_id", $listingObject->getNumber("estado_id"));
	$claimObject->setString("old_cidade_id", $listingObject->getNumber("cidade_id"));
	$claimObject->setString("new_cidade_id", $listingObject->getNumber("cidade_id"));
	$claimObject->setString("old_bairro_id", $listingObject->getNumber("bairro_id"));
	$claimObject->setString("new_bairro_id", $listingObject->getNumber("bairro_id"));
	$claimObject->setString("old_city_id", $listingObject->getNumber("city_id"));
	$claimObject->setString("new_city_id", $listingObject->getNumber("city_id"));
	$claimObject->setString("old_area_id", $listingObject->getNumber("area_id"));
	$claimObject->setString("new_area_id", $listingObject->getNumber("area_id"));
	$claimObject->setString("old_title", $listingObject->getString("title", false));
	$claimObject->setString("new_title", $listingObject->getString("title", false));
	$claimObject->setString("old_friendly_url", $listingObject->getString("friendly_url", false));
	$claimObject->setString("new_friendly_url", $listingObject->getString("friendly_url", false));
	$claimObject->setString("old_email", $listingObject->getString("email", false));
	$claimObject->setString("new_email", $listingObject->getString("email", false));
	$claimObject->setString("old_url", $listingObject->getString("url", false));
	$claimObject->setString("new_url", $listingObject->getString("url", false));
	$claimObject->setString("old_phone", $listingObject->getString("phone", false));
	$claimObject->setString("new_phone", $listingObject->getString("phone", false));
	$claimObject->setString("old_fax", $listingObject->getString("fax", false));
	$claimObject->setString("new_fax", $listingObject->getString("fax", false));
	$claimObject->setString("old_address", $listingObject->getString("address", false));
	$claimObject->setString("new_address", $listingObject->getString("address", false));
	$claimObject->setString("old_address2", $listingObject->getString("address2", false));
	$claimObject->setString("new_address2", $listingObject->getString("address2", false));
	$claimObject->setString("old_zip_code", $listingObject->getString("zip_code", false));
	$claimObject->setString("new_zip_code", $listingObject->getString("zip_code", false));
	$claimObject->setString("old_level", $listingObject->getNumber("level"));
	$claimObject->setString("new_level", $listingObject->getNumber("level"));
	$claimObject->setString("old_listingtemplate_id", $listingObject->getNumber("listingtemplate_id"));
	$claimObject->setString("new_listingtemplate_id", $listingObject->getNumber("listingtemplate_id"));

	$claimObject->save();

	/**************************************************************************************************/
	/*                                                                                                */
	/* E-mail notify                                                                                  */
	/*                                                                                                */
	/**************************************************************************************************/
	setting_get("sitemgr_send_email",$sitemgr_send_email);
	setting_get("sitemgr_email",$sitemgr_email);
	$sitemgr_emails = split(",",$sitemgr_email);
	setting_get("sitemgr_claim_email",$sitemgr_claim_email);
	$sitemgr_claim_emails = split(",",$sitemgr_claim_email);

	// site manager warning message ////////////////////////////////////////////////////////////////////
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
					New ".LISTING_FEATURE_NAME." claim in ".EDIRECTORY_TITLE.".<br /><br />
					<b>Account: </b>".system_showAccountUserName($accountObject->getString("username"))."<br />
					<a href=\"".DEFAULT_URL."/gerenciamento/account/view.php?id=".$accountObject->getNumber("id")."\" target=\"_blank\">".DEFAULT_URL."/gerenciamento/account/view.php?id=".$accountObject->getNumber("id")."</a><br /><br />
					<b>".ucwords(LISTING_FEATURE_NAME).": </b>".$listingObject->getString("title")."<br />
					<a href=\"".DEFAULT_URL."/gerenciamento/estabelecimentos/view.php?id=".$listingObject->getNumber("id")."\" target=\"_blank\">".DEFAULT_URL."/gerenciamento/estabelecimentos/view.php?id=".$listingObject->getNumber("id")."</a><br /><br />
					<b>Claim ID: </b>".$claimObject->getNumber("id")."<br />
					<a href=\"".DEFAULT_URL."/gerenciamento/claim/view.php?id=".$claimObject->getNumber("id")."\" target=\"_blank\">".DEFAULT_URL."/gerenciamento/claim/view.php?id=".$claimObject->getNumber("id")."</a><br /><br />
				</div>
			</body>
		</html>";
	if ($sitemgr_send_email == "on") {
		if ($sitemgr_emails[0]) {
			foreach ($sitemgr_emails as $sitemgr_email) {
				system_mail($sitemgr_email, "[".EDIRECTORY_TITLE."] ".ucwords(LISTING_FEATURE_NAME)." Claim Notification", $sitemgr_msg, EDIRECTORY_TITLE." <$sitemgr_email>", "text/html", '', '', $error);
			}
		}
	}
	if ($sitemgr_claim_emails[0]) {
		foreach ($sitemgr_claim_emails as $sitemgr_claim_email) {
			system_mail($sitemgr_claim_email, "[".EDIRECTORY_TITLE."] ".ucwords(LISTING_FEATURE_NAME)." Claim Notification", $sitemgr_msg, EDIRECTORY_TITLE." <$sitemgr_claim_email>", "text/html",  '', '', $error);
		}
	}
	////////////////////////////////////////////////////////////////////////////////////////////////////

	header("Location: ".DEFAULT_URL."/membros/claim/listinglevel.php?claimlistingid=".$claimlistingid);
	exit;

?>