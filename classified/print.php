<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /classified/print.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (CLASSIFIED_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/validate_querystring.php");

	# ----------------------------------------------------------------------------------------------------
	# CLASSIFIED
	# ----------------------------------------------------------------------------------------------------
	if (($_GET["id"]) || ($_POST["id"])) {
		$id = $_GET["id"] ? $_GET["id"] : $_POST["id"];
		$classified = new Classified($id);
		$level = new ClassifiedLevel();
		unset($classifiedMsg);
		if ((!$classified->getNumber("id")) || ($classified->getNumber("id") <= 0)) {
			$classifiedMsg = system_showText(LANG_MSG_NOTFOUND);
			unset($classified);
		} elseif ($classified->getString("status") != "A") {
			$classifiedMsg = system_showText(LANG_MSG_NOTAVAILABLE);
			unset($classified);
		} elseif ($level->getDetail($classified->getNumber("level")) != "y") {
			$classifiedMsg = system_showText(LANG_MSG_NOTAVAILABLE);
			unset($classified);
		}
	} else {
		$classifiedMsg = system_showText(LANG_MSG_NOTFOUND);
		unset($classified);
	}

	if ($classified) {
		$headertag_title = $classified->getString("title");
		$headertag_description = $classified->getString("summarydesc");
		$headertag_keywords = str_replace(" || ", ", ", $classified->getString("keywords"));
	} else {
		$headertag_title = $classifiedMsg;
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
		
			<? if ($classified) { ?>
				<ul class="basePrintNavbar" id="print">
					<li><a href="javascript:void(0);" onclick="document.getElementById('print').style.display='none';window.print();document.getElementById('print').style.display='block'"><?=system_showText(LANG_PRINTCLICK);?></a></li>
				</ul>
				<?
				$level = new ClassifiedLevel();
				if ($level->getDetail($classified->getNumber("level")) == "y") {
					include(INCLUDES_DIR."/views/view_classified_detail_".$classified->getNumber("level").".php");
				}
				?>
			<? } else { ?>
				<p class="errorMessage"><?=$classifiedMsg?></p>
			<? } ?>
		
		</div>
		
	</body>
	
</html>
