<?
	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/prefs/claim.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (CLAIM_FEATURE != "on") { exit; }

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

	if (!$lang) $lang = EDIR_DEFAULT_LANGUAGE;
	
	// Default CSS class for message
	$message_style = "successMessage";

	if ($_SERVER['REQUEST_METHOD'] == "POST") {

		if ($claim_options) {
			if(!setting_set("claim_approve", $claim_approve)) {
				if(!setting_new("claim_approve", $claim_approve)) {
					$error = true;
				}
			}
			if(!setting_set("claim_deny", $claim_deny)) {
				if(!setting_new("claim_deny", $claim_deny)) {
					$error = true;
				}
			}
			if(!setting_set("claim_approveemail", $claim_approveemail)) {
				if(!setting_new("claim_approveemail", $claim_approveemail)) {
					$error = true;
				}
			}
			if(!setting_set("claim_denyemail", $claim_denyemail)) {
				if(!setting_new("claim_denyemail", $claim_denyemail)) {
					$error = true;
				}
			}
			
			if (trim($claim_textlink) == "") $claim_textlink = "Is this your ".LISTING_FEATURE_NAME."?";
			
			if(!customtext_set("claim_textlink", $claim_textlink, $lang)) {
				if(!customtext_new("claim_textlink", $claim_textlink, $lang)) {
					$error = true;
				}
			}
			
			if (!$error) {
				$actions[] = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_SETTINGS_CLAIM_CONFIGURATIONWASCHANGED);
			} else {
				$actions[] = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_MSGERROR_SYSTEMERROR);
				$message_style = "errorMessage";
			}
			if($actions) {
				$message_claim_options .= implode("<br />", $actions);
			}
		}
	}
	
	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------

	setting_get("claim_approve", $claim_approve);
	if ($claim_approve) $claim_approve_checked = "checked";
	setting_get("claim_deny", $claim_deny);
	if ($claim_deny) $claim_deny_checked = "checked";
	setting_get("claim_approveemail", $claim_approveemail);
	if ($claim_approveemail) $claim_approveemail_checked = "checked";
	setting_get("claim_denyemail", $claim_denyemail);
	if ($claim_denyemail) $claim_denyemail_checked = "checked";
	customtext_get("claim_textlink", $claim_textlink, $lang);

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/header_manager.php");


?>

<script language="javascript">
function changeComboLang (value) {
	if (value)
		window.location.href = "claim.php?lang="+value;
	return true;
}
</script>

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

			<form name="claim_options" action="<?=$_SERVER["PHP_SELF"]?>" method="post">
				<? include(INCLUDES_DIR."/forms/form_claim_options.php"); ?>
				<table style="margin: 0 auto 0 auto;">
					<tr>
						<td>
							<button type="submit" name="claim_options" value="Submit" class="ui-state-default ui-corner-all"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
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
