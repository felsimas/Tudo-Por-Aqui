<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /membros/billing/pay.php
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
	$second_step = $_POST["second_step"] ? $_POST["second_step"] : $_GET["second_step"];
	if (!$second_step) {
		header("Location: ".$url_base."/billing/index.php");
		exit;
	}
	include(INCLUDES_DIR."/code/billing.php");

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

				<div id="header-form"><?=system_highlightLastWord(system_showText(LANG_MANAGE_BILLING))?></div>

				<? if ($paymentSystemError) { ?>

					<a href="javascript:history.back(-1);" class="btn ui-state-default ui-corner-all">
						<?=system_showText(LANG_LABEL_BACK);?>
						<span ></span>
					</a>
					<div style="clear:left"></div>

					
					<div class="response-msg error ui-corner-all"><?=$payment_message?></div>

				<? } elseif ($payment_message) { ?>

					<a class="btn ui-state-default ui-corner-all" href="javascript:history.back(-1);">
					<?=system_showText(LANG_LABEL_BACK);?>
					<span class="ui-icon ui-icon-circle-arrow-w"></span>
					</a>
					
					<div class="clearfix"></div>
					<br/>
					<div class="response-msg error ui-corner-all">
						<?=system_showText(LANG_MSG_PROBLEMS_WERE_FOUND)?>:<br />
						<?=$payment_message?>
					</div>

				<? } elseif ((!$bill_info["listings"]) && (!$bill_info["events"]) && (!$bill_info["banners"]) && (!$bill_info["classifieds"]) && (!$bill_info["articles"]) && (!$bill_info["custominvoices"])) { ?>

					<a href="javascript:history.back(-1);" class="btn ui-state-default ui-corner-all">
						<?=system_showText(LANG_LABEL_BACK);?>
						<span ></span>
					</a>
					<div style="clear:left"></div>

					<?
					echo "<div class=\"response-msg notice ui-corner-all\">".system_showText(LANG_MSG_NO_ITEMS_SELECTED_REQUIRING_PAYMENT)."</div>";
					?>

				<? } else { ?>

					<? include(INCLUDES_DIR."/tables/table_billing_second_step.php"); ?>

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
