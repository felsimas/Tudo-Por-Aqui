<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form_promotion_conditions.php
	# ----------------------------------------------------------------------------------------------------

?>

<br />

<div id="header-form">
	<?=ucwords(system_showText(LANG_SITEMGR_PROMOTION))?> - <?=ucwords(system_showText(LANG_SITEMGR_OPTIONS))?>
</div>

<? if ($message_promotion_conditions) { ?>
	<div id="warning" class="<?=$message_style?>">
		<?=$message_promotion_conditions?>
	</div>
<? } ?>

<table cellpadding="2" cellspacing="0" border="0" class="standard-table">
	<tr class="tr-form">
		<th colspan="2" class="standard-tabletitle">
			<?=ucwords(system_showText(LANG_SITEMGR_SETTINGS_PROMOTION_DEFAULTCONDITIONTEXT))?>
		</th>
	</tr>
	<tr>
		<th><?=system_showText(LANG_SITEMGR_SETTINGS_PROMOTION_CONDITIONS)?><br /><input readonly type="text" name="condLen" size="3" maxlength="3" value="<?=(250-strlen($promotion_default_conditions)); ?>" class="textcounter" />&nbsp;<span><?=system_showText(LANG_SITEMGR_CHARACTERSLEFT)?></span></th>
		<td>
			<textarea name="promotion_default_conditions" rows="5" onKeyDown="textCounter(this.form.promotion_default_conditions,this.form.condLen,250);" onKeyUp="textCounter(this.form.promotion_default_conditions,this.form.condLen,250);" class="input-textarea-form-listing"><?=$promotion_default_conditions?></textarea>
		</td>
	</tr>
</table>