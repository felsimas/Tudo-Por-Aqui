<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form_content_header.php
	# ----------------------------------------------------------------------------------------------------

?>

<table border="0" cellpadding="2" cellspacing="0" class="standard-table">
	<tr>
		<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_SITEMGR_CONTENT_HEADERLOGO)?>&nbsp;<span>(JPG <?=system_showText(LANG_OR);?> GIF)</span></th>
	</tr>
	<tr>
		<th class="alignTop" rowspan="2"><?=system_showText(LANG_SITEMGR_LABEL_IMAGESOURCE)?>:</th>
		<td><input type="file" name="header_image" size="50" /><span><?=system_showText(LANG_SITEMGR_MSGMAXFILESIZE)?> <?=UPLOAD_MAX_SIZE;?> MB.</span></td>
	</tr>
	<tr>
		<td>
			<?
			if (file_exists(EDIRECTORY_ROOT.IMAGE_HEADER_PATH)) {
				$headerlogo_path = IMAGE_HEADER_PATH;
			} else {
				$headerlogo_path = "/images/content/logo.png";
			}
			$headerlogo_width  = 0;
			$headerlogo_height = 0;
			$headerlogo_info = @getimagesize(EDIRECTORY_ROOT."/".$headerlogo_path);
			if (count($headerlogo_info)) {
				$width  = $headerlogo_info[0];
				$height = $headerlogo_info[1];
			} else {
				$width  = IMAGE_HEADER_WIDTH;
				$height = IMAGE_HEADER_HEIGHT;
			}
			image_getNewDimension((IMAGE_HEADER_WIDTH/2), (IMAGE_HEADER_HEIGHT/2), $width, $height, $headerlogo_width, $headerlogo_height);
			?>
			<img src="<?=DEFAULT_URL.$headerlogo_path?>" width="<?=$headerlogo_width?>" height="<?=$headerlogo_height?>" border="0" />
		</td>
	</tr>
	<tr>
		<th><input type="checkbox" class="standard-table-putradio" name="restore_image" value="1" style="width:auto;border:0;" /></th>
		<td><?=system_showText(LANG_SITEMGR_CONTENT_CHECKBOX_RESTOREDEFAULTIMAGE)?></td>
	</tr>
</table>

<table border="0" cellpadding="2" cellspacing="0" class="standard-table">
	<tr>
		<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_SITEMGR_CONTENT_RSSLOGO)?>&nbsp;<span>( <?=RSS_LOGO_WIDTH?>px x <?=RSS_LOGO_HEIGHT?>px ) (JPG <?=system_showText(LANG_OR);?> GIF)</span></th>
	</tr>
	<tr>
		<th class="alignTop" rowspan="2"><?=system_showText(LANG_SITEMGR_LABEL_IMAGESOURCE)?>:</th>
		<td><input type="file" name="rss_logo" size="50" /><span><?=system_showText(LANG_SITEMGR_MSGMAXFILESIZE)?> <?=UPLOAD_MAX_SIZE;?> MB.</span></td>
	</tr>
	<tr>
		<td colspan="2">
			<?
			if (file_exists(EDIRECTORY_ROOT.RSS_LOGO_PATH)) {
				$rsslogo_path = RSS_LOGO_PATH;
			} else {
				$rsslogo_path = "/images/content/logo.png";
			}
			$rsslogo_width  = 0;
			$rsslogo_height = 0;
			$rsslogo_info = @getimagesize(EDIRECTORY_ROOT."/".$rsslogo_path);
			if (count($rsslogo_info)) {
				$width  = $rsslogo_info[0];
				$height = $rsslogo_info[1];
			} else {
				$width  = RSS_LOGO_WIDTH;
				$height = RSS_LOGO_HEIGHT;
			}
			image_getNewDimension((RSS_LOGO_WIDTH/2), (RSS_LOGO_HEIGHT/2), $width, $height, $rsslogo_width, $rsslogo_height);
			?>
			<img src="<?=DEFAULT_URL.$rsslogo_path?>" width="<?=$rsslogo_width?>" height="<?=$rsslogo_height?>" border="0" />
		</td>
	</tr>
	<tr>
		<th><input type="checkbox" class="standard-table-putradio" name="restore_logo_rrs" value="1" style="width:auto;border:0;" /></th>
		<td><?=system_showText(LANG_SITEMGR_CONTENT_CHECKBOX_RESTOREDEFAULTLOGO)?></td>
	</tr>
</table>

<table border="0" cellpadding="2" cellspacing="0" class="standard-table">
    <tr>
        <th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_SITEMGR_CONTENT_MOBILELOGO)?>&nbsp;<span>( <?=MOBILE_LOGO_WIDTH?>px x <?=MOBILE_LOGO_HEIGHT?>px ) (JPG <?=system_showText(LANG_OR);?> GIF)</span></th>
    </tr>
    <tr>
        <th class="alignTop" rowspan="2"><?=system_showText(LANG_SITEMGR_LABEL_IMAGESOURCE)?>:</th>
        <td><input type="file" name="mobile_logo" size="50" /><span><?=system_showText(LANG_SITEMGR_MSGMAXFILESIZE)?> <?=UPLOAD_MAX_SIZE;?> MB.</span></td>
    </tr>
    <tr>
        <td colspan="2">
            <?
            if (file_exists(EDIRECTORY_ROOT.MOBILE_LOGO_PATH)) {
                $mobilelogo_path = MOBILE_LOGO_PATH;
            } else {
                $mobilelogo_path = "/images/content/img_logo_mobile.gif";
            }
            $mobilelogo_width  = 0;
            $mobilelogo_height = 0;
            $mobilelogo_info = @getimagesize(EDIRECTORY_ROOT."/".$mobilelogo_path);
            if (count($mobilelogo_info)) {
                $width  = $mobilelogo_info[0];
                $height = $mobilelogo_info[1];
            } else {
                $width  = MOBILE_LOGO_WIDTH;
                $height = MOBILE_LOGO_HEIGHT;
            }
            image_getNewDimension(MOBILE_LOGO_WIDTH, MOBILE_LOGO_HEIGHT, $width, $height, $mobilelogo_width, $mobilelogo_height);
            ?>
            <img src="<?=DEFAULT_URL.$mobilelogo_path?>" width="<?=$mobilelogo_width?>" height="<?=$mobilelogo_height?>" border="0" />
        </td>
    </tr>
    <tr>
        <th><input type="checkbox" class="standard-table-putradio" name="restore_logo_mobile" value="1" style="width:auto;border:0;" /></th>
        <td><?=system_showText(LANG_SITEMGR_CONTENT_CHECKBOX_RESTOREDEFAULTLOGO)?></td>
    </tr>
</table>

<table class="standard-table">
	<tr>
		<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_SITEMGR_CONTENT_SEOCENTER)?></th>
	</tr>
	<tr>
		<th><?=system_showText(LANG_SITEMGR_LANGUAGE)?>:</th>
		<td>
		<?=language_writeComboLang('lang', $lang, 'changeComboLang(this.value)'); ?>
		</td>
	</tr>
	<tr>
		<th><?=system_showText(LANG_SITEMGR_TITLE)?>:</th>
		<td><input type="text" name="header_title" value="<?=$header_title?>" maxlength="255" /></td>
	</tr>
	<tr>
		<th><?=system_showText(LANG_SITEMGR_LABEL_AUTHOR)?>:</th>
		<td><input type="text" name="header_author" value="<?=$header_author?>" maxlength="255" /></td>
	</tr>
	<tr>
		<th><?=system_showText(LANG_SITEMGR_LABEL_METADESCRIPTION)?>:<br /><br /></th>
		<td><input type="text" name="header_description" value="<?=$header_description?>" maxlength="255" /><br /><?=system_showText(LANG_SITEMGR_CONTENT_METADESCRIPTION_EG)?></td>
	</tr>
	<tr>
		<th><?=system_showText(LANG_SITEMGR_LABEL_METAKEYWORDS)?>:<br /><br /></th>
		<td><input type="text" name="header_keywords" value="<?=$header_keywords?>" maxlength="255" /><br /><?=system_showText(LANG_SITEMGR_CONTENT_METAKEYWORDS_EG)?></td>
	</tr>
</table>