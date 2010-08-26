<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form_classifieddefaultprice.php
	# ----------------------------------------------------------------------------------------------------

	$levelObj = new ClassifiedLevel();

?>

<div id="header-form"><?=ucwords(system_showText(LANG_SITEMGR_CLASSIFIED_PLURAL))?> - <?=ucwords(system_showText(LANG_SITEMGR_SETTINGS_PRICING_DEFAULTPRICES))?></div>

<? if ($message_classifieddefaultprice) { ?>
	<div class="response-msg error ui-corner-all"><?=$message_classifieddefaultprice?></div>
<? } ?>

<table cellpadding="2" cellspacing="0" class="table-form tablePricing" border="0">

	<?
	$levelvalues = $levelObj->getLevelValues();
	foreach ($levelvalues as $levelvalue) {
		?>
		<tr>
			<td align="left" class="td-form"><div class="label-form" style="text-align:right"><?=$levelObj->showLevel($levelvalue)?>:</div></td>
			<td align="left" class="td-form">
				<input type="text" name="price[<?=$levelvalue?>]" class="input-form-classified" style="width:100px" value="<?=$levelObj->getPrice($levelvalue)?>" />
			</td>
			<td align="left" class="td-form">
				<div class="label-form" style="text-align: left;"><b>
					<?=system_showText(LANG_SITEMGR_SETTINGS_PRICING_PRICEPER)?>
					<?
					if (payment_getRenewalCycle("classified") > 1) {
						echo payment_getRenewalCycle("classified")." ";
						echo payment_getRenewalUnitName("classified")."s";
					}else {
						echo payment_getRenewalUnitName("classified");
					}
					?>
				</b></div>
			</td>
		</tr>
		<?
	}
	?>

</table>
