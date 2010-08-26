<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/views/view_article_detail_50.php
	# ----------------------------------------------------------------------------------------------------

?>

<div class="detail">

	<? if (!strpos($_SERVER["PHP_SELF"], "print.php")) { ?>
		<div class="baseIconNavbar">
			<? include(EDIRECTORY_ROOT."/includes/views/icon_article.php"); ?>
		</div>
	<? } ?>

	<div class="detailContent">

		<h2><?=$article->getString("title");?></h2>

		<?
		if (($article->getString("publication_date", true)) || ($article->getString("author", true))) echo "<p class=\"complementaryInfo\">\n"; 
		if ($article->getString("publication_date", true)) {
			echo system_showText(LANG_ARTICLE_PUBLISHED).": ".$article->getDate("publication_date");
		}
		if ($article->getString("author", true)) {
			echo " ".system_showText(LANG_BY)." ";
			if (($user) && ($article->getString("author_url", true))) {
				echo "<a href=\"".$article->getString("author_url", true)."\" target=\"_blank\">\n";
			}
			echo $article->getString("author", true);
			if (($user) && ($article->getString("author_url", true))) {
				echo "</a>\n";
			}
		}
		if (($article->getString("publication_date", true)) || ($article->getString("author", true))) echo "</p>\n";
		?>
		
		<? if($article->getString("content")) { ?><p class="detailSpacer"><?=nl2br($article->getStringLang(EDIR_LANGUAGE, "content", true))?></p><? } ?>		

	</div>

	<div class="detailComplementaryContent" style="width:<?=(IMAGE_EVENT_FULL_WIDTH+20)?>px;">

		<h3 class="detailTitle"><?=system_showText(LANG_LABEL_PHOTO_GALLERY);?></h3>

		<?
		$imageObj = new Image($article->getNumber("image_id"));
		if ($imageObj->imageExists()) {
			echo "<div class=\"imgDetail\">";
			echo $imageObj->getTag(true, IMAGE_EVENT_FULL_WIDTH, IMAGE_EVENT_FULL_HEIGHT, $article->getString("title"));
			echo "</div>";
			if ($article->getString("image_attribute")) {
				echo "<p class=\"complementaryInfo\">".$article->getString("image_attribute")."</p>";
			}
			if ($article->getString("image_caption")) {
				echo "<p class=\"complementaryInfo\">".$article->getString("image_caption")."</p>";
			}
		} else {
			echo "<div class=\"imgDetail\" style=\"width:".(IMAGE_EVENT_FULL_WIDTH)."px;\">";
			echo "<div class=\"noimage\" style=\"height:".(IMAGE_EVENT_FULL_HEIGHT)."px;\">&nbsp;</div>";
			echo "</div>";
			
		}
		?>

		<?
		$articleGallery = "";
		$articleGallery = system_showFrontGallery($article->getGalleries(), $article->getNumber("level"), $user, 4, "article");
		if ($articleGallery!="") {
			?>
			<div class="detailGallery">
				<?=$articleGallery?>
			</div>
			<?
		}
		?>

	</div>

	<?
	setting_get("review_article_enabled", $review_enabled);
	if ($review_enabled == "on") {
		$item_id   = $id;
		$item_type = 'article';
		include(INCLUDES_DIR."/views/view_review.php");
		$summary_review .= $item_review;
		$item_review = "";
		$detail_review = "";
		if ($reviewsArr) {
			foreach ($reviewsArr as $each_rate) {
				if ($each_rate->getString("review")) {
					$each_rate->extract();
					include(INCLUDES_DIR."/views/view_review_detail.php");
					$detail_review .= $item_reviewcomment;
					$item_reviewcomment = "";
				}
			}
		}
		?>
		<div class="detailRatings">
			<h3 class="detailTitle" <?=$templateCSSLabel;?>><?=system_showText(LANG_REVIEWTITLE)?> <span class="complementaryInfo"><?=$summary_review?></span></h3>
			<? if ($detail_review) { ?>
				<?=$detail_review?>
			<? } ?>
		</div>
		<?
	}
	?>

</div>