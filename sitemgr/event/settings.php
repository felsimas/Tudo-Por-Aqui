<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/event/settings.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (EVENT_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	$url_redirect = "".DEFAULT_URL."/gerenciamento/event";
	$url_base = "".DEFAULT_URL."/gerenciamento";
	$sitemgr = 1;

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	if ($id) {
		$event = new Event($id);
	} else {
		header("Location: ".DEFAULT_URL."/gerenciamento/event/".(($search_page) ? "search.php" : "index.php")."?message=".urlencode($message)."&screen=$screen&letra=$letra".(($url_search_params) ? "&$url_search_params" : "")."");
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

		if (validate_form("eventsettings", $_POST, $message_eventsettings)) {

			$event->setString("status", $_POST['status']);
			$event->setDate("renewal_date", $_POST['renewal_date']);

			if (!$event->hasRenewalDate()) {
				$event->setString("renewal_date", "0000-00-00");
			}

			$event->Save();

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

				$payment_event_log["payment_log_id"]	= $paymentLogObj->getString("id");
				$payment_event_log["event_id"]			= $event->getString("id");
				$payment_event_log["event_title"]		= $event->getString("title",false);
				$payment_event_log["discount_id"]		= $event->getString("discount_id");
				$payment_event_log["level"]				= $event->getString("level");
				$payment_event_log["renewal_date"]		= $event->getString("renewal_date");
				$payment_event_log["amount"]			= str_replace(",", "", $_POST["amount"]);

				$paymentEventLogObj = new PaymentEventLog($payment_event_log);
				$paymentEventLogObj->Save();

			}

			# ------------------------------------------------------------------------------
			# SENDING EMAIL OF ACTIVATION EVENT TO MEMBER
			# ------------------------------------------------------------------------------
			if ($_POST['email_notification'] == 1 && $_POST['status'] == "A") {
				if ($event->getNumber("account_id") > 0) {
					$contactObj = new Contact($event->getNumber("account_id"));
					if ($emailNotificationObj = system_checkEmail(SYSTEM_ACTIVE_EVENT, $contactObj->getString("lang"))) {
						setting_get("sitemgr_send_email", $sitemgr_send_email);
						setting_get("sitemgr_email", $sitemgr_email);
						$sitemgr_emails = split(",", $sitemgr_email);
						if ($sitemgr_emails[0]) $sitemgr_email = $sitemgr_emails[0];
						$subject = $emailNotificationObj->getString("subject");
						$body 	 = $emailNotificationObj->getString("body");
						$body 	 = system_replaceEmailVariables($body, $event->getNumber('id'), 'event');
						$subject = system_replaceEmailVariables($subject, $event->getNumber('id'), 'event');
						$body = html_entity_decode($body);
						$subject = html_entity_decode($subject);
						//system_mail($contactObj->getString("email"), $subject, $body, EDIRECTORY_TITLE." <$sitemgr_email>", $emailNotificationObj->getString("content_type"), "", $emailNotificationObj->getString("bcc"), $error);
					}
				}
			}

			header("Location: ".DEFAULT_URL."/gerenciamento/event/".(($search_page) ? "search.php" : "index.php")."?message=".urlencode($message)."&screen=$screen&letra=$letra".(($url_search_params) ? "&$url_search_params" : "")."");
			exit;

		}

	}

	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------
	$renewal_date = $event->getDate("renewal_date");
	
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
			$arrayValueDD[] = $arrayValue[$i];
			$arrayNameDD[] = $arrayName[$i];
		}
	}
	$statusDropDown = html_selectBox("status", $arrayNameDD, $arrayValueDD, $event->getString("status"), "", "class='input-dd-form-settings'", "-- ".system_showText(LANG_LABEL_SELECT_ALLSTATUS)." --");

	if(!$_POST["account_id"]) $account_id = $event->getString("account_id");

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
		<div id="header-content">
			<h1><?=system_showText(LANG_SITEMGR_EVENT_SING)?> <?=ucwords(system_showText(LANG_SITEMGR_MENU_SETTINGS))?></h1>
		</div>
	</div>

	<div id="content-content">

		<div class="default-margin" style="padding-top:3px;">

			<? require(EDIRECTORY_ROOT."/gerenciamento/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

			<? include(INCLUDES_DIR."/tables/table_event_submenu.php"); ?>

			<br />
			
			<div class="baseForm">

			<form name="event_setting" action="<?=$_SERVER["PHP_SELF"]?>" method="post">
				<input type="hidden" name="id" value="<?=$id?>" />

				<? include(INCLUDES_DIR."/forms/form_eventsettings.php"); ?>

							<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
							<input type="hidden" name="letra" value="<?=$letra?>" />
							<input type="hidden" name="screen" value="<?=$screen?>" />
							<button type="submit" value="Submit" class="ui-state-default ui-corner-all"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
							<button type="button" name="back" value="Back" class="ui-state-default ui-corner-all" onclick="document.getElementById('formeventsettingscancel').submit();"><?=system_showText(LANG_SITEMGR_BACK)?></button>

			</form>
			<form id="formeventsettingscancel" action="<?=DEFAULT_URL?>/gerenciamento/event/<?=(($search_page) ? "search.php" : "index.php");?>" method="post">

							<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
							<input type="hidden" name="letra" value="<?=$letra?>" />
							<input type="hidden" name="screen" value="<?=$screen?>" />

			</form>
			
			</div>

		</div>

	</div>

	<div id="bottom-content">
		&nbsp;
	</div>

</div>

<? if ($event->hasRenewalDate()) { ?>
	<script language="javascript">
		<!--
		<? if (DEFAULT_DATE_FORMAT == "m/d/Y") { ?>
			var cal_renewal_date = new calendarmdy(document.forms['event_setting'].elements['renewal_date']);
		<? } elseif (DEFAULT_DATE_FORMAT == "d/m/Y") { ?>
			var cal_renewal_date = new calendardmy(document.forms['event_setting'].elements['renewal_date']);
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
