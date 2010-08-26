<?
	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/gallery/preview.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);

	$url_redirect = "".DEFAULT_URL."/gerenciamento/gallery";
	$url_base = "".DEFAULT_URL."/gerenciamento";
	$sitemgr = 1;

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	$message_error = "";
	if ($id) {
		$gallery = new Gallery($id);
		if ((!$gallery->getNumber("id")) || ($gallery->getNumber("id") <= 0)) {
			$message_error = system_showText(LANG_SITEMGR_GALLERY_NOEXIST);
		}
	} else {
		$message_error = system_showText(LANG_SITEMGR_GALLERY_NOEXIST);
	}

?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=<?=EDIR_CHARSET;?>" />
		<title>Gallery Preview</title>
		<link href="<?=DEFAULT_URL?>/layout/general_structure.css" rel="stylesheet" type="text/css" media="all" />
		<link href="<?=DEFAULT_URL?>/layout/preview.css" rel="stylesheet" type="text/css" />
		<?=system_getNoImageStyle($cssfile = true);?>
        <script language="javascript" src="<?=DEFAULT_URL?>/scripts/common.js"></script>
        <script language="javascript" src="<?=DEFAULT_URL?>/scripts/lang.js.php"></script>
	</head>
	<body>

		<?
		if (!$message_error) {
			?>
			<ul class="basePreviewNavbar">
				<li><a href="javascript:window.close();"><?=system_showText(LANG_SITEMGR_CLOSEWINDOW)?></a></li>
			</ul>
			<?
			echo "<h5>".ucwords(system_showText(LANG_SITEMGR_GALLERY))." ".ucwords(system_showText(LANG_SITEMGR_PREVIEW))." - ".$gallery->getString("title")."</h5>";
			include(INCLUDES_DIR."/views/view_gallery.php");
		} else {
			echo "<center><img src=\"".DEFAULT_URL."/images/content/img_error.gif\" alt=\"Error\" border=\"0\" /></center>";
		}
		?>

		<br class="clear" /><br />
		<ul class="basePreviewNavbar">
			<li><a href="javascript:window.close();"><?=system_showText(LANG_SITEMGR_CLOSEWINDOW)?></a></li>
		</ul>

	</body>
</html>
