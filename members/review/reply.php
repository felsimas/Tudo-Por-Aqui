<?
    # ----------------------------------------------------------------------------------------------------
    # * FILE: /gerenciamento/review/index.php
    # ----------------------------------------------------------------------------------------------------

    # ----------------------------------------------------------------------------------------------------
    # LOAD CONFIG
    # ----------------------------------------------------------------------------------------------------
    include("../../conf/loadconfig.inc.php");

    # ----------------------------------------------------------------------------------------------------
    # UPDATE REPLY
    # ----------------------------------------------------------------------------------------------------
    if(strlen(trim($_GET['reply'])) > 0) {

        setting_get("review_approve", $review_approve);
        $responseapproved = 0;
        if (!$review_approve == 'on') $responseapproved = 1;

        $db = db_getDBObject();
        $sql = "UPDATE Review SET response = " . db_formatString($_GET['reply']) . ", responseapproved = " . db_formatNumber($responseapproved) . " WHERE id = " . db_formatNumber($_GET['idReview']) . "";

        $db->query($sql);

        /* send e-mail to sitemgr */
       /* setting_get("sitemgr_send_email",$sitemgr_send_email);
        setting_get("sitemgr_email",$sitemgr_email);
        $sitemgr_emails = split(",",$sitemgr_email);
        setting_get("sitemgr_rate_email",$sitemgr_rate_email);
        $sitemgr_rate_emails = split(",",$sitemgr_rate_email);
		*/
        $reviewObj = new Review($_GET['idReview']);

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
                    <div class=\"email_style_settings\">"
                        ."Site Manager,<br /><br />"
                        ."Review <strong>" . $reviewObj->getString('review_title', true) . "</strong> has a new reply.</strong> <br /><br />"
                        ."Click on the link below to go to the review administration :<br />"
                        ."<a href=\"".DEFAULT_URL."/gerenciamento/review\" target=\"_blank\">".DEFAULT_URL."/gerenciamento/review</a><br /><br />"
                    ."</div>
                </body>
            </html>";
            if ($sitemgr_send_email == "on") {
                if ($sitemgr_emails[0]) {
                    foreach ($sitemgr_emails as $sitemgr_email) {
                        system_mail($sitemgr_email, "[".EDIRECTORY_TITLE."] Reply Notification", $sitemgr_msg, EDIRECTORY_TITLE." <$sitemgr_email>", "text/html", '', '', $error);
                    }
                }
                if ($sitemgr_rate_emails[0]) {
						foreach ($sitemgr_rate_emails as $sitemgr_rate_email) {
							system_mail($sitemgr_rate_email, "[".EDIRECTORY_TITLE."] Reply Notification", $sitemgr_msg, EDIRECTORY_TITLE." <$sitemgr_rate_email>", "text/html", '', '', $error);
						}
				}
            }
            
        /* */

        if (!$review_approve == 'on') {
        
            /* send e-mail to listing owner */
            if($reviewObj->getString('item_type') == 'listing') {
                $itemObj = new Listing($reviewObj->getNumber('item_id'));
                $contactObj = new Contact($itemObj->getNumber("account_id"));
                if($emailNotificationObj = system_checkEmail(SYSTEM_APPROVE_REPLY, $contactObj->getString("lang"))) {
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
            
            /* send e-mail to article owner */
            if($reviewObj->getString('item_type') == 'article') {
                $itemObj = new Article($reviewObj->getNumber('item_id'));
                $contactObj = new Contact($itemObj->getNumber("account_id"));
                if($emailNotificationObj = system_checkEmail(SYSTEM_APPROVE_REPLY, $contactObj->getString("lang"))) {
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
            /* */ 
        }

        $response = '&class=successMessage&message=' . urlencode(LANG_REPLY_SUCCESSFULLY);
    } else {
        $response = '&class=errorMessage&message=' . urlencode(LANG_REPLY_EMPTY);
    }

    header('Location: ' . DEFAULT_URL . '/membros/review/index.php?item_type=' . $_GET['item_type'] . '&item_id=' . $_GET['item_id'] . $response);
?>