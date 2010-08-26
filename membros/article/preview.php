<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /membros/article/preview.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (ARTICLE_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSession();
	$acctId = sess_getAccountIdFromSession();

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_GET);
	extract($_POST);

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	$error = false;
	if ($id) {
		$article = new Article($id);
		if ((!$article->getNumber("id")) || ($article->getNumber("id") <= 0)) {
			$error = true;
		}
		if (sess_getAccountIdFromSession() != $article->getNumber("account_id")) {
			$error = true;
		}
	} else {
		$error = true;
	}

	header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);

	# ----------------------------------------------------------------------------------------------------
	# REVIEWS
	# ----------------------------------------------------------------------------------------------------
	if ($id)  $sql_where[] = " item_type = 'article' AND item_id = ".db_formatNumber($id)." ";
	if (true) $sql_where[] = " review IS NOT NULL AND review != '' ";
	if (true) $sql_where[] = " approved = '1' ";
	if ($sql_where) $sqlwhere .= " ".implode(" AND ", $sql_where)." ";
	$pageObj  = new pageBrowsing("Review", $screen, 3, "added DESC", "", "", $sqlwhere);
	$reviewsArr = $pageObj->retrievePage("object");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=<?=EDIR_CHARSET;?>" />
		<title><?=system_showText(LANG_ARTICLE_PREVIEW);?></title>
		<?
		if (EDIR_THEME) {
			include(THEMEFILE_DIR."/".EDIR_THEME."/".EDIR_THEME.".php");
		} else {
			?>
			<link href="<?=DEFAULT_URL?>/layout/general_structure.css" rel="stylesheet" type="text/css" />
			<link href="<?=DEFAULT_URL?>/layout/results.css" rel="stylesheet" type="text/css" />
			<link href="<?=DEFAULT_URL?>/layout/detail.css" rel="stylesheet" type="text/css" />
			<link href="<?=DEFAULT_URL?>/layout/preview.css" rel="stylesheet" type="text/css" />
			<?
		}
		?>
        <script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/common.js"></script>
        <script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/lang.js.php"></script>
		<?=system_getNoImageStyle($cssfile = true);?>
	</head>
	<body class="previewmember">

		<?
		if (!$error) {
			?>
			<ul class="basePreviewNavbar">
				<li><a href="javascript:window.close();"><?=system_showText(LANG_LABEL_CLOSETHISWINDOW);?></a></li>
			</ul>
			<?
			$level = new ArticleLevel();
			echo "<h5>".system_showText(LANG_LABEL_SUMMARY_PAGE)."</h5>";
			include(INCLUDES_DIR."/views/view_article_summary_".$article->getNumber("level").".php");
			if ($level->getDetail($article->getNumber("level")) == "y") {
				echo "<h5>".system_showText(LANG_LABEL_DETAIL_PAGE)."</h5>";
				include(INCLUDES_DIR."/views/view_article_detail_".$article->getNumber("level").".php");
			}
		} else {
			echo "<center><img src=\"".DEFAULT_URL."/images/content/img_error.gif\" alt=\"".system_showText(LANG_LABEL_ERROR)."\" border=\"0\" /></center>";
		}
		?>

		<ul class="basePreviewNavbar">
			<li><a href="javascript:window.close();"><?=system_showText(LANG_LABEL_CLOSETHISWINDOW);?></a></li>
		</ul>

	</body>
</html>
