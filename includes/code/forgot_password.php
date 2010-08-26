<?

	if (!$_POST["username"]) {
		$message_class = (!$_POST) ? "informationMessage" : "errorMessage";
		$message = system_showText(LANG_MSG_TYPE_USERNAME);
	} else {

		$user_info = false;

		setting_get("sitemgr_username", $sitemgr_username);

		if ($section == "sitemgr") {
			if ($sitemgr_username == $_POST["username"]) {
				$user_info = true;
			} else {
				$dbObj = db_getDBObject();
				$sql = "SELECT id FROM SMAccount WHERE username = ".db_formatString($_POST["username"])."";
				$result = $dbObj->query($sql);
				if ($result) $user_info = mysql_fetch_assoc($result);
			}
		} else {
			$dbObj = db_getDBObject();
			$sql = "SELECT id FROM Account WHERE foreignaccount = 'n' AND username = ".db_formatString($_POST["username"])."";
			$result = $dbObj->query($sql);
			if ($result) $user_info = mysql_fetch_assoc($result);
		}

		if (!$user_info) {

			$message_class = "errorMessage";
			$message = system_showText(LANG_MSG_USERNAME_WAS_NOT_FOUND)."<br />".system_showText(LANG_MSG_TRY_AGAIN_OR_CONTACT_SUPPORT);
			setting_get("sitemgr_email", $sitemgr_email);
			$sitemgr_emails = split(",", $sitemgr_email);
			setting_get("sitemgr_support_email", $sitemgr_support_email);
			$sitemgr_support_emails = split(",", $sitemgr_support_email);
			if ($sitemgr_support_emails[0]) {
				foreach ($sitemgr_support_emails as $sitemgr_support_email) {
					$message .= "<br />$sitemgr_support_email";
				}
			} elseif ($sitemgr_emails[0]) {
				foreach ($sitemgr_emails as $sitemgr_email) {
					$message .= "<br />$sitemgr_email";
				}
			}

		} else {

			if ($section == "sitemgr") {
				if ($sitemgr_username == $_POST["username"]) {
					$account_id = 0;
					setting_get("sitemgr_email", $sitemgr_email_message);
				} else {
					$smaccountObj = new SMAccount($user_info["id"]);
					$account_id = $smaccountObj->getNumber("id");
					$sitemgr_email_message = $smaccountObj->getString("email");
				}
			} else {
				$accountObj = new Account($user_info["id"]);
				$contactObj = new Contact($user_info["id"]);
				$account_id = $accountObj->getNumber("id");
			}

			$row["account_id"] = $account_id;
			$row["unique_key"] = md5(uniqid(rand(), true));
			$row["entered"]    = date("Y-m-d");
			$row["section"]    = $section;

			$forgotPasswordObj = new forgotPassword();
			$forgotPasswordObj->MakeFromRow($row);

			if ($section == "sitemgr") {

				##################################################
				### SITEMGR EMAIL
				##################################################
				$link = DEFAULT_URL."/gerenciamento/login.php?key=".$row["unique_key"];
				setting_get("sitemgr_email", $sitemgr_email);
				$sitemgr_msg = "Prezado(a) ".$_POST["username"]."\n Para trocar seu password, clique no link abaixo e entre seu novo password.\n\n".$link."\n\n atenciosamente, \n Suporte Tudoporaqui \n suporte@tudoporaqui.com.br ";


                $error = false;
				$return = system_mail($sitemgr_email_message, "Solicita&#231&#245;&#227;o Tudoporaqui", $sitemgr_msg, EDIRECTORY_TITLE." <$sitemgr_email>", 'text/html', '', '', $error);
				##################################################

				$forgotPasswordObj->Save();
				
				if ($return) {
					$message_class = "successMessage";
					$message = system_showText(LANG_SITEMGR_FORGOTPASS_THANKYOU)."<br />".system_showText(LANG_SITEMGR_FORGOTPASS_EMAILSENTACCOUNTHOLDER);
				} else {
					$message_class = "errorMessage";
					$message = $error;
				}
				

			} else {

				if (!$emailNotificationObj = system_checkEmail(SYSTEM_FORGOTTEN_PASS, $contactObj->getString("lang"))) {

					$message_class = "errorMessage";
					$message = system_showText(LANG_MSG_FORGOTTEN_PASSWORD_DISABLED)."<br />".system_showText(LANG_MSG_CONTACT_SUPPORT);
					setting_get("sitemgr_email", $sitemgr_email);
					$sitemgr_emails = split(",", $sitemgr_email);
					setting_get("sitemgr_support_email", $sitemgr_support_email);
					$sitemgr_support_emails = split(",", $sitemgr_support_email);
					if ($sitemgr_support_emails[0]) {
						foreach ($sitemgr_support_emails as $sitemgr_support_email) {
							$message .= "<br />$sitemgr_support_email";
						}
					} elseif ($sitemgr_emails[0]) {
						foreach ($sitemgr_emails as $sitemgr_email) {
							$message .= "<br />$sitemgr_email";
						}
					}

				} else {

					##################################################
					### MEMBERS EMAIL
					##################################################
					$subject = $emailNotificationObj->getString("subject");
					$body    = $emailNotificationObj->getString("body");
					$link = DEFAULT_URL."/membros/login.php?key=".$row["unique_key"];
					setting_get("sitemgr_email", $sitemgr_email);
					$subject = str_replace("ACCOUNT_NAME",     $contactObj->getString("first_name")." ".$contactObj->getString("last_name"), $subject);
					$subject = str_replace("ACCOUNT_USERNAME", $accountObj->getString("username"),                                           $subject);
					$subject = str_replace("SITEMGR_EMAIL",    $sitemgr_email,                                                               $subject);
					$subject = str_replace("EDIRECTORY_TITLE", EDIRECTORY_TITLE,                                                             $subject);
					$subject = str_replace("DEFAULT_URL",      DEFAULT_URL,                                                                  $subject);
					$subject = str_replace("KEY_ACCOUNT",      $link,                                                                        $subject);
					$body = str_replace("ACCOUNT_NAME",     $contactObj->getString("first_name")." ".$contactObj->getString("last_name"), $body);
					$body = str_replace("ACCOUNT_USERNAME", $accountObj->getString("username"),                                           $body);
					$body = str_replace("SITEMGR_EMAIL",    $sitemgr_email,                                                               $body);
					$body = str_replace("EDIRECTORY_TITLE", EDIRECTORY_TITLE,                                                             $body);
					$body = str_replace("DEFAULT_URL",      DEFAULT_URL,                                                                  $body);
					$body = str_replace("KEY_ACCOUNT",      $link,                                                                        $body);
					$body = html_entity_decode($body);
					$subject = html_entity_decode($subject);
					$error = false;
					$return  = system_mail($contactObj->getString("email"), $subject, $body, EDIRECTORY_TITLE." <$sitemgr_email>", $emailNotificationObj->getString("content_type"), "", $emailNotificationObj->getString("bcc"), $error);
					##################################################

					$forgotPasswordObj->Save();

					if ($return) {
						$message_class = "successMessage";
						$message = system_showText(LANG_MSG_THANK_YOU)."<br />".system_showText(LANG_MSG_EMAIL_WAS_SENT_TO_ACCOUNT_HOLDER);
					} else {
						$message_class = "errorMessage";
						$message = $error;
					}

				}

			}

		}

	}
?>
