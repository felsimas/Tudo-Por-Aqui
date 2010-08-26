<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form_articledefaultprice.php
	# ----------------------------------------------------------------------------------------------------

	$levelObj = new ArticleLevel();

?>

<div id="header-form"><?=ucwords(system_showText(LANG_SITEMGR_ARTICLE_PLURAL))?> - <?=ucwords(system_showText(LANG_SITEMGR_SETTINGS_PRICING_DEFAULTPRICES))?></div>

<? if ($message_articledefaultprice) { ?>
	<div class="response-msg error ui-corner-all"><?=$message_articledefaultprice?></div>
<? } ?>

<table cellpadding="2" cellspacing="0" class="table-form tablePricing" border="0">

	<?
	$levelvalues = $levelObj->getLevelValues();
	foreach ($levelvalues as $levelvalue) {
		?>
		<tr>
			<td align="left" class="td-form"><div class="label-form" style="text-align:right"><?=$levelObj->showLevel($levelvalue)?>:</div></td>
			<td align="left" class="td-form">
				<input type="text" name="price[<?=$levelvalue?>]" class="input-form-article" style="width:100px" value="<?=$levelObj->getPrice($levelvalue)?>" />
			</td>
			<td align="left" class="td-form">
				<div class="label-form" style="text-align: left;"><b>
					<?=system_showText(LANG_SITEMGR_SETTINGS_PRICING_PRICEPER)?>
					<?
					if (payment_getRenewalCycle("article") > 1) {
						echo payment_getRenewalCycle("article")." ";
						echo payment_getRenewalUnitName("article")."s";
					}else {
						echo payment_getRenewalUnitName("article");
					}
					?>
				</b></div>
			</td>
		</tr>
		<?
	}
	?>

</table>
