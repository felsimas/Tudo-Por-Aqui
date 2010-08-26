<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /frontend/featured_article.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (ARTICLE_FEATURE == "on") {

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	$numberOfArticles = 4;

	$sql = "SELECT value FROM ArticleLevel WHERE detail = 'y' ORDER BY value DESC LIMIT 1";
	$dbObj = db_getDBObject();
	$result = $dbObj->query($sql);
	$row = mysql_fetch_assoc($result);
	$level = $row["value"];

	if ($level) {
		unset($searchReturn);
		$searchReturn = search_frontArticleSearch($_GET, "random");
		$sql = "SELECT ".$searchReturn["select_columns"]." FROM ".$searchReturn["from_tables"]." WHERE ".(($searchReturn["where_clause"])?($searchReturn["where_clause"]." AND"):(""))." Article.level = ".$level." ".(($searchReturn["group_by"])?("GROUP BY ".$searchReturn["group_by"]):(""))." ".(($searchReturn["order_by"])?("ORDER BY ".$searchReturn["order_by"]):(""))." LIMIT ".$numberOfArticles."";
		$array_articles = db_getFromDBBySQL("article", $sql);
	}

	$currentArticle = 1;
	if ($array_articles) {

		echo "<h2 class=\"standardTitle\">".system_showText(system_highlightLastWord(LANG_RECENT_ARTICLE))."</h2>";

		echo "<div class=\"featuredItems\">";

		foreach ($array_articles as $article) {

			report_newRecord("article", $article->getString("id"), ARTICLE_REPORT_SUMMARY_VIEW);

			if (MODREWRITE_FEATURE == "on") {
				$detailLink = "".ARTICLE_DEFAULT_URL."/".$article->getString("friendly_url").".html";
			} else {
				$detailLink = "".ARTICLE_DEFAULT_URL."/detail.php?id=".$article->getNumber("id")."";
			}

			echo "<div class=\"featured".(($currentArticle < $numberOfArticles) ? " divisor" : "")."\">";

			echo "<h3><a href=\"".$detailLink."\">".$article->getString("title")."</a></h3>";

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

			echo "<p class=\"complementaryInfo\">".$publication_string." ".$author_string." ".system_itemRelatedCategories($article->getNumber("id"), "article", true)."</p>";

			echo "</div>";
			$currentArticle++;

		}

		echo "</div>";

	}

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	}

?>
