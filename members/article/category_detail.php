<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /membros/article/category_detail.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (ARTICLE_FEATURE != "on") { exit; }

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<meta http-equiv="Content-Type" content="text/html; charset=<?=EDIR_CHARSET;?>" />
	<head>
		<title><?=system_showText(LANG_LABEL_CATEGORY_DETAIL)?></title>
		<link href="<?=DEFAULT_URL?>/layout/popup.css" rel="stylesheet" type="text/css" media="all" />
		<script>window.focus();</script>
	</head>
	<body>
		<div class="wrapper">
			<h1><?=system_showText(LANG_BUTTON_VIEWCATEGORYPATH)?></h1>
			<? include(EDIRECTORY_ROOT."/includes/views/view_article_category_detail.php"); ?>
		</div>
	</body>
</html>
