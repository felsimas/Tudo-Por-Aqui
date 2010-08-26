<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/prefs/paymentgateway.php
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
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/header_manager.php");

	
	# ----------------------------------------------------------------------------------------------------
	# MESSAGES
	# ----------------------------------------------------------------------------------------------------
	$msg_error   = system_showText(LANG_SITEMGR_MSGERROR_SYSTEMERROR);
	$msg_success = system_showText(LANG_SITEMGR_SETTINGS_PAYMENT_INFORMATIONWASCHANGED);

?>

<script type="text/javascript">
	<!--
	function formSubmit(item) {
		document.forms['paymentgateway'].elements['itemedit'].value = item;
		action = document.forms['paymentgateway'].action;
		action = action.split("#");
		action = action.join("");
		document.forms['paymentgateway'].action = action+"#"+item;
		document.forms['paymentgateway'].submit();
		return true;
	}
	-->
</script>


<div id="page-wrapper">

	<div id="main-wrapper">
	
	<?php 	include(SM_EDIRECTORY_ROOT."/menu.php"); ?>
	
		<div id="main-content"> 

			<div class="page-title ui-widget-content ui-corner-all">

				<div class="other_content">

			<? require(EDIRECTORY_ROOT."/gerenciamento/registration.php"); ?>

			<? include(INCLUDES_DIR."/tables/table_prefs_submenu.php"); ?>

			<br />

			<form id="paymentgateway" name="paymentgateway" action="<?=$_SERVER["PHP_SELF"]?>" method="post">
				<? include(INCLUDES_DIR."/forms/form_paymentsettings.php"); ?>
				<input type="hidden" name="itemedit" value="" />
			</form>

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
