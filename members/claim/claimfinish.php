<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /membros/claim/claimfinish.php
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
	if ($listingObject->getNumber("account_id") != $acctId) {
		header("Location: ".DEFAULT_URL."/membros/");
		exit;
	}

	$dbObjClaim = db_getDBObject();
	$sqlClaim = "SELECT id FROM Claim WHERE account_id = '".$acctId."' AND listing_id = '".$claimlistingid."' AND status = 'progress' AND step = 'e' ORDER BY date_time DESC LIMIT 1";
	$resultClaim = $dbObjClaim->query($sqlClaim);
	if ($rowClaim = mysql_fetch_assoc($resultClaim)) $claimID = $rowClaim["id"];
	if (!$claimID) {
		header("Location: ".DEFAULT_URL."/membros/");
		exit;
	}
	$claimObject = new Claim($claimID);
	if (!$claimObject->getNumber("id") || ($claimObject->getNumber("id") <= 0)) {
		header("Location: ".DEFAULT_URL."/membros/");
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	$claimObject->setString("step", "-");
	$claimObject->setString("status", "complete");
	$claimObject->save();

	setting_get("claim_approve", $claim_approve);
	if (!$claim_approve) {
		$claimObject->setString("status", "approved");
		$claimObject->save();
		setting_get("claim_approveemail", $claim_approveemail);
		if ($claim_approveemail) {
			setting_get("sitemgr_email",$sitemgr_email);
			$contact = new Contact($claimObject->getNumber("account_id"));
			if ($emailNotificationObj = system_checkEmail(SYSTEM_CLAIM_AUTOMATICALLY_APPROVED, $contact->getString("lang"))) {
				$subject = $emailNotificationObj->getString("subject");
				$body = $emailNotificationObj->getString("body");
				$body = system_replaceEmailVariables($body, $listingObject->getNumber('id'), 'listing');
				$subject = system_replaceEmailVariables($subject, $listingObject->getNumber('id'), 'listing');
				$body = html_entity_decode($body);
				$subject = html_entity_decode($subject);
				$error = false;
				system_mail($contact->getString("email"), $subject, $body, EDIRECTORY_TITLE." <$sitemgr_email>", $emailNotificationObj->getString("content_type"), "", $emailNotificationObj->getString("bcc"), $error);
			}
		}
	}

	header("Location: ".DEFAULT_URL."/membros/listing/index.php?process=claim");
	exit;

?>
