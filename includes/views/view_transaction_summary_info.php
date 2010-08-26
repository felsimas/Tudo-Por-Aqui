<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/views/view_transaction_summary_info.php
	# ----------------------------------------------------------------------------------------------------

	$id = $transaction["id"];
	$_GET['id'] = $id;
	include(INCLUDES_DIR."/code/transaction.php");

?>

<? if ($transaction_listing_log) { ?>

	<table align="center" border="0" cellpadding="2" cellspacing="2" class="standard-innerTable">
		<tr>
			<th class="tableTitle" colspan="3"><p><?=system_showText(LANG_LISTING_FEATURE_NAME_PLURAL);?></p></th>
		</tr>
		<? foreach ($transaction_listing_log as $each_listing) { ?>
			<tr>
				<th>
					<?
					$transactionListingObj = new Listing($each_listing["listing_id"]);
					if ($transactionListingObj->getNumber("id") > 0) {
						?><a href="<?=$url_base?>/listing/view.php?id=<?=$each_listing["listing_id"]?>" class="link-table"><?=$each_listing["listing_title"]?></a><?
					} else {
						?><?=$each_listing["listing_title"]?><?
					}
					?>
				</th>
				<td class="infoLevel"><?=ucwords($listingLevelObj->getLevel($each_listing["level"]));?></td>
				<td class="infoAmount">
					<?=$each_listing["amount"]." (".$transaction["transaction_currency"].")";?>
				</td>
			</tr>
		<? } ?>
	</table>
	<br />
<? } ?>
<? if ($transaction_event_log) { ?>

	<table align="center" border="0" cellpadding="2" cellspacing="2" class="standard-innerTable">
		<tr>
			<th class="tableTitle" colspan="3"><p><?=system_showText(LANG_EVENT_FEATURE_NAME_PLURAL);?></p></th>
		</tr>
		<? foreach ($transaction_event_log as $each_event) { ?>
			<tr>
				<th>
					<?
					$transactionEventObj = new Event($each_event["event_id"]);
					if ($transactionEventObj->getNumber("id") > 0) {
						?><a href="<?=$url_base?>/event/view.php?id=<?=$each_event["event_id"]?>" class="link-table"><?=$each_event["event_title"]?></a><?
					} else {
						?><?=$each_event["event_title"]?><?
					}
					?>
				</th>
				<td class="infoLevel"><?=ucwords($eventLevelObj->getLevel($each_event["level"]));?></td>
				<td class="infoAmount">
				<?=$each_event["amount"]." (".$transaction["transaction_currency"].")";?>
				</td>
			</tr>
		<? } ?>
	</table>
	<br />
<? } ?>

<? if ($transaction_banner_log) { ?>

	<table align="center" border="0" cellpadding="2" cellspacing="2" class="standard-innerTable">
		<tr>
			<th class="tableTitle" colspan="3"><p><?=system_showText(LANG_BANNER_FEATURE_NAME_PLURAL);?></p></th>
		</tr>
		<? foreach ($transaction_banner_log as $each_banner) {?>
			<tr>
				<th>
					<?
					$transactionBannerObj = new Banner($each_banner["banner_id"]);
					if ($transactionBannerObj->getNumber("id") > 0) {
						?><a href="<?=$url_base?>/banner/view.php?id=<?=$each_banner["banner_id"]?>" class="link-table"><?=$each_banner["banner_caption"]?></a><?
					} else {
						?><?=$each_banner["banner_caption"]?><?
					}
					?>
				</th>
				<td class="infoLevel"><?=ucwords($bannerLevelObj->getLevel($each_banner["level"]));?></td>
				<td class="infoAmount">
					<?=$each_banner["amount"]." (".$transaction["transaction_currency"].")";?>
				</td>
			</tr>
		<? } ?>
	</table>
	<br />
<? } ?>

<? if ($transaction_classified_log) { ?>

	<table align="center" border="0" cellpadding="2" cellspacing="2" class="standard-innerTable">
		<tr>
			<th class="tableTitle" colspan="3"><p><?=system_showText(LANG_CLASSIFIED_FEATURE_NAME_PLURAL);?></p></th>
		</tr>
		<? foreach ($transaction_classified_log as $each_classified) { ?>
			<tr>
				<th>
					<?
					$transactionClassifiedObj = new Classified($each_classified["classified_id"]);
					if ($transactionClassifiedObj->getNumber("id") > 0) {
						?><a href="<?=$url_base?>/classified/view.php?id=<?=$each_classified["classified_id"]?>" class="link-table"><?=$each_classified["classified_title"]?></a><?
					} else {
						?><?=$each_classified["classified_title"]?><?
					}
					?>
				</th>
				<td class="infoLevel"><?=ucwords($classifiedLevelObj->getLevel($each_classified["level"]));?></td>
				<td class="infoAmount">
					<?=$each_classified["amount"]." (".$transaction["transaction_currency"].")";?>
				</td>
			</tr>
		<? } ?>
	</table>
	<br />
<? } ?>

<? if ($transaction_article_log) { ?>

	<table align="center" border="0" cellpadding="2" cellspacing="2" class="standard-innerTable">
		<tr>
			<th class="tableTitle" colspan="2"><p><?=system_showText(LANG_ARTICLE_FEATURE_NAME_PLURAL);?></p></th>
		</tr>
		<? foreach ($transaction_article_log as $each_article) { ?>
			<tr>
				<th>
					<?
					$transactionArticleObj = new Article($each_article["article_id"]);
					if ($transactionArticleObj->getNumber("id") > 0) {
						?><a href="<?=$url_base?>/article/view.php?id=<?=$each_article["article_id"]?>" class="link-table"><?=$each_article["article_title"]?></a><?
					} else {
						?><?=$each_article["article_title"]?><?
					}
					?>
				</th>
				<td class="infoAmount">
					<?=$each_article["amount"]." (".$transaction["transaction_currency"].")";?>
				</td>
			</tr>
		<? } ?>
	</table>
	<br />
<? } ?>

<? if ($transaction_custominvoice_log) { ?>

	<table align="center" border="0" cellpadding="2" cellspacing="2" class="standard-innerTable">
		<tr>
			<th class="tableTitle" colspan="2"><p><?=system_showText(LANG_CUSTOM_INVOICES);?></p></th>
		</tr>
		<? foreach ($transaction_custominvoice_log as $each_custominvoice) { ?>
			<tr>
				<th>
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
				</th>
				<td class="infoAmount">
					<?=$each_custominvoice["amount"]." (".$transaction["transaction_currency"].")";?>
				</td>
			</tr>
		<? } ?>
	</table>
	<br />
<? } ?>


