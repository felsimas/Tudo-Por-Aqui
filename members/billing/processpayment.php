<?php

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /membros/billing/processpayment.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (PAYMENT_FEATURE != "on") { exit; }
	if (CREDITCARDPAYMENT_FEATURE != "on") { exit; }

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
	$url_redirect = "".DEFAULT_URL."/membros/billing";
	$url_base = "".DEFAULT_URL."/membros";

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	include(INCLUDES_DIR."/code/billing_".$payment_method.".php");
    	 
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

		<h1 class="titulodasecao"><?=system_showText(LANG_LABEL_TRANSACTION_STATUS)?></h1>

		<h2 class="standardSubTitle"><?=system_showText(LANG_LABEL_TRANSACTION_STATUS)?></h2>

		<?
		if ($payment_success == "y") {
			$contentObj = new Content("", EDIR_LANGUAGE);
			$content = $contentObj->retrieveContentByType("Transaction");
			if ($content) {
				echo "<div class=\"dynamicContent\">".$content."</div>";
			}
		}
		?>

		<? if ($payment_message) { ?>
			<?=urldecode($payment_message)?>
		<? } ?>

		<?
		if ($payment_success == "y") {
			$contentObj = new Content("", EDIR_LANGUAGE);
			$content = $contentObj->retrieveContentByType("Transaction Bottom");
			if ($content) {
				echo "<div class=\"dynamicContent\">".$content."</div>";
			}
		}
		?>


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
