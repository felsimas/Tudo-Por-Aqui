<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form_listingdefaultprice.php
	# ----------------------------------------------------------------------------------------------------

	$levelObj = new ListingLevel();

?>

<div id="header-form"><?=ucwords(system_showText(LANG_SITEMGR_LISTING_PLURAL))?> - <?=ucwords(system_showText(LANG_SITEMGR_SETTINGS_PRICING_DEFAULTPRICES))?></div>

<? if ($message_listingdefaultprice) { ?>
<div class="response-msg error ui-corner-all"><?=$message_listingdefaultprice?></div>
<? } ?>

<table cellpadding="2" cellspacing="0" class="table-form tablePricing" border="0">

	<tr class="tr-form">
		<td align="center" class="td-form" width="16">&nbsp;</td>
		<td align="center" class="td-form"><div class="label-form" style="text-align: left;"><b>
			<?=system_showText(LANG_SITEMGR_SETTINGS_PRICING_PRICEPER)?>
			<?
			if (payment_getRenewalCycle("listing") > 1) {
				echo payment_getRenewalCycle("listing")." ";
				echo payment_getRenewalUnitName("listing")."s";
			}else {
				echo payment_getRenewalUnitName("listing");
			}
			?>
		</b></div></td>
		<td align="center" class="td-form"><div class="label-form" style="text-align: left;"><b># <?=system_showText(LANG_SITEMGR_SETTINGS_PRICING_CATEGORIESINCLUDED)?></b></div></td>
		<td align="center" class="td-form"><div class="label-form" style="text-align: left;"><b><?=system_showText(LANG_SITEMGR_SETTINGS_PRICING_EXTRACATEGORYPRICE)?></b></div></td>
	</tr>

	<?
	$levelvalues = $levelObj->getLevelValues();
	foreach ($levelvalues as $levelvalue) {
		?>
		<tr>
			<td align="left" class="td-form"><div class="label-form" style="text-align:right"><?=$levelObj->showLevel($levelvalue)?>:</div></td>
			<td align="left" class="td-form">
				<input type="text" name="price[<?=$levelvalue?>]" class="input-form-listing" style="width:100px" value="<?=$levelObj->getPrice($levelvalue)?>" />
			</td>
			<td align="left" class="td-form">
				<input type="text" name="free_category[<?=$levelvalue?>]" class="input-form-listing" style="width:150px" value="<?=$levelObj->getFreeCategory($levelvalue)?>" />
			</td>
			<td align="left" class="td-form">
				<input type="text" name="category_price[<?=$levelvalue?>]" class="input-form-listing" style="width:150px" value="<?=$levelObj->getCategoryPrice($levelvalue)?>" />
			</td>
		</tr>
		<?
	}
	?>

</table>
