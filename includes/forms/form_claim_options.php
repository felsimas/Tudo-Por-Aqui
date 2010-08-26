<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form_claim_options.php
	# ----------------------------------------------------------------------------------------------------

?>

<br />

<div id="header-form">
	<?=system_showText(LANG_SITEMGR_NAVBAR_OPTIONS)?>
</div>

<? if ($message_claim_options) { ?>
	<div id="warning" class="<?=$message_style?>">
		<?=$message_claim_options?>
	</div>
<? } ?>

<table cellpadding="2" cellspacing="0" border="0" class="table-form">
	<tr class="tr-form">
		<td align="right" class="td-form">
			<input type="checkbox" name="claim_approve" value="on" <?=$claim_approve_checked?> class="inputCheck" />
		</td>
		<td>
			<div class="label-form" align="left"><?=system_showText(LANG_SITEMGR_SETTINGS_CLAIM_SITEMGRMUSTAPPROVE)?></div>
		</td>
	</tr>
	<tr class="tr-form">
		<td align="right" class="td-form">
			<input type="checkbox" name="claim_deny" value="on" <?=$claim_deny_checked?> class="inputCheck" />
		</td>
		<td>
			<div class="label-form" align="left"><?=system_showText(LANG_SITEMGR_SETTINGS_CLAIM_AFTERDENIED)?></div>
		</td>
	</tr>
	<tr class="tr-form">
		<td align="right" class="td-form">
			<input type="checkbox" name="claim_approveemail" value="on" <?=$claim_approveemail_checked?> class="inputCheck" />
		</td>
		<td>
			<div class="label-form" align="left"><?=system_showText(LANG_SITEMGR_SETTINGS_CLAIM_SENDEMAILLISTINGOWNER_ISAPPROVED)?></div>
		</td>
	</tr>
	<tr class="tr-form">
		<td align="right" class="td-form">
			<input type="checkbox" name="claim_denyemail" value="on" <?=$claim_denyemail_checked?> class="inputCheck" />
		</td>
		<td>
			<div class="label-form" align="left"><?=system_showText(LANG_SITEMGR_SETTINGS_CLAIM_SENDEMAILLISTINGOWNER_ISDENIED)?></div>
		</td>
	</tr>
	<tr class="tr-form">
		<th align="right">
			<?=system_showText(LANG_SITEMGR_LANGUAGE)?>:
		</th>
		<td>
		   <?=language_writeComboLang('lang', $lang, 'changeComboLang (this.value)')?>
		</td>
	</tr>
	<tr class="tr-form">
		<th align="right">
			<?=system_showText(LANG_SITEMGR_SETTINGS_CLAIM_CLAIMTEXTLINK)?>
		</th>
		<td>
			<input type="text" name="claim_textlink" value="<?=$claim_textlink?>" maxlength="50" />
		</td>
	</tr>
</table>