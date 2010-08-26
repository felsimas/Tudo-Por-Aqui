<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/views/view_article_summary_50.php
	# ----------------------------------------------------------------------------------------------------

	if (MODREWRITE_FEATURE == "on") {
		$detailLink = "".ARTICLE_DEFAULT_URL."/".$article->getString("friendly_url").".html";
	} else {
		$detailLink = "".ARTICLE_DEFAULT_URL."/detail.php?id=".$article->getNumber("id");
	}

?>

<div class="summary">

	<div class="baseIconNavbar">
		<? include(EDIRECTORY_ROOT."/includes/views/icon_article.php"); ?>
	</div>

	<div class="summaryTitle">
	
		<h3>
			<? if (($user) && ($level->getDetail($article->getNumber("level")) == "y")) { ?>
				<a href="<?=$detailLink?>">
			<? } ?>
			<?=$article->getString("title")?>
			<? if (($user) && ($level->getDetail($article->getNumber("level")) == "y")) { ?>
				</a>
			<? } ?>
		</h3>

		<p class="complementaryInfo">
			<?
			if ($article->getString("publication_date", true)) {
				echo system_showText(LANG_ARTICLE_PUBLISHED).": ".$article->getDate("publication_date");
			}
			if ($article->getString("author", true)) {
				echo " ".system_showText(LANG_BY)." ";
				if ($article->getString("author_url", true)) {
					echo "<a href=\"".$article->getString("author_url", true)."\" target=\"_blank\">\n";
				}
				echo $article->getString("author", true);
				if ($article->getString("author_url", true)) {
					echo "</a>\n";
				}
			}
			echo " ".system_itemRelatedCategories($article->getNumber("id"), "article", $user);
			?>
		</p>

	</div>
	
	<div class="summaryImage">
			<?
			$imageObj = new Image($article->getNumber("thumb_id"));
			if ($imageObj->imageExists()) {
				if (($user) && ($level->getDetail($article->getNumber("level")) == "y")) echo "<a href=\"".$detailLink."\">";
				echo $imageObj->getTag(true, IMAGE_ARTICLE_THUMB_WIDTH, IMAGE_ARTICLE_THUMB_HEIGHT, $article->getString("title"));
				if (($user) && ($level->getDetail($article->getNumber("level")) == "y")) echo "</a>";
			} else {
				echo "<div class=\"noimage\" style=\"width:".(IMAGE_ARTICLE_THUMB_WIDTH+5)."px; height:".(IMAGE_ARTICLE_THUMB_HEIGHT)."px;\">";
				if (($user) && ($level->getDetail($article->getNumber("level")) == "y")) echo "<a href=\"".$detailLink."\">";
				echo "&nbsp;";
				if (($user) && ($level->getDetail($article->getNumber("level")) == "y")) echo "</a>";
				echo "</div>";
			}
			?>
	</div>

	<p class="summaryDescription"><?=nl2br($article->getStringLang(EDIR_LANGUAGE, "abstract", true))?></p>
	
	<? 
	setting_get('review_article_enabled', $review_enabled);
	if ($review_enabled == 'on') {
		$item_type = 'article';
		$item_id   = $article->getNumber('id');
		$itemObj   = $article;
	    include(INCLUDES_DIR."/views/view_review.php");
	    echo $item_review;
	}
	?>
		
</div>