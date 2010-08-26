<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form_content_footer.php
	# ----------------------------------------------------------------------------------------------------

?>

<table class="standard-table">
	<tr>
		<th colspan="2" class="standard-tabletitle"><?=ucwords(system_showText(LANG_SITEMGR_CONTENT_FOOTERINFORMATION))?></th>
	</tr>
</table>
<table class="standard-table">
	<tr>
		<th><?=system_showText(LANG_SITEMGR_LANGUAGE)?>:</th>
		<td>
		<?=language_writeComboLang('lang', $lang, 'changeComboLang (this.value)'); ?>
		</td>
	</tr>
	<tr>
		<th><?=system_showText(LANG_SITEMGR_LABEL_COPYRIGHTTEXT)?>:</th>
		<td><input type="text" name="copyright" value="<?=$copyright?>" maxlength="255" /><br /></td>
	</tr>
</table>