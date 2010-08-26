<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /classified/emailform.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (CLASSIFIED_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	session_start();

	# ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/validate_querystring.php");
	include(EDIRECTORY_ROOT."/includes/code/validate_frontrequest.php");

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	$classi_id = $_POST["classi_id"] ? $_POST["classi_id"] : $_GET["classi_id"];
	$classi_id = system_denyInjections($classi_id);
	$receiver = $_POST["receiver"] ? $_POST["receiver"] : $_GET["receiver"];
	$receiver = system_denyInjections($receiver);

	$level = new ClassifiedLevel();
	$obj = new Classified($classi_id);
	if ($level->getDetail($obj->getNumber("level")) == "y") {
		$local_url = "/detail.php?id=".$classi_id;
	} else {
		$local_url = "/results.php?id=".$classi_id;
	}

	if ($receiver == "owner") {
		$to = $obj->getString("email");
		$saudation = system_showText(LANG_CONTACT)." ".$obj->getString('title');
		if (empty($subject)) $subject = system_showText(LANG_CLASSIFIED_CONTACTSUBJECT_ISNULL_1)." ".$obj->getString('title')." ".system_showText(LANG_CLASSIFIED_CONTACTSUBJECT_ISNULL_2)." ".EDIRECTORY_TITLE;
	} else {
		$saudation = system_showText(LANG_CLASSIFIED_TOFRIEND_SAUDATION);
		$emailNotificationObj = system_checkEmail(SYSTEM_EMAIL_TOFRIEND, EDIR_LANGUAGE);
		if (empty($subject)) {
			$subject = system_replaceEmailVariables($emailNotificationObj->subject, $obj->getNumber("id"), "classified");
			$subject = htmlspecialchars($subject);
		}
		$disabled = "";
	}

	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		$to = trim($to);
		$from = trim($from);

		$to = system_denyInjections($to);
		$from = system_denyInjections($from);
		$subject = system_denyInjections($subject);
		$body = system_denyInjections($body);

		$error = "";
		if (!validate_email($to)) $error .= system_showText(LANG_MSG_TOFRIEND1).".<br />";
		if (!validate_email($from)) $error .= system_showText(LANG_MSG_TOFRIEND2).".<br />";

		if (md5($_POST["captchatext"]) != $_SESSION["captchakey"]) {
			$error .= system_showText(LANG_MSG_CONTACT_TYPE_CODE)."<br />";
		}

		$subject = stripslashes($subject);
		$body = stripslashes($body);

		if (empty($error)) {

			if (empty($subject)) $subject = system_showText(LANG_CLASSIFIED_CONTACTSUBJECT_ISNULL_1)." ".$obj->getString("title")." ".system_showText(LANG_CLASSIFIED_CONTACTSUBJECT_ISNULL_2)." ".EDIRECTORY_TITLE;

			$subject = stripslashes($subject);

			$subject = "[".system_showText(LANG_CONTACTPRESUBJECT)." ".EDIRECTORY_TITLE."] ".$subject;

			$message = "";

			$url = CLASSIFIED_DEFAULT_URL.$local_url;

			if ($receiver == "friend") {

				$message = "";

				if ($emailNotificationObj = system_checkEmail(SYSTEM_EMAIL_TOFRIEND, EDIR_LANGUAGE)) {
					$message .= system_replaceEmailVariables($emailNotificationObj->body, $obj->getNumber("id"), "classified");
				}

				if ($emailNotificationObj->content_type == "text/plain") $linebreak = "\r\n";
				else $linebreak = "<br />";

				$message .= $linebreak.$linebreak;
				$message .= system_showText(LANG_CLASSIFIED_TOFRIEND_MAIL).$linebreak;
				$message .= system_showText(LANG_LABEL_NAME).": ".$obj->getString("title").$linebreak;
				$cityObj  = new LocationRegion($obj->getString("bairro_id"));
				$stateObj = new LocationState($obj->getString("cidade_id"));
				$message .= system_showText(LANG_CLASSIFIED_LOCATIONS).":";
				if ($obj->getString("address")) $message .= " ".$obj->getString("address");
				if ($obj->getString("address2")) $message .= " (".$obj->getString("address2").")";
				if (($obj->getString("address")) || ($obj->getString("address2"))) $message .= ", ";
				if ($cityObj->getString("name")) $message .= $cityObj->getString("name");
				if (($cityObj->getString("name")) || ($stateObj->getString("name"))) $message .= " - ";
				if ($stateObj->getString("name")) $message .= $stateObj->getString("name");
				if ($obj->getString("zip_code")) $message .= " ".$obj->getString("zip_code");
				$message .= $linebreak;
				$message .= "----------------------------".$linebreak;

			}

			$message .= stripslashes($body);
			$subject = html_entity_decode($subject);

			$error = false;
			$return = system_mail($to, $subject, $message, $from, $emailNotificationObj->content_type, '', '', $error);

			$return_email_message = "";
			if ($return) $return_email_message .= "<p class=\"successMessage\">".system_showText(LANG_CONTACTMSGSUCCESS)."</p>";
			else $return_email_message .= "<p class=\"errorMessage\">".system_showText(LANG_CONTACTMSGFAILED).($error ? '<br />'.$error : '')."</p>";

			$return_email_message .= "<p class=\"standardButton closeButton\"><a href=\"javascript:void(0);\" onclick=\"javascript:window.close();\">".system_showText(LANG_CLOSEWINDOW)."</a></p>";

		}

	}

	header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);

	include(INCLUDES_DIR."/code/headertag.php");

	$headertag_title = $headertag_title." - ".ucwords(system_showText(LANG_CLASSIFIED))." ".system_showText(LANG_EMAILFORM);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

	<head>

		<meta http-equiv="Content-Type" content="text/html; charset=<?=EDIR_CHARSET;?>" />

		<meta name="ROBOTS" content="index, follow" />

		<? $headertag_author = (($headertag_author) ? ($headertag_author) : ("Sis Dir 2009 - Classificados")); ?>
		<meta name="author" content="<?=$headertag_author?>" />

		<? $headertag_description = (($headertag_description) ? ($headertag_description) : (EDIRECTORY_TITLE)); ?>
		<meta name="description" content="<?=$headertag_description?>" />

		<? $headertag_keywords = (($headertag_keywords) ? ($headertag_keywords) : (EDIRECTORY_TITLE)); ?>
		<meta name="keywords" content="<?=$headertag_keywords?>" />

		<? $headertag_title = (($headertag_title) ? ($headertag_title) : (EDIRECTORY_TITLE)); ?>
		<title><?=$headertag_title?></title>

		<?
		if (EDIR_THEME) {
			include(THEMEFILE_DIR."/".EDIR_THEME."/".EDIR_THEME.".php");
		} else {
			?><link href="<?=DEFAULT_URL?>/layout/popup.css" rel="stylesheet" type="text/css" media="all" /><?
		}
		?>

		<?=system_getNoImageStyle($cssfile = true);?>

	</head>

	<body>

		<div class="wrapper">

		<form name="mail" method="post">
			<input type="hidden" name="classi_id" value="<?=$classi_id?>" />
			<input type="hidden" name="receiver" value="<?=$receiver?>" />

				<? if ($return_email_message) { ?>

					<h1><?=$obj->getString("title")?></h1>

					<p><?=$saudation?></p>

					<p><?=$return_email_message?></p>

				<? } else { ?>

					<h1><?=$obj->getString("title")?></h1>

					<p><?=$saudation?></p>

						<? if ($error) { ?>

							<p class="errorMessage"><?=$error?></p>

						<? } ?>

					<table border="0" cellpadding="0" cellspacing="0" class="standardForm">
						<? if ($receiver != "owner") { ?>
							<tr>
								<th><?=system_showText(LANG_LABEL_TO)?></th>
								<td colspan="2"><input type="text" name="to" value="<?=$to?>" /></td>
							</tr>
						<? } else { ?>
							<input type="hidden" name="to" value="<?=$to?>" />
						<? } ?>
						<tr>
							<th><?=system_showText(LANG_LABEL_FROM)?></th>
							<td colspan="2"><input type="text" name="from" value="<?=$from?>" /></td>
						</tr>
						<tr>
							<th><?=system_showText(LANG_LABEL_SUBJECT)?></th>
							<td colspan="2"><input type="text" name="subject" value="<?=$subject?>" /></td>
						</tr>
						<tr>
							<th><?=system_showText(LANG_LABEL_ADDITIONALMSG)?></th>
							<td colspan="2"><textarea name="body" rows="4" cols="0"><?=$body?></textarea></td>
						</tr>
						<tr>
							<th>&nbsp;</th>
							<td colspan="2">
								<?=system_showText(LANG_CAPTCHA_HELP)?>
							</td>
						</tr>
						<tr>
							<th><img src="<?=DEFAULT_URL?>/includes/code/captcha.php" border="0" alt="<?=system_showText(LANG_CAPTCHA_ALT)?>" title="<?=system_showText(LANG_CAPTCHA_TITLE)?>" /></th>
							<td><input type="text" name="captchatext" value="" class="formCode" /></td>
							<td><p class="standardButton"><button type="submit" value="Send"><?=system_showText(LANG_BUTTON_SEND)?></button></p></td>
						</tr>
					</table>

				<? } ?>

			</form>

		</div>

	</body>

</html>
