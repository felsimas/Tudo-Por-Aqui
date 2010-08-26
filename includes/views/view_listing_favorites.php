<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/views/view_listing_favorites.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("./conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	$ids = $_COOKIE["bookmarklisting"];
	if ($ids) {
		$sql = "SELECT * FROM Listing WHERE id IN (".str_replace("\\", "", $ids).") ORDER BY level DESC, title";
		$listings = db_getFromDBBySQL("listing", $sql);
	}

	if ($listings) {

		?>
		<div class="favoriteBusinesses">
			<p class="standardTitle">Favorite <span><?=ucwords(LISTING_FEATURE_NAME_PLURAL);?></span></p>
			<?

			$listingLevel = new ListingLevel();

			foreach ($listings as $listing) {

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

				if ($listing->getNumber("level") == 70) {

					echo "<blockquote class=\"highlightBusinesses\" style=\"width:".(IMAGE_FAVORITE_LISTING_WIDTH+5)."px;\">";?>
					<a href="javascript:void(0)" class="quickListRemove" onclick="removeFromCookie('<?=$listing->getNumber("id")?>','<?=EDIRECTORY_FOLDER?>','listing')"><img src="<?=DEFAULT_URL?>/images/icon_delete.gif" alt="Remove" title="Remove" /></a>
					<? $imageObj = new Image($listing->getNumber("image_id"));
					if ($imageObj->imageExists()) {
						echo "<a href=\"".$detailLink."\" class=\"favoriteBusinessesIMAGE\" style=\"width:".(IMAGE_FAVORITE_LISTING_WIDTH)."px;\">";
						echo $imageObj->getTag(true, IMAGE_FAVORITE_LISTING_WIDTH, IMAGE_FAVORITE_LISTING_HEIGHT, $listing->getString("title"), true);
						echo "</a>";
					} else {
						echo "<a href=\"".$detailLink."\" class=\"favoriteBusinessesNOIMAGE\" style=\"width: ".IMAGE_FAVORITE_LISTING_WIDTH."px; height: ".IMAGE_FAVORITE_LISTING_HEIGHT."px; ".system_getNoImageStyle()."\">";
						echo "&nbsp;";
						echo "</a>";
					}
					echo "<h1><a href=\"".$detailLink."\">";
					if (strlen($listing->getString("title")) > 40) echo substr($listing->getString("title"), 0, 37)."...";
					else echo $listing->getString("title");
					echo "</a></h1>";
					echo "</blockquote>";

				} else {

					echo "<ul class=\"highlightBusinessesList\">";
						echo "<li>";
							echo "<span>";
								?><a href="javascript:void(0)" onclick="removeFromCookie('<?=$listing->getNumber("id")?>','<?=EDIRECTORY_FOLDER?>','listing')"><img src="<?=DEFAULT_URL?>/images/icon_delete.gif" alt="Remove" title="Remove" /></a><?
							echo "</span>";
							echo "&nbsp;";
							echo "<a href=\"".$detailLink."\">".$listing->getString("title")."</a>";
						echo "</li>";
					echo "</ul>";

				}

			}

			?>
			<br class="clear" /><br class="clear" />
		</div>
		<?

	}

?>
