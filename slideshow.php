<?
	include("./conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	if ($_GET["gallery_image"]) {
		$imageObj        = new Image($_GET["gallery_image"]);
		$first_name      = "photo_".$imageObj->GetString("id");
		$first_type      = strtolower($imageObj->GetString("type"));
		$first_image_src = "".DEFAULT_URL."/custom/image_files/".$first_name.".".$first_type;
	}

	$langIndex = language_getIndex(EDIR_LANGUAGE);

	$current = ($_GET["i"]) ? $_GET["i"] : 0;
	if ($current) if (!is_numeric($current) || ($current <= 0) || (strpos($current, "x") !== false) || (strpos($current, ".") !== false)) $current = 0;

	$galleryObj = new Gallery($_GET["gallery_id"]);

	if ($galleryObj->getNumber("id") && $galleryObj->image && count($galleryObj->image) > 0) {

		if ($_GET["listing_level"]) {
			$galleryLevel = new ListingLevel();
			$maxGalleryImages = $galleryLevel->getImages($_GET["listing_level"]);
		} elseif ($_GET["event_level"]) {
			$galleryLevel = new EventLevel();
			$maxGalleryImages = $galleryLevel->getImages($_GET["event_level"]);
		} elseif ($_GET["classified_level"]) {
			$galleryLevel = new ClassifiedLevel();
			$maxGalleryImages = $galleryLevel->getImages($_GET["classified_level"]);
		} elseif ($_GET["article_level"]) {
			$galleryLevel = new ArticleLevel();
			$maxGalleryImages = $galleryLevel->getImages($_GET["article_level"]);
		}
		$maxGalleryImages = 1000;
		if (($maxGalleryImages) && (($maxGalleryImages > 0) || ($maxGalleryImages == -1))) {

			$totalImages = ($maxGalleryImages >= count($galleryObj->image)) ? count($galleryObj->image) : $maxGalleryImages;
			if ($maxGalleryImages == -1) $totalImages = count($galleryObj->image);

			$countImages = 0;

			$i=0;
			for ($imgInd = 0; $imgInd < $totalImages; $imgInd++) {

				$each_image = $galleryObj->image[$imgInd];

				$imageObj = new Image($each_image["image_id"]);
				$imageThumbObj = new Image($each_image["thumb_id"]);

				if ($imageObj->imageExists() && $imageThumbObj->imageExists()) {

					$countImages++;
					$name          = "photo_".$imageObj->GetString("id");
					$type          = strtolower($imageObj->GetString("type"));
					$image_name    = $name.".".$type;
					$image_caption = $each_image["image_caption".$langIndex];

					if ($each_image["image_id"] == $_GET["gallery_image"] || $i == 0){
						$first_image_caption = $image_caption;
					}

					if ($i == 0) {
						if (!$first_image_src) $first_image_src = "".DEFAULT_URL."/custom/image_files/$image_name";
						$image_caption      = str_replace("\\", "", $image_caption);
						$image_caption      = eregi_replace("'", "\'", $image_caption);
						$image_caption      = eregi_replace("\"", "\\\"", $image_caption);
						$image_caption_list = "'$image_caption'";
						$image_list         = "'".DEFAULT_URL."/custom/image_files/$image_name'";
					} elseif ($i > 0) {
						$image_caption       = str_replace("\\", "", $image_caption);
						$image_caption       = eregi_replace("'", "\'", $image_caption);
						$image_caption       = eregi_replace("\"", "\\\"", $image_caption);
						$image_caption_list .= ", '$image_caption'";
						$image_list         .= ", '".DEFAULT_URL."/custom/image_files/$image_name'";
					}

					$i++;

				}

			}

		}

	}

	header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);

	include(INCLUDES_DIR."/code/headertag.php");

	$headertag_title = $headertag_title." - SlideShow";

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>

		<? $headertag_title = (($headertag_title) ? ($headertag_title) : (EDIRECTORY_TITLE)); ?>
		<title><?=$headertag_title?></title>

		<? $headertag_author = (($headertag_author) ? ($headertag_author) : ("Sis Dir 2009 - Classificados")); ?>
		<meta name="author" content="<?=$headertag_author?>" />

		<? $headertag_description = (($headertag_description) ? ($headertag_description) : (EDIRECTORY_TITLE)); ?>
		<meta name="description" content="<?=$headertag_description?>" />

		<? $headertag_keywords = (($headertag_keywords) ? ($headertag_keywords) : (EDIRECTORY_TITLE)); ?>
		<meta name="keywords" content="<?=$headertag_keywords?>" />

		<meta http-equiv="Content-Type" content="text/html; charset=<?=EDIR_CHARSET;?>" />

		<meta name="ROBOTS" content="index, follow" />

		<script language="JavaScript" type="text/javascript">
			<!--
			// browser detection
			var isInternetExplorer = navigator.appName.indexOf("Microsoft") != -1;

			//set image paths
			var src = [<?=$image_list?>];
			//set corresponding captions
			var cpt = [<?=$image_caption_list?>];

			//set duration for each image and transitions
			var duration = 2.5;
			var crossFadeDuration = 0.5;
			var current_ad = <?=$current?>;
			var next_ad = 1;
			var ads = new Array(src.length);
			var timeout_id = 0;
			var isPlaying = false;

			function showCurrentImage() {
				document.getElementById('progress_bar').innerHTML = "<?=system_showText(LANG_SLIDESHOW_IMAGE)?> " + (next_ad + 1) + " <?=system_showText(LANG_SLIDESHOW_IMAGEOF)?> " + src.length + "";
				document.getElementById('img_description').innerHTML = cpt[next_ad];

				if(isInternetExplorer){
					document.images.slide.style.filter="blendTrans(duration=2)";
					document.images.slide.style.filter="blendTrans(duration=crossFadeDuration)";
					document.images.slide.filters.blendTrans.Apply();
				}

				document.images.slide.src = ads[next_ad].src;
				document.images.slide.alt = cpt[next_ad];
				document.images.slide.title = cpt[next_ad];

				if (isInternetExplorer) if (document.all) document.images.slide.filters.blendTrans.Play();

				current_ad = next_ad;

				if(isPlaying){
					isPlaying = false;
					timeout_id = setTimeout("slideshow_play()", duration * 1000);
				}
			}
			function image_onerror(){
				document.getElementById('progress_bar').innerHTML = "<?=system_showText(LANG_SLIDESHOW_IMAGELOADINGERROR)?> " + (current_ad + 1) + " <?=system_showText(LANG_SLIDESHOW_IMAGEOF)?> " + src.length + "";
			}
			function image_onload(){
				showCurrentImage();
			}
			function slideshow_refresh(again){
				if(typeof(ads[next_ad]) == "undefined"){
					imageObject = new Image;
					imageObject.onload = image_onload;
					imageObject.onerror = image_onerror;
					ads[next_ad] = imageObject;
					imageObject.src = src[next_ad];
				} else {
					showCurrentImage();
				}
				if (!again) { window.setTimeout("slideshow_refresh(1)", 1); }
			}
			function slideshow_play(){
				if(!isPlaying){
					clearTimeout(timeout_id);
					isPlaying = true;
					next_ad = current_ad + 1;
					if(next_ad  > (src.length - 1)){ next_ad = 0; }
					slideshow_refresh();
				}
			}
			function slideshow_next(forcePause, again){
				if(forcePause) slideshow_pause();
				next_ad = current_ad + 1;
				if(next_ad > (src.length - 1)){ next_ad = 0; }
				slideshow_refresh();
			}
			function slideshow_prev(forcePause, again){
				if(forcePause) slideshow_pause();
				next_ad = current_ad - 1;
				if(next_ad < 0){ next_ad = src.length - 1; }
				slideshow_refresh();
			}
			function slideshow_pause(){ isPlaying = false; clearTimeout(timeout_id); }
			window.onload = function(){
				if (document.images){
					timeout_id = setTimeout("slideshow_play()", (duration - crossFadeDuration) * 1000);
				}
			}
			//-->
		</script>

		<?
		if (EDIR_THEME) {
			include(THEMEFILE_DIR."/".EDIR_THEME."/".EDIR_THEME.".php");
		} else {
			?><link href="<?=DEFAULT_URL?>/layout/popup.css" rel="stylesheet" type="text/css" /><?
		}
		?>

		<?=system_getNoImageStyle($cssfile = true);?>

	</head>
	<body>

		<div class="wrapper galleryWrapper">

			<dl class="galleryNav">
				<dt id="progress_bar"><?=system_showText(LANG_SLIDESHOW_IMAGE)?> <?=$current+1?> <?=system_showText(LANG_SLIDESHOW_IMAGEOF)?> <?=$countImages?></dt>
				<dd><a href="javascript:void(null)" onclick="slideshow_next(true)"><img src="<?=DEFAULT_URL?>/images/bt_next.gif" title="<?=system_showText(LANG_SLIDESHOW_NEXT)?>" alt="<?=system_showText(LANG_SLIDESHOW_NEXT)?>" /></a></dd>
				<dd><a href="javascript:void(null)" onclick="slideshow_pause()"><img src="<?=DEFAULT_URL?>/images/bt_pause.gif" title="<?=system_showText(LANG_SLIDESHOW_PAUSE)?>" alt="<?=system_showText(LANG_SLIDESHOW_PAUSE)?>" /></a></dd>
				<dd><a href="javascript:void(null)" onclick="slideshow_play()"><img src="<?=DEFAULT_URL?>/images/bt_play.gif" title="<?=system_showText(LANG_SLIDESHOW_PLAY)?>" alt="<?=system_showText(LANG_SLIDESHOW_PLAY)?>" /></a></dd>
				<dd><a href="javascript:void(null)" onclick="slideshow_prev(true)"><img src="<?=DEFAULT_URL?>/images/bt_back.gif" title="<?=system_showText(LANG_SLIDESHOW_BACK)?>" alt="<?=system_showText(LANG_SLIDESHOW_BACK)?>" /></a></dd>
			</dl>

			<div class="galleryPicture" id="gallery-picture">
				<img src="<?=$first_image_src?>" alt="<?=$first_image_caption?>" title="<?=$first_image_caption?>" border="0" name="slide" id="slide" />
				<p id="img_description"><?=$first_image_caption?></p>
			</div>

		</div>

	</body>
</html>
