<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/prefs/foreignaccount.php
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

	$message_style = "successMessage";

	if ($_SERVER['REQUEST_METHOD'] == "POST") {

		if (!setting_set("foreignaccount_openid", $foreignaccount_openid))
			if (!setting_new("foreignaccount_openid", $foreignaccount_openid))
				$error = true;

		if (!setting_set("foreignaccount_facebook", $foreignaccount_facebook))
			if (!setting_new("foreignaccount_facebook", $foreignaccount_facebook))
				$error = true;

		if (!setting_set("foreignaccount_facebook_apikey", $foreignaccount_facebook_apikey))
			if (!setting_new("foreignaccount_facebook_apikey", $foreignaccount_facebook_apikey))
				$error = true;

		if (!$error) {
			$actions[] = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_SETTINGS_LOGINOPTION_CONFIGURATIONWASCHANGED);
		} else {
			$actions[] = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_MSGERROR_SYSTEMERROR);
			$message_style = "errorMessage";
		}
		if ($actions) {
			$message_foreignaccount .= implode("<br />", $actions);
		}

	}

	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------
	setting_get("foreignaccount_openid", $foreignaccount_openid);
	if ($foreignaccount_openid) $foreignaccount_openid_checked = "checked";
	setting_get("foreignaccount_facebook", $foreignaccount_facebook);
	if ($foreignaccount_facebook) $foreignaccount_facebook_checked = "checked";
	if (!$foreignaccount_facebook_apikey) setting_get("foreignaccount_facebook_apikey", $foreignaccount_facebook_apikey);

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

			<br />

			<form name="foreignaccount" action="<?=$_SERVER["PHP_SELF"]?>" method="post">
				<? include(INCLUDES_DIR."/forms/form_foreignaccount.php"); ?>
				<table style="margin: 0 auto 0 auto;">
					<tr>
						<td>
							<button type="submit" name="foreignaccount" value="Submit" class="ui-state-default ui-corner-all"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
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
