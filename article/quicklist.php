<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /article/quicklist.php
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

	$ids = $_COOKIE["bookmarkarticle"];
	if ($ids) {
		$ids = str_replace("\\", "", $ids);
		$ids = str_replace("=", "", $ids);
		$ids = str_replace("%27", "", str_replace("'", "", $ids));
		$ids = str_replace("%22", "", str_replace("\"", "", $ids));
		$ids = str_replace(")", "", str_replace("(", "", $ids));
		$ids = preg_replace("([^0-9,])", "", $ids);
		$ids = system_denyInjections($ids);
		if ($ids) {
			$sql = "SELECT * FROM Article WHERE id IN (".$ids.") ORDER BY level DESC, title";
			$articles = db_getFromDBBySQL("article", $sql);
		}
	}
	
	if (strpos($_SERVER['PHP_SELF'], "favorites.php") !== false) {
		if ($articles) {
			?><h2 class="standardSubTitle"><?=system_showText(system_highlightLastWord(LANG_FAVORITE_ARTICLE));?></h2><?
		}
	} else {
		?><h2 class="standardTitle"><?=system_showText(system_highlightLastWord(LANG_FAVORITE_ARTICLE));?></h2><?
	}

	if ($articles) {

		?>
		<div class="quickList">
			<?

			$articleLevel = new ArticleLevel();

			$itemsPerLine = 6;
			$thisItemAmount = 0;
			foreach ($articles as $article) {
				if (($thisItemAmount) && !($thisItemAmount%$itemsPerLine)) echo "<span class=\"clear\"></span>";
				$thisItemAmount++;

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
				
				if (strpos($_SERVER['PHP_SELF'], "favorites.php") !== false) {

					echo "<div class=\"featuredItems favoriteArticle\">";?>
					<a href="javascript:void(0)" class="quickListRemove" onclick="removeFromCookie('<?=$article->getNumber("id")?>','<?=EDIRECTORY_FOLDER?>','article')"><img src="<?=DEFAULT_URL?>/images/icon_delete.gif" alt="<?=system_showText(LANG_QUICKLIST_REMOVE);?>" title="<?=system_showText(LANG_QUICKLIST_REMOVE);?>" /></a>
					<? $imageObj = new Image($article->getNumber("thumb_id"));
					if ($imageObj->imageExists()) {
						echo "<a href=\"".$detailLink."\" class=\"favoriteArticleImage\">";
						echo $imageObj->getTag(true, IMAGE_FAVORITE_ARTICLE_WIDTH, IMAGE_FAVORITE_ARTICLE_HEIGHT, $article->getString("title"), true);
						echo "</a>";
					} else {
						echo "<a href=\"".$detailLink."\" class=\"favoriteArticleImage noimage\" style=\"".system_getNoImageStyle()."\">";
						echo "&nbsp;";
						echo "</a>";
					}
					echo "<h3><a href=\"".$detailLink."\">";
					if (strlen($article->getString("title")) > 40) echo substr($article->getString("title"), 0, 37)."...";
					else echo $article->getString("title");
					echo "</a></h3>";
					echo "</div>";
					
				} else {
				
					echo "<h3>";
								?><a href="javascript:void(0)" class="quickListRemove" onclick="removeFromCookie('<?=$article->getNumber("id")?>','<?=EDIRECTORY_FOLDER?>','article')"><img src="<?=DEFAULT_URL?>/images/icon_delete.gif" alt="<?=system_showText(LANG_QUICKLIST_REMOVE);?>" title="<?=system_showText(LANG_QUICKLIST_REMOVE);?>" /></a><?
							echo "<a href=\"".$detailLink."\">".$article->getString("title")."</a>";
					echo "</h3>";
				
				}

			}

			?>
		</div>
		<?

	} else {
		
		if (strpos($_SERVER['PHP_SELF'], "favorites.php") === false) {
			echo "<div class=\"response-msg notice ui-corner-all\">".system_showText(LANG_LABEL_NOQUICKLIST)."</div>";
		}
		
	}
	
	if (strpos($_SERVER['PHP_SELF'], "favorites.php") === false) {
		echo "<p class=\"viewMore\"><a href=\"".DEFAULT_URL."/favorites.php\">".system_showText(LANG_QUICK_LIST)." &raquo;</a></p>";
	}

?>
