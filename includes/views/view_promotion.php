<?


	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/views/view_promotion.php
	# ----------------------------------------------------------------------------------------------------

	if (strpos($url_base, "/membros")) {
		$by_key = array("promotion_id", "account_id");
		$by_value = array(db_formatNumber($id), sess_getAccountIdFromSession());
		$listing = db_getFromDB("listing", $by_key, $by_value);
	} else {
		$listing = db_getFromDB("listing", "promotion_id", db_formatNumber($id));
	}

?>

	<div class="wrapper_promo">
		<?

		if ($promotion->getString("html") == "no" && $promotion->getNumber("image_id") != 0) {
			$imageObj = new Image($promotion->getNumber("image_id"));
			if ($imageObj->imageExists()) {
				echo "<div class=\"couponImage\">";
				echo $imageObj->getTag(true, IMAGE_PROMOTION_FULL_WIDTH, IMAGE_PROMOTION_FULL_HEIGHT, $promotion->getString("name"));
				echo "</div>";
			}
		} else {

			?>

			<h1><?=$promotion->getString("name");?></h1>

			<?
			$imageObj = new Image($promotion->getNumber("thumb_id"));
			if ($imageObj->imageExists()) {
				echo "<div class=\"promotionImage\">".$imageObj->getTag(true, IMAGE_PROMOTION_THUMB_WIDTH, IMAGE_PROMOTION_THUMB_HEIGHT, $promotion->getString("name"))."</div>";
			}
			?>

			<?
			if ($listing->getString("title")) {

				echo "<h2>";
				echo system_showText(LANG_PROMOTION_OFFEREDBY)." ";
				$level = new ListingLevel();
				if ($level->getDetail($listing->getNumber("level")) == "y") {
					if (MODREWRITE_FEATURE == "on") {
						$listing_link = "".LISTING_DEFAULT_URL."/".$listing->getString("friendly_url").".html";
					} else {
						$listing_link = "".LISTING_DEFAULT_URL."/detail.php?id=".$listing->getNumber("id")."";
					}
				} else {
					$listing_link = "".LISTING_DEFAULT_URL."/results.php?id=".$listing->getNumber("id");
				}
				if ($user) echo "<a href=\"".$listing_link."\" target=\"_blank\">".$listing->getString("title", true)."</a>";
				else echo "<a href=\"javascript:void(0);\">".$listing->getString("title", true)."</a>";
				echo " <span class=\"complementaryInfo\"><strong>".system_showText(LANG_PROMOTION_VALIDFROM).":</strong> ".$promotion->getDate("start_date")." <strong>".system_showText(LANG_PROMOTION_VALIDTO).":</strong> ".$promotion->getDate("end_date")."</span>";
				echo "</h2>";

				echo "<address>";
				if ($listing->getString("address")) {
					echo $listing->getString("address", true)."<br />";
				}
				if ($listing->getString("address2")) {
					echo $listing->getString("address2", true)."<br />";
				}
				$location = $listing->getLocationString("r, s z");
				if ($location) {
					echo $location."<br />";
				}
				if ($listing->getString("phone")) { 
					echo $listing->getString("phone", true)."<br />";
				}
				echo "</address>";

			}
			?>

			<p><?=nl2br($promotion->getStringLang(EDIR_LANGUAGE, "offer"));?></p>
			<p><?=nl2br($promotion->getStringLang(EDIR_LANGUAGE, "description"));?></p>

			<p class="warning"><?=nl2br($promotion->getStringLang(EDIR_LANGUAGE, "conditions"));?></p>

			<?
		}
		?>

		<ul class="promotionNavbar">
			<li>
				<? if ($user) { ?><a href="javascript:void(0);" onclick="window.print();"><?=system_showText(LANG_PROMOTION_PRINT)?></a><? } else { ?><a href="javascript:void(0);"><?=system_showText(LANG_PROMOTION_PRINT)?></a><? } ?>
			</li>
			<li>
				<? if ($user) { ?><a href="javascript:void(0);" onclick="window.close();"><?=system_showText(LANG_CLOSE)?></a><? } else { ?><a href="javascript:void(0);"><?=system_showText(LANG_CLOSE)?></a><? } ?>
			</li>
		</ul>

	</div>
