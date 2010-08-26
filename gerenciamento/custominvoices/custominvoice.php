<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/custominvoices/custominvoice.php
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

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_GET);
	extract($_POST);

	$url_redirect = "".DEFAULT_URL."/gerenciamento/custominvoices";
	$url_base = "".DEFAULT_URL."/gerenciamento";
	$sitemgr = 1;

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	include(INCLUDES_DIR."/code/custominvoice.php");

	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------
	$url_redirect = "".DEFAULT_URL."/gerenciamento/custominvoices";
	$url_base     = "".DEFAULT_URL."/gerenciamento";

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
					<? include(INCLUDES_DIR."/forms/form_custominvoice.php"); ?>
					<button type="button" name="submit_button" value="<?=system_showText(LANG_SITEMGR_CUSTOMINVOICE_CONTINUETOSEND)?>" class="ui-state-default ui-corner-all btExpanded" onclick="document.custominvoice.submit();"><?=system_showText(LANG_SITEMGR_CUSTOMINVOICE_CONTINUETOSEND)?></button>
					<button type="button" value="Cancel" class="ui-state-default ui-corner-all" onclick="document.getElementById('formcustominvoicecancel').submit();"><?=system_showText(LANG_SITEMGR_CANCEL)?></button>
				</form>
				<form id="formcustominvoicecancel" action="<?=DEFAULT_URL?>/gerenciamento/custominvoices/<?=(($search_page) ? "search.php" : "index.php");?>" method="post">
					<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
					<input type="hidden" name="letra" value="<?=$letra?>" />
					<input type="hidden" name="screen" value="<?=$screen?>" />
				</form>
				
				</div>
				
				<br />

		</div>

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