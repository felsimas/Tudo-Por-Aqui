<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/prefs/review.php
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

		if($review_admin) {

			if(!setting_set("review_listing_enabled", $review_listing_enabled))
				if(!setting_new("review_listing_enabled", $review_listing_enabled))
					$error = true;
					
			if(!setting_set("review_article_enabled", $review_article_enabled))
				if(!setting_new("review_article_enabled", $review_article_enabled))
					$error = true;

			if (!$error) {
				$actions[] = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_SETTINGS_REVIEW_CONFIGURATIONWASCHANGED);
			} else {
				$actions[] = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_MSGERROR_SYSTEMERROR);
				$message_style = "errorMessage";
			}
			if($actions) {
				$message_review_admin .= implode("<br />", $actions);
			}

		} elseif ($review_options) {
			if(!setting_set("review_approve", $review_approve))
				if(!setting_new("review_approve", $review_approve))
					$error = true;
					
			if(!setting_set("review_manditory", $review_manditory))
				if(!setting_new("review_manditory", $review_manditory))
					$error = true;
					
			if (!$error) {
				$actions[] = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_SETTINGS_REVIEW_CONFIGURATIONWASCHANGED);
			} else {
				$actions[] = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_MSGERROR_SYSTEMERROR);
				$message_style = "errorMessage";
			}
			if($actions) {
				$message_review_options .= implode("<br />", $actions);
			}
		}
	}

	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------
	setting_get("review_listing_enabled", $review_listing_enabled);
	if ($review_listing_enabled) $review_listing_enabled_checked = "checked";
	
	setting_get("review_article_enabled", $review_article_enabled);
	if ($review_article_enabled) $review_article_enabled_checked = "checked";

	setting_get("review_approve", $review_approve);
	if ($review_approve) $review_approve_checked = "checked";

	setting_get("review_manditory", $review_manditory);
	if ($review_manditory) $review_manditory_checked = "checked";

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

			<form name="review_admin" action="<?=$_SERVER["PHP_SELF"]?>" method="post">
				<? include(INCLUDES_DIR."/forms/form_review_admin.php"); ?>
				<table style="margin: 0 auto 0 auto;">
					<tr>
						<td>
							<button type="submit" name="review_admin" value="Submit" class="ui-state-default ui-corner-all"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
						</td>
					</tr>
				</table>
			</form>

			<form name="review_options" action="<?=$_SERVER["PHP_SELF"]?>" method="post">
				<? include(INCLUDES_DIR."/forms/form_review_options.php"); ?>
				<table style="margin: 0 auto 0 auto;">
					<tr>
						<td>
							<button type="submit" name="review_options" value="Submit" class="ui-state-default ui-corner-all"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
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
