<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /event/print.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (EVENT_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/validate_querystring.php");

	# ----------------------------------------------------------------------------------------------------
	# EVENT
	# ----------------------------------------------------------------------------------------------------
	if (($_GET["id"]) || ($_POST["id"])) {
		$id = $_GET["id"] ? $_GET["id"] : $_POST["id"];
		$event = new Event($id);
		$level = new EventLevel();
		unset($eventMsg);
		if ((!$event->getNumber("id")) || ($event->getNumber("id") <= 0)) {
			$eventMsg = system_showText(LANG_MSG_NOTFOUND);
			unset($event);
		} elseif ($event->getString("status") != "A") {
			$eventMsg = system_showText(LANG_MSG_NOTAVAILABLE);
			unset($event);
		} elseif ($level->getDetail($event->getNumber("level")) != "y") {
			$eventMsg = system_showText(LANG_MSG_NOTAVAILABLE);
			unset($event);
		}
	} else {
		$eventMsg = system_showText(LANG_MSG_NOTFOUND);
		unset($event);
	}

	if ($event) {
		$headertag_title = $event->getString("title");
		$headertag_description = $event->getString("description");
		$headertag_keywords = str_replace(" || ", ", ", $event->getString("keywords"));
	} else {
		$headertag_title = $eventMsg;
	}

	header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);

	include(INCLUDES_DIR."/code/headertag.php");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

	<head>

		<meta http-equiv="Content-Type" content="text/html; charset=<?=EDIR_CHARSET;?>" />

		<meta name="ROBOTS" content="index, follow" />

		<? $headertag_author = (($headertag_author) ? ($headertag_author) : ("Sis Dir 2009 - Classificados")); ?>
		<meta name="author" content="<?=$headertag_author?>" />

		<? $headertag_description = (($headertag_description) ? ($headertag_description) : (EDIRECTORY_TITLE)); ?>
		<meta name="description" content="<?=$headertag_description?>" />

		<? $headertag_keywords = (($headertag_keywords) ? ($headertag_keywords) : (EDIRECTORY_TITLE)); ?>
		<meta name="keywords" content="<?=$headertag_keywords?>" />

		<? $headertag_title = (($headertag_title) ? ($headertag_title) : (EDIRECTORY_TITLE)); ?>
		<title><?=$headertag_title?></title>

		<link href="<?=DEFAULT_URL?>/layout/detail_print.css" rel="stylesheet" type="text/css" media="all" />
		<?=system_getNoImageStyle($cssfile = true);?>

	</head>

	<body>

		<div class="basePrint">

			<? if ($event) { ?>
				<ul class="basePrintNavbar" id="print">
					<li><a href="javascript:void(0);" onclick="document.getElementById('print').style.display='none';window.print();document.getElementById('print').style.display='block'"><?=system_showText(LANG_PRINTCLICK)?></a></li>
				</ul>
				<?
				$level = new EventLevel();
				include(INCLUDES_DIR."/views/view_event_detail_" . $event->getNumber("level") . ".php");
				?>
			<? } else { ?>
				<p class="errorMessage"><?=$eventMsg?></p>
			<? } ?>

		</div>

	</body>

</html>
