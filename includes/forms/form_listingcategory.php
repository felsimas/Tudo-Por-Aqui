<?
	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form_listingcategory.php
	# ----------------------------------------------------------------------------------------------------

?>

<script language="javascript" type="text/javascript" src="<?=DEFAULT_URL?>/scripts/common.js"></script>

<table cellpadding="2" cellspacing="0" class="table-form" style="margin-bottom:10px">
	<tr>
		<td colspan="2" class="table-formContent" align="justify">
			<p style="text-align: justify;"><?=system_showText(LANG_SITEMGR_CATEGORY_INFOTEXT1)?></p>
		</td>
	</tr>
	<? if ($category_id && $category_id != 0) { ?>
		<tr class="tr-form">
			<td align="right" class="td-form nowrap">
				<div class="label-form">
					<?=system_showText(LANG_SITEMGR_CATEGORY_FATHERCATEGORY)?>:
				</div>
			</td>
			<td align="left" class="td-form" style="width: 100%;">
				<span style="font-size:12px"><strong><?=$fatherCategoryObj->getString("title")?></strong></span>
				<input type="hidden" name="category_id" value="<?=$fatherCategoryObj->getNumber("id")?>" />
			</td>
		</tr>
	<? } else { ?>
		<input type="hidden" name="category_id" id="category_id" value="<?=$category_id?>" />
	<? } ?>
	<tr class="tr-form">
		<td align="right" class="td-form">
			<div class="label-form">* <?=system_showText(LANG_SITEMGR_TITLE)?>:</div>
		</td>
		<td align="left" class="td-form">
			<input type="text" name="title" class="input-form-listing" value="<?=$title?>" OnBlur="easyFriendlyUrl(this.value, 'friendly_url', '<?=FRIENDLYURL_VALIDCHARS?>', '<?=FRIENDLYURL_SEPARATOR?>');" />
		</td>
	</tr>
</table>

<table border="0" cellpadding="2" cellspacing="2" class="standard-table">
	<tr>
		<th colspan="2" class="standard-tabletitle">
			<?=system_showText(LANG_SITEMGR_KEYWORDSFORTHESEARCH)?>
		</th>
	</tr>
	<tr>
		<td colspan="2">
			<table border="0" cellpadding="0" cellspacing="0" align="center">
				<tr>
				<td class="font-view" style="font-size:11px" align="left" valign="top">
					<?=system_showText(LANG_SITEMGR_ADDONEKEYWORDPERLINE)?>. <?=system_showText(LANG_SITEMGR_FOREXAMPLE)?>:
				</td>
				<td class="font-view" style="font-size:11px" align="left">
					&nbsp;<?=system_showText(LANG_SITEMGR_KEYWORD_SAMPLE_1)?><br />
					&nbsp;<?=system_showText(LANG_SITEMGR_KEYWORD_SAMPLE_2)?><br />
					&nbsp;<?=system_showText(LANG_SITEMGR_KEYWORD_SAMPLE_3)?><br />
				</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan=2 style="text-align:center">
			<textarea name="keywords" rows="5"><?=$keywords?></textarea>
		</td>
	</tr>
</table>

<div id="header-form"><?=system_showText(LANG_SITEMGR_TODO_SEOCENTER)?></div>

<table cellpadding="2" cellspacing="0" class="table-form" border="0">
	<tr>
		<td colspan="2">
			<span class="label-login">
				<p style="text-align: justify;"><?=system_showText(LANG_SITEMGR_CATEGORY_FRIENDLYURL1)?><br /><br /><strong><?=system_showText(LANG_SITEMGR_FOREXAMPLE)?>:</strong><br /><br /><?=system_showText(LANG_SITEMGR_CATEGORY_FRIENDLYURL2)?><br />"<?=LISTING_DEFAULT_URL?>/guide/computer"<br />"<?=PROMOTION_DEFAULT_URL?>/guide/computer"<br /><br /><?=system_showText(LANG_SITEMGR_CATEGORY_FRIENDLYURL3)?><br />"<?=LISTING_DEFAULT_URL?>/guide/computer/software-development"<br />"<?=PROMOTION_DEFAULT_URL?>/guide/computer/software-development"<br /><br /><?=system_showText(LANG_SITEMGR_CATEGORY_FRIENDLYURL4)?></p>
			</span>
		</td>
	</tr>
	<tr class="tr-form">
		<td align="right" class="td-form">
			<div class="label-form">
				* <?=system_showText(LANG_SITEMGR_LABEL_FRIENDLYTITLE)?>:
			</div>
		</td>
		<td align="left" class="td-form">
			<input type="text" id="friendly_url" name="friendly_url" class="input-form-listing" value="<?=$friendly_url?>" OnBlur="easyFriendlyUrl(this.value, 'friendly_url', '<?=FRIENDLYURL_VALIDCHARS?>', '<?=FRIENDLYURL_SEPARATOR?>');" />
		</td>
	</tr>
	<tr class="tr-form">
		<td align="right" class="td-form">
			<div class="label-form"><?=system_showText(LANG_SITEMGR_LABEL_METADESCRIPTION)?>:</div>
		</td>
		<td align="left" class="td-form">
			<textarea name="seo_description" rows="5"><?=$seo_description;?></textarea>
		</td>
	</tr>
	<tr class="tr-form">
		<td align="right" class="td-form">
			<div class="label-form"><?=system_showText(LANG_SITEMGR_LABEL_METAKEYWORDS)?>:</div>
		</td>
		<td align="left" class="td-form">
			<textarea name="seo_keywords" rows="5"><?=$seo_keywords;?></textarea>
		</td>
	</tr>
</table>

<?
$array_edir_languages = explode(",", EDIR_LANGUAGES);
$array_edir_languagenames = explode(",", EDIR_LANGUAGENAMES);
if (count($array_edir_languages)>1) {
	?>
	<table border="0" cellpadding="2" cellspacing="2" class="standard-table">
		<tr>
			<th colspan="2" class="standard-tabletitle">
				<?=system_showText(LANG_SITEMGR_LANGUAGE)?> <span>(<?=system_showText(LANG_SITEMGR_LANGUAGE_SELECTAVAIBLE)?>)</span>
			</th>
		</tr>
		<?
		for ($i=0; $i<count(explode(",", EDIR_LANGUAGES)); $i++) {
			$labelsuffix = "";
			if ($i) {
				$labelsuffix = $i;
				?>
				<tr>
					<th colspan="2">&nbsp;</th>
				</tr>
				<tr>
					<th class="td-checkbox">
						<input type="checkbox" name="languages[]" value="<?=$array_edir_languages[$i];?>" class="inputCheck" <? if ($languages) if (in_array($array_edir_languages[$i], $languages)) { echo "checked"; } ?> <? if (($fatherCategoryObj->getNumber("id")) && (strpos($fatherCategoryObj->getString("lang"), $array_edir_languages[$i])) === false) { echo "disabled"; } ?> />
					</th>
					<td>
						<?=$array_edir_languagenames[$i];?>
					</td>
				</tr>
				<tr>
					<th>
						<?=system_showText(LANG_SITEMGR_TITLE)?>:
					</th>
					<td>
						<input type="text" name="title<?=$labelsuffix;?>" class="input-form-listing" value="<?=${"title".$labelsuffix};?>" OnBlur="easyFriendlyUrl(this.value, 'friendly_url<?=$labelsuffix;?>', '<?=FRIENDLYURL_VALIDCHARS?>', '<?=FRIENDLYURL_SEPARATOR?>');" />
					</td>
				</tr>
				<tr>
					<th>
						<?=system_showText(LANG_SITEMGR_KEYWORDSFORTHESEARCH)?>:
					</th>
					<td>
						<textarea name="keywords<?=$labelsuffix;?>" rows="5"><?=${"keywords".$labelsuffix}?></textarea>
					</td>
				</tr>
				<tr>
					<th>
						<?=system_showText(LANG_SITEMGR_LABEL_FRIENDLYTITLE)?> (<?=system_showText(LANG_SITEMGR_SEO)?>):
					</th>
					<td>
						<input type="text" id="friendly_url<?=$labelsuffix;?>" name="friendly_url<?=$labelsuffix;?>" class="input-form-listing" value="<?=${"friendly_url".$labelsuffix};?>" OnBlur="easyFriendlyUrl(this.value, 'friendly_url<?=$labelsuffix;?>', '<?=FRIENDLYURL_VALIDCHARS?>', '<?=FRIENDLYURL_SEPARATOR?>');" />
					</td>
				</tr>
				<tr>
					<th>
						<?=system_showText(LANG_SITEMGR_LABEL_DESCRIPTION)?> (<?=system_showText(LANG_SITEMGR_SEO)?>):
					</th>
					<td>
						<textarea name="seo_description<?=$labelsuffix;?>" rows="5"><?=${"seo_description".$labelsuffix}?></textarea>
					</td>
				</tr>
				<tr>
					<th>
						<?=system_showText(LANG_SITEMGR_LABEL_KEYWORDS)?> (<?=system_showText(LANG_SITEMGR_SEO)?>):
					</th>
					<td>
						<textarea name="seo_keywords<?=$labelsuffix;?>" rows="5"><?=${"seo_keywords".$labelsuffix}?></textarea>
					</td>
				</tr>
				<?
			} else {
				?>
				<tr>
					<th class="td-checkbox">
						<input type="checkbox" name="languages[]" value="<?=$array_edir_languages[$i];?>" class="inputCheck" <? if ($languages) if (in_array($array_edir_languages[$i], $languages)) { echo "checked"; } ?> <? if (($fatherCategoryObj->getNumber("id")) && (strpos($fatherCategoryObj->getString("lang"), $array_edir_languages[$i])) === false) { echo "disabled"; } ?> />
					</th>
					<td>
						<?=$array_edir_languagenames[$i];?><span>(<?=system_showText(LANG_SITEMGR_LANGUAGE_THISYOURDEFAULTLANGUAGE)?>)</span>
					</td>
				</tr>
				<?
			}
		}
		?>
	</table>
	<?
} else {
	?>
	<input type="hidden" name="languages[]" value="<?=$array_edir_languages[0];?>" />
	<?
}
?>
