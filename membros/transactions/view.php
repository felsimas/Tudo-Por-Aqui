<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /membros/transactions/view.php
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
	sess_validateSession();
	$acctId = sess_getAccountIdFromSession();

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	if ($cart_id = $_GET['id']) {

		$url_redirect = "".DEFAULT_URL."/membros/transactions";
		$url_base = "".DEFAULT_URL."/membros";

		include(INCLUDES_DIR."/code/transaction.php");

	} else {
		header("Location: ".DEFAULT_URL."/membros/transactions/index.php");
		exit;
	}

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

						<div class="mainContentExtended">

				<? require(EDIRECTORY_ROOT."/gerenciamento/registration.php"); ?>
				<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
				<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

				<div id="header-form"><?=system_highlightLastWord(system_showText(LANG_TRANSACTION_DETAIL));?></div>

				<? if (is_array($transaction) && (is_array($transaction_listing_log) || is_array($transaction_event_log) || is_array($transaction_banner_log) || is_array($transaction_classified_log) || is_array($transaction_article_log) || is_array($transaction_custominvoice_log))) { ?>

					<? include_once(EDIRECTORY_ROOT."/includes/views/view_transaction_detail.php"); ?>

				<? } else { ?>

					<div class="response-msg notice ui-corner-all"><?=system_showText(LANG_TRANSACTION_NOT_FOUND_FOR_ACCOUNT)?></div>

				<? } ?>

				</div>
		</div>
	<div class="clearfix"></div>
</div>