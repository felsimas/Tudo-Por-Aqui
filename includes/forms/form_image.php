<?
if(!$disable) {
	$title = system_showText(LANG_LABEL_ADDIMAGE);
	if ($imgGalleryW && $imgGalleryH) $title .= " <span>(".$imgGalleryW."px x ".$imgGalleryH."px) (JPG ".system_showText(LANG_OR)." GIF)</span>";
} else $title = system_showText(LANG_LABEL_EDITIMAGECAPTIONS);
?>

<table border="0" cellpadding="0" cellspacing="0" class="standard-table">

	<tr>
		<th colspan="2" class="standard-tabletitle"><?=$title?></th>
	</tr>

    <? if(strlen(trim($error))>0) {?>
        <tr>
            <td colspan="2" style="background:#FFF;"><p class="errorMessage"><?=$error?></p></td>
        </tr>
    <? } ?>
    
	<? if(strlen(trim($message))>0) {?>
		<tr>
			<td colspan="2" class="errorMessage"><?=$message?></td>
		</tr>
	<? } ?>

	<tr>
		<th><?=system_showText(LANG_LABEL_IMAGEFILE);?>:</th>
		<td>
			<?
			if ($disable) {
				$imageObj = new Image($gallery->image[$newI]["thumb_id"]);
				if ($imageObj->imageExists()) {
					echo $imageObj->getTag(true, $imgGalleryW, $imgGalleryH, $thumb_caption);
				}
			} else {
				echo "<input type=\"file\" name=\"image\" /><span>".system_showText(LANG_MSG_MAX_FILE_SIZE)." ".UPLOAD_MAX_SIZE." MB. ".system_showText(LANG_MSG_TRANSPARENTGIF_NOT_SUPPORTED).".</span>";
			}
			?>
		</td>
	</tr>

	<?
	$array_edir_languagenames = explode(",", EDIR_LANGUAGENAMES);
	for ($i=0; $i<count(explode(",", EDIR_LANGUAGES)); $i++) {
		$labelsuffix = "";
		if ($i) $labelsuffix = $i;
		?>
		<tr>
			<th class="wrap"><?=system_showText(LANG_LABEL_THUMBCAPTION)?><?=((count(explode(",", EDIR_LANGUAGES))>1)?(" (".$array_edir_languagenames[$i]."):"):(":"));?></th>
			<td><input type="text" name="thumb_caption<?=$labelsuffix;?>" value="<?=${"thumb_caption".$labelsuffix}?>" class="inputExplode" /></td>
		</tr>
		<tr>
			<th class="wrap"><?=system_showText(LANG_LABEL_IMAGECAPTION)?><?=((count(explode(",", EDIR_LANGUAGES))>1)?(" (".$array_edir_languagenames[$i]."):"):(":"));?></th>
			<td><input type="text" name="image_caption<?=$labelsuffix;?>" value="<?=${"image_caption".$labelsuffix}?>" class="inputExplode" /></td>
		</tr>
		<?
	}
	?>

	<? if(!$disable) { ?>
		<tr>
			<td colspan="2" class="standard-tablenote">
				<?=system_showText(LANG_LABEL_NOTEFORGALLERYIMAGE)?>
			</td>
		</tr>
	<? } ?>

</table>
