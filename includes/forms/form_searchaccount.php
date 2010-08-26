<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form_searchaccount.php
	# ----------------------------------------------------------------------------------------------------

?>

<? if ($message_searchaccount) { ?>
	<div id="warning" class="errorMessage">
		<?=$message_searchaccount?>
	</div>
<? } ?>
<table cellpadding="2" cellspacing="0" class="table-form">
	<tr class="tr-form">
		<td align="right" class="td-form">
			<div class="label-form">
				<?=system_showText(LANG_SITEMGR_LABEL_TYPE)?>:
			</div>
		</td>
		<td align="left" class="td-form">
			<select name="search_type">
				<option value=""><?=system_showText(LANG_SITEMGR_SETTINGS_LOGINOPTION_DROPDOWN_ALL)?></option>
				<option value="directory" <? if ($search_type == "directory") { echo "selected"; } ?> >Directory</option>
				<option value="openid" <? if ($search_type == "openid") { echo "selected"; } ?> >OpenID 2.0</option>
				<option value="facebook" <? if ($search_type == "facebook") { echo "selected"; } ?> >Facebook</option>
			</select>
		</td>
	</tr>
	<tr class="tr-form">
		<td align="right" class="td-form">
			<div class="label-form">
				<?=system_showText(LANG_SITEMGR_LABEL_USERNAME)?>:
			</div>
		</td>
		<td align="left" class="td-form">
			<input type="text" name="search_username" value="<?=$search_username?>" class="input-form-searchaccount" />
		</td>
	</tr>
</table>
