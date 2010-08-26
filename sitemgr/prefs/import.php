<?
	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/prefs/import.php
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

		if ($imports) {
		
			if ($import_sameaccount==1) {
				if (!is_numeric($account_id)) {
					$actions[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_SETTINGS_IMPORT_COMESFROMEXPORT);
					$message_style = "errorMessage";
					$error_sameaccount = true;
				} else {
					if(!setting_set("import_sameaccount", $import_sameaccount)) 
						if(!setting_new("import_sameaccount", $import_sameaccount))
							$error = true;
					if(!setting_set("import_account_id", $account_id)) 
						if(!setting_new("import_account_id", $account_id))
							$error = true;
				}
			} else {
				if(!setting_set("import_sameaccount", $import_sameaccount)) 
					if(!setting_new("import_sameaccount", $import_sameaccount))
						$error = true;
				if(!setting_set("import_account_id", "")) 
					if(!setting_new("import_account_id", ""))
						$error = true;
			}

			if(!setting_set("import_from_export", $import_from_export))
				if(!setting_new("import_from_export", $import_from_export))
					$error = true;

			if(!setting_set("import_enable_listing_active", $import_enable_listing_active))
				if(!setting_new("import_enable_listing_active", $import_enable_listing_active))
					$error = true;

			if(!setting_set("import_defaultlevel", $import_defaultlevel))
				if(!setting_new("import_defaultlevel", $import_defaultlevel))
					$error = true;

			if (!$error) {
				if (!$error_sameaccount) $actions[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_SETTINGS_IMPORT_INFORMATIONWASCHANGED);
			} else {
				$actions[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_SYSTEMERROR);
				$message_style = "errorMessage";
			}
			if($actions) {
				$message_imports .= implode("<br />", $actions);
			}

		}

	}

	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------
	setting_get("import_sameaccount", $import_sameaccount);
	if ($import_sameaccount) $import_sameaccount = "checked";

	setting_get("import_account_id", $account_id);

	setting_get("import_from_export", $import_from_export);
	if ($import_from_export) $import_from_export = "checked";

	setting_get("import_enable_listing_active", $import_enable_listing_active);
	if ($import_enable_listing_active) $import_enable_listing_active = "checked";

	setting_get("import_defaultlevel", $import_defaultlevel);

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

			<form name="invoiceinfo" action="<?=$_SERVER["PHP_SELF"]?>" method="post" enctype="multipart/form-data">
				<? include(INCLUDES_DIR."/forms/form_import.php"); ?>
				<table style="margin: 0 auto 0 auto;">
					<tr>
						<td>
							<button type="submit" name="imports" value="Submit" class="ui-state-default ui-corner-all"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
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
