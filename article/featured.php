<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /article/featured.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (ARTICLE_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	$numberOfArticles = 9;

	$sql = "SELECT value FROM ArticleLevel WHERE detail = 'y' ORDER BY value DESC LIMIT 1";
	$dbObj = db_getDBObject();
	$result = $dbObj->query($sql);
	$row = mysql_fetch_assoc($result);
	$level = $row["value"];

	if ($level) {
		unset($searchReturn);
		$searchReturn = search_frontArticleSearch($_GET, "random");
		$sql = "SELECT ".$searchReturn["select_columns"]." FROM ".$searchReturn["from_tables"]." WHERE ".(($searchReturn["where_clause"])?($searchReturn["where_clause"]." AND"):(""))." Article.level = ".$level." ".(($searchReturn["group_by"])?("GROUP BY ".$searchReturn["group_by"]):(""))." ".(($searchReturn["order_by"])?("ORDER BY ".$searchReturn["order_by"]):(""))." LIMIT ".$numberOfArticles."";
		$random_articles = db_getFromDBBySQL("article", $sql);
	}

	if ($random_articles) {
		$top_featured_article = "";
		$featured_article = "";
		?>

		<h2 class="standardTitle"><?=system_highlightLastWord(LANG_FEATURED_ARTICLE)?></h2>
		<div class="featuredItems">

			<?
			$user = true;
			$count = 0;
			foreach ($random_articles as $article) {

				report_newRecord("article", $article->getString("id"), ARTICLE_REPORT_SUMMARY_VIEW);

				if (MODREWRITE_FEATURE == "on") {
					$detailLink = "".ARTICLE_DEFAULT_URL."/".$article->getString("friendly_url").".html";
				} else {
					$detailLink = "".ARTICLE_DEFAULT_URL."/detail.php?id=".$article->getNumber("id")."";
				}

				if ($count < 3) {

					if ($count < 2) $top_featured_article .= "<div class=\"divisor\">";

					$top_featured_article .= "<div class=\"highlightImage\">";

					$imageObj = new Image($article->getNumber("thumb_id"));
					if ($imageObj->imageExists()) {
						$top_featured_article .= "<a href=\"".$detailLink."\" class=\"featuredArticleImage\">";
						$top_featured_article .= $imageObj->getTag(true, IMAGE_FRONT_ARTICLE_WIDTH, IMAGE_FRONT_ARTICLE_HEIGHT, $article->getString("title"), true);
						$top_featured_article .= "</a>";
					} else {
						$top_featured_article .= "<a href=\"".$detailLink."\" class=\"featuredArticleImage noimage\" style=\"".system_getNoImageStyle()."\">";
						$top_featured_article .= "&nbsp;";
						$top_featured_article .= "</a>";
					}

					$top_featured_article .= "</div>";

					$top_featured_article .= "<h3><a href=\"".$detailLink."\">".((strlen($article->getString("title"))<=30)?($article->getString("title")):(substr($article->getString("title"), 0, 27)."..."))."</a></h3>";

					$publication_string = "";
					if ($article->getString("publication_date", true)) {
						$publication_string .= system_showText(LANG_ARTICLE_PUBLISHED).": ".$article->getDate("publication_date");
					}

					$author_string = "";
					if ($article->getString("author", true)) {
						$author_string .= system_showText(LANG_BY)." ";
						if ($article->getString("author_url", true)) {
							$author_string .= "<a href=\"".$article->getString("author_url", true)."\" target=\"_blank\">\n";
						}
						$author_string .= " ".$article->getString("author", true);
						if ($article->getString("author_url", true)) {
							$author_string .= "</a>\n";
						}
					}

					$top_featured_article .= "<p class=\"complementaryInfo\">".$publication_string." ".$author_string." ".system_itemRelatedCategories($article->getNumber("id"), "article", true)."</p>";

					$top_featured_article .= "<p class=\"description\">".((strlen($article->getStringLang(EDIR_LANGUAGE, "abstract"))<=100)?($article->getStringLang(EDIR_LANGUAGE, "abstract")):(substr($article->getStringLang(EDIR_LANGUAGE, "abstract"), 0, 97)."..."))."</p>";

					if ($count < 2) $top_featured_article .= "</div>";

				} else {

					$featured_article .= "<div class=\"featured".(($count < ($numberOfArticles - 1)) ? " divisor" : "")."\">";

					$featured_article .= "<h3><a href=\"".$detailLink."\">".((strlen($article->getString("title"))<=30)?($article->getString("title")):(substr($article->getString("title"), 0, 27)."..."))."</a></h3>";

					$publication_string = "";
					if ($article->getString("publication_date", true)) {
						$publication_string .= system_showText(LANG_ARTICLE_PUBLISHED).": ".$article->getDate("publication_date");
					}

					$author_string = "";
					if ($article->getString("author", true)) {
						$author_string .= system_showText(LANG_BY)." ";
						if ($article->getString("author_url", true)) {
							$author_string .= "<a href=\"".$article->getString("author_url", true)."\" target=\"_blank\">\n";
						}
						$author_string .= " ".$article->getString("author", true);
						if ($article->getString("author_url", true)) {
							$author_string .= "</a>\n";
						}
					}

					$featured_article .= "<p class=\"complementaryInfo\">".$publication_string." ".$author_string." ".system_itemRelatedCategories($article->getNumber("id"), "article", true)."</p>\n\n";

					$featured_article .= "</div>";

				}

				$count++;

			}
			?>

			<div class="highlightBox">
				<span class="highlightLabel"><?=system_showText(LANG_ITEM_FEATURED);?></span>
				<?=$top_featured_article?>
			</div>

			<div class="featuredColumn">
				<?=$featured_article?>
			</div>

		</div>

		<?
	}

?>
