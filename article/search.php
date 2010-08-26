<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /article/search.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/loadconfig.inc.php");

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

	header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", FALSE);
	header("Pragma: no-cache");
	header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);

	$langIndex = language_getIndex(EDIR_LANGUAGE);

	$categories = db_getFromDBBySQL("articlecategory", "SELECT * FROM ArticleCategory WHERE category_id = 0 AND lang LIKE ".db_formatString("%".EDIR_LANGUAGE."%")." ORDER BY title");
	if ($categories) {
		foreach ($categories as $category) {
			if (ARTICLECATEGORY_SCALABILITY_OPTIMIZATION != "on") {
				$valueArray[] = "";
				$nameArray[] = "---------------------------";
			}
			$valueArray[] = $category->getNumber("id");
			$nameArray[] = $category->getString("title".$langIndex);
			if (ARTICLECATEGORY_SCALABILITY_OPTIMIZATION != "on") {
				$subcategories = db_getFromDBBySQL("articlecategory", "SELECT * FROM ArticleCategory WHERE category_id = ".db_formatNumber($category->getNumber("id"))." AND lang LIKE ".db_formatString("%".EDIR_LANGUAGE."%")." ORDER BY title");
				if ($subcategories) {
					foreach ($subcategories as $subcategory) {
						$valueArray[] = $subcategory->getNumber("id");
						$nameArray[] = "&nbsp;&nbsp;".$subcategory->getString("title".$langIndex);
					}
				}
			}
		}
	}
	if (ARTICLECATEGORY_SCALABILITY_OPTIMIZATION != "on") {
		$valueArray[] = "";
		$nameArray[] = "---------------------------";
	}
	$categoryDD = html_selectBoxCat("category_id", $nameArray, $valueArray, "", "", "class='altSelect'", system_showText(LANG_SEARCH_LABELCBCATEGORY), "article");

	?>

	<span class="clear"></span>

	<fieldset>
		<label class="altLabel"><?=system_showText(LANG_SEARCH_LABELMATCH)?>:</label>
		<input type="radio" name="match" value="exactmatch" class="inputAuto" /><span class="optionDescription"><?=system_showText(LANG_SEARCH_LABELMATCH_EXACTMATCH)?></span>
		<input type="radio" name="match" value="anyword" class="inputAuto" /><span class="optionDescription"><?=system_showText(LANG_SEARCH_LABELMATCH_ANYWORD)?></span>
		<input type="radio" name="match" value="allwords" class="inputAuto" /><span class="optionDescription"><?=system_showText(LANG_SEARCH_LABELMATCH_ALLWORDS)?></span>
	</fieldset>

	<fieldset>
		<label class="altLabel"><?=system_showText(LANG_SEARCH_LABELCATEGORY)?>:</label>
		<?=$categoryDD;?>
	</fieldset>
