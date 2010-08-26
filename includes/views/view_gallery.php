<?
	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/views/view_gallery.php
	# ----------------------------------------------------------------------------------------------------

$langIndex = language_getIndex(EDIR_LANGUAGE);

if (count($gallery->image) > 0) {
	$col = 0;
	for ($i=0; $i<count($gallery->image); $i++) {
		if ($col == 0) {
			echo "";
		}
		$col++;
		?>

		<div class="galleryDetail" style="width: <?=(IMAGE_GALLERY_THUMB_WIDTH+10)?>px;">

			<?
			if (strpos($_SERVER["PHP_SELF"], "preview.php") === false) {
			//	$galleryImageLink = $url_redirect."/image.php?gallery_image_id=".$gallery->image[$i]["id"]."&id=".$gallery->getNumber("id")."&screen=".$screen."&letra=".$letra;
				$galleryImageLink = $url_redirect."/imagem/".$gallery->image[$i]["id"]."/".$gallery->getNumber("id");
			
				$galleryImageStyle = "";
			} else {
				$galleryImageLink = "javascript:void(0);";
				$galleryImageStyle = "cursor: default;";
			}
			?>
			<a href="<?=$galleryImageLink?>" style="height:<?=(IMAGE_GALLERY_THUMB_HEIGHT+10)?>px; <?=$galleryImageStyle?>">

				<?
				$imageObj = new Image($gallery->image[$i]["thumb_id"]);
				if ($imageObj->imageExists()) {
					echo "<span class=\"galleryImgThumb\">".$imageObj->getTag(true, IMAGE_GALLERY_THUMB_WIDTH, IMAGE_GALLERY_THUMB_HEIGHT, $gallery->image[$i]["thumb_caption".$langIndex])."</span>";
				} else {
					echo "<span class=\"errorMessage\">".system_showText(LANG_MSG_ERRORNOTHUMBIMAGE)."</span>";
				}
				?>

			</a>

			<? if ($gallery->image[$i]['thumb_caption'.$langIndex]) { ?>

				<a href="<?=$galleryImageLink?>" <?=(($galleryImageStyle) ? ("style=\"".$galleryImageStyle."\"") : (""))?>>

					<span style="width: <?=(IMAGE_GALLERY_THUMB_WIDTH+10)?>px; width:expression(<?=IMAGE_GALLERY_THUMB_WIDTH+10?>);"><?=$gallery->image[$i]['thumb_caption'.$langIndex]?></span>

				</a>

			<? } ?>

		</div>

		<?
		if ($col == 4) {
			echo "<br class=\"clear\" /><br class=\"clear\" />";
			$col = 0;
		}
	}
} else {
	echo "<div class=\"response-msg notice ui-corner-all\">".system_showText(LANG_MSG_NOIMAGESUPLOADEDYET)."</div>";
}

?>
