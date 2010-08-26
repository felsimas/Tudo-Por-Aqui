<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /article/results.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

?>

	<div class="itemSearchResults">

		<?
		$user = true;
		$langIndex = language_getIndex(EDIR_LANGUAGE);
		$str_search = "";
		if ($keyword) $str_search .= " ".system_showText(LANG_SEARCHRESULTS_KEYWORD)." <strong>".$keyword."</strong>";
		if ($where) $str_search .= " ".system_showText(LANG_SEARCHRESULTS_WHERE)." <strong>".$where."</strong>";
		if ($category_id) {
			$search_category = new ArticleCategory($category_id);
			if ($search_category->getString("title".$langIndex)) {
				$str_search .= " ".system_showText(LANG_SEARCHRESULTS_INCATEGORY)." <strong>".$search_category->getString("title".$langIndex)."</strong>";
			}
		}
		if (!$articles) {
			if ($search_lock) {
				echo "<p class=\"errorMessage\">".system_showText(LANG_MSG_LEASTONEPARAMETER)."</p>";
			} else {
				$db = db_getDBObject();
				if($db->getRowCount("Article") > 0){
					if ($str_search) {
						?><p class="standardSubTitle"><?=system_showText(LANG_SEARCHRESULTS)?> <?=$str_search?></p><?
					}
					?><p class="errorMessage"><?=system_showText(LANG_MSG_NORESULTS);?> <?=system_showText(LANG_MSG_TRYAGAIN);?></p><?
					if ($keyword) {
						?><div class="response-msg inf ui-corner-all"><?=system_showText(LANG_MSG_USE_SPECIFIC_KEYWORD);?></div><?
					}
				} else {
					?><div class="response-msg inf ui-corner-all"><?=system_showText(LANG_MSG_NOARTICLES);?></div><?
				}
			}
		} elseif ($articles) {
			$itemRSSSection = "article";
			echo "<h3 class=\"standardTitle\">".system_showText(system_highlightLastWord(LANG_MSG_ARTICLERESULTS));
			echo "<span class=\"complementaryInfo\">";
			include(INCLUDES_DIR."/code/rss.php");
			echo "</span></h3><br class=\"clear\">";
			if ($str_search) {
				?><p class="standardSubTitle"><?=system_showText(LANG_SEARCHRESULTS)?> <?=$str_search?></p><?
			}
			include(EDIRECTORY_ROOT."/frontend/paging.php");
			$level = new ArticleLevel(EDIR_DEFAULT_LANGUAGE, true);
			foreach ($articles as $article) {
				report_newRecord("article", $article->getString("id"), ARTICLE_REPORT_SUMMARY_VIEW);
				include(INCLUDES_DIR."/views/view_article_summary_".$article->getNumber("level").".php");
			}
			echo "<div class=\"summaryBottom\"></div>";
			include(EDIRECTORY_ROOT."/frontend/paging.php");
		}
		?>

	</div>
