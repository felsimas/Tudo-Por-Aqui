<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/prefs/invoice.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (PAYMENT_FEATURE != "on") { exit; }
	if (INVOICEPAYMENT_FEATURE != "on") { exit; }

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

	if ($_SERVER['REQUEST_METHOD'] == "POST") {

		if ($invoiceinfo) {

			if (!setting_set("invoice_company", $invoice_company))
				if (!setting_new("invoice_company", $invoice_company))
					$error = true;

			if (!setting_set("invoice_address", $invoice_address))
				if (!setting_new("invoice_address", $invoice_address))
					$error = true;

			if (!setting_set("invoice_city", $invoice_city))
				if (!setting_new("invoice_city", $invoice_city))
					$error = true;

			if (!setting_set("invoice_state", $invoice_state))
				if (!setting_new("invoice_state", $invoice_state))
					$error = true;

			if (!setting_set("invoice_country", $invoice_country))
				if (!setting_new("invoice_country", $invoice_country))
					$error = true;

			if (!setting_set("invoice_zipcode", $invoice_zipcode))
				if (!setting_new("invoice_zipcode", $invoice_zipcode))
					$error = true;

			if (!setting_set("invoice_phone", $invoice_phone))
				if (!setting_new("invoice_phone", $invoice_phone))
					$error = true;

			if (!setting_set("invoice_fax", $invoice_fax))
				if (!setting_new("invoice_fax", $invoice_fax))
					$error = true;

			if (!setting_set("invoice_email", $invoice_email))
				if (!setting_new("invoice_email", $invoice_email))
					$error = true;

			if (!setting_set("invoice_notes", $invoice_notes))
				if (!setting_new("invoice_notes", $invoice_notes))
					$error = true;

			if ($remove_image){
				$image = new Image($invoice_image);
				$image->Delete();
				$invoice_image = 0;
			}

			$upload_image = "";
			if (file_exists($_FILES['image']['tmp_name'])) {
				if (!image_upload_check ($_FILES['image']['tmp_name'])) {
					$upload_image = "failed";
					$upload_actions = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_ALERTUPLOADIMAGE);
					@unlink($_FILES['image']['tmp_name']);
				} else {
					$imageObj = image_upload($_FILES['image']['tmp_name'], IMAGE_INVOICE_LOGO_WIDTH, IMAGE_INVOICE_LOGO_HEIGHT);
					if (!$imageObj) {
						$upload_image = "failed";
						$upload_actions = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_ALERTUPLOADIMAGE2);
						$invoice_image = 0;
					} else {
						$upload_image = "success";
						$image = new Image($invoice_image);
						$image->Delete();
						$invoice_image = $imageObj->getNumber("id");
					}
				}
			}

			if (!setting_set("invoice_image", $invoice_image))
				if (!setting_new("invoice_image", $invoice_image))
					$error = true;

			$message_invoiceinfo = "";
			if (!$error) {
				if ($upload_image == "success") $message_invoiceinfo .= "<p class=\"successMessage\">&#149;&nbsp;".system_showText(LANG_SITEMGR_INVOICE_WASCHANGED)."<br />&#149;&nbsp;".system_showText(LANG_SITEMGR_INVOICE_LOGOWASUPLOADED)."</p>";
				elseif ($upload_image == "failed") $message_invoiceinfo .= "<p class=\"successMessage\">&#149;&nbsp;".system_showText(LANG_SITEMGR_INVOICE_WASCHANGED)."</p><p class=\"errorMessage\">".$upload_actions."</p>";
				else $message_invoiceinfo .= "<p class=\"successMessage\">&#149;&nbsp;".system_showText(LANG_SITEMGR_INVOICE_WASCHANGED)."</p>";
			} else {
				if ($upload_image == "success") $message_invoiceinfo .= "<p class=\"errorMessage\">&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_SYSTEMERROR)."</p><p class=\"successMessage\">&#149;&nbsp;".system_showText(LANG_SITEMGR_INVOICE_LOGOWASUPLOADED)."</p>";
				elseif ($upload_image == "failed") $message_invoiceinfo .= "<p class=\"errorMessage\">&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_SYSTEMERROR)."<br />".$upload_actions."</p>";
				else $message_invoiceinfo .= "<p class=\"errorMessage\">&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_SYSTEMERROR)."</p>";
			}

		}

	}

	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------
	setting_get("invoice_company", $invoice_company);
	setting_get("invoice_address", $invoice_address);
	setting_get("invoice_city", $invoice_city);
	setting_get("invoice_state", $invoice_state);
	setting_get("invoice_country", $invoice_country);
	setting_get("invoice_zipcode", $invoice_zipcode);
	setting_get("invoice_phone", $invoice_phone);
	setting_get("invoice_fax", $invoice_fax);
	setting_get("invoice_email", $invoice_email);
	setting_get("invoice_image", $invoice_image);
	setting_get("invoice_notes", $invoice_notes);

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

			<form name="invoiceinfo" action="<?=$_SERVER["PHP_SELF"]?>" method="post" enctype="multipart/form-data">
				<? include(INCLUDES_DIR."/forms/form_invoiceinfo.php"); ?>
				<table style="margin: 0 auto 0 auto;">
					<tr>
						<td>
							<button type="submit" name="invoiceinfo" value="Submit" class="ui-state-default ui-corner-all"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
						</td>
					</tr>
				</table>
			</form>

	<div id="bottom-content">
		<iframe src="view_invoice.php" style="width: 680px; height: 500px;" scrolling="No" frameborder="text/html"></iframe>
	</div>
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
