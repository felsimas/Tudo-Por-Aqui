<?

	header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", FALSE);
	header("Pragma: no-cache");
	header("Content-Type: text/html; charset=utf-8", TRUE);

	include(INCLUDES_DIR."/code/headertag.php");
	$headertag_title = $headertag_title." - Celular";

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

	<head>

		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

		<? $headertag_title = (($headertag_title) ? ($headertag_title) : (EDIRECTORY_TITLE)); ?>
		<title><?=$headertag_title?></title>

		<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; minimum-scale=1.0; user-scalable=0;" />

		<? if (strpos($_SERVER["PHP_SELF"], "index.php") === false) { ?>

			<link href="<?=DEFAULT_URL;?>/iapp/layout/structure.css" rel="stylesheet" type="text/css" media="all" />
			<script src="<?=DEFAULT_URL;?>/iapp/layout/control.js" type="text/javascript" charset="utf-8"></script>
			<? if ($section) { ?><link href="<?=DEFAULT_URL;?>/iapp/layout/<?=$section;?>.css" rel="stylesheet" type="text/css" media="all" /><? } ?>

		<? } else { ?>

			<link href="<?=DEFAULT_URL;?>/iapp/layout/presentation.css" rel="stylesheet" type="text/css" media="all" />

		<? } ?>

	</head>

	<? if (strpos($_SERVER["PHP_SELF"], "index.php") === false) { ?>
	<body onload="document.getElementById('iapp_loading').style.display='none';">
		<div id="iapp_loading"></div>
	<? } else { ?>
	<body>
	<? } ?>

		<div id="header">
			<? if ($backButton) { echo "<a class=\"backButton\" href=\"javascript:history.back();\"><span>Back</span></a>"; } ?>
			<? if ($headerTitle) { echo "<h1>".$headerTitle."</h1>"; } ?>
			<? if ($homeButton) { echo "<a class=\"homeButton\" href=\"".DEFAULT_URL."/iapp/home.php\"><span>Home</span></a>"; } ?>
			<? if ($contactButton) { echo "<a class=\"contactButton\" href=\"".DEFAULT_URL."/iapp/contact.php\"><span>Contact</span></a>"; } ?>
			<? if ($searchButton) { echo "<a class=\"searchButton\" href=\"".$searchButtonLink."\"><span>Search</span></a>"; } ?>
		</div>

		<div id="container">

			<div id="content">
