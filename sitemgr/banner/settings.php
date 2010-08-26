<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/banner/settings.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (BANNER_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);

	$url_redirect = "".DEFAULT_URL."/gerenciamento/banner";
	$url_base = "".DEFAULT_URL."/gerenciamento";
	$sitemgr = 1;

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	if ($id) {
		$bannerObj = new Banner($id);
	} else {
		header("Location: ".DEFAULT_URL."/gerenciamento/banner/".(($search_page) ? "search.php" : "index.php")."");
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
		if ($hasimpressions == "no") {
			unset($_POST['impressions']);
		}

		if (validate_form("bannersettings", $_POST, $message_bannersettings)) {

			$bannerObj->setString("status", $_POST['status']);
			$bannerObj->setDate("renewal_date", $_POST['renewal_date']);
			$bannerObj->setNumber("impressions", $_POST['impressions']);
			$bannerObj->setString("expiration_setting", $_POST['expiration_setting']);

			if (!$bannerObj->hasRenewalDate()) {
				$bannerObj->setString("renewal_date", "0000-00-00");
			}
			if (!$bannerObj->hasImpressions()) {
				$bannerObj->setNumber("unpaid_impressions", 0);
				$bannerObj->setString("unlimited_impressions", "y");
			} else {
				$bannerObj->setString("unlimited_impressions", "n");
			}

			$bannerObj->setNumber("unpaid_impressions", 0);

			$bannerObj->save();

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

				$payment_banner_log["payment_log_id"]	= $paymentLogObj->getString("id");
				$payment_banner_log["banner_id"]		= $bannerObj->getString("id");
				$payment_banner_log["banner_caption"]	= $bannerObj->getString("caption",false);
				$payment_banner_log["discount_id"]		= $bannerObj->getString("discount_id");
				$payment_banner_log["level"]			= $bannerObj->getString("level");
				$payment_banner_log["renewal_date"]		= $bannerObj->getString("renewal_date");
				$payment_banner_log["impressions"]		= $bannerObj->getString("impressions");
				$payment_banner_log["amount"]			= str_replace(",", "", $_POST["amount"]);

				$paymentBannerLogObj = new PaymentBannerLog($payment_banner_log);
				$paymentBannerLogObj->Save();

			}

			# ------------------------------------------------------------------------------
			# SENDING EMAIL OF ACTIVATION BANNER TO MEMBER
			# ------------------------------------------------------------------------------
			if ($_POST['email_notification'] == 1 && $_POST['status'] == "A") {
				if ($bannerObj->getNumber("account_id") > 0) {
					$contactObj = new Contact($bannerObj->getNumber("account_id"));
					if ($emailNotificationObj = system_checkEmail(SYSTEM_ACTIVE_BANNER, $contactObj->getString("lang"))) {
						setting_get("sitemgr_send_email", $sitemgr_send_email);
						setting_get("sitemgr_email", $sitemgr_email);
						$sitemgr_emails = split(",", $sitemgr_email);
						if ($sitemgr_emails[0]) $sitemgr_email = $sitemgr_emails[0];
						$subject = $emailNotificationObj->getString("subject");
						$body 	 = $emailNotificationObj->getString("body");
						$body 	 = system_replaceEmailVariables($body, $bannerObj->getNumber('id'), 'banner');
						$subject = system_replaceEmailVariables($subject, $bannerObj->getNumber('id'), 'banner');
						$body = html_entity_decode($body);
						$subject = html_entity_decode($subject);
						//system_mail($contactObj->getString("email"), $subject, $body, EDIRECTORY_TITLE." <$sitemgr_email>", $emailNotificationObj->getString("content_type"), "", $emailNotificationObj->getString("bcc"), $error);
					}
				}
			}

			header("Location: ".DEFAULT_URL."/gerenciamento/banner/".(($search_page) ? "search.php" : "index.php")."?screen=$screen&letra=$letra".(($url_search_params) ? "&$url_search_params" : "")."");
			exit;

		}

	}

	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------
	$renewal_date = $bannerObj->getDate("renewal_date");

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
	$statusDropDown = html_selectBox("status", $arrayNameDD, $arrayValueDD, $bannerObj->getString("status"), "", "class='input-dd-form-settings'", "-- ".system_showText(LANG_LABEL_SELECT_ALLSTATUS)." --");

	if(!$_POST["account_id"]) $account_id = $bannerObj->getString("account_id");

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
			<? include(INCLUDES_DIR."/tables/table_banner_submenu.php"); ?>

			<div class="baseForm">

			<form name="banner" action="<?=$_SERVER["PHP_SELF"]?>" method="post">
				<input type="hidden" name="id" value="<?=$id?>" />
				<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
				<input type="hidden" name="letra" value="<?=$letra?>" />
				<input type="hidden" name="screen" value="<?=$screen?>" />

				<? include(INCLUDES_DIR."/forms/form_bannersettings.php"); ?>

				<button type="submit" value="Submit" class="ui-state-default ui-corner-all"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>

			</form>
			<form action="<?=DEFAULT_URL?>/gerenciamento/banner/<?=(($search_page) ? "search.php" : "index.php")?>" method="post">

				<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
				<input type="hidden" name="letra" value="<?=$letra?>" />
				<input type="hidden" name="screen" value="<?=$screen?>" />
				<button type="submit" name="back" value="Back" class="ui-state-default ui-corner-all"><?=system_showText(LANG_SITEMGR_BACK)?></button>

			</form>
			
							</div>
						</div>
					</div>
				</div>
			</div>
		<div class="clearfix"></div>
<script language="javascript">
	<!--

	<? if (DEFAULT_DATE_FORMAT == "m/d/Y") { ?>
		
		var cal_renewal_date = new calendarmdy(document.forms['banner'].elements['renewal_date']);
	//	var cal_start_date = new calendarmdy(document.forms['banner'].elements['start_date']);
	
	<? } elseif (DEFAULT_DATE_FORMAT == "d/m/Y") { ?>
		
		var cal_renewal_date = new calendardmy(document.forms['banner'].elements['renewal_date']);
	//	var cal_start_date = new calendardmy(document.forms['banner'].elements['start_date']);
	
	<? } ?>
	
	cal_renewal_date.year_scroll = true;
	cal_renewal_date.time_comp = false;

	cal_start_date.year_scroll = true;
	cal_start_date.time_comp = false;
	//-->
</script>
<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>