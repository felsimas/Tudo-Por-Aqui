<?

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("./conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/validate_querystring.php");
	include(EDIRECTORY_ROOT."/includes/code/validate_frontrequest.php");

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", FALSE);
	header("Pragma: no-cache");
	header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);

	$_GET["prefix"] = system_denyInjections($_GET["prefix"]);
	$_GET["category"] = system_denyInjections($_GET["category"]);

	$langIndex = language_getIndex(EDIR_LANGUAGE);

	$return = "";

	if (strpos(strtolower($_GET["category"]), "category") !== false) {
		if ($_GET["action"] == "template") {
			$listingtemplate = new ListingTemplate($_GET["template_id"]);
			if ($listingtemplate) {
				$templatecategories = $listingtemplate->getCategories();
			}
			if ($templatecategories) {
				foreach ($templatecategories as $templatecategory) {
					$arraycategories[] = $templatecategory->getNumber("id");
				}
				$categories = db_getFromDBBySQL($_GET["category"], "SELECT * FROM ".$_GET["category"]." WHERE category_id = ".db_formatNumber($_GET["category_id"])." AND id IN (".(implode(",", $arraycategories)).")AND lang LIKE ".db_formatString("%".EDIR_LANGUAGE."%")." ORDER BY title");
			} else {
				$categories = db_getFromDBBySQL($_GET["category"], "SELECT * FROM ".$_GET["category"]." WHERE category_id = ".db_formatNumber($_GET["category_id"])." AND lang LIKE ".db_formatString("%".EDIR_LANGUAGE."%")." ORDER BY title");
			}
		} else {
			$categories = db_getFromDBBySQL($_GET["category"], "SELECT * FROM ".$_GET["category"]." WHERE category_id = ".db_formatNumber($_GET["category_id"])." AND lang LIKE ".db_formatString("%".EDIR_LANGUAGE."%")." ORDER BY title");
		}
	}

	if ($categories) {
		$dbObj = db_getDBObject();
		foreach ($categories as $category) {
			if ($_GET["action"] == "main") {
				$return .= "<li class=\"categoryBullet\">".$category->getString("title".$langIndex)." <a href=\"javascript:void(0);\" onClick=\"JS_addCategory('".html_entity_decode(addslashes($category->getString("title".$langIndex)))."', ".$category->getNumber("id").");\" class=\"categoryAdd\">".system_showText(LANG_ADD)."</a></li>";
			} else {
				$path_count = count($category->getFullPath());
				$sql = "SELECT id FROM ".$_GET["category"]." WHERE category_id =".$category->getNumber("id")." AND lang LIKE ".db_formatString("%".EDIR_LANGUAGE."%");
				$result = $dbObj->query($sql);
				if (($path_count < CATEGORY_LEVEL_AMOUNT) && (mysql_num_rows($result) > 0)) {
					$return .= "<li>\n<a href=\"javascript:void(0);\" onClick=\"loadCategoryTree('all', '".$_GET["prefix"]."', '".$_GET["category"]."', ".$category->getNumber("id").", 0, '".EDIRECTORY_FOLDER."');\" class=\"categoryOpen\" id=\"".$_GET["prefix"]."opencategorytree_id_".$category->getNumber("id")."\">+</a><a href=\"javascript:void(0);\" onClick=\"loadCategoryTree('all', '".$_GET["prefix"]."', '".$_GET["category"]."', ".$category->getNumber("id").", 0, '".EDIRECTORY_FOLDER."');\" class=\"categoryTitle\" id=\"".$_GET["prefix"]."opencategorytree_title_id_".$category->getNumber("id")."\">".$category->getString("title".$langIndex)."</a><a href=\"javascript:void(0);\" onClick=\"closeCategoryTree('".$_GET["prefix"]."', '".$_GET["category"]."', ".$category->getNumber("id").", '".DEFAULT_URL."');\" class=\"categoryClose\" id=\"".$_GET["prefix"]."closecategorytree_id_".$category->getNumber("id")."\" style=\"display: none;\">-</a><a href=\"javascript:void(0);\" onClick=\"closeCategoryTree('".$_GET["prefix"]."', '".$_GET["category"]."', ".$category->getNumber("id").", '".DEFAULT_URL."');\" class=\"categoryTitle\" id=\"".$_GET["prefix"]."closecategorytree_title_id_".$category->getNumber("id")."\" style=\"display: none;\">".$category->getString("title".$langIndex)."</a>\n<ul id=\"".$_GET["prefix"]."categorytree_id_".$category->getNumber("id")."\" style=\"display: none;\"></ul>\n</li>\n";
				} else {
					$return .= "<li class=\"categoryBullet\">".$category->getString("title".$langIndex)." <a href=\"javascript:void(0);\" onClick=\"JS_addCategory('".html_entity_decode(addslashes($category->getString("title".$langIndex)))."', ".$category->getNumber("id").");\" class=\"categoryAdd\">".system_showText(LANG_ADD)."</a></li>";
				}
			}
		}
	} else {
		$return = "<li class=\"informationMessage\">".system_showText(LANG_CATEGORY_NOTFOUND)."</li>";
	}

	echo $return;

?>
