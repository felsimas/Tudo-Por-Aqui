<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /article/index.php
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
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/validate_querystring.php");

	# ----------------------------------------------------------------------------------------------------
	# SITE CONTENT
	# ----------------------------------------------------------------------------------------------------
	$contentObj = new Content("", EDIR_LANGUAGE);
	$sitecontentSection = "Article Home";
	$sitecontentinfo = $contentObj->retrieveContentInfoByType($sitecontentSection);
	if ($sitecontentinfo) {
		$headertagtitle = $sitecontentinfo["title"];
		$headertagdescription = $sitecontentinfo["description"];
		$headertagkeywords = $sitecontentinfo["keywords"];
		$sitecontent = $sitecontentinfo["content"];
	} else {
		$headertagtitle = "";
		$headertagdescription = "";
		$headertagkeywords = "";
		$sitecontent = "";
	}

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	//$*_index = 0; // current * article index
	//$*_img = 0; // number of * article with image
	//$*_max = 3; // max * article
	$middle_index = 0;
	$right_index = 0;
	$middle_img = 1;
	$right_img = 2;
	$middlemax = $middle_max = 4;
	$rightmax = $right_max = 4;

	$sql = "SELECT value FROM ArticleLevel WHERE detail = 'y' ORDER BY value DESC LIMIT 1";
	$dbObj = db_getDBObject();
	$result = $dbObj->query($sql);
	$row = mysql_fetch_assoc($result);
	$level = $row["value"];

	if ($level) {
		unset($searchReturn);
		$searchReturn = search_frontArticleSearch($_GET, "random");
		$sql = "SELECT ".$searchReturn["select_columns"]." FROM ".$searchReturn["from_tables"]." WHERE ".(($searchReturn["where_clause"])?($searchReturn["where_clause"]." AND"):(""))." Article.level = ".$level." ".(($searchReturn["group_by"])?("GROUP BY ".$searchReturn["group_by"]):(""))." ".(($searchReturn["order_by"])?("ORDER BY ".$searchReturn["order_by"]):(""))." LIMIT ".($middle_max+$right_max)."";
		$array_articles = db_getFromDBBySQL("article", $sql);
	}

	if ($array_articles) {

		$i=0;

		$articleindex = array();

		if (count($array_articles) < ($middle_max+$right_max)) {

			$middle_max = floor(count($array_articles)/2);
			$right_max = floor(count($array_articles)/2);

			if (count($array_articles) > ($middle_max+$right_max)) {
				if ((count($array_articles) - ($middle_max+$right_max)) == 1) {
					$right_max++;
				}
			}

			if ($middle_max == 0) {
				$middle_max = 1;
				$right_max = 0;
			}

			if ($middle_img > $middle_max) $middle_img = $middle_max;
			if ($right_img > $right_max) $right_img = $right_max;

		}

		foreach ($array_articles as $article) {

			$imageObj = new Image($article->getNumber("image_id"));

			if ($imageObj->imageExists()) {

				if ($middle_index < $middle_img) {
					$articlesmiddle[$middle_index] = $article;
					$middle_index++;
					$articleindex[] = $i;
				} elseif ($right_index < $right_img) {
					$articlesright[$right_index] = $article;
					$right_index++;
					$articleindex[] = $i;
				}

			}

			$i++;

		}

		$i=0;

		foreach ($array_articles as $article) {

			if (!in_array($i, $articleindex)) {

				if ($middle_index < $middle_max) {
					$articlesmiddle[$middle_index] = $article;
					$middle_index++;
				} elseif ($right_index < $right_max) {
					$articlesright[$right_index] = $article;
					$right_index++;
				}

			}

			$i++;

		}

	}

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	$extrastyle = DEFAULT_URL."/layout/front.css";
	$banner_section = "article";
	$headertag_title = $headertagtitle;
	$headertag_description = $headertagdescription;
	$headertag_keywords = $headertagkeywords;
	include(EDIRECTORY_ROOT."/layout/header.php");

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");

	# ----------------------------------------------------------------------------------------------------
	# BODY
	# ----------------------------------------------------------------------------------------------------
	if (EDIR_THEME) {
		include(THEMEFILE_DIR."/".EDIR_THEME."/body/article_index.php");
	} else {
		include(EDIRECTORY_ROOT."/frontend/body/article_index.php");
	}

	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	$banner_section = "article";
	include(EDIRECTORY_ROOT."/layout/footer.php");

?>
