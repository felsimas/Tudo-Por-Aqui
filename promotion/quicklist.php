<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /promotion/quicklist.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	$ids = $_COOKIE["bookmarkpromotion"];
	if ($ids) {
		$ids = str_replace("\\", "", $ids);
		$ids = str_replace("=", "", $ids);
		$ids = str_replace("%27", "", str_replace("'", "", $ids));
		$ids = str_replace("%22", "", str_replace("\"", "", $ids));
		$ids = str_replace(")", "", str_replace("(", "", $ids));
		$ids = preg_replace("([^0-9,])", "", $ids);
		$ids = system_denyInjections($ids);
		if ($ids) {
			$sql = "SELECT * FROM Promotion WHERE id IN (".$ids.") ORDER BY name";
			$promotions = db_getFromDBBySQL("promotion", $sql);
		}
	}
	
	if (strpos($_SERVER['PHP_SELF'], "favorites.php") !== false) {
		if ($promotions) {
			?><h2 class="standardSubTitle"><?=system_showText(system_highlightLastWord(LANG_FAVORITE_PROMOTION));?></h2><?
		}
	} else {
		?><h2 class="standardTitle"><?=system_showText(system_highlightLastWord(LANG_FAVORITE_PROMOTION));?></h2><?
	}

	if ($promotions) {

		?>
		<div class="quickList">
			<?

			$itemsPerLine = 6;
			$thisItemAmount = 0;
			foreach ($promotions as $promotion) {
				if (($thisItemAmount) && !($thisItemAmount%$itemsPerLine)) echo "<span class=\"clear\"></span>";
				$thisItemAmount++;

				$myfavorites++;

				$promotion_link = "javascript:window.open('".PROMOTION_DEFAULT_URL."/promotion.php?id=".$promotion->getNumber("id")."', 'popup', 'toolbar=0, location=0, directories=0, status=0, width=".(IMAGE_PROMOTION_FULL_WIDTH+100).", height=".(IMAGE_PROMOTION_FULL_HEIGHT+100).", screenX=0, screenY=0, menubar=0, scrollbars=no, resizable=0');";
				
				if (strpos($_SERVER['PHP_SELF'], "favorites.php") !== false) {
	
					echo "<div class=\"featuredItems favoritePromotion\">";?>
					<a href="javascript:void(0)" class="quickListRemove" onclick="removeFromCookie('<?=$promotion->getNumber("id")?>','<?=EDIRECTORY_FOLDER?>','promotion')"><img src="<?=DEFAULT_URL?>/images/icon_delete.gif" alt="<?=system_showText(LANG_QUICKLIST_REMOVE);?>" title="<?=system_showText(LANG_QUICKLIST_REMOVE);?>" /></a>
					<?
					$imageObj = new Image($promotion->getNumber("thumb_id"));
					if ($imageObj->imageExists()) {
						echo "<a href=\"javascript:void(0);\" onclick=\"".$promotion_link."\" class=\"favoritePromotionImage\">";
						echo $imageObj->getTag(true, IMAGE_FAVORITE_PROMOTION_WIDTH, IMAGE_FAVORITE_PROMOTION_HEIGHT, $promotion->getString("name"), true);
						echo "</a>";
					} else {
						echo "<a href=\"javascript:void(0);\" onclick=\"".$promotion_link."\" class=\"favoritePromotionImage noimage\" style=\"".system_getNoImageStyle()."\">";
						echo "&nbsp;";
						echo "</a>";
					}
					echo "<h3><a href=\"javascript:void(0);\" onclick=\"".$promotion_link."\">";
					if (strlen($promotion->getString("name")) > 40) echo substr($promotion->getString("name"), 0, 37)."...";
					else echo $promotion->getString("name");
					echo "</a></h3>";
					echo "</div>";
					
				} else {
				
					echo "<h3>";
								?><a href="javascript:void(0)" class="quickListRemove" onclick="removeFromCookie('<?=$promotion->getNumber("id")?>','<?=EDIRECTORY_FOLDER?>','promotion')"><img src="<?=DEFAULT_URL?>/images/icon_delete.gif" alt="<?=system_showText(LANG_QUICKLIST_REMOVE);?>" title="<?=system_showText(LANG_QUICKLIST_REMOVE);?>" /></a><?
							echo "<a href=\"javascript:void(0);\" onclick=\"".$promotion_link."\">".$promotion->getString("name")."</a>";
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
