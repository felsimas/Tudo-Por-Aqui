<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form_bannerdefaultprice.php
	# ----------------------------------------------------------------------------------------------------

	$levelObj = new BannerLevel();
	
?>

<div id="header-form"><?=ucwords(system_showText(LANG_SITEMGR_BANNER_PLURAL))?> - <?=ucwords(system_showText(LANG_SITEMGR_SETTINGS_PRICING_DEFAULTPRICES))?></div>

<? if ($message_bannerdefaultprice) { ?>
	<div class="response-msg error ui-corner-all"><?=$message_bannerdefaultprice?></div>
<? } ?>

<table cellpadding="2" cellspacing="0" class="table-form tablePricing" border="0">

	<tr class="tr-form">
		<td align="center" class="td-form" width="16">&nbsp;</td>
		<td align="center" class="td-form"><div class="label-form" style="text-align: left;"><b>
			<?=system_showText(LANG_SITEMGR_SETTINGS_PRICING_PRICEPER)?>
			<?
			if (payment_getRenewalCycle("banner") > 1) {
				echo payment_getRenewalCycle("banner")." ";
				echo payment_getRenewalUnitName("banner")."s";
			}else {
				echo payment_getRenewalUnitName("banner");
			}
			?>
		</b></div></td>
		<td align="center" class="td-form"><div class="label-form" style="text-align: left;"><b><?=system_showText(LANG_SITEMGR_SETTINGS_PRICING_IMPRESSIONSPERBLOCK)?></b></div></td>
		<td align="center" class="td-form"><div class="label-form" style="text-align: left;"><b><?=system_showText(LANG_SITEMGR_SETTINGS_PRICING_PRICEPERBLOCK)?></b></div></td>
	</tr>

	<?
	$levelvalues = $levelObj->getLevelValues();
	foreach ($levelvalues as $levelvalue) {
		?>
		<tr>
			<td align="left" class="td-form"><div class="label-form" style="text-align:right"><?=$levelObj->showLevel($levelvalue)?>:</div></td>
			<td align="left" class="td-form">
				<input type="text" name="price[<?=$levelvalue?>]" class="input-form-banner" style="width:100px" value="<?=$levelObj->getPrice($levelvalue)?>" />
			</td>
			<td align="left" class="td-form">
				<input type="text" name="impression_block[<?=$levelvalue?>]" class="input-form-banner" style="width:160px" value="<?=$levelObj->getImpressionBlock($levelvalue)?>" maxlenght="4" />
			</td>
			<td align="left" class="td-form">
				<input type="text" name="impression_price[<?=$levelvalue?>]" class="input-form-banner" style="width:150px" value="<?=$levelObj->getImpressionPrice($levelvalue)?>" maxlength="10" />
			</td>
		</tr>
		<?
	}
	?>
</table>
