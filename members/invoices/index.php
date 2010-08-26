<?


	# ----------------------------------------------------------------------------------------------------
	# * FILE: /membros/invoices/index.php
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
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSession();
	$acctId = sess_getAccountIdFromSession();

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------	
	extract($_GET);
	extract($_POST);
	
	$url_base = "".DEFAULT_URL."/membros";
	
	include(INCLUDES_DIR."/code/invoice.php");
	
	// Page Browsing /////////////////////////////////////////
	$invoiceStatusObj = new InvoiceStatus();
	
	if($acctId)                           $sql_where[] = " account_id = $acctId ";
	if($invoiceStatusObj->getDefault())   $sql_where[] = " status != '".$invoiceStatusObj->getDefault()."' ";
	if ($sql_where)                       $where .= " ".implode(" AND ", $sql_where)." ";
	
	$pageObj  = new pageBrowsing("Invoice",$screen,10,"date DESC","","", $where);
	$invoices = $pageObj->retrievePage("array");
	
	$paging_url = DEFAULT_URL."/membros/invoices/index.php";
	
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

				<div id="header-form"><?=system_highlightLastWord(system_showText(LANG_MANAGE_INVOICES))?></div>

				<? include(INCLUDES_DIR."/tables/table_paging.php"); ?>

				<? 	if ($invoices) { ?>
					<? include(INCLUDES_DIR."/tables/table_invoice.php"); ?>
				<? } else { ?>
					<br/>
					<div class="response-msg notice ui-corner-all"><?=system_showText(LANG_MSG_NO_INVOICES_IN_THE_SYSTEM)?></div>
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
