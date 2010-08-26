<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form_listing_seocenter.php
	# ----------------------------------------------------------------------------------------------------

	if ($message) {
		echo "<p class='errorMessage'>";
			echo $message;
		echo "</p>";
	}

?>

<table cellpadding="0" cellspacing="0" border="0" class="standard-table">
	<tr>
		<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_LABEL_SEO_TUNING)?> <?=system_showText(LANG_LABEL_TITLE)?></th>
	</tr>
	<tr>
		<th><?=system_showText(LANG_LABEL_TITLE)?>:</th>
		<td>
			<input type="text" name="seo_title" value="<?=$seo_title?>" maxlength="100" onBlur="easyFriendlyUrl(this.value, 'friendly_url', '<?=FRIENDLYURL_VALIDCHARS?>', '<?=FRIENDLYURL_SEPARATOR?>');" />
		</td>
	</tr>
</table>

<table cellpadding="0" cellspacing="0" border="0" class="standard-table">
	<tr>
		<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_LABEL_FRIENDLY_URL)?></th>
	</tr>
	<tr>
		<td colspan="2" class="standard-tableContent">
			<?=system_showText(LANG_MSG_FRIENDLY_URL1)?><br /><br /><strong><?=system_showText(LANG_LABEL_FOR_EXAMPLE);?>:</strong><br /><br /><?=system_showText(LANG_MSG_FRIENDLY_URL2)?><br />"<?=LISTING_DEFAULT_URL?>/john-auto-repair.html"
		</td>
	</tr>
	<tr>
		<th><?=system_showText(LANG_LABEL_PAGE_NAME)?>:</th>
		<td>
			<input type="text" name="friendly_url" id="friendly_url" value="<?=$friendly_url?>" maxlength="150" onBlur="easyFriendlyUrl(this.value, 'friendly_url', '<?=FRIENDLYURL_VALIDCHARS?>', '<?=FRIENDLYURL_SEPARATOR?>');" />
		</td>
	</tr>
</table>

<table cellpadding="0" cellspacing="0" border="0" class="standard-table">
	<tr>
		<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_SEO_DESCRIPTION)?></th>
	</tr>
	<?
	$array_edir_languagenames = explode(",", EDIR_LANGUAGENAMES);
	for ($i=0; $i<count(explode(",", EDIR_LANGUAGES)); $i++) {
		$labelsuffix = "";
		if ($i) $labelsuffix = $i;
		?>
		<tr>
			<th><?=((count(explode(",", EDIR_LANGUAGES))>1)?($array_edir_languagenames[$i].":"):("&nbsp;"));?></th>
			<td>
				<textarea name="seo_description<?=$labelsuffix;?>" rows="5"><?=${"seo_description".$labelsuffix};?></textarea>
			</td>
		</tr>
		<?
	}
	?>
</table>

<table cellpadding="0" cellspacing="0" border="0" class="standard-table">
	<tr>
		<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_SEO_KEYWORDS)?></th>
	</tr>
	<?
	$array_edir_languagenames = explode(",", EDIR_LANGUAGENAMES);
	for ($i=0; $i<count(explode(",", EDIR_LANGUAGES)); $i++) {
		$labelsuffix = "";
		if ($i) $labelsuffix = $i;
		?>
		<tr>
			<th><?=((count(explode(",", EDIR_LANGUAGES))>1)?($array_edir_languagenames[$i].":"):("&nbsp;"));?></th>
			<td>
				<textarea name="seo_keywords<?=$labelsuffix;?>" rows="5"><?=${"seo_keywords".$labelsuffix}?></textarea>
			</td>
		</tr>
		<?
	}
	?>
</table>
