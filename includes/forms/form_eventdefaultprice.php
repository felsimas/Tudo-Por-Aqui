<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form_eventdefaultprice.php
	# ----------------------------------------------------------------------------------------------------

	$levelObj = new EventLevel();

?>

<div id="header-form"><?=system_showText(LANG_SITEMGR_NAVBAR_EVENT)?> - <?=ucwords(system_showText(LANG_SITEMGR_SETTINGS_PRICING_DEFAULTPRICES))?></div>

<? if ($message_eventdefaultprice) { ?>
	<div class="response-msg error ui-corner-all"><?=$message_eventdefaultprice?></div>
<? } ?>

<table cellpadding="2" cellspacing="0" class="table-form tablePricing" border="0">

	<tr class="tr-form">
		<td align="center" class="td-form" width="16">&nbsp;</td>
		<td align="center" class="td-form"><div class="label-form" style="text-align: left;"><b>
			<?=system_showText(LANG_SITEMGR_SETTINGS_PRICING_PRICEPER)?>
			<?
			if (payment_getRenewalCycle("event") > 1) {
				echo payment_getRenewalCycle("event")." ";
				echo payment_getRenewalUnitName("event")."s";
			}else {
				echo payment_getRenewalUnitName("event");
			}
			?>
		</b></div></td>
	</tr>

	<?
	$levelvalues = $levelObj->getLevelValues();
	foreach ($levelvalues as $levelvalue) {
		?>
		<tr>
			<td align="left" class="td-form"><div class="label-form" style="text-align:right"><?=$levelObj->showLevel($levelvalue)?>:</div></td>
			<td align="left" class="td-form">
				<input type="text" name="price[<?=$levelvalue?>]" class="input-form-event" style="width:100px" value="<?=$levelObj->getPrice($levelvalue)?>" />
			</td>
		</tr>
		<?
	}
	?>

</table>
