<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/prefs/promotion.php
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
	extract($_GET);
	
	// Default CSS class for message
	$message_style = "successMessage";

	if ($_SERVER['REQUEST_METHOD'] == "POST") {

		if ($promotion_conditions) {
			if(!customtext_set("promotion_default_conditions", $promotion_default_conditions)) {
				if(!customtext_new("promotion_default_conditions", $promotion_default_conditions)) {
					$error = true;
				}
			}
			if (!$error) {
				$actions[] = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_SETTINGS_PROMOTION_CONFIGURATIONWASCHANGED);
			} else {
				$actions[] = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_MSGERROR_SYSTEMERROR);
				$message_style = "errorMessage";
			}
			if($actions) {
				$message_promotion_conditions .= implode("<br />", $actions);
			}
		}
	}
	
	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------

	customtext_get("promotion_default_conditions", $promotion_default_conditions);

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

			<? include(INCLUDES_DIR."/tables/table_prefs_submenu.php"); ?>

			<form name="promotion_conditions" action="<?=$_SERVER["PHP_SELF"]?>" method="post">
				<? include(INCLUDES_DIR."/forms/form_promotion_conditions.php"); ?>
				<table style="margin: 0 auto 0 auto;">
					<tr>
						<td>
							<button type="submit" name="promotion_conditions" value="Submit" class="ui-state-default ui-corner-all"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
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
