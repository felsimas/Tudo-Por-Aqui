<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /membros/claim/billing.php
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
	if (PAYMENT_FEATURE != "on") { exit; }
	if ((CREDITCARDPAYMENT_FEATURE != "on") && (INVOICEPAYMENT_FEATURE != "on")) { exit; }
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
	$sqlClaim = "SELECT id FROM Claim WHERE account_id = '".$acctId."' AND listing_id = '".$claimlistingid."' AND status = 'progress' AND step = 'c' ORDER BY date_time DESC LIMIT 1";
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

		$claimObject->setString("step", "d");
		$claimObject->save();

		if ($payment_method == "invoice") {
			header("Location: ".$url_redirect."/invoice.php?claimlistingid=".$claimlistingid);
		} else {
			header("Location: ".$url_redirect."/payment.php?payment_method=".$payment_method."&claimlistingid=".$claimlistingid);
		}
		exit;

	}

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	$listing_id[] = $listingObject->getNumber("id");
	$second_step = 1;
	$payment_method = "claim";
	include(INCLUDES_DIR."/code/billing.php");
	if ($bill_info["listings"]) foreach ($bill_info["listings"] as $id => $info);

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
			<li><span>2</span>&nbsp;<?=system_showText(LANG_LISTING_UPDATE);?></li>
			<li class="stepActived"><span>3</span>&nbsp;<?=system_showText(LANG_LABEL_CHECKOUT)?></li>
		</ul>

	</div>

	<div class="extendedContent">

		<?
		if (!$bill_info["listings"]){
			echo "<div class=\"response-msg notice ui-corner-all\">".system_showText(LANG_MSG_NO_ITEMS_REQUIRING_PAYMENT)."</div>";
		} else {
			?>

			<form name="claimbilling" action="<?=$_SERVER["PHP_SELF"]?>" method="post">

				<input type="hidden" name="claimlistingid" value="<?=$claimlistingid?>" />

				<table class="standard-tableTOPBLUE">
					<tr>
						<th><?=system_showText(LANG_LISTING_FEATURE_NAME);?></th>
						<th><?=system_showText(LANG_LABEL_LEVEL);?></th>
						<th><?=system_showText(LANG_LABEL_EXTRA_CATEGORY);?></th>
						<?
						if (PAYMENT_FEATURE == "on") {
							if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) {
								?><th><?=system_showText(LANG_LABEL_DISCOUNT_CODE)?></th><?
							}
						}
						?>
						<th><?=system_showText(LANG_LABEL_RENEWAL);?></th>
						<th><?=system_showText(LANG_LABEL_TOTAL);?></th>
					</tr>
					<tr>
						<td><strong><?=$info["title"];?><?=($info["listingtemplate"]?"<span class=\"itemNote\">(".$info["listingtemplate"].")</span>":"");?></strong></td>
						<td><?=ucwords($info["level"]);?></td>
						<td><?=$info["extra_category_amount"];?></td>
						<?
						if (PAYMENT_FEATURE == "on") {
							if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) {
								?><td><?=(($info["discount_id"]) ? ($info["discount_id"]) : (system_showText(LANG_NA)));?></td><?
							}
						}
						?>
						<td><?=format_date($info["renewal_date"]);?></td>
						<td><?=CURRENCY_SYMBOL." ".$bill_info["total_bill"];?></td>
					</tr>
				</table>

				<br />

				<? if (PAYMENT_FEATURE == "on") { ?>
					<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
						<div id="check_out_payment">
							<? include(INCLUDES_DIR."/forms/form_paymentmethod.php"); ?>
							<br />
							<p class="standardButton claimButton">
								<button type="submit" name="submit" value="<?=system_showText(LANG_BUTTON_NEXT);?>"><?=system_showText(LANG_BUTTON_NEXT);?></button>
							</p>
						</div>
					<? } ?>
				<? } ?>

			</form>

			<?
		}
		?>

	</div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");
?>