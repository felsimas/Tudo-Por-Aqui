<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /membros/claim/listinglevel.php
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
	$sqlClaim = "SELECT id FROM Claim WHERE account_id = '".$acctId."' AND listing_id = '".$claimlistingid."' AND status = 'progress' AND step = 'a' ORDER BY date_time DESC LIMIT 1";
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
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		$status = new ItemStatus();
		$listingObject->setDate("renewal_date", "00/00/0000");
		$listingObject->setString("status", $status->getDefaultStatus());
		$listingObject->setString("level", $_POST["level"]);
		$listingObject->setNumber("listingtemplate_id", $_POST["listingtemplate_id"]);
		$listingObject->save();
		$claimObject->setString("step", "b");
		$claimObject->save();
		header("Location: ".DEFAULT_URL."/membros/claim/listing.php?claimlistingid=".$claimlistingid);
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	$listing = $listingObject;
	$listing->extract();
	$levelObj = new ListingLevel();
	$levelArray[$levelObj->getLevel($levelObj->getDefaultLevel())] = $levelObj->getDefaultLevel();

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

		<h1 class="standardTitle"><?=system_showText(LANG_LISTING_FEATURE_NAME);?>: <span><?=$listingObject->getString("title");?></span></h1>

		<h1 class="standardTitle"><?=system_highlightLastWord(system_showText(LANG_LABEL_SELECT_PACKAGE))?></h1>

		<form name="listinglevel" action="<?=$_SERVER["PHP_SELF"]?>" method="post">

			<input type="hidden" name="claimlistingid" value="<?=$claimlistingid?>" />

			<? include(INCLUDES_DIR."/forms/form_listinglevel.php"); ?>

			<p class="standardButton claimButton">
				<button type="submit"><?=system_showText(LANG_BUTTON_NEXT)?></button>
			</p>

		</form>

	</div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");
?>
