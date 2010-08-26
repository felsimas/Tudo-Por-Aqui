<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form_foreignaccount.php
	# ----------------------------------------------------------------------------------------------------

?>

<div id="header-form">
	<?=system_showText(LANG_SITEMGR_MENU_LOGINOPTIONS)?>
</div>

<? if ($message_foreignaccount) { ?>
	<div id="warning" class="<?=$message_style?>">
		<?=$message_foreignaccount?>
	</div>
<? } ?>

<br />

<table cellpadding="2" cellspacing="0" border="0" class="table-form">
	<tr class="tr-form">
		<td align="right" class="td-form">
			<input type="checkbox" name="foreignaccount_openid" id="foreignaccount_openid" value="on" <?=$foreignaccount_openid_checked?>  class="inputCheck" />
		</td>
		<td>
			<div class="label-form" align="left"><label for="foreignaccount_openid"><?=system_showText(LANG_SITEMGR_SETTINGS_LOGINOPTION_CHECKTHISBOXTOENABLEOPENID)?></label></div>
		</td>
	</tr>
	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>
	<tr class="tr-form">
		<td align="right" class="td-form">
			<input type="checkbox" name="foreignaccount_facebook" id="foreignaccount_facebook" value="on" <?=$foreignaccount_facebook_checked?>  class="inputCheck" />
		</td>
		<td>
			<div class="label-form" align="left"><label for="foreignaccount_facebook"><?=system_showText(LANG_SITEMGR_SETTINGS_LOGINOPTION_CHECKTHISBOXTOENABLEFACEBOOK)?></label></div>
		</td>
	</tr>
	<tr class="tr-form">
		<td align="left" class="td-form">
			<?=system_showText(LANG_SITEMGR_SETTINGS_LOGINOPTION_FACEBOOKAPIKEY)?>:
		</td>
		<td>
			<input type="text" name="foreignaccount_facebook_apikey" value="<?=$foreignaccount_facebook_apikey?>" />
		</td>
	</tr>
</table>
