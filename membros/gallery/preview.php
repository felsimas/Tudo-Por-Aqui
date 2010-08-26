<?


	# ----------------------------------------------------------------------------------------------------
	# * FILE: /membros/gallery/preview.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

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

	header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	$message_error = "";
	if ($id) {
		$gallery = new Gallery($id);
		if ((!$gallery->getNumber("id")) || ($gallery->getNumber("id") <= 0)) {
			$message_error = system_showText(LANG_LABEL_GALLERYDOESNOTEXIST);
		}
		if (sess_getAccountIdFromSession() != $gallery->getNumber("account_id")) {
			$message_error = system_showText(LANG_LABEL_GALLERYNOTAVAILABLE);
		}
	} else {
		$message_error = system_showText(LANG_LABEL_GALLERYDOESNOTEXIST);
	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=<?=EDIR_CHARSET;?>" />
		<title><?=system_showText(LANG_GALLERY_PREVIEW);?></title>
		<link href="<?=DEFAULT_URL?>/layout/general_structure.css" rel="stylesheet" type="text/css" media="all" />
		<link href="<?=DEFAULT_URL?>/layout/preview.css" rel="stylesheet" type="text/css" />
		<?=system_getNoImageStyle($cssfile = true);?>
	</head>
	<body class="previewmember">

		<?
		if (!$message_error) {
			?>
			<ul class="basePreviewNavbar">
				<li><a href="javascript:window.close();"><?=system_showText(LANG_LABEL_CLOSETHISWINDOW);?></a></li>
			</ul>
			<?
			echo "<h5>".system_showText(LANG_GALLERY_PREVIEW)." - ".$gallery->getString("title")."</h5>";
			include(INCLUDES_DIR."/views/view_gallery.php");
		} else {
			echo "<center><img src=\"".DEFAULT_URL."/images/content/img_error.gif\" alt=\"".system_showText(LANG_LABEL_ERROR)."\" border=\"0\" /></center>";
		}
		?>

		<br class="clear" /><br />
		<ul class="basePreviewNavbar">
			<li><a href="javascript:window.close();"><?=system_showText(LANG_LABEL_CLOSETHISWINDOW);?></a></li>
		</ul>

	</body>
</html>