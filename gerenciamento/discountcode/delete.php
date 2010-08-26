<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/discountcode/delete.php
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

	extract($_GET);
	extract($_POST);

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == "POST") {

		if($_POST["x_id"]){
			$discountCodeObj = new DiscountCode($_POST["x_id"]);
			$discountCodeObj->Delete();
			$message = ucwords(LANG_LABEL_DISCOUNTCODE)." &quot;".$_POST["x_id"]."&quot; ".system_showText(LANG_SITEMGR_WASSUCCESSDELETED);
		}

		header("Location: ".DEFAULT_URL."/gerenciamento/discountcode/index.php?screen=$screen&letra=$letra&message=".urlencode($message));
		exit;

	} elseif ($_SERVER["REQUEST_METHOD"] == "GET"){

		if ($_GET["x_id"]) {
			$discountCodeObj = new DiscountCode($_GET["x_id"]);
		} else {
			$message = system_showText(LANG_SITEMGR_MSGERROR_INVALID_REQUEST);
			header("Location: ".DEFAULT_URL."/gerenciamento/discountcode/index.php?screen=$screen&letra=$letra&message=".urlencode($message));
			exit;
		}

	}

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
		
		<div class="baseForm">

		<form name="discountcode_delete" method="post">
			<input type="hidden" name="x_id" value="<?=$x_id?>" />
			<div id="header-form">
				<?=system_showText(LANG_SITEMGR_DELETE)?> <?=ucwords(LANG_LABEL_DISCOUNTCODE)?> "<?=$discountCodeObj->getString("id")?>"
			</div>
			<div class="response-msg inf ui-corner-all">
				<?=system_showText(LANG_SITEMGR_PROMOTIONALCODE_DELETEQUESTION)?>
			</div>
			<input type="hidden" name="letra" value="<?=$letra?>" />
			<input type="hidden" name="screen" value="<?=$screen?>" />
			<button type="submit" value="Submit" class="ui-state-default ui-corner-all"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
			<button type="button" value="Cancel" class="ui-state-default ui-corner-all" onclick="document.getElementById('formdiscountcodedeletecancel').submit();"><?=system_showText(LANG_SITEMGR_CANCEL)?></button>
		</form>
		<form id="formdiscountcodedeletecancel" action="<?=DEFAULT_URL?>/gerenciamento/discountcode/index.php" method="post">
			<input type="hidden" name="letra" value="<?=$letra?>" />
			<input type="hidden" name="screen" value="<?=$screen?>" />
		</form>
		
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
