<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/views/view_custominvoice_detail.php
	# ----------------------------------------------------------------------------------------------------

?>

<br />

<table border="0" cellpadding="2" cellspacing="2" style="width: 525px;" class="standard-tableTOPBLUE">
	<tr>
		<th colspan="2">
			<h1 style="background: none; margin: 5px; padding: 5px;"><?=ucwords(system_showText(LANG_SITEMGR_CUSTOMINVOICE))?></h1>
		</th>
	</tr>
	<tr>
		<td width="50%">
			<p><b><?=system_showText(LANG_SITEMGR_LABEL_ACCOUNT)?>:</b></p><p><?=system_showAccountUserName($account->getString("username"))?></p>
		</td>
		<td width="50%">
			<p><b><?=system_showText(LANG_SITEMGR_TITLE)?>:</b></p><p><?=$customInvoice->getString("title")?></p>
		</td>
	</tr>
	<tr>
		<td width="50%">
			<p><b><?=system_showText(LANG_SITEMGR_NUMBER)?>:</b></p><p><?=$customInvoice->getString("id")?></p>
		</td>
		<td width="50%">
			<p><b><?=system_showText(LANG_SITEMGR_STATUS)?>:</b></p><p><?=($customInvoice->getString("paid") == "y" ? system_showText(LANG_SITEMGR_CUSTOMINVOICE_PAID) : ($customInvoice->getString("sent") == "y" ? system_showText(LANG_SITEMGR_CUSTOMINVOICE_SENT) : system_showText(LANG_SITEMGR_CUSTOMINVOICE_NOTSENT)))?></p>
		</td>
	</tr>
	<tr>
		<td colspan="2" style="padding-top: 10px;">
			<table border="0" cellspacing="0" cellpadding="0" class="standard-tableTOPBLUE" style="width: 525px;">
				<tr>
					<th style="width: 350px;"><?=system_showText(LANG_SITEMGR_LABEL_ITEM)?></th>
					<th><?=system_showText(LANG_SITEMGR_LABEL_AMOUNT)?></th>
				</tr>
				<?
				$total_custom_invoice_price = 0;
				$custom_invoice_items = $customInvoice->getItems();
				if ($custom_invoice_items) {
					foreach ($custom_invoice_items as $each_custom_invoice_item) {
						?>
						<tr>
							<td><?=$each_custom_invoice_item["description"]?></td>
							<td>
								<?
								if ($each_custom_invoice_item["price"] > 0) {
									echo CURRENCY_SYMBOL." ".format_money($each_custom_invoice_item["price"]);
									$total_custom_invoice_price += $each_custom_invoice_item["price"];
								} else {
									echo system_showText(LANG_SITEMGR_FREE);
								}
								?>
							</td>
						</tr>
						<?
					}
				}
				?>
				<tr>
					<td>&nbsp;</th>
					<th><?=ucwords(system_showText(LANG_SITEMGR_PAYMENT_OVERVIEW_TOTALPAYMENTS1))?></th>
				</tr>
				<tr>
					<td>&nbsp;</th>
					<td>
						<?=CURRENCY_SYMBOL." ".format_money($total_custom_invoice_price);?>
					</th>
				</tr>
			</table>
		</td>
	</tr>
</table>