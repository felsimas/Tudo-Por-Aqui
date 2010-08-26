<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/custominvoices/send.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (PAYMENT_FEATURE != "on") { exit; }
	if ((CREDITCARDPAYMENT_FEATURE != "on") && (INVOICEPAYMENT_FEATURE != "on")) { exit; }
	if (CUSTOM_INVOICE_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	$url_redirect = "".DEFAULT_URL."/gerenciamento/custominvoices";
	$url_base = "".DEFAULT_URL."/gerenciamento";
	$sitemgr = 1;

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_GET);
	extract($_POST);

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	if (!$id) {
		header("Location: ".DEFAULT_URL."/gerenciamento/custominvoices/index.php");
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		$customInvoice = new CustomInvoice($id);

		if ($customInvoice->getString("paid") == "y") {
			header("Location: ".DEFAULT_URL."/gerenciamento/custominvoices/".($search_page) ? "search.php" : "index.php")."?screen=$screen&letra=$letra".(($url_search_params) ? "&$url_search_params" : "")."";
			exit;
		}

		/* updating status */
		$customInvoice->setString("sent", "y");

		$sent_date = $customInvoice->getString("sent_date").($customInvoice->getString("sent_date")) ? "\n" : "".date("Y-m-d");

		$customInvoice->setString("sent_date", $sent_date);

		$customInvoice->Save();

		$emailNotification = new EmailNotification(SYSTEM_NEW_CUSTOMINVOICE);

		$body = stripslashes($body_message);
		$subject = stripslashes($subject);

		$return = system_mail($to, $subject, $body, $from, $emailNotification->getString("content_type"), $cc, $bcc, $error);
		
		if (!$return) {
			$message = urlencode($error);
		} else {
			$error = 0;
			$message = urlencode(system_showText(LANG_SITEMGR_CUSTOMINVOICE_SUCCESSSENT));	
		}
		
		header("Location: ".DEFAULT_URL."/gerenciamento/custominvoices/".(($search_page) ? "search.php" : "index.php")."?message=$message&error=$error&screen=$screen&letra=$letra".(($url_search_params) ? "&$url_search_params" : "")."");
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------
	$url_redirect = "".DEFAULT_URL."/gerenciamento/custominvoices";
	$url_base     = "".DEFAULT_URL."/gerenciamento";

	setting_get("sitemgr_email", $sitemgr_email);
	$sitemgr_emails = split(",", $sitemgr_email);
	if ($sitemgr_emails[0]) $sitemgr_email = $sitemgr_emails[0];

	$customInvoice = new CustomInvoice($id);

	$account = new Account($customInvoice->getNumber("account_id"));

	$contact = db_getFromDB("contact", "account_id", $account->getNumber("id"));

	$emailNotification = new EmailNotification(SYSTEM_NEW_CUSTOMINVOICE, $contact->getString("lang"));

	$body = $emailNotification->getString("body");
	$body = str_replace("EDIRECTORY_TITLE", EDIRECTORY_TITLE, $body);
	$body = str_replace("DEFAULT_URL", DEFAULT_URL, $body);
	$body = str_replace("ACCOUNT_NAME", $contact->getString("first_name")." ".$contact->getString("last_name"), $body);
	$body = str_replace("ACCOUNT_USERNAME", $account->getString("username"), $body);
	$body = str_replace("SITEMGR_EMAIL", $sitemgr_email, $body);
	$body = str_replace("CUSTOM_INVOICE_AMOUNT", CURRENCY_SYMBOL." ".$customInvoice->getPrice(), $body);

	$subject = str_replace("EDIRECTORY_TITLE", EDIRECTORY_TITLE, $emailNotification->getString("subject"));

		# ----------------------------------------------------------------------------------------------------
		# HEADER
		# ----------------------------------------------------------------------------------------------------
		include(SM_EDIRECTORY_ROOT."/layout/header_manager.php");

	?>

		<div id="page-wrapper">

			<div id="main-wrapper">

			<?php 	include(SM_EDIRECTORY_ROOT."/menu.php"); ?>

				<div id="main-content"> 

					<div class="page-title ui-widget-content ui-corner-all">

						<div class="other_content">

			<? require(EDIRECTORY_ROOT."/gerenciamento/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>
			
			<div class="baseForm">

			<form name="custominvoice" method="post" action="<?=$_SERVER["PHP_SELF"]?>">
				<input type="hidden" name="id" value="<?=$id?>" />
				<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
				
					<div class="response-msg inf ui-corner-all"><?=system_showText(LANG_SITEMGR_CUSTOMINVOICE_SENDQUESTION)?></div>
							
					<table align="center" class="standard-table">
					<tr>
						<th class="standard-tabletitle"><?=system_showText(LANG_SITEMGR_CUSTOMINVOICE_MESSAGE)?><br /><br /><span><?=system_showText(LANG_SITEMGR_EDITINFORMATIONBELLOWIFNECESSARY)?></span></th>
					</tr>
				</table>
				<table align="left'" class="standard-table">
					<tr>
						<th style="text-align: left; width: 45px;"><?=system_showText(LANG_SITEMGR_CUSTOMINVOICE_TO)?>: </th>
						<td class="td-form">
							<?=$contact->getString("email")?>
							<input type="hidden" name="to" value="<?=$contact->getString("email")?>" />
						</td>
					</tr>
					<tr>
						<th style="text-align: left; width: 45px;"><?=system_showText(LANG_SITEMGR_LABEL_FROM)?>: </th>
						<td class="td-form">
							<?=$sitemgr_email?>
							<input type="hidden" name="from" value="<?=$sitemgr_email?>" />
						</td>
					</tr>
					<tr>
						<th style="text-align: left; width: 45px;"><?=system_showText(LANG_SITEMGR_LABEL_CC)?>: </th>
						<td class="td-form"><input type="text" name="cc" maxlength="255" /></td>
					</tr>
					<tr>
						<th style="text-align: left; width: 45px;"><?=system_showText(LANG_SITEMGR_LABEL_BCC)?>: </th>
						<td class="td-form"><input type="text" name="bcc" value="<?=$emailNotification->getString("bcc")?>" maxlength="255" /></td>
					</tr>
					<tr>
						<th style="text-align: left; width: 45px;"><?=system_showText(LANG_SITEMGR_LABEL_SUBJECT)?>: </th>
						<td class="td-form"><input type="text" name="subject" value="<?=$subject?>" maxlength="255" /></td>
					</tr>
				</table>
				<table align="center" class="standard-table">
					<tr>
						<td><textarea name="body_message" rows="15" style="width: 500px;"><?=$body?></textarea></td>
					</tr>
				</table>
				<button type="submit" name="send" value="Send" class="ui-state-default ui-corner-all"><?=system_showText(LANG_SITEMGR_SEND)?></button>
				<button type="button" value="Cancel" class="ui-state-default ui-corner-all" onclick="document.getElementById('formcustoinvoicessendcancel').submit();"><?=system_showText(LANG_SITEMGR_CANCEL)?></button>
			</form>
			<form id="formcustoinvoicessendcancel" action="<?=DEFAULT_URL?>/gerenciamento/custominvoices/<?=(($search_page) ? "search.php" : "index.php");?>" method="post">
				<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
				<input type="hidden" name="letra" value="<?=$letra?>" />
				<input type="hidden" name="screen" value="<?=$screen?>" />
			</form>
			
							</div>
						</div>
					</div>
				</div>
			</div>
		<div class="clearfix"></div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>