<?


	# ----------------------------------------------------------------------------------------------------
	# * FILE: /membros/signup/invoice.php
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
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_GET);
	extract($_POST);

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSession();
	$acctId = sess_getAccountIdFromSession();
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
	$payment_method = "invoice";
	if ($itemCount == 1) include(INCLUDES_DIR."/code/billing.php");

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/header.php");
//include(EDIRECTORY_ROOT."/layout/header_members.php");
?>
<div id="consulta">
<h5></h5></div>
	<div style="width:900px; margin-left:20px">
	<div class="extendedContent" >

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

		<h1 class="standardTitle"><?=system_highlightLastWord(system_showText(LANG_LABEL_PAY_BY_INVOICE))?></h1>

		<? if ($paymentSystemError) { ?>

			<p class="errorMessage">
				<?=$payment_message?><br />
				<a href="<?=DEFAULT_URL?>/membros/billing/index.php\"><?=system_showText(LANG_MSG_GO_TO_MEMBERS_CHECKOUT);?></a>.
			</p>

		<? } elseif ($payment_message) { ?>

			<p class="errorMessage">
				<?=system_showText(LANG_MSG_PROBLEMS_WERE_FOUND)?>:<br />
				<?=$payment_message?><br />
				<a href="<?=DEFAULT_URL?>/membros/billing/index.php\"><?=system_showText(LANG_MSG_GO_TO_MEMBERS_CHECKOUT);?></a>.
			</p>

		<? } elseif ((!$bill_info["listings"]) && (!$bill_info["events"]) && (!$bill_info["banners"]) && (!$bill_info["classifieds"]) && (!$bill_info["articles"])) { ?>

			<?
			if ($itemCount > 1) echo "<div class=\"response-msg notice ui-corner-all\">Already registered users should use <a href=\"".DEFAULT_URL."/membros/billing/index.php\">membros check out area</a>.</div>";
			else echo "<div class=\"response-msg notice ui-corner-all\">".system_showText(LANG_MSG_NO_ITEMS_SELECTED_REQUIRING_PAYMENT)."</div>";
			?>

		<? } else { ?>

			<?
			/**************************************************************************************************/
			/*                                                                                                */
			/* E-mail notify                                                                                  */
			/*                                                                                                */
			/**************************************************************************************************/
			setting_get("sitemgr_email",$sitemgr_email);
			$contact = new Contact($acctId);
			$body = "Dear ".$contact->getString("first_name")." ".$contact->getString("last_name").",\n".system_showText(LANG_MSG_YOU_CAN_SEE_INVOICE)." ".DEFAULT_URL."/membros/billing/invoice.php?id=".$bill_info["invoice_number"];
			system_mail($contact->getString("email"), "[".EDIRECTORY_TITLE."] Invoice Notification", $body, EDIRECTORY_TITLE." <$sitemgr_email>", 'text/plain', '', '', $error);
			////////////////////////////////////////////////////////////////////////////////////////////////////
			?>

			<?
			$invoiceObj = new Invoice($bill_info["invoice_number"]);
			$invoiceObj->setString("status", "P");
			$invoiceObj->Save();
			?>

			<?
				if ($bill_info["listings"]) foreach ($bill_info["listings"] as $id => $info);
				if ($bill_info["events"]) foreach ($bill_info["events"] as $id => $info);
				if ($bill_info["banners"]) foreach ($bill_info["banners"] as $id => $info);
				if ($bill_info["classifieds"]) foreach ($bill_info["classifieds"] as $id => $info);
				if ($bill_info["articles"]) foreach ($bill_info["articles"] as $id => $info);
			?>

			<table class="standard-tableTOPBLUE">
				<tr>

					<th style="text-align:center"><?=system_showText(LANG_LABEL_INVOICENUMBER);?></th>

					<th>
						<?
						if ($bill_info["listings"]) {
							echo system_showText(LANG_LISTING_FEATURE_NAME);
						} elseif ($bill_info["events"]) {
							echo system_showText(LANG_EVENT_FEATURE_NAME);
						} elseif ($bill_info["banners"]) {
							echo system_showText(LANG_BANNER_FEATURE_NAME);
						} elseif ($bill_info["classifieds"]) {
							echo system_showText(LANG_CLASSIFIED_FEATURE_NAME);
						} elseif ($bill_info["articles"]) {
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

					<td width="65" style="text-align:center; font-weight:bold;"><?=$bill_info["invoice_number"]?></td>

					<td style="font-weight:bold">
						<?
						if ($bill_info["banners"]) {
							echo $info["caption"];
						} else {
							echo $info["title"];
						}
						?>
						<?=($info["listingtemplate"]?"<span class=\"itemNote\">(".$info["listingtemplate"].")</span>":"");?>
					</td>

					<td><?=ucwords($info["level"])?></td>

					<? if ($bill_info["listings"]) { ?>
						<td style="text-align:center;"><?=$info["extra_category_amount"];?></td>
					<? } ?>

					<?
					if (PAYMENT_FEATURE == "on") {
						if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) {
							?><td style="text-align:center;"><?=($info["discount_id"]) ? $info["discount_id"] : system_showText(LANG_NA);?></td><?
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

			<table border="0" cellpadding="0" cellspacing="0" class="standard-table">
				<tr>
					<th class="standard-tabletitle" colspan="2"><?=system_showText(LANG_LABEL_MAKE_CHECKS_PAYABLE)?></th>
				</tr>
				<tr>
					<th><?=system_showText(LANG_LABEL_MAKE_CHECKS_PAYABLE)?>:</th>
					<td><strong><?=EDIRECTORY_TITLE?></strong></td>
				</tr>
				<tr>
					<th>&nbsp;</th>
					<td>
						<ul class="basePrintNavbar">
							<li>
								<a href="javascript:void(0);" onclick="window.open('<?=DEFAULT_URL?>/membros/billing/invoice.php?id=<?=$bill_info["invoice_number"]?>', 'popup', 'toolbar=0, width=680, height=420, scrollbars=yes, screenX=0, screenY=0');"><?=system_showText(LANG_MSG_CLICK_TO_PRINT_INVOICE)?></a>
							</li>
						</ul>
					</td>
				</tr>
				<tr>
					<th><input type="checkbox" name="terms" id="terms" value="1" /></th>
					<td><a href="javascript: void(0);" onclick='javascript:window.open("<?=DEFAULT_URL?>/terms.php", "popup", "toolbar=0, location=0, directories=0, status=0, width=650, height=500, screenX=0, screenY=0, menubar=0, no-resizable, scrollbars=yes")'><?=system_showText(LANG_MSG_AGREE_TO_TERMS);?></a> <?=system_showText(LANG_MSG_I_WILL_SEND_PAYMENT);?></td>
				</tr>
			</table>

			<p class="standardButton paymentButton">
				<a href="javascript:next();"><?=system_highlightLastWord(system_showText(LANG_LABEL_PLACE_ORDER_CONTINUE))?></a>
			</p>

			<?
			if ($bill_info["listings"]) {
				$thisListingID = array_keys($bill_info["listings"]);
				$next = DEFAULT_URL."/membros/listing/listing.php?id=".$thisListingID[0]."&process=signup";
			} elseif ($bill_info["events"]) {
				$thisEventID = array_keys($bill_info["events"]);
				$next = DEFAULT_URL."/membros/event/event.php?id=".$thisEventID[0]."&process=signup";
			} elseif ($bill_info["banners"]) {
				$thisBannerID = array_keys($bill_info["banners"]);
				$next = DEFAULT_URL."/membros/banner/edit.php?id=".$thisBannerID[0]."&process=signup";
			} elseif ($bill_info["classifieds"]) {
				$thisClassifiedID = array_keys($bill_info["classifieds"]);
				$next = DEFAULT_URL."/membros/classified/classified.php?id=".$thisClassifiedID[0]."&process=signup";
			} elseif ($bill_info["articles"]) {
				$thisArticleID = array_keys($bill_info["articles"]);
				$next = DEFAULT_URL."/membros/article/article.php?id=".$thisArticleID[0]."&process=signup";
			}
			?>

			<script language="javascript" type="text/javascript">
				<!--

				function next() {
					if (document.getElementById("terms").checked) document.location="<?=$next?>";
					else alert("Please check the agreement terms!");
				}

				//-->
			</script>

		<? } ?>

	</div>
	</div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	//include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");
?>
