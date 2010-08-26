<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/transactions/view.php
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

	extract($_GET);
	extract($_POST);

	$url_redirect = "".DEFAULT_URL."/gerenciamento/transactions";
	$url_base = "".DEFAULT_URL."/gerenciamento";

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	if ($id) {

		include(INCLUDES_DIR."/code/transaction.php");

	} else {
		header("Location: ".DEFAULT_URL."/gerenciamento/transactions/".(($search_page) ? "search.php" : "index.php")."?screen=$screen&letra=$letra".(($url_search_params) ? "&$url_search_params" : "")."");
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

	<? include(INCLUDES_DIR."/tables/table_transaction_submenu.php"); ?>

	<? include_once(EDIRECTORY_ROOT."/includes/views/view_transaction_detail.php");?>


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