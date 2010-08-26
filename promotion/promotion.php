<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /promotion/promotion.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/validate_querystring.php");

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	unset($promotionMsg);
	if (($_GET["id"]) || ($_POST["id"])) {
		$id = $_GET["id"] ? $_GET["id"] : $_POST["id"];
		$promotion = new Promotion($id);
		$level = new ListingLevel();
		if ((!$promotion->getNumber("id")) || ($promotion->getNumber("id") <= 0)) {
			$promotionMsg = system_showText(LANG_MSG_NOTFOUND);
			unset($promotion);
		} else {
			$listing = db_getFromDB("listing", "promotion_id", $promotion->getNumber("id"));
			$today = mktime(0,0,0,date("m"),date("d"),date("Y"));
			list($promotion_end_year,$promotion_end_month,$promotion_end_day) = split("-",$promotion->getString("end_date"));
			$promotion_end_date = mktime(0,0,0,(int)$promotion_end_month,(int)$promotion_end_day,(int)$promotion_end_year);
			if ((!$listing->getNumber("id")) || ($listing->getNumber("id") <= 0) || ($level->getHasPromotion($listing->getNumber("level")) != "y") || ($listing->getString("status") != "A") || ($promotion_end_date < $today)) {
				$promotionMsg = system_showText(LANG_MSG_NOTAVAILABLE);
				unset($promotion);
			}
		}
	} else {
		$promotionMsg = system_showText(LANG_MSG_NOTFOUND);
		unset($promotion);
	}

	if ($promotion) {
		$headertag_title = (($promotion->getString("seo_name"))?($promotion->getString("seo_name")):($promotion->getString("name")));
		$headertag_description = (($promotion->getStringLang(EDIR_LANGUAGE, "seo_description"))?($promotion->getStringLang(EDIR_LANGUAGE, "seo_description")):($promotion->getStringLang(EDIR_LANGUAGE, "description")));
		$headertag_keywords = (($promotion->getStringLang(EDIR_LANGUAGE, "seo_keywords"))?($promotion->getStringLang(EDIR_LANGUAGE, "seo_keywords")):(str_replace(" || ", ", ", $promotion->getStringLang(EDIR_LANGUAGE, "keywords"))));
	} else {
		$headertag_title = $promotionMsg;
	}

	header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);

	include(INCLUDES_DIR."/code/headertag.php");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

	<head>

		<meta http-equiv="Content-Type" content="text/html; charset=<?=EDIR_CHARSET;?>" />

		<meta name="ROBOTS" content="index, follow" />

		<? $headertag_title = (($headertag_title) ? ($headertag_title) : (EDIRECTORY_TITLE)); ?>
		<title><?=$headertag_title?></title>

		<? $headertag_author = (($headertag_author) ? ($headertag_author) : ("Sis Dir 2009 - Classificados")); ?>
		<meta name="author" content="<?=$headertag_author?>" />

		<? $headertag_description = (($headertag_description) ? ($headertag_description) : (EDIRECTORY_TITLE)); ?>
		<meta name="description" content="<?=$headertag_description?>" />

		<? $headertag_keywords = (($headertag_keywords) ? ($headertag_keywords) : (EDIRECTORY_TITLE)); ?>
		<meta name="keywords" content="<?=$headertag_keywords?>" />

		<?
		if (EDIR_THEME) {
			include(THEMEFILE_DIR."/".EDIR_THEME."/".EDIR_THEME.".php");
		} else {
			?><link href="<?=DEFAULT_URL?>/layout/popup.css" rel="stylesheet" type="text/css" media="all" /><?
		}
		?>

		<?=system_getNoImageStyle($cssfile = true);?>

	</head>

	<body>

		<?
		if (!$promotionMsg) {
			$user = true;
			include(INCLUDES_DIR."/views/view_promotion.php");
		} else {
			echo "<p class=\"errorMessage\">".$promotionMsg."</p>";
		}
		?>

	</body>

</html>
