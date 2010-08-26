<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/views/views_promotion_favorites.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("./conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	$ids = $_COOKIE["bookmarkpromotion"];
	if ($ids) {
		$sql = "SELECT * FROM Promotion WHERE id IN (".str_replace("\\", "", $ids).") ORDER BY name";
		$promotions = db_getFromDBBySQL("promotion", $sql);
	}

	if ($promotions) {

		?>
		<div class="favoritePromotions">
			<p class="standardTitle">Favorite <span><?=ucwords(PROMOTION_FEATURE_NAME_PLURAL);?></span></p>
			<?

			foreach ($promotions as $promotion) {

				$myfavorites++;

				$promotion_link = "javascript:window.open('".PROMOTION_DEFAULT_URL."/promotion.php?id=".$promotion->getNumber("id")."', 'popup', 'toolbar=0, location=0, directories=0, status=0, width=".(IMAGE_PROMOTION_FULL_WIDTH+100).", height=".(IMAGE_PROMOTION_FULL_HEIGHT+100).", screenX=0, screenY=0, menubar=0, scrollbars=no, resizable=0');";

				echo "<blockquote class=\"highlightPromotions\" style=\"width:".(IMAGE_FAVORITE_PROMOTION_WIDTH+5)."px;\">";?>
				<a href="javascript:void(0)" class="quickListRemove" onclick="removeFromCookie('<?=$promotion->getNumber("id")?>','<?=EDIRECTORY_FOLDER?>','promotion')"><img src="<?=DEFAULT_URL?>/images/icon_delete.gif" alt="Remove" title="Remove" /></a>
				<?
				$imageObj = new Image($promotion->getNumber("image_id"));
				if ($imageObj->imageExists()) {
					echo "<a href=\"javascript:void(0);\" onclick=\"".$promotion_link."\" class=\"favoritePromotionsIMAGE\" style=\"width:".(IMAGE_FAVORITE_PROMOTION_WIDTH)."px;\">";
					echo $imageObj->getTag(true, IMAGE_FAVORITE_PROMOTION_WIDTH, IMAGE_FAVORITE_PROMOTION_HEIGHT, $promotion->getString("name"), true);
					echo "</a>";
				} else {
					echo "<a href=\"javascript:void(0);\" onclick=\"".$promotion_link."\" class=\"favoritePromotionsNOIMAGE\" style=\"width: ".IMAGE_FAVORITE_PROMOTION_WIDTH."px; height: ".IMAGE_FAVORITE_PROMOTION_HEIGHT."px; ".system_getNoImageStyle()."\">";
					echo "&nbsp;";
					echo "</a>";
				}
				echo "<h1><a href=\"javascript:void(0);\" onclick=\"".$promotion_link."\">";
				if (strlen($promotion->getString("name")) > 40) echo substr($promotion->getString("name"), 0, 37)."...";
				else echo $promotion->getString("name");
				echo "</a></h1>";
				echo "</blockquote>";

			}

			?>
			<br class="clear" /><br class="clear" />
		</div>
		<?

	}

?>
