<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /membros/transactions/index.php
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
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_GET);
	extract($_POST);

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSession();
	$acctId = sess_getAccountIdFromSession();

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	$url_redirect = "".DEFAULT_URL."/membros/transactions";
	$url_base = "".DEFAULT_URL."/membros";

	// Page Browsing /////////////////////////////////////////
	$sql_where[] = " account_id = $acctId ";

	if ($sql_where) $where .= " ".implode(" AND ", $sql_where)." ";

	$pageObj  = new pageBrowsing("Payment_Log", $screen, 10, "transaction_datetime DESC, id DESC", "", "", $where);
	
	$transactions = $pageObj->retrievePage("array");

	$paging_url = DEFAULT_URL."/membros/transactions/index.php";

	# PAGES DROP DOWN ----------------------------------------------------------------------------------------------
	$pagesDropDown = $pageObj->getPagesDropDown($_GET, $paging_url, $screen, system_showText(LANG_PAGING_GOTOPAGE).": ", "this.form.submit();");
	# --------------------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/header_members.php");

?>

	<div id="page-wrapper">

		<div id="main-wrapper">
		<?php 	include(MEMBERS_EDIRECTORY_ROOT."/menu.php"); ?>
		
			<div id="main-content"> 

				
				<div class="page-title ui-widget-content ui-corner-all">

					<div class="other_content">

				<? require(EDIRECTORY_ROOT."/gerenciamento/registration.php"); ?>
				<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
				<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

					<div id="header-form"><?=system_highlightLastWord(system_showText(LANG_MANAGE_TRANSACTIONS))?></div>

					<? include(INCLUDES_DIR."/tables/table_paging.php"); ?>

					<? if ($transactions) { ?>

						<? include(INCLUDES_DIR."/tables/table_transaction.php"); ?>

					<? } else { ?>
						<br/>
						<div class="response-msg notice ui-corner-all"><?=system_showText(LANG_MSG_NO_TRANSACTIONS_IN_THE_SYSTEM)?></div>

					<? } ?>

			</div>

		</div>
	<div class="clearfix"></div>
</div>
