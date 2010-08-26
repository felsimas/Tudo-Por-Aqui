<?
	header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);
	setting_get("invoice_company", $invoice_company);
	setting_get("invoice_address", $invoice_address);
	setting_get("invoice_city", $invoice_city);
	setting_get("invoice_state", $invoice_state);
	setting_get("invoice_country", $invoice_country);
	setting_get("invoice_zipcode", $invoice_zipcode);
	setting_get("invoice_phone", $invoice_phone);
	setting_get("invoice_fax", $invoice_fax);
	setting_get("invoice_email", $invoice_email);
	setting_get("invoice_image", $invoice_image);
	setting_get("invoice_notes", $invoice_notes);
?>

<html>

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=<?=EDIR_CHARSET;?>" />
		<link href="<?=DEFAULT_URL?>/layout/invoice.css" rel="stylesheet" type="text/css" />
	</head>

	<body class="invoice-body">

		<table border="0" cellpadding="2" cellspacing="2" class="base-invoice">
			<tr>
				<td colspan="2" style="padding: 0;">

					<table width="100%" border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td>
								<p><?=$invoice_company?></p>
								<p><?=$invoice_address?></p>
								<p><?=$invoice_city?>, <?=$invoice_state?> <?=$invoice_zipcode?></p>
								<p><?=$invoice_country?></p>
								<p><?=$invoice_phone?></p>
								<p><?=$invoice_fax?></p>
								<p><?=$invoice_email?></p>
							</td>
							<td width="250" align="center">
								<?
								$imgTag = "";
								if ($invoice_image) {
									$imageObj = new Image($invoice_image);
									if ($imageObj->imageExists()) {
										$imgTag = $imageObj->getTag(true, IMAGE_INVOICE_LOGO_WIDTH, IMAGE_INVOICE_LOGO_HEIGHT, "Invoice Logo");
									}
								}
								if ($imgTag) {
									echo $imgTag;
								} else {
									echo "<img src=\"".DEFAULT_URL."/images/content/img_invoice.gif\" alt=\"invoice logo\" title=\"invoice logo\" border=\"0\" width=\"".IMAGE_INVOICE_LOGO_WIDTH."\" height=\"".IMAGE_INVOICE_LOGO_HEIGHT."\" />";
								}
								?>
							</td>
							<td width="150">
								<h1><?=strtoupper(system_showText(LANG_LABEL_INVOICE));?></h1>
							</td>
						</tr>
					</table>

				</td>
			</tr>
			<tr>
				<td colspan="2">

					<div class="invoice-bill" style=" float:left;">
						<p><b><?=system_showText(LANG_BILLTO);?>:</b></p>
						<p>
							<?=$contactObj->getString("first_name")?> <?=$contactObj->getString("last_name")?><br />
							<?=$contactObj->getString("company")?> <br />
							<?=$contactObj->getString("address")?> <?=$contactObj->getString("address2")?> <br />
							<?=$contactObj->getString("city")?>, <?=$contactObj->getString("state")?> <?=$contactObj->getString("zip")?>
						</p>
					</div>

					<div class="invoice-bill" style=" float:right;">
						<p><b><?=system_showText(LANG_ISSUINGDATE);?>:</b> <?=format_date($invoiceObj->getString("date"),DEFAULT_DATE_FORMAT,"datetime")?></p>

                        <?
                           $i=7;
while ((date("d", time() + ($i * 86400)) <> 5) && (date("d", time() + ($i * 86400)) <> 10)  && (date("d", time() + ($i * 86400)) <> 15) && (date("d", time() + ($i * 86400)) <> 20) && (date("d", time() + ($i * 86400)) <> 25)&& (date("d", time() + ($i * 86400)) <> 30))  {
  $i++;
}

                         ?>
					  	<p><b><?=system_showText(LANG_EXPIREDATE);?>:</b> <?=date("d/m/Y", time() + ($i * 86400))?></p>
						<p><b><?=system_showText(LANG_LABEL_INVOICENUMBER);?>:</b> <?=$invoiceObj->getString("id")?></p>
					</div>

				</td>
			</tr>
			<tr>
				<td colspan="2">

					<table border="0" cellspacing="0" cellpadding="0" class="invoice-content">
						<tr>
							<th width="300">
								<?=system_showText(LANG_LABEL_ITEM);?>
							</th>
							<? if (count($arr_invoice_listing)) { ?>
								<th nowrap="nowrap">
									<?=system_showText(LANG_LABEL_EXTRA_CATEGORY);?>
								</th>
							<? } ?>
							<th width="80" nowrap="nowrap">
								<?=system_showText(LANG_LABEL_LEVEL);?>
							</th>
							<th nowrap="nowrap">
								<?=system_showText(LANG_LABEL_DISCOUNT_CODE);?>
							</th>
							<th nowrap="nowrap">
								<?=system_showText(LANG_LABEL_AMOUNT);?>
							</th>
						</tr>
						<? if ($item_example===true) {?>
							<tr>
								<td><?=ucfirst(system_showText(LANG_SITEMGR_LABEL_ITEM))?> - <?=ucfirst(system_showText(LANG_SITEMGR_MSGERROR_LANG_TITLEISREQUIRED1))?></td>
								<? if (count($arr_invoice_listing)) { ?>
									<td>0</td>
								<? } ?>
								<td>0</td>
								<td nowrap="nowrap">abcde</td>
								<td nowrap="nowrap" style="vertical-align: top;">FREE</td>
							</tr>
						<? } ?>
						<?
						for($i=0; $i < count($arr_invoice_listing); $i++){
							//get the listing level name
							$listingLevel = new ListingLevel();
							$level_name = ucfirst($listingLevel->getName($arr_invoice_listing[$i]["level"]));
							?>
							<tr>
								<td><b><?=system_showText(LANG_LISTING_FEATURE_NAME)?>:</b> <?=$arr_invoice_listing[$i]["listing_title"]?><?=($arr_invoice_listing[$i]["listingtemplate"]?"<span class=\"itemNote\">(".$arr_invoice_listing[$i]["listingtemplate"].")</span>":"");?></td>
								<td><?=intval($arr_invoice_listing[$i]["extra_categories"])?></td>
								<td><?=$level_name?></td>
								<td><? if (trim($arr_invoice_listing[$i]["discount_id"]) != "") echo $arr_invoice_listing[$i]["discount_id"]; else echo " ".system_showText(LANG_NA)." "; ?></td>
								<td nowrap="nowrap">
									<?=CURRENCY_SYMBOL." ".format_money($arr_invoice_listing[$i]["amount"]);?>
								</td>
							</tr>
						<? } ?>
						<?
						for($i=0; $i < count($arr_invoice_event); $i++){
							//get the event level name
							$eventLevel = new EventLevel();
							$level_name = ucfirst($eventLevel->getName($arr_invoice_event[$i]["level"]));
							?>
							<tr>
								<td <? if (count($arr_invoice_listing)) { echo "colspan=\"2\""; } ?>><b><?=system_showText(LANG_EVENT_FEATURE_NAME)?>:</b> <?=$arr_invoice_event[$i]["event_title"]?></td>
								<td><?=$level_name?></td>
								<td><? if (trim($arr_invoice_event[$i]["discount_id"]) != "") echo $arr_invoice_event[$i]["discount_id"]; else echo " ".system_showText(LANG_NA)." "; ?></td>
								<td nowrap="nowrap">
									<?=CURRENCY_SYMBOL." ".format_money($arr_invoice_event[$i]["amount"]);?>
								</td>
							</tr>
						<? } ?>
						<?
						for($i=0; $i < count($arr_invoice_banner); $i++){
							//get the banner level name
							$bannerLevel = new BannerLevel();
							$level_name   = ucfirst($bannerLevel->getName($arr_invoice_banner[$i]["level"]));
							?>
							<tr>
								<td <? if (count($arr_invoice_listing)) { echo "colspan=\"2\""; } ?>><b><?=system_showText(LANG_BANNER_FEATURE_NAME)?>:</b> <?=$arr_invoice_banner[$i]["banner_caption"]?> <?=($arr_invoice_banner[$i]["impressions"]) ? "(".$arr_invoice_banner[$i]["impressions"]." impressions)" : ""?></td>
								<td><?=$level_name?></td>
								<td><? if (trim($arr_invoice_banner[$i]["discount_id"]) != "") echo $arr_invoice_banner[$i]["discount_id"]; else echo " ".system_showText(LANG_NA)." "; ?></td>
								<td nowrap="nowrap">
									<?=CURRENCY_SYMBOL." ".format_money($arr_invoice_banner[$i]["amount"]);?>
								</td>
							</tr>
						<? } ?>
						<?
						for($i=0; $i < count($arr_invoice_classified); $i++) {
							$classifiedLevel = new ClassifiedLevel();
							$level_name = ucfirst($classifiedLevel->getName($arr_invoice_classified[$i]["level"]));
							?>
							<tr>
								<td <? if (count($arr_invoice_listing)) { echo "colspan=\"2\""; } ?>><b><?=system_showText(LANG_CLASSIFIED_FEATURE_NAME)?>:</b> <?=$arr_invoice_classified[$i]["classified_title"]?></td>
								<td><?=$level_name?></td>
								<td><? if (trim($arr_invoice_classified[$i]["discount_id"]) != "") echo $arr_invoice_classified[$i]["discount_id"]; else echo " ".system_showText(LANG_NA)." "; ?></td>
								<td nowrap="nowrap">
									<?=CURRENCY_SYMBOL." ".format_money($arr_invoice_classified[$i]["amount"]);?>
								</td>
							</tr>
						<? } ?>
						<?
						for($i=0; $i < count($arr_invoice_article); $i++){
							$articleLevel = new ArticleLevel();
							$level_name = ucfirst($articleLevel->getName($arr_invoice_article[$i]["level"]));
							?>
							<tr>
								<td <? if (count($arr_invoice_listing)) { echo "colspan=\"2\""; } ?>><b><?=system_showText(LANG_ARTICLE_FEATURE_NAME)?>:</b> <?=$arr_invoice_article[$i]["article_title"]?></td>
								<td><?=$level_name?></td>
								<td><? if (trim($arr_invoice_article[$i]["discount_id"]) != "") echo $arr_invoice_article[$i]["discount_id"]; else echo " ".system_showText(LANG_NA)." "; ?></td>
								<td nowrap="nowrap">
									<?=CURRENCY_SYMBOL." ".format_money($arr_invoice_article[$i]["amount"]);?>
								</td>
							</tr>
						<? } ?>
						<? for($i=0; $i < count($arr_invoice_custominvoice); $i++){?>
							<?
							$customInvoiceObj = new CustomInvoice($arr_invoice_custominvoice[$i]["custom_invoice_id"]);

							$custom_invoice_items = $arr_invoice_custominvoice[$i]["items"];
							$custom_invoice_items = explode("\n", $custom_invoice_items);

							$custom_invoice_items_price = $arr_invoice_custominvoice[$i]["items_price"];
							$custom_invoice_items_price = explode("\n", $custom_invoice_items_price);

							if ($custom_invoice_items && $custom_invoice_items_price) {
								foreach ($custom_invoice_items as $key => $each_item) {
									$custom_invoice_items_desc[] = $each_item." - ".$custom_invoice_items_price[$key];
								}
							}
							?>
							<tr>
								<td <? if (count($arr_invoice_listing)) { echo "colspan=\"4\""; } else { echo "colspan=\"3\""; } ?>><?=$arr_invoice_custominvoice[$i]["title"].":<br />"?><?=($custom_invoice_items_desc) ? implode("<br />", $custom_invoice_items_desc) : ""?></td>
								<td nowrap="nowrap" style="vertical-align: top;">
									<?=CURRENCY_SYMBOL." ".format_money($arr_invoice_custominvoice[$i]["amount"]);?>
								</td>
							</tr>
							<?
							unset($customInvoiceObj, $custom_invoice_items_desc, $custom_invoice_items_price);
							?>
						<? } ?>
						<tr>
							<td <? if (count($arr_invoice_listing)) { echo "colspan=\"3\""; } else { echo "colspan=\"2\""; } ?> class="invoice-detailbelow">
							   Fazer os cheques nominais para SLG-Tudo Por Aqui
								<br />
								<b><?=system_showText(LANG_QUESTIONS);?>:</b> 47 3027 7750 ou mande um e-mail para financeiro@tudoporaqui.com.br <?=$invoice_phone?>
								<br />
								<strong style="font-size: 8pt;"><?=system_showText(LANG_MSG_THANK_YOU);?></strong>
							</td>
							<th colspan="2" class="invoice-total"><?=system_showText(LANG_LABEL_TOTAL);?>: <span><?=CURRENCY_SYMBOL?><?=format_money($invoiceObj->getString("amount"))?></span></th>
						</tr>
					</table>

				</td>
			</tr>
			<tr>
				<td colspan="2" class="invoice-detailbelow" align="center">
					<?=$invoice_notes?>
				</td>
			</tr>
		</table>

		<p name="print" id="print"><a href="javascript:void(0);" <?=(strpos($url_base, "/membros")) ? "onclick=\"document.getElementById('print').style.display='none';window.print();document.getElementById('print').style.display='block'\"" : "";?> style="color:#000000; font: bold 10pt Verdana, Arial, Helvetica, sans-serif;"><?=system_showText(LANG_MSG_CLICK_TO_PRINT_INVOICE);?></a></p>

	</body>

</html>
