<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /mobile/layout/header.php
	# ----------------------------------------------------------------------------------------------------

	header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", FALSE);
	header("Pragma: no-cache");
	header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);

	include(INCLUDES_DIR."/code/headertag.php");
	$headertag_title = $headertag_title." Mobile";

	$querystringLang = ($_GET["lang"]) ? ("?lang=".$_GET["lang"]) : ("");

?>

<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<? $headertag_title = (($headertag_title) ? ($headertag_title) : (EDIRECTORY_TITLE)); ?>
		<title><?=$headertag_title?></title>
		<meta http-equiv="Content-Type" content="application/vnd.wap.xhtml+xml;charset=UTF-8" />
		<link href="<?=MOBILE_DEFAULT_URL?>/layout/general_mobile.css" rel="stylesheet" type="text/css" media="screen" />
		<link href="<?=MOBILE_DEFAULT_URL?>/layout/general_mobile.css" rel="stylesheet" type="text/css" media="handheld" />
	</head>

	<body>

		<div class="wrapper">

			<div class="header">

				<a href="<?=MOBILE_DEFAULT_URL?>/index.php<?=$querystringLang?>" accesskey="H">
					<?
					$image_logo_path = system_getHeaderMobileLogo();
					list($width, $height) = getimagesize(EDIRECTORY_ROOT.$image_logo_path);
					image_getNewDimension(200, 85, $width, $height, $image_logo_width, $image_logo_height);
					?>
					<img width="<?=(int)$image_logo_width?>" height="<?=(int)$image_logo_height?>" src="<?=DEFAULT_URL.$image_logo_path?>" alt="<?=$headertag_title?>" title="<?=$headertag_title?>" />
				</a>

			</div>

			<div class="content">
