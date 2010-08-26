<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/custominvoices/index.php
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
	# CODE
	# ----------------------------------------------------------------------------------------------------
	extract($_GET);
	extract($_POST);

	$url_redirect = "".DEFAULT_URL."/gerenciamento/custominvoices";
	$url_base = "".DEFAULT_URL."/gerenciamento";
	$sitemgr = 1;

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	include(INCLUDES_DIR."/code/custominvoice.php");

	// Page Browsing /////////////////////////////////////////

	$pageObj  = new pageBrowsing("CustomInvoice",$screen,10,"date DESC","","", $where);
	$custominvoices = $pageObj->retrievePage();

	$paging_url = DEFAULT_URL."/gerenciamento/custominvoices/index.php";

	# PAGES DROP DOWN ----------------------------------------------------------------------------------------------
	$pagesDropDown = $pageObj->getPagesDropDown($_GET, $paging_url, $screen, system_showText(LANG_SITEMGR_PAGING_GOTOPAGE), "this.form.submit();");
	# --------------------------------------------------------------------------------------------------------------
	
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

		<ul class="list-view">
			<li><a href="<?=DEFAULT_URL?>/gerenciamento/custominvoices/custominvoice.php"><?=system_showText(LANG_SITEMGR_CUSTOMINVOICE_ADDNEWINVOICE)?> &raquo;</a></li>
		</ul>

		<? include(INCLUDES_DIR."/tables/table_paging.php"); ?>

		<? 	if ($custominvoices) { ?>
			<? include(INCLUDES_DIR."/tables/table_custominvoice.php"); ?>
		<? } else { ?>
			<div class="response-msg inf ui-corner-all">
				<?=system_showText(LANG_SITEMGR_CUSTOMINVOICE_NORECORD)?>
			</div>
		<? } ?>
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