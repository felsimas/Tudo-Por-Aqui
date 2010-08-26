<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/views/view_transaction_detail.php
	# ----------------------------------------------------------------------------------------------------

?>

<br />

<h2 class="headerStandardTitle standardSubTitle"><?=system_showText(LANG_TRANSACTION_INFO)?></h2>

<ul class="general-item">
	<? if (strpos($url_base, "/gerenciamento")) { ?>
		<li>
			<strong><?=system_showText(LANG_LABEL_ACCOUNT)?>:</strong>
			<? if ($transaction["account_id"]) echo "<a href=\"".DEFAULT_URL."/gerenciamento/account/view.php?id=".$transaction["account_id"]."\">"; ?>
				<?=system_showAccountUserName($transaction["username"])?>
			<? if ($transaction["account_id"]) echo "</a>"; ?>
		</li>
	<? } ?>
	<li>
		<strong><?=system_showText(LANG_LABEL_PAYMENT_TYPE)?>:</strong>
		<?
		if (($transaction["system_type"] != "paypal") && ($transaction["system_type"] != "manual")) {
			echo system_showText(LANG_CREDITCARD);
		} else {
			echo $transaction["system_type"];
		}
		if ($transaction["recurring"] == "y") {
			echo "&nbsp;<em>".system_showText(LANG_MSG_PRICES_AMOUNT_PER_INSTALLMENTS)."</em>";
		}
		?>
	</li>
	<li><strong><?=system_showText(LANG_LABEL_ID)?>:</strong> <?=$transaction["transaction_id"]?></li>
	<li><strong><?=system_showText(LANG_LABEL_STATUS)?>:</strong> <?=$transaction["transaction_status"]?></li>
	<li><strong><?=system_showText(LANG_LABEL_DATE)?>:</strong> <?=$transaction["transaction_datetime"]?></li>
	<li><strong><?=system_showText(LANG_LABEL_IP)?>:</strong> <?=$transaction["ip"]?></li>
	<li><strong><?=system_showText(LANG_LABEL_AMOUNT)?>:</strong> <?=$transaction["transaction_amount"]?> (<?=$transaction["transaction_currency"]?>)</li>
	<li><strong><?=system_showText(LANG_LABEL_NOTES)?>:</strong> <?=$transaction["notes"]?></li>
</ul>

<? if ($transaction_listing_log) { ?>

	<h2 class="headerStandardTitle standardSubTitle"><?=system_showText(LANG_LISTING_FEATURE_NAME_PLURAL);?></h2>
<div class="hastable">
	<table border="0" cellpadding="2" cellspacing="2">
	<thead>
		<tr>
			<th><?=system_showText(LANG_LABEL_TITLE);?></th>
			<th style="width:100px;"><?=system_showText(LANG_LABEL_EXTRA_CATEGORY);?></th>
			<th style="width:100px;"><?=system_showText(LANG_LABEL_LEVEL);?></th>
			<? if (PAYMENT_FEATURE == "on") { ?>
				<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
					<th style="width:120px;"><?=system_showText(LANG_LABEL_DISCOUNT_CODE)?></th>
				<? } ?>
			<? } ?>
			<th style="width:70px;"><?=system_showText(LANG_LABEL_RENEWAL);?></th>
			<th style="width:100px;"><?=system_showText(LANG_LABEL_AMOUNT);?></th>
		</tr>
	</thead>	
		<? foreach ($transaction_listing_log as $each_listing) { ?>
			<tr>
				<td>
					<?
					$transactionListingObj = new Listing($each_listing["listing_id"]);
					if ($transactionListingObj->getNumber("id") > 0) {
						?><a href="<?=$url_base?>/listing/view.php?id=<?=$each_listing["listing_id"]?>" class="link-table"><?=$each_listing["listing_title"]?></a><?
					} else {
						?><?=$each_listing["listing_title"]?><?
					}
					?>
					<?=($each_listing["listingtemplate"]?"<span class=\"itemNote\">(".$each_listing["listingtemplate"].")</span>":"");?>
				</td>
				<td style="text-align:center"><?=$each_listing["extra_categories"]?></td>
				<td><?=ucwords($listingLevelObj->getLevel($each_listing["level"]));?></td>
				<? if (PAYMENT_FEATURE == "on") { ?>
					<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
						<td style="text-align:center"><?=$each_listing["discount_id"]?></td>
					<? } ?>
				<? } ?>
				<td style="text-align:center"><?=($each_listing["renewal_date"] == "0000-00-00") ? system_showText(LANG_NA) : format_date($each_listing["renewal_date"],DEFAULT_DATE_FORMAT,"date")?></td>
				<td style="text-align:center">
					<?=$each_listing["amount"]." (".$transaction["transaction_currency"].")";?>
				</td>
			</tr>
		<? } ?>
	</table>
	</div>
	<br />
<? } ?>

<? if ($transaction_event_log) { ?>

	<h2 class="headerStandardTitle standardSubTitle"><?=system_showText(LANG_EVENT_FEATURE_NAME_PLURAL);?></h2>

	<table border="0" cellpadding="2" cellspacing="2">
	<thead>
		<tr>
			<th><?=system_showText(LANG_LABEL_TITLE);?></th>
			<th style="width:100px;"><?=system_showText(LANG_LABEL_LEVEL);?></th>
			<? if (PAYMENT_FEATURE == "on") { ?>
				<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
					<th style="width:120px;"><?=system_showText(LANG_LABEL_DISCOUNT_CODE)?></th>
				<? } ?>
			<? } ?>
			<th style="width:70px;"><?=system_showText(LANG_LABEL_RENEWAL);?></th>
			<th style="width:100px;"><?=system_showText(LANG_LABEL_AMOUNT);?></th>
		</tr>
		</thead>
		<? foreach ($transaction_event_log as $each_event) { ?>
			<tr>
				<td>
					<?
					$transactionEventObj = new Event($each_event["event_id"]);
					if ($transactionEventObj->getNumber("id") > 0) {
						?><a href="<?=$url_base?>/event/view.php?id=<?=$each_event["event_id"]?>" class="link-table"><?=$each_event["event_title"]?></a><?
					} else {
						?><?=$each_event["event_title"]?><?
					}
					?>
				</td>
				<td><?=ucwords($eventLevelObj->getLevel($each_event["level"]));?></td>
				<? if (PAYMENT_FEATURE == "on") { ?>
					<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
						<td style="text-align:center"><?=$each_event["discount_id"]?></td>
					<? } ?>
				<? } ?>
				<td style="text-align:center"><?=($each_event["renewal_date"] == "0000-00-00") ? system_showText(LANG_NA) : format_date($each_event["renewal_date"],DEFAULT_DATE_FORMAT,"date")?></td>
				<td style="text-align:center">
					<?=$each_event["amount"]." (".$transaction["transaction_currency"].")";?>
				</td>
			</tr>
		<? } ?>
	</table>
	<br />
<? } ?>

<? if ($transaction_banner_log) { ?>

	<h2 class="headerStandardTitle standardSubTitle"><?=system_showText(LANG_BANNER_FEATURE_NAME_PLURAL);?></h2>

	<table border="0" cellpadding="2" cellspacing="2">
	<thead>
		<tr>
			<th><?=system_showText(LANG_LABEL_CAPTION)?></th>
			<th style="width:100px;"><?=system_showText(LANG_LABEL_IMPRESSIONS)?></th>
			<th style="width:100px;"><?=system_showText(LANG_LABEL_LEVEL);?></th>
			<? if (PAYMENT_FEATURE == "on") { ?>
				<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
					<th style="width:120px;"><?=system_showText(LANG_LABEL_DISCOUNT_CODE)?></th>
				<? } ?>
			<? } ?>
			<th style="width:70px;"><?=system_showText(LANG_LABEL_RENEWAL);?></th>
			<th style="width:100px;"><?=system_showText(LANG_LABEL_AMOUNT);?></th>
		</tr>
		</thead>
		<? foreach ($transaction_banner_log as $each_banner) {?>
			<tr>
				<td>
					<?
					$transactionBannerObj = new Banner($each_banner["banner_id"]);
					if ($transactionBannerObj->getNumber("id") > 0) {
						?><a href="<?=$url_base?>/banner/view.php?id=<?=$each_banner["banner_id"]?>" class="link-table"><?=$each_banner["banner_caption"]?></a><?
					} else {
						?><?=$each_banner["banner_caption"]?><?
					}
					?>
				</td>
				<td style="text-align:center"><?=(($each_banner["impressions"]) ? $each_banner["impressions"] : system_showText(LANG_LABEL_UNLIMITED))?></td>
				<td><?=ucwords($bannerLevelObj->getLevel($each_banner["level"]));?></td>
				<? if (PAYMENT_FEATURE == "on") { ?>
					<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
						<td style="text-align:center"><?=$each_banner["discount_id"]?></td>
					<? } ?>
				<? } ?>
				<td style="text-align:center"><?=($each_banner["renewal_date"] == "0000-00-00") ? (($each_banner["impressions"]) ? (system_showText(LANG_LABEL_UNLIMITED)) : (system_showText(LANG_NA))) : format_date($each_banner["renewal_date"],DEFAULT_DATE_FORMAT,"date")?></td>
				<td style="text-align:center">
					<?=$each_banner["amount"]." (".$transaction["transaction_currency"].")";?>
				</td>
			</tr>
		<? } ?>
	</table>
	<br />
<? } ?>

<? if ($transaction_classified_log) { ?>

	<h2 class="headerStandardTitle standardSubTitle"><?=system_showText(LANG_CLASSIFIED_FEATURE_NAME_PLURAL);?></h2>

	<table border="0" cellpadding="2" cellspacing="2">
	<thead>
		<tr>
			<th><?=system_showText(LANG_LABEL_TITLE);?></th>
			<th style="width:100px;"><?=system_showText(LANG_LABEL_LEVEL);?></th>
			<? if (PAYMENT_FEATURE == "on") { ?>
				<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
					<th style="width:120px;"><?=system_showText(LANG_LABEL_DISCOUNT_CODE)?></th>
				<? } ?>
			<? } ?>
			<th style="width:70px;"><?=system_showText(LANG_LABEL_RENEWAL);?></th>
			<th style="width:100px;"><?=system_showText(LANG_LABEL_AMOUNT);?></th>
		</tr>
		</thead>
		<? foreach ($transaction_classified_log as $each_classified) { ?>
			<tr>
				<td>
					<?
					$transactionClassifiedObj = new Classified($each_classified["classified_id"]);
					if ($transactionClassifiedObj->getNumber("id") > 0) {
						?><a href="<?=$url_base?>/classified/view.php?id=<?=$each_classified["classified_id"]?>" class="link-table"><?=$each_classified["classified_title"]?></a><?
					} else {
						?><?=$each_classified["classified_title"]?><?
					}
					?>
				</td>
				<td><?=ucwords($classifiedLevelObj->getLevel($each_classified["level"]));?></td>
				<? if (PAYMENT_FEATURE == "on") { ?>
					<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
						<td style="text-align:center"><?=$each_classified["discount_id"]?></td>
					<? } ?>
				<? } ?>
				<td style="text-align:center"><?=($each_classified["renewal_date"] == "0000-00-00") ? system_showText(LANG_NA) : format_date($each_classified["renewal_date"],DEFAULT_DATE_FORMAT,"date")?></td>
				<td style="text-align:center">
					<?=$each_classified["amount"]." (".$transaction["transaction_currency"].")";?>
				</td>
			</tr>
		<? } ?>
	</table>
	<br />
<? } ?>

<? if ($transaction_article_log) { ?>

	<h2 class="headerStandardTitle standardSubTitle"><?=system_showText(LANG_ARTICLE_FEATURE_NAME_PLURAL);?></h2>

	<table border="0" cellpadding="2" cellspacing="2">
	<thead>
		<tr>
			<th><?=system_showText(LANG_LABEL_TITLE);?></th>
			<? if (PAYMENT_FEATURE == "on") { ?>
				<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
					<th style="width:120px;"><?=system_showText(LANG_LABEL_DISCOUNT_CODE)?></th>
				<? } ?>
			<? } ?>
			<th style="width:70px;"><?=system_showText(LANG_LABEL_RENEWAL);?></th>
			<th style="width:100px;"><?=system_showText(LANG_LABEL_AMOUNT);?></th>
		</tr>
		</thead>
		<? foreach ($transaction_article_log as $each_article) { ?>
			<tr>
				<td>
					<?
					$transactionArticleObj = new Article($each_article["article_id"]);
					if ($transactionArticleObj->getNumber("id") > 0) {
						?><a href="<?=$url_base?>/article/view.php?id=<?=$each_article["article_id"]?>" class="link-table"><?=$each_article["article_title"]?></a><?
					} else {
						?><?=$each_article["article_title"]?><?
					}
					?>
				</td>
				<? if (PAYMENT_FEATURE == "on") { ?>
					<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
						<td style="text-align:center"><?=$each_article["discount_id"]?></td>
					<? } ?>
				<? } ?>
				<td style="text-align:center"><?=($each_article["renewal_date"] == "0000-00-00") ? system_showText(LANG_NA) : format_date($each_article["renewal_date"],DEFAULT_DATE_FORMAT,"date")?></td>
				<td style="text-align:center">
					<?=$each_article["amount"]." (".$transaction["transaction_currency"].")";?>
				</td>
			</tr>
		<? } ?>
	</table>
	<br />
<? } ?>

<? if ($transaction_custominvoice_log) { ?>
	<h2 class="headerStandardTitle standardSubTitle"><?=system_showText(LANG_CUSTOM_INVOICES);?></h2>

	<table border="0" cellpadding="2" cellspacing="2">
	<thead>
		<tr>
			<th><?=system_showText(LANG_LABEL_TITLE);?></th>
			<th style="width:120px;"><?=system_showText(LANG_LABEL_ITEMS);?></th>
			<th style="width:70px;"><?=system_showText(LANG_LABEL_DATE);?></th>
			<th style="width:100px;"><?=system_showText(LANG_LABEL_AMOUNT);?></th>
		</tr>
	</thead>
		<? foreach ($transaction_custominvoice_log as $each_custominvoice) { ?>
			<tr>
				<td>
					<?
					$transactionCustomInvoiceObj = new CustomInvoice($each_custominvoice["custom_invoice_id"]);					
					
					if ($transactionCustomInvoiceObj->getNumber("id") > 0) {
						if (strpos($url_base, "/gerenciamento") !== false) {
							?><a href="<?=$url_base?>/custominvoices/view.php?id=<?=$each_custominvoice["custom_invoice_id"]?>" class="link-table"><?=$each_custominvoice["title"]?></a><?
						} else {
							?><?=$each_custominvoice["title"]?><?
						}
					} else {
						?><?=$each_custominvoice["title"]?><?
					}
					?>
				</td>
				<?
				if (strpos($url_base, "/gerenciamento") !== false) {
					$popup_url = DEFAULT_URL."/gerenciamento/custominvoices/view_items.php";
				} else {
					$popup_url = DEFAULT_URL."/membros/billing/view_custominvoice_items.php";
				}
				?>
				<td><a href="javascript:void(0)" onclick="javascript:window.open('<?=$popup_url?>?id=<?=$each_custominvoice["custom_invoice_id"];?>&items=<?=urlencode($each_custominvoice["items"])?>&items_price=<?=urlencode($each_custominvoice["items_price"])?>&view=payment_log', 'popup', 'toolbar=0, width=620, height=370, scrollbars=yes, screenX=0, screenY=0');" class="link-table" style="text-decoration: underline;"><?=system_showText(LANG_VIEWITEMS)?></a></td>
				<td><?=format_date($each_custominvoice["date"])?></td>
				<td style="text-align:center; width: 100px;">
					<?=$each_custominvoice["amount"]." (".$transaction["transaction_currency"].")";?>
				</td>
			</tr>
		<? } ?>
	</table>
	<br />
<? } ?>

