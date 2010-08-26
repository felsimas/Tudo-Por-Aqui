<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form_content_noimage.php
	# ----------------------------------------------------------------------------------------------------

?>

<table class="standard-table">
	<tr>
		<div class="tip-base"><p style="text-align: left;"><a href="<?=DEFAULT_URL;?>/gerenciamento/faq.php?keyword=<?=urlencode("no image");?>" target="_blank"><?=system_showText(LANG_SITEMGR_CONTENT_FAQTITLE)?></a></p></div>
		<br>
		<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_SITEMGR_CONTENT_NOIMAGE)?> <span> (JPG <?=system_showText(LANG_OR);?> GIF)</span></th>
	</tr>
	<tr>
		<th><?=system_showText(LANG_SITEMGR_LABEL_IMAGESOURCE)?>:</th>
		<td><input type="file" name="noimage_image" size="50" /><span><?=system_showText(LANG_SITEMGR_MSGMAXFILESIZE)?> <?=UPLOAD_MAX_SIZE;?> MB.</span></td>
	</tr>
</table>
<table border="0" cellpadding="2" cellspacing="2" class="standard-table">
	<tr>
		<td colspan="2" style="padding-left: 40px;">
			<input type="checkbox" class="standard-table-putradio" name="restore_image" value="1" style="width:auto;" /> <?=system_showText(LANG_SITEMGR_CONTENT_CHECKBOX_RESTORENOIMAGE)?>
		</td>
	</tr>
</table>
