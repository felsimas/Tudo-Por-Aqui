<?
	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/custominvoices/view.php
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
	# CODE
	# ----------------------------------------------------------------------------------------------------
	extract($_GET);
	extract($_POST);

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	if ($id) {
		$customInvoice = new CustomInvoice($id);
		$account = new Account($customInvoice->getNumber("account_id"));
		$contactObj = db_getFromDB("contact", "account_id", $account->getNumber("id"));
	} else {
		header("Location: ".DEFAULT_URL."/gerenciamento/custominvoices");
		exit;
	}

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

		<? include(INCLUDES_DIR."/tables/table_custominvoice_submenu.php"); ?>

		<? if ($message) { ?>
			<div class="response-msg success ui-corner-all"><?=$message?></div>
		<? } ?>

		<br />

		<p style="font-size: 13px; font-family: Verdana; color: #003365; font-weight: bold;"><?=$customInvoice->getString("title")?></p>

		<? if ($customInvoice->getString("paid") != "y") { ?>
				<table style="margin: 0 auto 0 auto;">
				<tr>
					<td>
						<button type="submit" name="submit_button" value="<?=system_showText(LANG_SITEMGR_CUSTOMINVOICE_CLICKHERETOSEND)?>" class="ui-state-default ui-corner-all" style="width: 350px;" onclick="javascript:document.location.href='<?=DEFAULT_URL."/gerenciamento/custominvoices/send.php?id=".$id?>';"><?=system_showText(LANG_SITEMGR_CUSTOMINVOICE_CLICKHERETOSEND)?></button>
					</td>
				</tr>
			</table>
		<? } ?>

		<? include_once(EDIRECTORY_ROOT."/includes/views/view_custominvoice_detail.php");?>

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