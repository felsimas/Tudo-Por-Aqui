<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/views/view_classified_favorites.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("./conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (CLASSIFIED_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	$ids = $_COOKIE["bookmarkclassified"];
	if ($ids) {
		$sql = "SELECT * FROM Classified WHERE id IN (".str_replace("\\", "", $ids).") ORDER BY level DESC, title";
		$classifieds = db_getFromDBBySQL("classified", $sql);
	}

	if ($classifieds) {

		?>
		<div class="favoriteClassified">
			<p class="standardTitle">Favorite <span><?=ucwords(CLASSIFIED_FEATURE_NAME_PLURAL);?></span></p>
			<?

			$classifiedLevel = new ClassifiedLevel();

			foreach ($classifieds as $classified) {

				$myfavorites++;

				if ($classifiedLevel->getDetail($classified->getNumber("level")) == "y") {
					if (MODREWRITE_FEATURE == "on") {
						$detailLink = "".CLASSIFIED_DEFAULT_URL."/".$classified->getString("friendly_url").".html";
					} else {
						$detailLink = "".CLASSIFIED_DEFAULT_URL."/detail.php?id=".$classified->getNumber("id")."";
					}
				} else {
					$detailLink = "".CLASSIFIED_DEFAULT_URL."/results.php?id=".$classified->getNumber("id")."";
				}

				echo "<blockquote class=\"highlightClassified\" style=\"width:".(IMAGE_FAVORITE_CLASSIFIED_WIDTH+5)."px;\">";?>
				<a href="javascript:void(0)" class="quickListRemove" onclick="removeFromCookie('<?=$classified->getNumber("id")?>','<?=EDIRECTORY_FOLDER?>','classified')"><img src="<?=DEFAULT_URL?>/images/icon_delete.gif" alt="Remove" title="Remove" /></a>
				<?
				$imageObj = new Image($classified->getNumber("img_small"));
				if ($imageObj->imageExists()) {
					echo "<a href=\"".$detailLink."\" class=\"favoriteClassifiedIMAGE\" style=\"width:".(IMAGE_FAVORITE_CLASSIFIED_WIDTH)."px;\">";
					echo $imageObj->getTag(true, IMAGE_FAVORITE_CLASSIFIED_WIDTH, IMAGE_FAVORITE_CLASSIFIED_HEIGHT, $classified->getString("title"), true);
					echo "</a>";
				} else {
					echo "<a href=\"".$detailLink."\" class=\"favoriteClassifiedNOIMAGE\" style=\"width: ".IMAGE_FAVORITE_CLASSIFIED_WIDTH."px; height: ".IMAGE_FAVORITE_CLASSIFIED_HEIGHT."px; ".system_getNoImageStyle()."\">";
					echo "&nbsp;";
					echo "</a>";
				}
				echo "<h1><a href=\"".$detailLink."\">";
				if (strlen($classified->getString("title")) > 40) echo substr($classified->getString("title"), 0, 37)."...";
				else echo $classified->getString("title");
				echo "</a></h1>";
				echo "</blockquote>";

			}

			?>
			<br class="clear" /><br class="clear" />
		</div>
		<?

	}

?>
