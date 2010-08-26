<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /membros/signup/payment.php
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
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_GET);
	extract($_POST);

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSession();
	$acctId = sess_getAccountIdFromSession();
	header ("Location: http://192.168.1.21/tudoporaqui/public/membros/account/account.php?id=".$acctId);
	$url_redirect = "".DEFAULT_URL."/membros/signup";
	$url_base = "".DEFAULT_URL."/membros";
	$membros = 1;

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	$itemCount = 0;

	$listingsToPay = db_getFromDB("listing", "account_id", $acctId, "", "title", "array");
	foreach ($listingsToPay as $listingToPay) {
		$listing_id[] = $listingToPay["id"];
		$itemCount++;
	}

	if (EVENT_FEATURE == "on") {
		$eventsToPay = db_getFromDB("event", "account_id", $acctId, "", "title", "array");
		foreach ($eventsToPay as $eventToPay) {
			$event_id[] = $eventToPay["id"];
			$itemCount++;
		}
	}

	if (BANNER_FEATURE == "on") {
		$bannersToPay = db_getFromDB("banner", "account_id", $acctId, "", "caption", "array");
		foreach ($bannersToPay as $bannerToPay) {
			$banner_id[] = $bannerToPay["id"];
			$itemCount++;
		}
	}

	if (CLASSIFIED_FEATURE == "on") {
		$classifiedsToPay = db_getFromDB("classified", "account_id", $acctId, "", "title", "array");
		foreach ($classifiedsToPay as $classifiedToPay) {
			$classified_id[] = $classifiedToPay["id"];
			$itemCount++;
		}
	}

	if (ARTICLE_FEATURE == "on") {
		$articlesToPay = db_getFromDB("article", "account_id", $acctId, "", "title", "array");
		foreach ($articlesToPay as $articleToPay) {
			$article_id[] = $articleToPay["id"];
			$itemCount++;
		}
	}

	$second_step = 1;
	if ($itemCount == 1) include(INCLUDES_DIR."/code/billing.php");

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/header.php");
?>

	<div class="extendedContent">

		<? require(EDIRECTORY_ROOT."/gerenciamento/registration.php"); ?>
		<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
		<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

		<ul class="standardStep">
			<li class="standardStepAD"><?=system_showText(LANG_LABEL_EASY_AND_FAST);?> <span>3 <?=system_showText(LANG_LABEL_STEPS);?> &raquo;</span></li>
			<li><span>1</span>&nbsp;<?=system_showText(LANG_LABEL_ORDER)?></li>
			<li class="stepActived"><span>2</span>&nbsp;<?=system_showText(LANG_LABEL_CHECKOUT)?></li>
			<li><span>3</span>&nbsp;<?=system_showText(LANG_LABEL_CONFIGURATION)?></li>
		</ul>

	</div>

	<div class="extendedContent">

		<h1 class="standardTitle"><?=system_highlightLastWord(system_showText(LANG_MENU_MAKEPAYMENT));?></span></h1>

		<? if ($paymentSystemError) { ?>

			<p class="errorMessage">
				<?=$payment_message?><br />
				<a href="<?=DEFAULT_URL?>/membros/billing/index.php"><?=system_showText(LANG_MSG_GO_TO_MEMBERS_CHECKOUT);?></a>.
			</p>

		<? } elseif ($payment_message) { ?>

			<p class="errorMessage">
				<?=system_showText(LANG_MSG_PROBLEMS_WERE_FOUND)?>:<br />
				<?=$payment_message?><br />
				<a href="<?=DEFAULT_URL?>/membros/billing/index.php"><?=system_showText(LANG_MSG_GO_TO_MEMBERS_CHECKOUT);?></a>.
			</p>

		<? } elseif ((!$bill_info["listings"]) && (!$bill_info["events"]) && (!$bill_info["banners"]) && (!$bill_info["classifieds"]) && (!$bill_info["articles"])) { ?>

			<?
			if ($itemCount > 1) echo "<div class=\"response-msg notice ui-corner-all\">Already registered users should use <a href=\"".DEFAULT_URL."/membros/billing/index.php\">membros check out area</a>.</div>";
			else echo "<div class=\"response-msg notice ui-corner-all\">".system_showText(LANG_MSG_NO_ITEMS_SELECTED_REQUIRING_PAYMENT)."</div>";
			?>

		<? } else { ?>

			<table class="standard-tableTOPBLUE">

				<tr>

					<th>
						<?
						if ($bill_info["listings"]) {
							foreach ($bill_info["listings"] as $id => $info);
							echo system_showText(LANG_LISTING_FEATURE_NAME);
						} elseif ($bill_info["events"]) {
							foreach ($bill_info["events"] as $id => $info);
							echo system_showText(LANG_EVENT_FEATURE_NAME);
						} elseif ($bill_info["banners"]) {
							foreach ($bill_info["banners"] as $id => $info);
							echo system_showText(LANG_BANNER_FEATURE_NAME);
						} elseif ($bill_info["classifieds"]) {
							foreach ($bill_info["classifieds"] as $id => $info);
							echo system_showText(LANG_CLASSIFIED_FEATURE_NAME);
						} elseif ($bill_info["articles"]) {
							foreach ($bill_info["articles"] as $id => $info);
							echo system_showText(LANG_ARTICLE_FEATURE_NAME);
						}
						?>
					</th>

					<th><?=system_showText(LANG_LABEL_LEVEL);?></th>

					<? if ($bill_info["listings"]) { ?>
						<th><?=system_showText(LANG_LABEL_EXTRA_CATEGORY);?></th>
					<? } ?>

					<?
					if (PAYMENT_FEATURE == "on") {
						if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) {
							?><th><?=system_showText(LANG_LABEL_DISCOUNT_CODE)?></th><?
						}
					}
					?>

					<? if ($bill_info["banners"]) { ?>
						<th><?=system_showText(LANG_LABEL_EXPIRATION);?></th>
					<? } ?>

					<th><?=system_showText(LANG_LABEL_TOTAL);?></th>

				</tr>

				<tr>

					<td>
						<strong>
							<?
							if ($bill_info["banners"]) {
								echo $info["caption"];
							} else {
								echo $info["title"];
							}
							?>
							<?=($info["listingtemplate"]?"<span class=\"itemNote\">(".$info["listingtemplate"].")</span>":"");?>
						</strong>
					</td>

					<td><?=ucwords($info["level"])?></td>

					<? if ($bill_info["listings"]) { ?>
						<td><?=$info["extra_category_amount"];?></td>
					<? } ?>

					<?
					if (PAYMENT_FEATURE == "on") {
						if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) {
							?><td><?=($info["discount_id"]) ? $info["discount_id"] : system_showText(LANG_NA);?></td><?
						}
					}
					?>

					<? if ($bill_info["banners"]) { ?>
						<td>
							<?
							if ($info["expiration_setting"] == BANNER_EXPIRATION_RENEWAL_DATE) echo "By time period";
							elseif ($info["expiration_setting"] == BANNER_EXPIRATION_IMPRESSION) echo "By impressions";
							?>
						</td>
					<? } ?>

					<td><?=CURRENCY_SYMBOL." ".$bill_info["total_bill"]?></td>

				</tr>

			</table>

			<?
			$payment_process = "signup";
			if (file_exists(INCLUDES_DIR."/forms/form_billing_".$payment_method.".php")) {
				include(INCLUDES_DIR."/forms/form_billing_".$payment_method.".php");
			}
			?>

		<? } ?>

	</div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");
?>
