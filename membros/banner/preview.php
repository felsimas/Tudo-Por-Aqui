<?


	# ----------------------------------------------------------------------------------------------------
	# * FILE: /membros/banner/preview.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (BANNER_FEATURE != "on") { exit; }

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
		$banner = new Banner($id);
		if ((!$banner->getNumber("id")) || ($banner->getNumber("id") <= 0)) {
			$error = true;
		}
		if (sess_getAccountIdFromSession() != $banner->getNumber("account_id")) {
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
		<title><?=system_showText(LANG_BANNER_PREVIEW);?></title>
		<?
		if (EDIR_THEME) {
			include(THEMEFILE_DIR."/".EDIR_THEME."/".EDIR_THEME.".php");
		} else {
			?>
			<link href="<?=DEFAULT_URL?>/layout/general_structure.css" rel="stylesheet" type="text/css" />
			<link href="<?=DEFAULT_URL?>/layout/preview.css" rel="stylesheet" type="text/css" />
			<?
		}
		?>
		<?=system_getNoImageStyle($cssfile = true);?>
	</head>
	<body class="previewmember">

		<?
		if (!$error) {
			?>
			<ul class="basePreviewNavbar">
				<li><a href="javascript:window.close();"><?=system_showText(LANG_LABEL_CLOSETHISWINDOW);?></a></li>
			</ul>
			<br />
			<?
			$bannerObj = new Banner();
			$banner_info = $bannerObj->retrieve($id);
			$banner = $bannerObj->makeBanner($banner_info, $_GET["lang"]);
			if($banner_info["type"] >= 50) {
				echo "<div class=\"bannerleftText bannerPreview\">$banner</div>";
			} else if ($banner_info["type"]) {
				echo "<div class=\"bannerPreview\">$banner</div>";
			}
		} else {
			echo "<div class=\"bannerPreview\"><img src=\"".DEFAULT_URL."/images/content/img_error.gif\" alt=\"".system_showText(LANG_LABEL_ERROR)."\" border=\"0\" /></div>";
		}
		?>

		<br /><br />
		<ul class="basePreviewNavbar">
			<li><a href="javascript:window.close();"><?=system_showText(LANG_LABEL_CLOSETHISWINDOW);?></a></li>
		</ul>

	</body>
</html>