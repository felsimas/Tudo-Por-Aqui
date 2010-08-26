<?
	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/export/payment.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	$type_invoice = "";
	$type_online = "checked";
	if($_GET["type"]) {
		if($_GET["type"]=="invoice") {
			$type_invoice = "checked";
			$type_online = "";
		} elseif($_GET["type"]=="online") {
			$type_online = "checked";
			$type_invoice = "";
		}
	}

	include(INCLUDES_DIR."/code/export_payment.php");

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

		<? include(INCLUDES_DIR."/tables/table_export_submenu.php"); ?>
		
		<? if ($error) { ?>
		<div class="errorMessage"><?=$error?></div>
		<? } ?>
		<form name="export_payment" method="post">
			<? include(INCLUDES_DIR."/forms/form_export_payment.php"); ?>
				<table style="margin: 0 auto 0 auto;">
				<tr>
					<td>
						<button type="submit" name="btn_export_payment" value="Submit" class="ui-state-default ui-corner-all"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
					</td>
				</tr>
			</table>
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