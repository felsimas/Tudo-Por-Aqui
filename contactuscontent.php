<?
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");
?>

	<?
	if (($send) && ($_POST)) {
		$senderror = false;
		if (md5($_POST["captchatext"]) != $_SESSION["captchakey"]) {
			$captchaerror = true;
		}
		$emailerror = false;
		if (!validate_email($_POST["email"])) {
			$emailerror = true;
		}
		$nameerror = false;
		if (!$_POST["name"]) {
			$nameerror = true;
		}
		$titleerror = false;
		if (!$_POST["title"]) {
			$titleerror = true;
		}
		$messageerror = false;
		if (!$_POST["messageBody"]) {
			$messageerror = true;
		}
		if (!$captchaerror && !$emailerror && !$nameerror && !$titleerror && !$messageerror) {
			$_POST["email"] = stripslashes($_POST["email"]);
			$_POST["name"] = stripslashes($_POST["name"]);
			$_POST["title"] = stripslashes($_POST["title"]);
			$_POST["messageBody"] = stripslashes($_POST["messageBody"]);
			$from_email = $_POST["email"];
			$from_name = $_POST["name"];
			$subject = $_POST["title"];
			$messageBody = $_POST["messageBody"];
			$messageBody = str_replace("\r\n", "\n", $messageBody);
			$messageBody = str_replace("\n", "\r\n", $messageBody);
			setting_get("sitemgr_email", $sitemgr_email);
			$sitemgr_emails = split(",", $sitemgr_email);
			setting_get("sitemgr_contactus_email", $sitemgr_contactus_email);
			$sitemgr_contactus_emails = split(",", $sitemgr_contactus_email);
			$errors = array();
			$error  = false;

			if ($sitemgr_contactus_emails[0]) {
				foreach ($sitemgr_contactus_emails as $sitemgr_contactus_email) {
			    	system_mail($sitemgr_contactus_email, "[".EDIRECTORY_TITLE." - Fale Conosco] ".stripslashes($subject), stripslashes($messageBody), "$from_name <$from_email>", "text/html", "", "", $error);
					if ($error) $errors[] = $error;
				}
			} elseif ($sitemgr_emails[0]) {
				foreach ($sitemgr_emails as $sitemgr_email) {
			   	  system_mail($sitemgr_email, "[".EDIRECTORY_TITLE." - Fale Conosco] ".stripslashes($subject), stripslashes($messageBody), "$from_name <$from_email>", "text/html", "", "", $error);
                  if ($error) $errors[] = $error;
				}
			}
			if (!count($errors)) {
				$message_style = "successMessage";
				$contactus_message = system_showText(LANG_CONTACTMSGSUCCESS);
				unset($_POST["email"]);
				unset($_POST["name"]);
				unset($_POST["title"]);
				unset($_POST["messageBody"]);
			} else {
				$senderror = true;
				$existerror = true;
				$contactus_message = implode("<br />", $errors);
			}
		}
		if ($nameerror) {
			$existerror = true;
			$contactus_message .= system_showText(LANG_MSG_CONTACT_TYPE_NAME)."<br />";
		}
		if ($emailerror) {
			$existerror = true;
			$contactus_message .= system_showText(LANG_MSG_CONTACT_ENTER_VALID_EMAIL)."<br />";
		}
		if ($titleerror) {
			$existerror = true;
			$contactus_message .= system_showText(LANG_MSG_CONTACT_TYPE_SUBJECT)."<br />";
		}
		if ($messageerror) {
			$existerror = true;
			$contactus_message .= system_showText(LANG_MSG_CONTACT_TYPE_MESSAGE)."<br />";
		}
		if ($captchaerror) {
			$existerror = true;
			$contactus_message .= system_showText(LANG_MSG_CONTACT_TYPE_CODE)."<br />";
		}
		
		if ($existerror) {
			$message_style = "errorMessage";
			if (!$senderror) {
				$contactus_message .= system_showText(LANG_MSG_CONTACT_CORRECTIT_TRYAGAIN);
			}
		}
	}
	?>

	<? if ($contactus_message) { ?>
		<p class="<?=$message_style?>"><?=$contactus_message?></p>
	<? } ?>

	<form name="contact" action="<?=DEFAULT_URL?>/registro" method="post">
	
		<h2><?=system_showText(LANG_LABEL_FORMCONTACTUS);?></h2>

	Entre em contato conosco atrav&#233;s do formul&#225;rio abaixo ou, se preferir atrav&#233;s do nosso SAC. 
	<br/><br/>
		<table border="0" align="center" cellpadding="0" cellspacing="0" class="standardForm">
			<tr>
				<th><span class="infocontact"><?=system_showText(LANG_LABEL_NAME)?></span></th>
				<td><input id="name" name="name" value="<?=$_POST["name"];?>" type="text" /></td>
			</tr>
			<tr>
				<th><span class="infocontact"><?=system_showText(LANG_LABEL_EMAIL)?></span></th>
				<td><input id="email" name="email" value="<?=$_POST["email"];?>" type="text" /></td>
			</tr>
			<tr>
				<th><span class="infocontact"><?=system_showText(LANG_LABEL_SUBJECT)?></span></th>
				<td><input id="title" name="title" value="<?=$_POST["title"];?>" type="text" /></td>
			</tr>
			<tr>
				<th><span class="infocontact"><?=system_showText(LANG_LABEL_MESSAGE)?></span></th>
				<td><textarea id="message" name="messageBody" rows="8" cols="30"><?=$_POST["messageBody"];?></textarea></td>
			</tr>
			<tr>
				<th>&nbsp;</th>
				<td>
					<?=system_showText(LANG_CAPTCHA_HELP);?>
				</td>
			</tr>
			<tr>
				<th><img src="<?=DEFAULT_URL?>/includes/code/captcha.php" alt="<?=system_showText(LANG_CAPTCHA_ALT)?>" title="<?=system_showText(LANG_CAPTCHA_TITLE)?>" border="0" /></th>
				<td>
					<table cellpadding="0" cellspacing="0">
						<tr>
							<td><input type="text" name="captchatext" value="" class="formCode" /></td>
							<td class="standardFormButton">
								<p class="standardButton">
									<button name="send" value="<?=system_showText(LANG_BUTTON_SEND);?>" type="submit" class="button-send"><?=system_showText(LANG_BUTTON_SEND);?></button>
								</p>
							</td>
						</tr>
					</table>
					
				</td>
			</tr>
		</table>
	</form>
