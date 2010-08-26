<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/googleprefs/googleanalytics.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATING FEATURES
	# ----------------------------------------------------------------------------------------------------
	if (GOOGLE_ANALYTICS_ENABLED != "on") { exit; }

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

		$googleSettingObj = new GoogleSettings(GOOGLE_ANALYTICS_SETTING);
		$google_analytics_account = $googleSettingObj->formatValue($google_analytics_account);
		$googleSettingObj->setString("value", $google_analytics_account);
		$googleSettingObj->Save();

		$googleSettingObj = new GoogleSettings(GOOGLE_ANALYTICS_FRONT_SETTING);
		$googleSettingObj->setString("value", $google_analytics_front);
		$googleSettingObj->Save();

		$googleSettingObj = new GoogleSettings(GOOGLE_ANALYTICS_MEMBERS_SETTING);
		$googleSettingObj->setString("value", $google_analytics_membros);
		$googleSettingObj->Save();

		$googleSettingObj = new GoogleSettings(GOOGLE_ANALYTICS_SITEMGR_SETTING);
		$googleSettingObj->setString("value", $google_analytics_sitemgr);
		$googleSettingObj->Save();

		$message_googleanalytics = system_showText(LANG_SITEMGR_GOOGLEANALYTICS_SETTINGSSUCCESSCHANGED);
		$message_style = "successMessage";
	}

	# ----------------------------------------------------------------------------------------------------
	# DEFINES
	# ----------------------------------------------------------------------------------------------------	
	$googleSettingObj = new GoogleSettings(GOOGLE_ANALYTICS_SETTING);	
	$google_analytics_account = $googleSettingObj->getString("value");

	$googleSettingObj = new GoogleSettings(GOOGLE_ANALYTICS_FRONT_SETTING);
	$google_analytics_front = $googleSettingObj->getString("value");

	$googleSettingObj = new GoogleSettings(GOOGLE_ANALYTICS_MEMBERS_SETTING);
	$google_analytics_membros = $googleSettingObj->getString("value");

	$googleSettingObj = new GoogleSettings(GOOGLE_ANALYTICS_SITEMGR_SETTING);
	$google_analytics_sitemgr = $googleSettingObj->getString("value");

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
				<p><a href="http://www.google.com/analytics/" target="_blank"><?=system_showText(LANG_SITEMGR_GOOGLEANALYTICS_TIP1)?></a></p>
			</div>

			<br />

			<form name="googleprefs" action="<?=$_SERVER["PHP_SELF"]?>" method="post">
				<? include(INCLUDES_DIR."/forms/form_google_analytics.php"); ?>
				<table style="margin: 0 auto 0 auto;">
					<tr>
						<td>
							<button type="submit" name="googleanalytics" value="Submit" class="ui-state-default ui-corner-all"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
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
