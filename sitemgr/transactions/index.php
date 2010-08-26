<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/transactions/index.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (PAYMENT_FEATURE != "on") { exit; }
	if ((CREDITCARDPAYMENT_FEATURE != "on") && (MANUALPAYMENT_FEATURE != "on")) { exit; }

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

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	$url_redirect = "".DEFAULT_URL."/gerenciamento/transactions";
	$url_base = "".DEFAULT_URL."/gerenciamento";

	// Page Browsing /////////////////////////////////////////

	if ($sql_where) $where .= " ".implode(" AND ", $sql_where)." ";

	$pageObj  = new pageBrowsing("Payment_Log", $screen, 10, "transaction_datetime DESC, id DESC", "", "", $where);
	$transactions = $pageObj->retrievePage("array");

	$paging_url = DEFAULT_URL."/gerenciamento/transactions/index.php";

	# PAGES DROP DOWN ----------------------------------------------------------------------------------------------
	$pagesDropDown = $pageObj->getPagesDropDown($_GET, $paging_url, $screen, system_showText(LANG_SITEMGR_PAGING_GOTOPAGE)." ", "this.form.submit();");
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
	<? include(INCLUDES_DIR."/tables/table_transaction_submenu.php"); ?>
	<? include(INCLUDES_DIR."/tables/table_paging.php"); ?>

		<? if ($transactions) { ?>
			<? include(INCLUDES_DIR."/tables/table_transaction.php"); ?>
		<? } else { ?>
			<div class="response-msg inf ui-corner-all">
				<?=system_showText(LANG_SITEMGR_TRANSACTION_NORECORD)?>
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