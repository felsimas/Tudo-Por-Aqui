<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/views/view_featured_listing.php
	# ----------------------------------------------------------------------------------------------------

	if (MODREWRITE_FEATURE == "on") {
		$detailLink = "".LISTING_DEFAULT_URL."/".$listing->getString("friendly_url").".html";
	} else {
		$detailLink = "".LISTING_DEFAULT_URL."/detail.php?id=".$listing->getNumber("id")."";
	}

	// remove the last grey line on random listing
	if($count < 2) $style = "class=\"tableFeatured\""; else $style = "class=\"tableFeatured\" style=\"border-bottom: 0; margin-bottom: 10px;\"";

?>

<table align="center" border="0" cellspacing="0" cellpadding="0" <?=$style?>>
	<tr>
		<td rowspan="2" style="width:<?=IMAGE_FEATURED_THUMB_WIDTH;?>px; height:<?=IMAGE_FEATURED_THUMB_HEIGHT;?>px;">
		
			
			<?
			$imageObj = new Image($listing->getString("image_id"));
			if($imageObj->imageExists()) {
				if ($user) {
					echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"imgListingFeatured\" style=\"width: ".(IMAGE_FEATURED_THUMB_WIDTH)."px;\"><tr><td><a href=\"".$detailLink."\">";
					echo $imageObj->getTag(true, IMAGE_FEATURED_THUMB_WIDTH, IMAGE_FEATURED_THUMB_HEIGHT, $listing->getString("title"));
					echo "</a></td></tr></table>";
				} else {
					echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"imgListingFeatured\" style=\"width: ".(IMAGE_FEATURED_THUMB_WIDTH)."px;\"><tr><td>";
					echo $imageObj->getTag(true, IMAGE_FEATURED_THUMB_WIDTH, IMAGE_FEATURED_THUMB_HEIGHT, $listing->getString("title"));
					echo "</td></tr></table>";
				}
			} else {
				echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"imgListingFeatured\"><tr><td class=\"noimage\">";
				if ($user) echo "<a href=\"".$detailLink."\" style=\"width:".(IMAGE_FEATURED_THUMB_WIDTH)."px; height:".(IMAGE_FEATURED_THUMB_HEIGHT)."px;\">";
				echo "&nbsp;";
				if ($user) echo "</a>";
				echo "</td></tr></table>";
			}
			?>
			
		</td>
		<td>
			<h1 class="title-featured">
				<?
					if ($user) {
						echo "<a href=\"".$detailLink."\">".$listing->getString("title", true)."</a>";
					} else {
						echo $listing->getString("title");
					}
				?>
			</h1>
			<p class="featured-view">
				<?=$listing->getString("description")?>
				<?
				if ($user) {
					echo "<a href=\"".$detailLink."\">&raquo; More info</a>";
				} else {
					echo "<a href=\"#\">&raquo; More info</a>";
				}
				?>
			</p>
			
		</td>
	</tr>
</table>
