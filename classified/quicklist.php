<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /classified/quicklist.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (CLASSIFIED_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	$ids = $_COOKIE["bookmarkclassified"];
	if ($ids) {
		$ids = str_replace("\\", "", $ids);
		$ids = str_replace("=", "", $ids);
		$ids = str_replace("%27", "", str_replace("'", "", $ids));
		$ids = str_replace("%22", "", str_replace("\"", "", $ids));
		$ids = str_replace(")", "", str_replace("(", "", $ids));
		$ids = preg_replace("([^0-9,])", "", $ids);
		$ids = system_denyInjections($ids);
		if ($ids) {
			$sql = "SELECT * FROM Classified WHERE id IN (".$ids.") ORDER BY level DESC, title";
			$classifieds = db_getFromDBBySQL("classified", $sql);
		}
	}
	
	if (strpos($_SERVER['PHP_SELF'], "favorites.php") !== false) {
		if ($classifieds) {
			?><h2 class="standardSubTitle"><?=system_showText(system_highlightLastWord(LANG_FAVORITE_CLASSIFIED));?></h2><?
		}
	} else {
		?><h2 class="standardTitle"><?=system_showText(system_highlightLastWord(LANG_FAVORITE_CLASSIFIED));?></h2><?
	}

	if ($classifieds) {

		?>
		<div class="quickList">
			<?

			$classifiedLevel = new ClassifiedLevel();

			$itemsPerLine = 6;
			$thisItemAmount = 0;
			foreach ($classifieds as $classified) {
				if (($thisItemAmount) && !($thisItemAmount%$itemsPerLine)) echo "<span class=\"clear\"></span>";
				$thisItemAmount++;

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
				
				if (strpos($_SERVER['PHP_SELF'], "favorites.php") !== false) {

					echo "<div class=\"featuredItems favoriteClassified\">";?>
					<a href="javascript:void(0)" class="quickListRemove" onclick="removeFromCookie('<?=$classified->getNumber("id")?>','<?=EDIRECTORY_FOLDER?>','classified')"><img src="<?=DEFAULT_URL?>/images/icon_delete.gif" alt="<?=system_showText(LANG_QUICKLIST_REMOVE);?>" title="<?=system_showText(LANG_QUICKLIST_REMOVE);?>" /></a>
					<?
					$imageObj = new Image($classified->getNumber("thumb_id"));
					if ($imageObj->imageExists()) {
						echo "<a href=\"".$detailLink."\" class=\"favoriteClassifiedImage\">";
						echo $imageObj->getTag(true, IMAGE_FAVORITE_CLASSIFIED_WIDTH, IMAGE_FAVORITE_CLASSIFIED_HEIGHT, $classified->getString("title"), true);
						echo "</a>";
					} else {
						echo "<a href=\"".$detailLink."\" class=\"favoriteClassifiedImage noimage\" style=\"".system_getNoImageStyle()."\">";
						echo "&nbsp;";
						echo "</a>";
					}
					echo "<h3><a href=\"".$detailLink."\">";
					if (strlen($classified->getString("title")) > 40) echo substr($classified->getString("title"), 0, 37)."...";
					else echo $classified->getString("title");
					echo "</a></h3>";
					echo "</div>";
					
				} else {
				
					echo "<h3>";
								?><a href="javascript:void(0)" class="quickListRemove" onclick="removeFromCookie('<?=$classified->getNumber("id")?>','<?=EDIRECTORY_FOLDER?>','classified')"><img src="<?=DEFAULT_URL?>/images/icon_delete.gif" alt="<?=system_showText(LANG_QUICKLIST_REMOVE);?>" title="<?=system_showText(LANG_QUICKLIST_REMOVE);?>" /></a><?
							echo "<a href=\"".$detailLink."\">".$classified->getString("title")."</a>";
					echo "</h3>";
				
				}

			}

			?>
		</div>
		<?

	} else {
		
		if (strpos($_SERVER['PHP_SELF'], "favorites.php") === false) {
			echo "<div class=\"response-msg notice ui-corner-all\">".system_showText(LANG_LABEL_NOQUICKLIST)."</div>";
		}
		
	}
	
	if (strpos($_SERVER['PHP_SELF'], "favorites.php") === false) {
		echo "<p class=\"viewMore\"><a href=\"".DEFAULT_URL."/favorites.php\">".system_showText(LANG_QUICK_LIST)." &raquo;</a></p>";
	}

?>
