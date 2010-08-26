<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/views/view_article_favorites.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("./conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (ARTICLE_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	$ids = $_COOKIE["bookmarkarticle"];
	if ($ids) {
		$sql = "SELECT * FROM Article WHERE id IN (".str_replace("\\", "", $ids).") ORDER BY level DESC, title";
		$articles = db_getFromDBBySQL("article", $sql);
	}

	if ($articles) {

		?>
		<div class="favoriteArticle">
			<p class="standardTitle">Favorite <span><?=ucwords(ARTICLE_FEATURE_NAME_PLURAL);?></span></p>
			<?

			$articleLevel = new ArticleLevel();

			foreach ($articles as $article) {

				$myfavorites++;

				if ($articleLevel->getDetail($article->getNumber("level")) == "y") {
					if (MODREWRITE_FEATURE == "on") {
						$detailLink = "".ARTICLE_DEFAULT_URL."/".$article->getString("friendly_url").".html";
					} else {
						$detailLink = "".ARTICLE_DEFAULT_URL."/detail.php?id=".$article->getNumber("id")."";
					}
				} else {
					$detailLink = "".ARTICLE_DEFAULT_URL."/results.php?id=".$article->getNumber("id")."";
				}

				echo "<blockquote class=\"highlightArticle\" style=\"width:".(IMAGE_FAVORITE_ARTICLE_WIDTH+5)."px;\">";?>
				<a href="javascript:void(0)" class="quickListRemove" onclick="removeFromCookie('<?=$article->getNumber("id")?>','<?=EDIRECTORY_FOLDER?>','article')"><img src="<?=DEFAULT_URL?>/images/icon_delete.gif" alt="Remove" title="Remove" /></a>
				<? $imageObj = new Image($article->getNumber("image_id"));
				if ($imageObj->imageExists()) {
					echo "<a href=\"".$detailLink."\" class=\"favoriteArticleIMAGE\" style=\"width:".(IMAGE_FAVORITE_ARTICLE_WIDTH)."px;\">";
					echo $imageObj->getTag(true, IMAGE_FAVORITE_ARTICLE_WIDTH, IMAGE_FAVORITE_ARTICLE_HEIGHT, $article->getString("title"), true);
					echo "</a>";
				} else {
					echo "<a href=\"".$detailLink."\" class=\"favoriteArticleNOIMAGE\" style=\"width: ".IMAGE_FAVORITE_ARTICLE_WIDTH."px; height: ".IMAGE_FAVORITE_ARTICLE_HEIGHT."px; ".system_getNoImageStyle()."\">";
					echo "&nbsp;";
					echo "</a>";
				}
				echo "<h1><a href=\"".$detailLink."\">";
				if (strlen($article->getString("title")) > 40) echo substr($article->getString("title"), 0, 37)."...";
				else echo $article->getString("title");
				echo "</a></h1>";
				echo "</blockquote>";

			}

			?>
			<br class="clear" /><br class="clear" />
		</div>
		<?

	}

?>
