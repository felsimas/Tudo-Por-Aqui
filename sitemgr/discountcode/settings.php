<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/discountcode/settings.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (PAYMENT_FEATURE != "on") { exit; }
	if ((CREDITCARDPAYMENT_FEATURE != "on") && (INVOICEPAYMENT_FEATURE != "on")) { exit; }

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);

	if ($_SERVER['REQUEST_METHOD'] == "GET") {
		if ($_GET["x_id"]) {
			$discountCodeObj = new DiscountCode($_GET["x_id"]);
			$discountCodeObj->setString("x_id", $_GET["x_id"]); // Existent discount id, this variable must be forced into the object because it is extracted to compose the form.
			$discountCodeObj->extract();
		} else {
			$message = system_showText(LANG_SITEMGR_MSGERROR_INVALID_ACCESS);
			header("Location: ".DEFAULT_URL."/gerenciamento/discountcode/index.php?screen=$screen&letra=$letra&message=".urlencode($message));
			exit;
		}
	}

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		if (validate_form("discountcodesettings", $_POST, $message_discountcodesettings)) {
			$discountCodeObj = new DiscountCode($_POST["x_id"]);
			$discountCodeObj->setString("x_id", $_POST['x_id']); // Existent discount id, this variable must be forced into the object so it can make an update operation.
			$discountCodeObj->setString("status", $_POST['status']);
			$discountCodeObj->setDate("expire_date", $_POST['expire_date']);
			$discountCodeObj->Save();
			$message = ucwords(LANG_LABEL_DISCOUNTCODE)." &quot;".$_POST["x_id"]."&quot; ".system_showText(LANG_SITEMGR_SETTINGSSUCCESSUPDATED)."";
			header("Location: ".DEFAULT_URL."/gerenciamento/discountcode/index.php?screen=$screen&letra=$letra&message=".urlencode($message));
			exit;
		} else { // validation failure the object is instanciated to be extracted
			$discountCodeObj = new DiscountCode($_POST["x_id"]);
			$discountCodeObj->setString("x_id", $_POST['x_id']); // Existent discount id, this variable must be forced into the object so it can make an update operation.
			$discountCodeObj->extract();
		}
	}

	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------
	// Discount Code Status Drop Down
	$discountCodeStatusObj = new DiscountCodeStatus();
	unset($arrayValue);
	unset($arrayName);
	$arrayValue = $discountCodeStatusObj->getValues();
	$arrayName = $discountCodeStatusObj->getNames();
	unset($arrayValueDD);
	unset($arrayNameDD);
	for ($i=0; $i<count($arrayValue); $i++) {
		if ($arrayValue[$i] != "E") {
			$arrayValueDD[] = $arrayValue[$i];
			$arrayNameDD[] = $arrayName[$i];
		}
	}
	$discountCodeStatusDropDown = html_selectBox("status", $arrayNameDD, $arrayValueDD, $status, "", "class='input-dd-form-settings'", "-- ".system_showText(LANG_SITEMGR_SELECTASTATUS)." --");

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

		<? include(INCLUDES_DIR."/tables/table_discount_submenu.php"); ?>
		<br />
		
		<div class="baseForm">
		<form name="discount_setting" action="<?=$_SERVER["PHP_SELF"]?>" method="post">
			<input type="hidden" name="x_id" value="<?=$id?>" />
			<? include(INCLUDES_DIR."/forms/form_discountcodesettings.php"); ?>
			<input type="hidden" name="letra" value="<?=$letra?>" />
				<input type="hidden" name="screen" value="<?=$screen?>" />
				<button type="submit" value="Submit" class="ui-state-default ui-corner-all"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
				<button type="button" name="back" value="Back" class="ui-state-default ui-corner-all" onclick="document.getElementById('formdiscountcodesettingscancel').submit();"><?=system_showText(LANG_SITEMGR_BACK)?></button>
		</form>
		<form id="formdiscountcodesettingscancel" action="<?=DEFAULT_URL?>/gerenciamento/discountcode/index.php" method="post">
			<input type="hidden" name="letra" value="<?=$letra?>" />
			<input type="hidden" name="screen" value="<?=$screen?>" />
		</form>
		</div>
		
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