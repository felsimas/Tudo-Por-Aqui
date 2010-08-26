<?
	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form_promotion.php
	# ----------------------------------------------------------------------------------------------------

?>

<script language="javascript" type="text/javascript" src="<?=DEFAULT_URL?>/scripts/common.js"></script>

<? // Account Search Javascript /////////////////////////////////////////////////////// ?>
<script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/accountsearch.js"></script>
<? //////////////////////////////////////////////////////////////////////////////////// ?>

<div class="response-msg notice ui-corner-all"><span>* <?=system_showText(LANG_LABEL_REQUIRED_FIELD)?> </span></div>
<?
if ($message_promotion) { 
	echo "<div class=\"response-msg error ui-corner-all\"><span>";
	echo $message_promotion ;
	echo "</span></div>";
}
?>

<? // Account Search ////////////////////////////////////////////////////////////////// ?>
<? if (!$membros && !$listing_id) { ?>


	<?
	$acct_search_table_title = system_showText(LANG_SITEMGR_ACCOUNTSEARCH_SELECT)." ".system_showText(LANG_SITEMGR_PROMOTION);
	$acct_search_field_name = "account_id";
	$acct_search_field_value = $account_id;
	$acct_search_required_mark = false;
	$acct_search_form_width = "95%";
	$acct_search_cell_width = "";
	$return = system_generateAjaxAccountSearch($acct_search_table_title, $acct_search_field_name, $acct_search_field_value, $acct_search_required_mark, $acct_search_form_width, $acct_search_cell_width);
	echo $return;
	?>

<? } ?>
<? //////////////////////////////////////////////////////////////////////////////////// ?>

<table border="0" cellpadding="2" cellspacing="0" class="standard-table">

	<tr>
		<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_LABEL_INFORMATION);?></th>
	</tr>

	<tr>
		<th>* <?=system_showText(LANG_LABEL_HEADLINE);?>:</th>
		<td><input type="text" name="name" value="<?=$name?>" class="inputExplode"></td>
	</tr>

	<?
	$array_edir_languagenames = explode(",", EDIR_LANGUAGENAMES);
	for ($i=0; $i<count(explode(",", EDIR_LANGUAGES)); $i++) {
		$labelsuffix = "";
		if ($i) $labelsuffix = $i;
		?>
		<tr>
			<th><? if (!$i) echo "*"; ?> <?=system_showText(LANG_LABEL_OFFER);?><?=((count(explode(",", EDIR_LANGUAGES))>1)?(" (".$array_edir_languagenames[$i]."):"):(":"));?></th>
			<td><textarea name="offer<?=$labelsuffix;?>" class="input-textarea-form-listing"><?=${"offer".$labelsuffix}?></textarea></td>
		</tr>
		<?
	}
	?>

	<tr>
		<th colspan="2" class="standard-tabletitle">
			<?=system_showText(LANG_LABEL_DESCRIPTION)?> <span>(<?=strtolower(system_showText(LANG_MSG_MAX_250_CHARS))?>)</span>
		</th>
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
				<textarea name="description<?=$labelsuffix;?>" rows="5" onKeyDown="textCounter(this.form.description<?=$labelsuffix;?>,this.form.remLen<?=$labelsuffix;?>,250);" onKeyUp="textCounter(this.form.description<?=$labelsuffix;?>,this.form.remLen<?=$labelsuffix;?>,250);" class="input-textarea-form-listing"><?=${"description".$labelsuffix};?></textarea>
				<? $total = strlen(html_entity_decode(${"description".$labelsuffix})); ?>
				<span><input readonly type="text" name="remLen<?=$labelsuffix;?>" size="3" maxlength="3" value="<?=250-$total?>" class="textcounter" /> <?=system_showText(LANG_MSG_CHARS_LEFT)?> <?=system_showText(LANG_MSG_INCLUDING_SPACES_LINE_BREAKS)?></span>
			</td>
		</tr>
		<?
	}
	?>

	<tr>
		<th colspan="2" class="standard-tabletitle">
			<?=system_showText(LANG_LABEL_CONDITIONS)?> <span>(<?=strtolower(system_showText(LANG_MSG_MAX_250_CHARS))?>)</span>
		</th>
	</tr>
	<?
	$array_edir_languagenames = explode(",", EDIR_LANGUAGENAMES);
	for ($i=0; $i<count(explode(",", EDIR_LANGUAGES)); $i++) {
		$labelsuffix = "";
		if ($i) $labelsuffix = $i;
		//if (!${"conditions".$labelsuffix}) customtext_get("promotion_default_conditions", ${"conditions".$labelsuffix});
		?>
		<tr>
			<th><?=((count(explode(",", EDIR_LANGUAGES))>1)?($array_edir_languagenames[$i].":"):("&nbsp;"));?></th>
			<td>
				<textarea name="conditions<?=$labelsuffix;?>" rows="5" onKeyDown="textCounter(this.form.conditions<?=$labelsuffix;?>,this.form.condLen<?=$labelsuffix;?>,250);" onKeyUp="textCounter(this.form.conditions<?=$labelsuffix;?>,this.form.condLen<?=$labelsuffix;?>,250);" class="input-textarea-form-listing"><?=${"conditions".$labelsuffix};?></textarea>
				<? $total = strlen(html_entity_decode(${"conditions".$labelsuffix})); ?>
				<span><input readonly type="text" name="condLen<?=$labelsuffix;?>" size="3" maxlength="3" value="<?=250-$total?>" class="textcounter" /> <?=system_showText(LANG_MSG_CHARS_LEFT)?> <?=system_showText(LANG_MSG_INCLUDING_SPACES_LINE_BREAKS)?></span>
			</td>
		</tr>
		<?
	}
	?>

</table>

<table cellpadding="0" cellspacing="0" border="0" class="standard-table">
	<tr>
		<th colspan="2" class="standard-tabletitle">
			<?=system_showText(LANG_LABEL_KEYWORDS_FOR_SEARCH)?> <span>(<?=system_showText(LANG_LABEL_MAX);?> <?=MAX_KEYWORDS?> <?=system_showText(LANG_LABEL_KEYWORDS);?>)</span>
			<img src="<?=DEFAULT_URL?>/images/icon_interrogation.gif" alt="?" title="<?=system_showText(LANG_MSG_INCLUDE_UP_TO_KEYWORDS)?> <?=MAX_KEYWORDS?> <?=system_showText(LANG_MSG_KEYWORDS_WITH_MAXIMUM_50)?>" border="0" />
		</th>
	</tr>
	<tr>
		<td colspan="2" class="standard-tableContent">
			<table border="0" cellpadding="0" cellspacing="0" align="center">
				<tr>
					<th><?=system_showText(LANG_MSG_KEYWORD_PER_LINE)?></th>
					<td>
						<?=system_showText(LANG_KEYWORD_SAMPLE_1);?><br />
						<?=system_showText(LANG_KEYWORD_SAMPLE_2);?><br />
						<?=system_showText(LANG_KEYWORD_SAMPLE_3);?><br />
					</td>
				</tr>
			</table>
		</td>
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
				<textarea name="keywords<?=$labelsuffix;?>" rows="5"><?=${"keywords".$labelsuffix}?></textarea>
			</td>
		</tr>
		<?
	}
	?>
</table>

<table border="0" cellpadding="2" cellspacing="0" class="standard-table">

	<tr>
		<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_LABEL_PROMOTION_DATE)?></th>
	</tr>

	<tr>
		<th class="alignTop">* <?=system_showText(LANG_LABEL_START_DATE)?>:</th>
		<td>
			<input type="text" name="start_date" value="<?=$start_date?>" style="width:85px" /><a href="javascript:cal_start.popup();" title=""<?=system_showText(LANG_MSG_CLICK_TO_SELECT_DATE)?>""><img src="<?=DEFAULT_URL?>/images/calendar/cal.gif" alt="<?=system_showText(LANG_LABEL_CALENDAR)?>" title="<?=system_showText(LANG_LABEL_CALENDAR)?>" border="0" class="iconAlign" /></a><span> (<?=format_printDateStandard()?>)</span>
		</td>
	</tr>

	<tr>
		<th class="alignTop">* <?=system_showText(LANG_LABEL_END_DATE)?>:</th>
		<td>
			<input type="text" name="end_date" value="<?=$end_date?>" style="width:85px" /><a href="javascript:cal_end.popup();" title=""<?=system_showText(LANG_MSG_CLICK_TO_SELECT_DATE)?>""><img src="<?=DEFAULT_URL?>/images/calendar/cal.gif" alt="<?=system_showText(LANG_LABEL_CALENDAR)?>" title="<?=system_showText(LANG_LABEL_CALENDAR)?>" border="0" class="iconAlign" /></a><span> (<?=format_printDateStandard()?>)</span>
		</td>
	</tr>

	<tr>
		<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_LABEL_PROMOTION_LAYOUT)?></th>
	</tr>

	<tr>
		<th><?=system_showText(LANG_LABEL_PRINTABLE_PROMOTION)?>:</th>
		<td>
			<table border="0" cellpadding="0" cellspacing="0" style="width: auto">
				<tr>
					<td style="width: auto;"><input type="radio" name="html" value="yes" checked="checked" class="inputRadio" /></td>
					<td style="width:450px;"><strong><?=system_showText(LANG_LABEL_OUR_HTML_TEMPLATE_BASED)?></strong><span><?=system_showText(LANG_LABEL_FILL_FIELDS_ABOVE)?></span></td>
				</tr>
				<tr>
					<td style="width: auto;"><input type="radio" name="html" value="no" <? if ($html == "no") echo "checked=\"checked\""?> class="inputRadio" /></td>
					<td style="width:450px;"><strong><?=system_showText(LANG_LABEL_PROMOTION_PROVIDED_BY_YOU)?></strong><span><?=system_showText(LANG_LABEL_JPG_GIF_IMAGE);?> (<?=IMAGE_PROMOTION_FULL_WIDTH;?>px X <?=IMAGE_PROMOTION_FULL_HEIGHT;?>px)</span></td>
				</tr>
			</table>
		</td>
	</tr>

	<? 
	if ($thumb_id) {
		$imageObj = new Image($thumb_id);
		if ($imageObj->imageExists()) {
			?>
			<tr>
				<td class="image-space" colspan="2">
					<?=$imageObj->getTag(true, IMAGE_PROMOTION_THUMB_WIDTH, IMAGE_PROMOTION_THUMB_HEIGHT, $name);?>
				</td>
			</tr>
			<?
		}
	}
	?>

	<? if ($thumb_id) { ?>
		<tr>
			<td colspan="2" align="left">
				<input type="checkbox" name="remove_image" class="inputCheck" value="1" style="vertical-align:middle;" /> <?=system_showText(LANG_MSG_CHECK_TO_REMOVE_IMAGE)?>
			</td>
		</tr>
	<? } ?>

	<tr>
		<th><?=system_showText(LANG_LABEL_IMAGE_SOURCE)?>:<br /><br /></th>
		<td>
			<input type="file" name="image" size="50" /><span><?=system_showText(LANG_MSG_MAX_FILE_SIZE)?> <?=UPLOAD_MAX_SIZE;?> MB. <?=system_showText(LANG_MSG_TRANSPARENTGIF_NOT_SUPPORTED);?>.</span>
			<input type="hidden" name="image_id" value="<?=$image_id?>" />
		</td>
	</tr>

</table>
