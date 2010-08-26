<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form_discountcode.php
	# ----------------------------------------------------------------------------------------------------

?>

<script language="javascript" type="text/javascript">
	<!--
	function showAmountType(type) {
		if (type == '%') {
			document.getElementById('amount_monetary').innerHTML = '';
			document.getElementById('amount_percentage').innerHTML = type;
		} else {
			document.getElementById('amount_monetary').innerHTML = type;
			document.getElementById('amount_percentage').innerHTML = '';
		}
	}
	-->
</script>

<? echo "<div class=\"response-msg notice ui-corner-all\">* ".system_showText(LANG_SITEMGR_LABEL_REQUIREDFIELD)."</div>"; ?>

<? if ($message_discountcode) {?>
	<p class="errorMessage"><?=$message_discountcode?></p>
<? } ?>

<table border="0" cellpadding="2" cellspacing="0" class="standard-table">
	<tr>
		<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_SITEMGR_INFORMATION)?></th>
	</tr>
	<tr>
		<th>* <?=system_showText(LANG_SITEMGR_LABEL_CODE)?>:</th>
		<td><input type="text" name="id" value="<?=$id?>" class="input-form-discountcode" maxlength="10" /></td>
	</tr>
	<tr>
		<th>* <?=system_showText(LANG_SITEMGR_EXPIRATIONDATE)?>:</th>
		<td><input type="text" name="expire_date" value="<?=$expire_date?>" class="input-form-discountcode" style="width:100px" maxlength="10" /><span class="label-field-form">(<?=format_printDateStandard()?>)</span></td>
	</tr>
	<? if ($x_id) { ?>
		<tr>
			<th><?=system_showText(LANG_SITEMGR_STATUS)?></th>
			<td><?=$discountCodeStatusDropDown?></td>
		</tr>
	<? } ?>
	<tr>
		<th>* <?=system_showText(LANG_SITEMGR_LABEL_TYPE)?>:</th>
		<td>
			<table cellpadding="0" cellspacing="0" border="0">
				<tr>
					<td class="td-checkbox"><input type="radio" name="type" value="percentage" class="inputCheck" <?=(($type == "percentage") ? "checked=true" : "")?> onclick="showAmountType('%');" /></td>
					<td style="color: #003365; width:325px;"><?=system_showText(LANG_SITEMGR_LABEL_PERCENTAGE)?></td>
					<td class="td-checkbox"><input type="radio" name="type" value="monetary value" class="inputCheck" <?=((!$type || $type == "monetary value") ? "checked=true" : "")?> onclick="showAmountType('<?=CURRENCY_SYMBOL?>');" /></td>
					<td style="color: #003365;"><?=system_showText(LANG_SITEMGR_LABEL_FIXEDVALUE)?></td>
					<td>&nbsp;</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<th>* <?=system_showText(LANG_SITEMGR_LABEL_AMOUNT)?>:</th>
		<td>
			<span class="inline" id='amount_monetary'><? if (!$type || $type == "monetary value") { echo CURRENCY_SYMBOL; } ?></span><input type="text" name="amount" value="<?=(($amount) ? $amount : "0.00")?>" style="width:100px" class="input-form-discountcode" maxlength="10" /><span class="inline" id='amount_percentage'><? if ($type && $type != "monetary value") { echo "%"; } ?></span>
		</td>
	</tr>
	<tr>
		<th><?=system_showText(LANG_SITEMGR_AVAILABLEOF)?>:</th>
		<td>
			<table cellpadding="0" cellspacing="0" border="0">
				<tr>
					<td class="td-checkbox">
						<input type="checkbox" name="listing" class="inputCheck" <?=(($listing == "on") ? ("checked=true") : (""))?> />
					</td>
					<td style="color: #003365;">
						<?=system_showText(LANG_SITEMGR_LISTING_SING)?>
					</td>
					<? if (EVENT_FEATURE == "on") { ?>
						<td class="td-checkbox">
							<input type="checkbox" name="event" class="inputCheck" <?=(($event == "on") ? ("checked=true") : (""))?> />
						</td>
						<td style="color: #003365;">
							<?=system_showText(LANG_SITEMGR_EVENT_SING)?>
						</td>
					<? } ?>
					<? if (BANNER_FEATURE == "on") { ?>
						<td class="td-checkbox">
							<input type="checkbox" name="banner" class="inputCheck" <?=(($banner == "on") ? ("checked=true") : (""))?> />
						</td>
						<td style="color: #003365;">
							<?=system_showText(LANG_SITEMGR_BANNER_SING)?>
						</td>
					<? } ?>
					<? if (CLASSIFIED_FEATURE == "on") { ?>
						<td class="td-checkbox">
							<input type="checkbox" name="classified" class="inputCheck" <?=(($classified == "on") ? ("checked=true") : (""))?> />
						</td>
						<td style="color: #003365;">
							<?=system_showText(LANG_SITEMGR_CLASSIFIED_SING)?>
						</td>
					<? } ?>
					<? if (ARTICLE_FEATURE == "on") { ?>
						<td class="td-checkbox">
							<input type="checkbox" name="article" class="inputCheck" <?=(($article == "on") ? ("checked=true") : (""))?> />
						</td>
						<td style="color: #003365;">
							<?=system_showText(LANG_SITEMGR_ARTICLE_SING)?>
						</td>
					<? } ?>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<th>* <?=system_showText(LANG_SITEMGR_REPEATUSE)?>:</th>
		<td>
			<table cellpadding="0" cellspacing="0" border="0">
				<tr>
					<td class="td-checkbox"><input type="radio" name="recurring" value="yes" class="inputCheck" <?=(($recurring == "yes") ? "checked=true" : "")?> /></td>
					<td style="color: #003365;"><?=system_showText(strtolower(LANG_SITEMGR_YES))?></td>
					<td class="td-checkbox"><input type="radio" name="recurring" value="no" class="inputCheck" <?=((!$recurring || $recurring == "no") ? "checked=true" : "")?> /></td>
					<td style="color: #003365;"><?=system_showText(strtolower(LANG_SITEMGR_NO))?></td>
					<td class="nowrap"><span>(<?=system_showText(LANG_SITEMGR_PROMOTIONALCODE_ALLOWREPEAT_TEXT)?>)</span></td>
				</tr>
			</table>
		</td>
	</tr>
</table>

<script language="javascript" type="text/javascript"><!-- document.discountcode.id.focus(); --></script>
