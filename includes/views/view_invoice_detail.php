<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/views/view_invoice_detail.php
	# ----------------------------------------------------------------------------------------------------

?>

<br />

<h2 class="headerStandardTitle standardSubTitle"><?=system_showText(LANG_INVOICEINFO);?></h2>

	<ul class="general-item">
		<? if(strpos($url_base, "/gerenciamento")) { ?>
		<li>
		<strong><?=system_showText(LANG_LABEL_ACCOUNT);?>:</strong>
			<? if ($invoice["account_id"]) echo "<a href=\"".$url_base."/account/view.php?id=".$invoice["account_id"]."\">"; ?>
				<?=system_showAccountUserName($invoice["username"])?>
			<? if ($invoice["account_id"]) echo "</a>"; ?>
			
		</li>
		<? } ?>
		<li><strong><?=system_showText(LANG_LABEL_ID);?>:</strong> <?=$invoice["id"]?><? if (strpos($url_base, "/membros")) { ?>&nbsp;<a href="javascript:void(0);" class="link-table"><img src="<?=DEFAULT_URL?>/images/icon_print.gif" border="0" onclick="window.open('<?=DEFAULT_URL?>/membros/billing/invoice.php?id=<?=$id?>', 'popup', 'toolbar=0, width=680, height=420, scrollbars=yes, screenX=0, screenY=0');" alt="<?=system_showText(LANG_SITEMGR_INVOICE_CLICKHERETOPRINT)?>" title="<?=system_showText(LANG_SITEMGR_INVOICE_CLICKHERETOPRINT)?>" /></a><? } ?></li>
		<li><strong><?=system_showText(LANG_LABEL_STATUS);?>:</strong> <?=$invoice["status"]?></li>
		<li><strong><?=system_showText(LANG_ISSUINGDATE);?>:</strong> <?=$invoice["date"]?></li>
		<li><strong><?=system_showText(LANG_PAYMENTDATE);?>:</strong> <?=(($invoice["payment_date"]) ? $invoice["payment_date"] : system_showText(LANG_NONE))?></li>
		<li><strong><?=system_showText(LANG_EXPIREDATE);?>:</strong> <?=$invoice["expire_date"]?></li><li>
		<strong><?=system_showText(LANG_LABEL_IP);?>:</strong> <?=$invoice["ip"]?></li>
		<li><strong><?=system_showText(LANG_LABEL_AMOUNT);?>:</strong> <?=$invoice["amount"]?> (<?=$invoice["currency"]?>)</li>
	</ul>

<? if($invoice_listing){ ?>
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
			<th style="width:100px;"><?=system_showText(LANG_LABEL_AMOUNT);?> (<?=$invoice["currency"]?>)</th>
		</tr>
		</thead>
		<? foreach($invoice_listing as $each_invoice_listing) { ?>
			<tr>
				<td>
					<?
					$invoiceListingObj = new Listing($each_invoice_listing["listing_id"]);
					if ($invoiceListingObj->getNumber("id") > 0) {
					?>
					<a href="<?=$url_base?>/listing/view.php?id=<?=$each_invoice_listing["listing_id"]?>" class="link-table"><?=$each_invoice_listing["listing_title"]?></a>
					<?
					} else {
					?>
					<?=$each_invoice_listing["listing_title"]?>
					<?
					}
					?>
					<?=($each_invoice_listing["listingtemplate"]?"<span class=\"itemNote\">(".$each_invoice_listing["listingtemplate"].")</span>":"");?>
				</td>
				<td><?=$each_invoice_listing["extra_categories"]?></td>
				<td><?=ucwords($listingLevelObj->getLevel($each_invoice_listing["level"]));?></td>
				<? if (PAYMENT_FEATURE == "on") { ?>
					<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
						<td><?=$each_invoice_listing["discount_id"]?></td>
					<? } ?>
				<? } ?>
				<td><?=$each_invoice_listing["renewal_date"]?></td>
				<td>
					<?=$each_invoice_listing["amount"]." (".$invoice["currency"].")";?>
				</td>
			</tr>
		<? }?>
	</table>
	</div>
	<br />
<? } ?>

<? if($invoice_event){ ?>
	<h2 class="headerStandardTitle standardSubTitle"><?=system_showText(LANG_EVENT_FEATURE_NAME_PLURAL);?></h2>
	<div class="hastable">
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
			<th style="width:100px;"><?=system_showText(LANG_LABEL_AMOUNT);?> (<?=$invoice["currency"]?>)</th>
		</tr>
		</thead>
		<? foreach($invoice_event as $each_invoice_event) { ?>
			<tr>
				<td>
					<?
					$invoiceEventObj = new Event($each_invoice_event["event_id"]);
					if ($invoiceEventObj->getNumber("id") > 0) {
						?><a href="<?=$url_base?>/event/view.php?id=<?=$each_invoice_event["event_id"]?>" class="link-table"><?=$each_invoice_event["event_title"]?></a><?
					} else {
						?><?=$each_invoice_event["event_title"]?><?
					}
					?>
				</td>
				<td><?=ucwords($eventLevelObj->getLevel($each_invoice_event["level"]));?></td>
				<? if (PAYMENT_FEATURE == "on") { ?>
					<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
						<td><?=$each_invoice_event["discount_id"]?></td>
					<? } ?>
				<? } ?>
				<td><?=$each_invoice_event["renewal_date"]?></td>
				<td>
					<?=$each_invoice_event["amount"]." (".$invoice["currency"].")";?>
				</td>
			</tr>
		<? }?>
	</table>
	</div>
	<br />
<? } ?>

<? if($invoice_banner){ ?>
	<h2 class="headerStandardTitle standardSubTitle"><?=system_showText(LANG_BANNER_FEATURE_NAME_PLURAL);?></h2>
	<div class="hastable">
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
			<th style="width:100px;"><?=system_showText(LANG_LABEL_AMOUNT);?> (<?=$invoice["currency"]?>)</th>
		</tr>
		</thead>
		<? foreach($invoice_banner as $each_invoice_banner) { ?>
			<tr>
				<td>
					<?
					$invoiceBannerObj = new Banner($each_invoice_banner["banner_id"]);
					if ($invoiceBannerObj->getNumber("id") > 0) {
						?><a href="<?=$url_base?>/banner/view.php?id=<?=$each_invoice_banner["banner_id"]?>" class="link-table"><?=$each_invoice_banner["banner_caption"]?></a><?
					} else {
						?><?=$each_invoice_banner["banner_caption"]?><?
					}
					?>
				</td>
				<td><?=$each_invoice_banner["impressions"]?></td>
				<td><?=ucwords($bannerLevelObj->getLevel($each_invoice_banner["level"]));?></td>
				<? if (PAYMENT_FEATURE == "on") { ?>
					<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
						<td><?=$each_invoice_banner["discount_id"]?></td>
					<? } ?>
				<? } ?>
				<td><?=$each_invoice_banner["renewal_date"]?></td>
				<td>
					<?=$each_invoice_banner["amount"]." (".$invoice["currency"].")";?>
				</td>
			</tr>
		<? }?>
	</table>
	</div>
	<br />
<? } ?>

<? if($invoice_classified){ ?>
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
			<th style="width:100px;"><?=system_showText(LANG_LABEL_AMOUNT);?> (<?=$invoice["currency"]?>)</th>
		</tr>
		</thead>
		<? foreach($invoice_classified as $each_invoice_classified) { ?>
			<tr>
				<td>
					<?
					$invoiceClassifiedObj = new Classified($each_invoice_classified["classified_id"]);
					if ($invoiceClassifiedObj->getNumber("id") > 0) {
						?><a href="<?=$url_base?>/classified/view.php?id=<?=$each_invoice_classified["classified_id"]?>" class="link-table"><?=$each_invoice_classified["classified_title"]?></a><?
					} else {
						?><?=$each_invoice_classified["classified_title"]?><?
					}
					?>
				</td>
				<td><?=ucwords($classifiedLevelObj->getLevel($each_invoice_classified["level"]));?></td>
				<? if (PAYMENT_FEATURE == "on") { ?>
					<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
						<td><?=$each_invoice_classified["discount_id"]?></td>
					<? } ?>
				<? } ?>
				<td><?=$each_invoice_classified["renewal_date"]?></td>
				<td>
					<?=$each_invoice_classified["amount"]." (".$invoice["currency"].")";?>
				</td>
			</tr>
		<? }?>
	</table>
	<br />
<? } ?>

<? if($invoice_article){ ?>
	<h2 class="headerStandardTitle standardSubTitle"><?=system_showText(LANG_ARTICLE_FEATURE_NAME_PLURAL);?></h2>
	<table border="0" cellpadding="2" cellspacing="2" class="standard-tableTOPBLUE">
		<tr>
			<th><?=system_showText(LANG_LABEL_TITLE);?></th>
			<? if (PAYMENT_FEATURE == "on") { ?>
				<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
					<th style="width:120px;"><?=system_showText(LANG_LABEL_DISCOUNT_CODE)?></th>
				<? } ?>
			<? } ?>
			<th style="width:70px;"><?=system_showText(LANG_LABEL_RENEWAL);?></th>
			<th style="width:100px;"><?=system_showText(LANG_LABEL_AMOUNT);?> (<?=$invoice["currency"]?>)</th>
		</tr>
		<? foreach($invoice_article as $each_invoice_article) { ?>
			<tr>
				<td>
					<?
					$invoiceArticleObj = new Article($each_invoice_article["article_id"]);
					if ($invoiceArticleObj->getNumber("id") > 0) {
						?><a href="<?=$url_base?>/article/view.php?id=<?=$each_invoice_article["article_id"]?>" class="link-table"><?=$each_invoice_article["article_title"]?></a><?
					} else {
						?><?=$each_invoice_article["article_title"]?><?
					}
					?>
				</td>
				<? if (PAYMENT_FEATURE == "on") { ?>
					<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
						<td><?=$each_invoice_article["discount_id"]?></td>
					<? } ?>
				<? } ?>
				<td><?=$each_invoice_article["renewal_date"]?></td>
				<td>
					<?=$each_invoice_article["amount"]." (".$invoice["currency"].")";?>
				</td>
			</tr>
		<? }?>
	</table>
	<br />
<? } ?>

<? if($invoice_custominvoice){ ?>
	<h2 class="headerStandardTitle standardSubTitle"><?=system_showText(LANG_CUSTOM_INVOICES);?></h2>
	<div class="hastable">
	<table border="0" cellpadding="2" cellspacing="2">
	<thead>
		<tr>
			<th><?=system_showText(LANG_LABEL_TITLE);?></th>
			<th width="120px"><?=system_showText(LANG_LABEL_ITEMS);?></th>
			<th width="70"><?=system_showText(LANG_LABEL_DATE);?></th>
			<th width="100"><?=system_showText(LANG_LABEL_AMOUNT);?> (<?=$invoice["currency"]?>)</th>
		</tr>
	</thead>
		<? foreach($invoice_custominvoice as $each_invoice_custominvoice) { ?>
			<tr>
				<td>
					<?
					$invoiceCustomInvoiceObj = new CustomInvoice($each_invoice_custominvoice["custom_invoice_id"]);
					if ($invoiceCustomInvoiceObj->getNumber("id") > 0) {
						if (strpos($url_base, "/gerenciamento") !== false) {
							?><a href="<?=$url_base?>/custominvoices/view.php?id=<?=$each_invoice_custominvoice["custom_invoice_id"]?>" class="link-table"><?=$each_invoice_custominvoice["title"]?></a><?
						} else {
							?><?=$each_invoice_custominvoice["title"]?><?
						}
					} else {
						?><?=$each_invoice_custominvoice["title"]?><?
					}
					?>
				</td>
				<?
				if (strpos($url_base, "/gerenciamento")) {
					$popup_url = DEFAULT_URL."/gerenciamento/custominvoices/view_items.php";
				} else {
					$popup_url = DEFAULT_URL."/membros/billing/view_custominvoice_items.php";
				}
				?>
				<td><a href="javascript:void(0)" onclick="javascript:window.open('<?=$popup_url?>?id=<?=$each_invoice_custominvoice["custom_invoice_id"]?>&items=<?=urlencode($each_invoice_custominvoice["items"])?>&items_price=<?=urlencode($each_invoice_custominvoice["items_price"])?>&view=payment_log', 'popup', 'toolbar=0, width=620, height=370, scrollbars=yes, screenX=0, screenY=0');" class="link-table" style="text-decoration: underline;"><?=system_showText(LANG_VIEWITEMS)?></a></td>
				<td><?=format_date($each_invoice_custominvoice["date"])?></td>
				<td>
					<?=$each_invoice_custominvoice["amount"]." (".$invoice["currency"].")";?>
				</td>
			</tr>
		<? }?>
	</table>
	</div>
	<br />
<? } ?>
