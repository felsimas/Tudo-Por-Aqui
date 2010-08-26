<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form_promotion_seocenter.php
	# ----------------------------------------------------------------------------------------------------

	if ($message) {
		echo "<p class='errorMessage'>";
			echo $message;
		echo "</p>";
	}

?>

<table border="0" cellpadding="2" cellspacing="0" class="standard-table">
	<tr>
		<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_LABEL_SEO_TUNING)?> <?=system_showText(LANG_LABEL_TITLE)?></th>
	</tr>
	<tr>
		<th><?=system_showText(LANG_LABEL_TITLE)?>:</th>
		<td>
			<input type="text" name="seo_name" value="<?=$seo_name?>" class="inputExplode">
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
