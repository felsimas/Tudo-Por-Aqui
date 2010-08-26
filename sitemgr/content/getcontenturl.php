<?
	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/content/getcontenturl.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<meta http-equiv="Content-Type" content="text/html; charset=<?=EDIR_CHARSET;?>" />
	<head>
		<title><?=ucwords(system_showText(LANG_SITEMGR_CONTENT_CONTENTURL))?></title>
		<link href="<?=DEFAULT_URL?>/layout/popup.css" rel="stylesheet" type="text/css" media="all" />
		<script>window.focus();</script>
	</head>
	<body>
		<div class="wrapper">
			<h1><?=ucwords(system_showText(LANG_SITEMGR_VIEW))?> <?=ucwords(system_showText(LANG_SITEMGR_CONTENT_CONTENTURL))?></h1>
			<?
			$thisurl = DEFAULT_URL."/content/";
			if (MODREWRITE_FEATURE != "on") {
				$thisurl .= "index.php?content=";
			}
			$thisurl .= $_GET["c"];
			if (MODREWRITE_FEATURE == "on") {
				$thisurl .= ".html";
			}
			echo "<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$thisurl."<br /><br />";
			?>
		</div>
	</body>
</html>
