<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/code/email_notifications.php
	# ----------------------------------------------------------------------------------------------------

	$body = stripslashes($body);

	# ----------------------------------------------------------------------------------------------------
	# DEFAULTS
	# ----------------------------------------------------------------------------------------------------
	// Default from field value (this variable retrieve site manager e-mail from setting table)
	setting_get("sitemgr_email", $sitemgr_email);
	list($sitemgr_emails) = split(",", $sitemgr_email);
	$default_from = $sitemgr_email;
	///////////////////////////////////////////////////////////////////////////////////////////

	# ----------------------------------------------------------------------------------------------------
	# SAVE AND / OR LOAD
	# ----------------------------------------------------------------------------------------------------  

	if ($id) {

		$emailNotificationObj = new EmailNotification($id, $lang);
		$emailNotificationObjAux = new EmailNotification($id);

		$days = $emailNotificationObj->getNumber("days");

		if ($save || $reset_html || $reset_text) {

			$nav_page--;

			// Reset ///////////////////////////////////////////////////////
			if ($reset_html || $reset_text) {
				$subject = $emailNotificationObj->restoreSubject();
			}
			if ($reset_html){
				$body         = $emailNotificationObj->restoreBody("html");
				$content_type = "text/html";
			} elseif($reset_text) {
				$body         = $emailNotificationObj->restoreBody("text");
				$content_type = "text/plain";
			}
			///////////////////////////////////////////////////////////////

			// Loading data into the object

			if ($_POST["deactivate"]) $_POST["deactivate"] = 1;
			else $_POST["deactivate"] = 0;

			$_POST["subject"] = str_replace("&quot;", "\"", $_POST["subject"]);
			$_POST["body"] = str_replace("&quot;", "\"", $_POST["body"]);

			$emailNotificationObj->makeFromRow($_POST);

			// Default CSS style for message
			$message_style = "successMessage";

			// Save
			if ($save) {

				$nav_page = 0;

				if (!$emailNotificationObj->getString("bcc") || validate_email($emailNotificationObj->getString("bcc"))) {

					$emailNotificationObj->Save();

					if ($email) {
						$message = system_showText(LANG_SITEMGR_EMAILNOTIFICATION_SUCCESSUPDATED);
					} else {
						$message = system_showText(LANG_SITEMGR_EMAILNOTIFICATION_SUCCESSADDED);
					}

				} else {

					$message = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_ENTERVALIDEMAILADDRESS);
					$message_style = "errorMessage";

				}

			}

		}

		if ($_SERVER['REQUEST_METHOD'] != 'POST') {
			$emailNotificationObj->extract();
			$deactivate = $emailNotificationObjAux->getString("deactivate");
			$content_type = $emailNotificationObjAux->getString("content_type");
			$bcc = $emailNotificationObjAux->getString("bcc");
		}

	}

	# ----------------------------------------------------------------------------------------------------
	# FORM DEFINES
	# ----------------------------------------------------------------------------------------------------
	//deactivate
	if(!$deactivate == 1) {
		$deactivate = "";
	} else {
		$deactivate = "checked";
	}

?>
