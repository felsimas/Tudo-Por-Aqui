<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form_review_sitemgr.php
	# ----------------------------------------------------------------------------------------------------

?>
<? if ($message_review) { ?><p class="errorMessage"><?=$message_review?></p><? } ?> 
<input type="hidden" name="rating" id="rating" value="" />
<input type="hidden" name="item_type" value="<?=$item_type?>" />
<input type="hidden" name="item_id" value="<?=$item_id?>" />
<? if ($filter_id) { ?>
<input type="hidden" name="filter_id" value="1" />
<? } ?>
<table border="0" cellpadding="0" cellspacing="0" class="standard-table">
	<tr>
		<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_SITEMGR_REVIEW_REVIEWINFORMATION)?></th>
	</tr>
	<tr>
		<td align="center" colspan="2" style="width: auto;">
			<? 
			###### Keep the IMG's tags together ! #######
			?>
			<center><b><?=system_showText(LANG_SITEMGR_REVIEW_RATEIT)?>:</b>
			<img align="absmiddle" border="0" style="padding-right: 1px; cursor:pointer" src="<?=DEFAULT_URL?>/images/starno.gif" onclick="setRatingLevel(1)" onmouseout="resetRatingLevel()" onmouseover="setDisplayRatingLevel(1)" name="star1" alt="<?=system_showText(LANG_SITEMGR_REVIEW_STAR)?>" /><img align="absmiddle" border="0" style="padding-right: 1px; cursor:pointer" src="<?=DEFAULT_URL?>/images/starno.gif" onclick="setRatingLevel(2)" onmouseout="resetRatingLevel()" onmouseover="setDisplayRatingLevel(2)" name="star2" alt="<?=system_showText(LANG_SITEMGR_REVIEW_STAR)?>" /><img align="absmiddle" border="0" style="padding-right: 1px; cursor:pointer" src="<?=DEFAULT_URL?>/images/starno.gif" onclick="setRatingLevel(3)" onmouseout="resetRatingLevel()" onmouseover="setDisplayRatingLevel(3)" name="star3" alt="<?=system_showText(LANG_SITEMGR_REVIEW_STAR)?>" /><img align="absmiddle" border="0" style="padding-right: 1px; cursor:pointer" src="<?=DEFAULT_URL?>/images/starno.gif" onclick="setRatingLevel(4)" onmouseout="resetRatingLevel()" onmouseover="setDisplayRatingLevel(4)" name="star4" alt="<?=system_showText(LANG_SITEMGR_REVIEW_STAR)?>" /><img align="absmiddle" border="0" style="padding-right: 1px; cursor:pointer" src="<?=DEFAULT_URL?>/images/starno.gif" onclick="setRatingLevel(5)" onmouseout="resetRatingLevel()" onmouseover="setDisplayRatingLevel(5)" name="star5" alt="<?=system_showText(LANG_SITEMGR_REVIEW_STAR)?>" />
			</center>
			
		</td>
	</tr>
	<tr>
		<th><?=system_showText(LANG_SITEMGR_LABEL_NAME)?>:</th>
		<td><input type="text" name="reviewer_name" value="<?=$reviewer_name?>" maxlength="50" class="input-form-rate" /></td>
	</tr>
	<tr>
		<th><?=system_showText(LANG_SITEMGR_LABEL_EMAIL)?>:</th>
		<td><input type="text" name="reviewer_email" value="<?=$reviewer_email?>" maxlength="100" class="input-form-rate" /></td>
	</tr>
	<tr>
		<th><?=system_showText(LANG_SITEMGR_LABEL_CITY_STATE)?>:</th>
		<td><input type="text" name="reviewer_location" value="<?=$reviewer_location?>" maxlength="50" class="input-form-rate" /></td>
	</tr>
	<tr>
		<th><?=system_showText(LANG_SITEMGR_TITLE)?>:</th>
		<td><input type="text" name="review_title" value="<?=$review_title?>" maxlength="50" class="input-form-rate" /></td>
	</tr>
	<tr>
		<th><?=system_showText(LANG_SITEMGR_LABEL_COMMENT)?>:</th>
		<td><textarea name="review" class="input-textarea-form-rate" rows="5"><?=$review?></textarea></td>
	</tr>
</table>
<? if (strpos($url_base, "/gerenciamento")){ ?>
<script>
	setRatingLevel(<?=$rating?>);
	setDisplayRatingLevel(<?=$rating?>);
</script>
<? }?>