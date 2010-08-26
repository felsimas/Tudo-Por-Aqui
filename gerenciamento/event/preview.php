<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/event/preview.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (EVENT_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	$url_redirect = "".DEFAULT_URL."/gerenciamento/event";
	$url_base = "".DEFAULT_URL."/gerenciamento";
	$sitemgr = 1;

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	$error = false;
	if ($id) {
		$event = new Event($id);
		if ((!$event->getNumber("id")) || ($event->getNumber("id") <= 0)) {
			$error = true;
		}
	} else {
		$error = true;
	}

	header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=<?=EDIR_CHARSET;?>" />
		<title><?=system_showText(LANG_SITEMGR_EVENT_SING)?> <?=ucwords(system_showText(LANG_SITEMGR_PREVIEW))?></title>
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
        <script language="javascript" src="<?=DEFAULT_URL?>/scripts/common.js"></script>
        <script language="javascript" src="<?=DEFAULT_URL?>/scripts/lang.js.php"></script>
		<?=system_getNoImageStyle($cssfile = true);?>
	</head>
	<body>

		<?
		if (!$error) {
			?>
			<ul class="basePreviewNavbar">
				<li><a href="javascript:window.close();"><?=system_showText(LANG_SITEMGR_CLOSEWINDOW)?></a></li>
			</ul>
			<?
			$level = new EventLevel();
			echo "<h5>".system_showText(LANG_SITEMGR_SUMMARYPAGE)."</h5>";
			include(INCLUDES_DIR."/views/view_event_summary_".$event->getNumber("level").".php");
			if ($level->getDetail($event->getNumber("level")) == "y") {
				echo "<h5>".system_showText(LANG_SITEMGR_DETAILPAGE)."</h5>";
				include(INCLUDES_DIR."/views/view_event_detail_".$event->getNumber("level").".php");
			}
		} else {
			echo "<center><img src=\"".DEFAULT_URL."/images/content/img_error.gif\" alt=\"Error\" border=\"0\" /></center>";
		}
		?>

		<ul class="basePreviewNavbar">
			<li><a href="javascript:window.close();"><?=system_showText(LANG_SITEMGR_CLOSEWINDOW)?></a></li>
		</ul>

	</body>
</html>
