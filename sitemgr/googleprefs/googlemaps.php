<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/googleprefs/googlemaps.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATING FEATURES
	# ----------------------------------------------------------------------------------------------------
	if (GOOGLE_MAPS_ENABLED != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	extract($_POST);
	extract($_GET);

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	
	// Default CSS class for message
	$message_style = "errorMessage";

	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		$googleSettingObj = new GoogleSettings(GOOGLE_MAPS_SETTING);
		$google_maps_key  = $googleSettingObj->formatValue($google_maps_key);
		$googleSettingObj->setString("value", $google_maps_key);
		$googleSettingObj->Save();
		$message_googlemaps = system_showText(LANG_SITEMGR_GOOGLEMAPS_SETTINGSSUCCESSCHANGED);
		$message_style = "successMessage";
	}

	# ----------------------------------------------------------------------------------------------------
	# DEFINES
	# ----------------------------------------------------------------------------------------------------
	$googleSettingObj = new GoogleSettings(GOOGLE_MAPS_SETTING);
	$google_maps_key = $googleSettingObj->getString("value");

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

			<? include(INCLUDES_DIR."/tables/table_googleprefs_submenu.php"); ?>
			
			<div class="tip-base">
				<h1><?=ucwords(system_showText(LANG_SITEMGR_TIP))?>:</h1>
				<p><a href="http://www.google.com/apis/maps/signup.html" target="_blank"><?=system_showText(LANG_SITEMGR_GOOGLEMAPS_TIP1)?></a></p>
			</div>

			<br />

			<form name="googleprefs" action="<?=$_SERVER["PHP_SELF"]?>" method="post">
				<? include(INCLUDES_DIR."/forms/form_google_maps.php"); ?>
				<table style="margin: 0 auto 0 auto;">
					<tr>
						<td>
							<button type="submit" name="googlemaps" value="Submit" class="ui-state-default ui-corner-all"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
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
