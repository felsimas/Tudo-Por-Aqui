<?


	# ----------------------------------------------------------------------------------------------------
	# * FILE: /membros/invoices/view.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (PAYMENT_FEATURE != "on") { exit; }
	if (INVOICEPAYMENT_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	extract($_GET);
	extract($_POST);
	$url_base = "".DEFAULT_URL."/membros";

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSession();
	$acctId = sess_getAccountIdFromSession();

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	if ($id) {
		include(INCLUDES_DIR."/code/invoice.php");
	} else {
		header("Location: ".DEFAULT_URL."/membros/invoices/index.php?message=".urlencode($message)."&screen=$screen&letra=$letra");
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
	
				<? require(EDIRECTORY_ROOT."/gerenciamento/registration.php"); ?>
				<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
				<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

				<div id="header-form"><?=system_highlightLastWord(system_showText(LANG_INVOICE_DETAIL));?></div>

				<? if(is_array($invoice) && ((is_array($invoice_listing)) || (is_array($invoice_event)) || (is_array($invoice_banner)) || (is_array($invoice_classified)) || (is_array($invoice_article)) || (is_array($invoice_custominvoice)))){ ?>

					<? include_once(EDIRECTORY_ROOT."/includes/views/view_invoice_detail.php");?>

				<? } else { ?>

					<div class="response-msg inf ui-corner-all"><?=system_showText(LANG_INVOICE_NOT_FOUND_FOR_ACCOUNT)?></div>

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
					include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");
				?>
