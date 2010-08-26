<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /membros/claim/listing.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_GET);
	extract($_POST);

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSession();
	$acctId = sess_getAccountIdFromSession();
	$url_redirect = "".DEFAULT_URL."/membros/claim";
	$url_base = "".DEFAULT_URL."/membros";
	$membros = 1;

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (CLAIM_FEATURE != "on") { exit; }
	if (!$claimlistingid) {
		header("Location: ".DEFAULT_URL."/membros/");
		exit;
	}
	$listingObject = new Listing($claimlistingid);
	if (!$listingObject->getNumber("id") || ($listingObject->getNumber("id") <= 0)) {
		header("Location: ".DEFAULT_URL."/membros/");
		exit;
	}
	if ($listingObject->getNumber("account_id") != $acctId) {
		header("Location: ".DEFAULT_URL."/membros/");
		exit;
	}

	$dbObjClaim = db_getDBObject();
	$sqlClaim = "SELECT id FROM Claim WHERE account_id = '".$acctId."' AND listing_id = '".$claimlistingid."' AND status = 'progress' AND step = 'b' ORDER BY date_time DESC LIMIT 1";
	$resultClaim = $dbObjClaim->query($sqlClaim);
	if ($rowClaim = mysql_fetch_assoc($resultClaim)) $claimID = $rowClaim["id"];
	if (!$claimID) {
		header("Location: ".DEFAULT_URL."/membros/");
		exit;
	}
	$claimObject = new Claim($claimID);
	if (!$claimObject->getNumber("id") || ($claimObject->getNumber("id") <= 0)) {
		header("Location: ".DEFAULT_URL."/membros/");
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	$_POST["id"] = $claimlistingid;
	include(EDIRECTORY_ROOT."/includes/code/listing.php");

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/header.php");

?>

	<div class="extendedContent">

		<? require(EDIRECTORY_ROOT."/gerenciamento/registration.php"); ?>
		<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
		<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

		<h1 class="standardTitle"><?=system_highlightLastWord(system_showText(LANG_MSG_CLAIM_THIS_LISTING))?></h1>

		<ul class="standardStep">
			<li class="standardStepAD"><?=system_showText(LANG_LABEL_EASY_AND_FAST);?> <span>3 <?=system_showText(LANG_LABEL_STEPS);?> &raquo;</span></li>
			<li><span>1</span>&nbsp;<?=system_showText(LANG_LABEL_ACCOUNT_SIGNUP);?></li>
			<li class="stepActived"><span>2</span>&nbsp;<?=system_showText(LANG_LISTING_UPDATE);?></li>
			<li><span>3</span>&nbsp;<?=system_showText(LANG_LABEL_CHECKOUT)?></li>
		</ul>

	</div>

	<div class="extendedContent">

		<h1 class="standardTitle"><?=system_highlightLastWord(system_showText(LANG_LISTING_INFORMATION))?></h1>

		<form name="listing" action="<?=$_SERVER["PHP_SELF"]?>" method="post" enctype="multipart/form-data">

			<input type="hidden" name="ieBugFix" value="1" />

			<input type="hidden" name="process" id="process" value="claim" />
			<input type="hidden" name="id" id="id" value="<?=$id?>" />
			<input type="hidden" name="claimlistingid" id="claimlistingid" value="<?=$claimlistingid?>" />
			<input type="hidden" name="claim_id" id="claim_id" value="<?=$claimID?>" />
			<input type="hidden" name="listingtemplate_id" id="listingtemplate_id" value="<?=$listingtemplate_id?>" />
			<input type="hidden" name="account_id" id="account_id" value="<?=$acctId?>" />
			<input type="hidden" name="level" id="level" value="<?=$level?>" />

			<? include(INCLUDES_DIR."/forms/form_listing.php"); ?>

			<input type="hidden" name="ieBugFix2" value="1" />

			<p class="standardButton claimButton">
				<button type="button" onclick="JS_submit()"><?=system_showText(LANG_BUTTON_NEXT)?></button>
			</p>

		</form>

	</div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");
?>
