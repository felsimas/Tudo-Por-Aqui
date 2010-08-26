<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/review/approve.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	extract($_GET);
	extract($_POST);
	
	if (!$id) {
		$message = urlencode(system_showText(LANG_SITEMGR_REVIEW_NOTFOUND));
		header("Location: ".DEFAULT_URL."/gerenciamento/review/index.php?class=errorMessage&message=".urlencode($message)."&item_type=$item_type".($filter_id ? "&filter_id=1&item_id=$item_id" : '')."&screen=$screen&letra=$letra&item_letra=$item_letra&item_screen=$item_screen");
		exit;
	}
	
    $reviewObj=new Review($id);	
	$reviewObj->setNumber('approved',1);
	$reviewObj->Save();

    /* send e-mail to owner */
    if($reviewObj->getString('item_type') == 'listing') {
        $itemObj = new Listing($reviewObj->getNumber('item_id'));
        $contactObj = new Contact($itemObj->getNumber("account_id"));
        if($emailNotificationObj = system_checkEmail(SYSTEM_APPROVE_REVIEW, $contactObj->getString("lang"))) {
            setting_get("sitemgr_send_email", $sitemgr_send_email);
            setting_get("sitemgr_email", $sitemgr_email);
            $sitemgr_emails = split(",", $sitemgr_email);
            if ($sitemgr_emails[0]) $sitemgr_email = $sitemgr_emails[0];
            $subject   = $emailNotificationObj->getString("subject");
            $body      = $emailNotificationObj->getString("body");
            $body      = system_replaceEmailVariables($body, $itemObj->getNumber('id'), 'listing');
            $subject   = system_replaceEmailVariables($subject, $itemObj->getNumber('id'), 'listing');
            $body      = html_entity_decode($body);
            $subject   = html_entity_decode($subject);
            system_mail($contactObj->getString("email"), $subject, $body, EDIRECTORY_TITLE." <$sitemgr_email>", $emailNotificationObj->getString("content_type"), "", $emailNotificationObj->getString("bcc"), $error);
        }
    }
    /* */
    
    /* send e-mail to owner */
    if($reviewObj->getString('item_type') == 'article') {
        $itemObj = new Article($reviewObj->getNumber('item_id'));
        $contactObj = new Contact($itemObj->getNumber("account_id"));
        if($emailNotificationObj = system_checkEmail(SYSTEM_APPROVE_REVIEW, $contactObj->getString("lang"))) {
            setting_get("sitemgr_send_email", $sitemgr_send_email);
            setting_get("sitemgr_email", $sitemgr_email);
            $sitemgr_emails = split(",", $sitemgr_email);
            if ($sitemgr_emails[0]) $sitemgr_email = $sitemgr_emails[0];
            $subject   = $emailNotificationObj->getString("subject");
            $body      = $emailNotificationObj->getString("body");
            $body      = system_replaceEmailVariables($body, $itemObj->getNumber('id'), 'article');
            $subject   = system_replaceEmailVariables($subject, $itemObj->getNumber('id'), 'article');
            $body      = html_entity_decode($body);
            $subject   = html_entity_decode($subject);
            system_mail($contactObj->getString("email"), $subject, $body, EDIRECTORY_TITLE." <$sitemgr_email>", $emailNotificationObj->getString("content_type"), "", $emailNotificationObj->getString("bcc"), $error);
        }
    }
    
    $message = urlencode(system_showText(LANG_SITEMGR_REVIEW_SUCCESSAPROVED));
    
	header("Location: ".DEFAULT_URL."/gerenciamento/review/index.php?message=".urlencode($message)."&item_type=$item_type".($filter_id ? "&filter_id=1&item_id=$item_id" : '')."&screen=$screen&letra=$letra&item_letra=$item_letra&item_screen=$item_screen");
	exit;