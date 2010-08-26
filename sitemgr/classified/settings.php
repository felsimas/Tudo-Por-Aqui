<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/classified/settings.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (CLASSIFIED_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	$url_redirect = "".DEFAULT_URL."/gerenciamento/classified";
	$url_base = "".DEFAULT_URL."/gerenciamento";
	$sitemgr = 1;

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	if ($id) {
		$classifiedObj = new Classified($id);
	} else {
		header("Location: ".DEFAULT_URL."/gerenciamento/classified/".(($search_page) ? "search.php" : "index.php")."?message=".urlencode($message)."&screen=$screen&letra=$letra".(($url_search_params) ? "&$url_search_params" : "")."");
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == "POST") {

		if ($_POST["amount"]) $_POST["amount"] = format_money($_POST["amount"]);
		else $_POST["amount"] = false;

		if ($hasrenewaldate == "no") {
			unset($_POST['renewal_date']);
		}

		if (validate_form("classifiedsettings", $_POST, $message_classifiedsettings)) {

			$classifiedObj->setString("status", $_POST['status']);
			$classifiedObj->setDate("renewal_date", $_POST['renewal_date']);

			if (!$classifiedObj->hasRenewalDate()) {
				$classifiedObj->setString("renewal_date", "0000-00-00");
			}

			$classifiedObj->Save();

			if($_POST["add_transaction"] == 1){

				$accountObj = new Account($_POST["account_id"]);
				$contactObj = new Contact($_POST["account_id"]);

				$log["account_id"]				= $_POST["account_id"];
				$log["username"]				= $accountObj->getString("username");;
				$log["ip"]						= $_SERVER["REMOTE_ADDR"];
				$log["transaction_id"]			= "MAN_".strtoupper(uniqid(""));
				$log["transaction_status"]		= MANUAL_STATUS;
				$log["transaction_datetime"]	= date("Y-m-d H:i:s");
				$log["transaction_amount"]		= str_replace(",", "", $_POST["amount"]);
				$log["transaction_currency"]	= MANUAL_CURRENCY;
				$log["system_type"]				= "manual";
				$log["notes"]					= $_POST["notes"];

				$paymentLogObj = new PaymentLog($log);
				$paymentLogObj->Save();

				$payment_classified_log["payment_log_id"]	= $paymentLogObj->getString("id");
				$payment_classified_log["classified_id"]	= $classifiedObj->getString("id");
				$payment_classified_log["classified_title"]	= $classifiedObj->getString("title",false);
				$payment_classified_log["discount_id"]		= $classifiedObj->getString("discount_id");
				$payment_classified_log["level"]			= $classifiedObj->getString("level");
				$payment_classified_log["renewal_date"]		= $classifiedObj->getString("renewal_date");
				$payment_classified_log["amount"]			= str_replace(",", "", $_POST["amount"]);

				$paymentClassifiedLogObj = new PaymentClassifiedLog($payment_classified_log);
				$paymentClassifiedLogObj->Save();

			}

			# ------------------------------------------------------------------------------
			# SENDING EMAIL OF ACTIVATION CLASSIFIED TO MEMBER
			# ------------------------------------------------------------------------------
			if ($_POST['email_notification'] == 1 && $_POST['status'] == "A") {
				if ($classifiedObj->getNumber("account_id") > 0) {
					$contactObj = new Contact($classifiedObj->getNumber("account_id"));
					if ($emailNotificationObj = system_checkEmail(SYSTEM_ACTIVE_CLASSIFIED, $contactObj->getString("lang"))) {
						setting_get("sitemgr_send_email", $sitemgr_send_email);
						setting_get("sitemgr_email", $sitemgr_email);
						$sitemgr_emails = split(",", $sitemgr_email);
						if ($sitemgr_emails[0]) $sitemgr_email = $sitemgr_emails[0];
						$subject = $emailNotificationObj->getString("subject");
						$body 	 = $emailNotificationObj->getString("body");
						$body 	 = system_replaceEmailVariables($body, $classifiedObj->getNumber('id'), 'classified');
						$subject = system_replaceEmailVariables($subject, $classifiedObj->getNumber('id'), 'classified');
						$body = html_entity_decode($body);
						$subject = html_entity_decode($subject);
						system_mail($contactObj->getString("email"), $subject, $body, EDIRECTORY_TITLE." <$sitemgr_email>", $emailNotificationObj->getString("content_type"), "", $emailNotificationObj->getString("bcc"), $error);
					}
				}
			}

			header("Location: ".DEFAULT_URL."/gerenciamento/classified/".(($search_page) ? "search.php" : "index.php")."?message=".urlencode($message)."&screen=$screen&letra=$letra".(($url_search_params) ? "&$url_search_params" : "")."");
			exit;

		}

	}

	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------
	$renewal_date = $classifiedObj->getDate("renewal_date");

	// Status Drop Down
	$statusObj = new ItemStatus();
	unset($arrayValue);
	unset($arrayName);
	$arrayValue = $statusObj->getValues();
	$arrayName = $statusObj->getNames();
	unset($arrayValueDD);
	unset($arrayNameDD);
	for ($i=0; $i<count($arrayValue); $i++) {
		if ($arrayValue[$i] != "E") {
			$arrayValueDD[] = ucwords($arrayValue[$i]);
			$arrayNameDD[] = ucwords($arrayName[$i]);
		}
	}
	$statusDropDown = html_selectBox("status", $arrayNameDD, $arrayValueDD, $classifiedObj->getString("status"), "", "class='input-dd-form-settings'", "-- ".system_showText(LANG_LABEL_SELECT_ALLSTATUS)." --");

	if(!$_POST["account_id"]) $account_id = $classifiedObj->getString("account_id");

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/header.php");

	# ----------------------------------------------------------------------------------------------------
	# NAVBAR
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/navbar.php");

?>

<div id="main-right">

	<div id="top-content">
		<div id="header-content"><h1><?=ucwords(system_showText(LANG_SITEMGR_CLASSIFIED))?> <?=ucwords(system_showText(LANG_SITEMGR_MENU_SETTINGS))?></h1></div>
	</div>

	<div id="content-content">

		<div class="default-margin" style="padding-top:3px;">

			<? require(EDIRECTORY_ROOT."/gerenciamento/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

			<? include(INCLUDES_DIR."/tables/table_classified_submenu.php"); ?>

			<br />
			
			<div class="baseForm">

			<form name="classified_setting" action="<?=$_SERVER["PHP_SELF"]?>" method="post">
				<input type="hidden" name="id" value="<?=$id?>" />

				<? include(INCLUDES_DIR."/forms/form_classifiedsettings.php"); ?>

				<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
				<input type="hidden" name="letra" value="<?=$letra?>" />
				<input type="hidden" name="screen" value="<?=$screen?>" />
				<button type="submit" value="Submit" class="ui-state-default ui-corner-all"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>

				<button type="button" name="back" value="Back" class="ui-state-default ui-corner-all" onclick="document.getElementById('formclassifiedsettingscancel').submit();"><?=system_showText(LANG_SITEMGR_BACK)?></button>

			</form>
			<form id="formclassifiedsettingscancel" action="<?=DEFAULT_URL?>/gerenciamento/classified/<?=(($search_page) ? "search.php" : "index.php");?>" method="post">

				<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
				<input type="hidden" name="letra" value="<?=$letra?>" />
				<input type="hidden" name="screen" value="<?=$screen?>" />

			</form>
			
			</div>

		</div>

	</div>

	<div id="bottom-content">&nbsp;</div>

</div>

<? if ($classifiedObj->hasRenewalDate()) { ?>
	<script language="javascript">
		<!--
		<? if (DEFAULT_DATE_FORMAT == "m/d/Y") { ?>
			var cal_renewal_date = new calendarmdy(document.forms['classified_setting'].elements['renewal_date']);
		<? } elseif (DEFAULT_DATE_FORMAT == "d/m/Y") { ?>
			var cal_renewal_date = new calendardmy(document.forms['classified_setting'].elements['renewal_date']);
		<? } ?>
		cal_renewal_date.year_scroll = true;
		cal_renewal_date.time_comp = false;
		//-->
	</script>
<? } ?>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>
