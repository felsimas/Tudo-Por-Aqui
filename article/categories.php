<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /article/categories.php
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

	$categoriescontent  = "";

	unset($catObj);
	$catObj = new ArticleCategory();

	unset($categories);
	if (ARTICLECATEGORY_SCALABILITY_OPTIMIZATION == "on") {
		$dbCatObj = db_getDBObJect();
		$sql = "SELECT * FROM ArticleCategory WHERE category_id = '0' AND lang LIKE ".db_formatString("%".EDIR_LANGUAGE."%")." ORDER BY RAND() DESC LIMIT 20";
		$result = $dbCatObj->query($sql);
		$categories = false;
		while ($row = mysql_fetch_assoc($result)) $categories[] = $row;
		unset($dbCatObj);
	} else {
		$categories = $catObj->retrieveAllCategories(EDIR_LANGUAGE);
	}

	$langIndex = language_getIndex(EDIR_LANGUAGE);

	unset($categories_content);

	$total = 0;

	if ($categories) {

		for ($i=0; $i<count($categories); $i++) {

			$code_include = "";
			$count_this_category = 0;
			$hasImage = false;

			if (MODREWRITE_FEATURE == "on") {
				$code_include .= "<h3><a href=\"".ARTICLE_DEFAULT_URL."/guide/".$categories[$i]["friendly_url".$langIndex]."\">".$categories[$i]["title".$langIndex]."</a></h3>";
			} else {
				$code_include .= "<h3><a href=\"".ARTICLE_DEFAULT_URL."/results.php?category_id=".$categories[$i]["id"]."\" class=\"categoriesTitle\">".$categories[$i]["title".$langIndex]."</a></h3>";
			}

			$total++;

			if (ARTICLECATEGORY_SCALABILITY_OPTIMIZATION != "on") {

				unset($subcategories);
				$subcategories = $catObj->retrieveAllSubCatById($categories[$i]["id"], EDIR_LANGUAGE);

				if ($subcategories) {

					unset($code_include_aux);

					for ($j=0; $j<count($subcategories); $j++) {

						if (MODREWRITE_FEATURE == "on") {
							$code_include_aux[$j] = "<a href=\"".ARTICLE_DEFAULT_URL."/guide/".$categories[$i]["friendly_url".$langIndex]."/".$subcategories[$j]["friendly_url".$langIndex]."\">".$subcategories[$j]["title".$langIndex]."</a>";
						} else {
							$code_include_aux[$j] = "<a href=\"".ARTICLE_DEFAULT_URL."/results.php?category_id=".$subcategories[$j]["id"]."\">".$subcategories[$j]["title".$langIndex]."</a>";
						}

						$total++;
						$count_this_category++;

					}

					$code_include .= "<p class=\"complementaryInfo\">".implode(", ", $code_include_aux)."</p>";

				}

			}

			$categories_content[$i]["content"] = $code_include;
			$categories_content[$i]["count"] = $count_this_category;
			$categoriescontent .= $categories_content[$i]["content"];

		}

	}

?>

<? if ($categoriescontent) { ?>

	<p class="standardTitle"><?=system_highlightLastWord(system_showText(LANG_BROWSEBYCATEGORY))?></p>
	<div class="categories">
		<div class="categoriesColumn"><?=$categoriescontent?></div>
		<? if (ARTICLECATEGORY_SCALABILITY_OPTIMIZATION == "on") { ?>
			<p class="viewAllCategories"><a href="<?=ARTICLE_DEFAULT_URL?>/allcategories.php"><?=system_showText(LANG_ARTICLE_VIEWALLCATEGORIES)?> &raquo;</a></p>
		<? } ?>
	</div>

<? } ?>
