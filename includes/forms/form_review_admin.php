<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form_review_admin.php
	# ----------------------------------------------------------------------------------------------------

?>

<div id="header-form">
	<?=system_showText(LANG_SITEMGR_MENU_REVIEWS)?>
</div>

<? if ($message_review_admin) { ?>
	<div id="warning" class="<?=$message_style?>">
		<?=$message_review_admin?>
	</div>
<? } ?>

<table cellpadding="2" cellspacing="0" border="0" class="table-form">
	<tr class="tr-form">
		<td align="left" class="td-form">
			<input type="checkbox" name="review_listing_enabled" id="review_listing_enabled" value="on" <?=$review_listing_enabled_checked?>  class="inputCheck" />
		</td>
		<td>
			<div class="label-form" align="left"><label for="review_listing_enabled"><?=system_showText(LANG_SITEMGR_SETTINGS_REVIEW_CHECKTHISBOXTOENABLE_LISTING)?></label></div>
		</td>
	</tr>
	<tr class="tr-form">
		<td align="left" class="td-form">
			<input type="checkbox" name="review_article_enabled" id="review_article_enabled" value="on" <?=$review_article_enabled_checked?>  class="inputCheck" />
		</td>
		<td>
			<div class="label-form" align="left"><label for="review_article_enabled"><?=system_showText(LANG_SITEMGR_SETTINGS_REVIEW_CHECKTHISBOXTOENABLE_ARTICLE)?></label></div>
		</td>
	</tr>
</table>
