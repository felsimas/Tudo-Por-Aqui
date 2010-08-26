<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/prefs/email.php
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
	$message_style = "errorMessage";

	if ($_SERVER['REQUEST_METHOD'] == "POST") {

		// Admin E-mail
		if ($adminemail) {

			if (validate_form("adminemail", $_POST, $message_adminemail)) {

				$error = false;

				$sitemgr_email = str_replace(" ", "", $sitemgr_email);
				if ($sitemgr_email) {
					if (!setting_set("sitemgr_email", $sitemgr_email)) {
						if (!setting_new("sitemgr_email", $sitemgr_email)) {
							$error = true;
						}
					}
				}

				if (!setting_set("sitemgr_send_email", $send_email)) {
					if (!setting_new("sitemgr_send_email", $send_email)) {
						$error = true;
					}
				}

				$sitemgr_listing_email = str_replace(" ", "", $sitemgr_listing_email);
				if (!setting_set("sitemgr_listing_email", $sitemgr_listing_email)) {
					if (!setting_new("sitemgr_listing_email", $sitemgr_listing_email)) {
						$error = true;
					}
				}

				$sitemgr_event_email = str_replace(" ", "", $sitemgr_event_email);
				if (!setting_set("sitemgr_event_email", $sitemgr_event_email)) {
					if (!setting_new("sitemgr_event_email", $sitemgr_event_email)) {
						$error = true;
					}
				}

				$sitemgr_banner_email = str_replace(" ", "", $sitemgr_banner_email);
				if (!setting_set("sitemgr_banner_email", $sitemgr_banner_email)) {
					if (!setting_new("sitemgr_banner_email", $sitemgr_banner_email)) {
						$error = true;
					}
				}

				$sitemgr_classified_email = str_replace(" ", "", $sitemgr_classified_email);
				if (!setting_set("sitemgr_classified_email", $sitemgr_classified_email)) {
					if (!setting_new("sitemgr_classified_email", $sitemgr_classified_email)) {
						$error = true;
					}
				}

				$sitemgr_article_email = str_replace(" ", "", $sitemgr_article_email);
				if (!setting_set("sitemgr_article_email", $sitemgr_article_email)) {
					if (!setting_new("sitemgr_article_email", $sitemgr_article_email)) {
						$error = true;
					}
				}

				$sitemgr_account_email = str_replace(" ", "", $sitemgr_account_email);
				if (!setting_set("sitemgr_account_email", $sitemgr_account_email)) {
					if (!setting_new("sitemgr_account_email", $sitemgr_account_email)) {
						$error = true;
					}
				}

				$sitemgr_contactus_email = str_replace(" ", "", $sitemgr_contactus_email);
				if (!setting_set("sitemgr_contactus_email", $sitemgr_contactus_email)) {
					if (!setting_new("sitemgr_contactus_email", $sitemgr_contactus_email)) {
						$error = true;
					}
				}

				$sitemgr_support_email = str_replace(" ", "", $sitemgr_support_email);
				if (!setting_set("sitemgr_support_email", $sitemgr_support_email)) {
					if (!setting_new("sitemgr_support_email", $sitemgr_support_email)) {
						$error = true;
					}
				}

				$sitemgr_payment_email = str_replace(" ", "", $sitemgr_payment_email);
				if (!setting_set("sitemgr_payment_email", $sitemgr_payment_email)) {
					if (!setting_new("sitemgr_payment_email", $sitemgr_payment_email)) {
						$error = true;
					}
				}

				$sitemgr_rate_email = str_replace(" ", "", $sitemgr_rate_email);
				if (!setting_set("sitemgr_rate_email", $sitemgr_rate_email)) {
					if (!setting_new("sitemgr_rate_email", $sitemgr_rate_email)) {
						$error = true;
					}
				}

				$sitemgr_claim_email = str_replace(" ", "", $sitemgr_claim_email);
				if (!setting_set("sitemgr_claim_email", $sitemgr_claim_email)) {
					if (!setting_new("sitemgr_claim_email", $sitemgr_claim_email)) {
						$error = true;
					}
				}

				if (!$error) {
					$actions[] = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_SETTINGS_YOURSETTINGSWERECHANGED);
					$message_style = "successMessage";
				} else {
					$actions[] = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_MSGERROR_SYSTEMERROR);
				}

				if($actions) {
					$message_adminemail .= implode("<br />", $actions);
				}

			}

		}

	}

	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------

	if (!$sitemgr_email) setting_get("sitemgr_email", $sitemgr_email);
	setting_get("sitemgr_send_email", $send_email); if ($send_email) $send_email_checked = "checked";
	if (!$sitemgr_listing_email) setting_get("sitemgr_listing_email", $sitemgr_listing_email);
	if (!$sitemgr_event_email) setting_get("sitemgr_event_email", $sitemgr_event_email);
	if (!$sitemgr_banner_email) setting_get("sitemgr_banner_email", $sitemgr_banner_email);
	if (!$sitemgr_classified_email) setting_get("sitemgr_classified_email", $sitemgr_classified_email);
	if (!$sitemgr_article_email) setting_get("sitemgr_article_email", $sitemgr_article_email);
	if (!$sitemgr_account_email) setting_get("sitemgr_account_email", $sitemgr_account_email);
	if (!$sitemgr_contactus_email) setting_get("sitemgr_contactus_email", $sitemgr_contactus_email);
	if (!$sitemgr_support_email) setting_get("sitemgr_support_email", $sitemgr_support_email);
	if (!$sitemgr_payment_email) setting_get("sitemgr_payment_email", $sitemgr_payment_email);
	if (!$sitemgr_rate_email) setting_get("sitemgr_rate_email", $sitemgr_rate_email);
	if (!$sitemgr_claim_email) setting_get("sitemgr_claim_email", $sitemgr_claim_email);

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

			<form name="adminemail" action="<?=$_SERVER["PHP_SELF"]?>" method="post">
				<? include(INCLUDES_DIR."/forms/form_adminemail.php"); ?>
				<table style="margin: 0 auto 0 auto;">
					<tr>
						<td>
							<button type="submit" name="adminemail" value="Submit" class="ui-state-default ui-corner-all"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
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
