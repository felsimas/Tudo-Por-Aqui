<?


	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	$ids = $_COOKIE["bookmarklisting"];
	if ($ids) {
		$ids = str_replace("\\", "", $ids);
		$ids = str_replace("=", "", $ids);
		$ids = str_replace("%27", "", str_replace("'", "", $ids));
		$ids = str_replace("%22", "", str_replace("\"", "", $ids));
		$ids = str_replace(")", "", str_replace("(", "", $ids));
		$ids = preg_replace("([^0-9,])", "", $ids);
		$ids = system_denyInjections($ids);
		if ($ids) {
			$sql = "SELECT * FROM Listing WHERE id IN (".$ids.") ORDER BY level DESC, title";
			$listings = db_getFromDBBySQL("listing", $sql);
		}
	}
	
	if (strpos($_SERVER['PHP_SELF'], "favorites.php") !== false) {
		if ($listings) {
			?><h2 class="standardSubTitle"><?=system_showText(system_highlightLastWord(LANG_FAVORITE_LISTING));?></h2><?
		}
	} else {
		?><div id="featured" style="margin-top:10px; margin-bottom:20px;">
			<div class="box-t1">
				<div class="box-t2">
					<div class="box-t3"/>
					</div>
				</div>
			</div>
		<div class="box-1"><div class="box-2"><div class="box-3"><h2 class="standardTitle"><?=system_showText(system_highlightLastWord(LANG_FAVORITE_LISTING));?></h2><?
	}

	if ($listings) {

		?>
		<div class="quickList">
			<?

			$listingLevel = new ListingLevel();

			$itemsPerLine = 6;
			$thisItemAmount = 0;
			foreach ($listings as $listing) {
				if (($thisItemAmount) && !($thisItemAmount%$itemsPerLine)) echo "<span class=\"clear\"></span>";
				$thisItemAmount++;

				$myfavorites++;

				if ($listingLevel->getDetail($listing->getNumber("level")) == "y") {
					if (MODREWRITE_FEATURE == "on") {
						$detailLink = "".LISTING_DEFAULT_URL."/".$listing->getString("friendly_url").".html";
					} else {
						$detailLink = "".LISTING_DEFAULT_URL."/detail.php?id=".$listing->getNumber("id")."";
					}
				} else {
					$detailLink = "".LISTING_DEFAULT_URL."/results.php?id=".$listing->getNumber("id")."";
				}

				if (($listing->getNumber("level") == 70) && (strpos($_SERVER['PHP_SELF'], "favorites.php") !== false)) {

					echo "<div class=\"featuredItems favoriteListing\">";?>
					<a href="javascript:void(0)" class="quickListRemove" onclick="removeFromCookie('<?=$listing->getNumber("id")?>','<?=EDIRECTORY_FOLDER?>','listing')"><img src="<?=DEFAULT_URL?>/images/icon_delete.gif" alt="<?=system_showText(LANG_QUICKLIST_REMOVE);?>" title="<?=system_showText(LANG_QUICKLIST_REMOVE);?>" /></a>
					<? $imageObj = new Image($listing->getNumber("thumb_id"));
					if ($imageObj->imageExists()) {
						echo "<a href=\"".$detailLink."\" class=\"favoriteListingImage\">";
						echo $imageObj->getTag(true, IMAGE_FAVORITE_LISTING_WIDTH, IMAGE_FAVORITE_LISTING_HEIGHT, $listing->getString("title"), true);
						echo "</a>";
					} else {
						echo "<a href=\"".$detailLink."\" class=\"favoriteListingImage noimage\" style=\"".system_getNoImageStyle()."\">";
						echo "&nbsp;";
						echo "</a>";
					}
					
					echo "<h3><a href=\"".$detailLink."\">";
					if (strlen($listing->getString("title")) > 40) echo substr($listing->getString("title"), 0, 37)."...";
					else echo $listing->getString("title");
					echo "</a></h3>";
					echo "</div>";

				} else {

								?><h3><a href="javascript:void(0)" class="quickListRemove" onclick="removeFromCookie('<?=$listing->getNumber("id")?>','<?=EDIRECTORY_FOLDER?>','listing')"><img src="<?=DEFAULT_URL?>/images/icon_delete.gif" alt="<?=system_showText(LANG_QUICKLIST_REMOVE);?>" title="<?=system_showText(LANG_QUICKLIST_REMOVE);?>" /></a><?
							echo "<a href=\"".$detailLink."\">".$listing->getString("title")."</a></h3>";

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
		echo "</div></div></div><div class=\"box-b1\">
				<div class=\"box-b2\">
					<div class=\"box-b3\"/>
					</div>
				</div>
			</div></div>";
	}

?>



	