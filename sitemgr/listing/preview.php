<?
	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/estabelecimentos/preview.php
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

	$url_redirect = "".DEFAULT_URL."/gerenciamento/estabelecimentos";
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
		$listing = new Listing($id);
		if ((!$listing->getNumber("id")) || ($listing->getNumber("id") <= 0)) {
			$error = true;
		}
	} else {
		$error = true;
	}

	header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);

	$level = new ListingLevel();

	# ----------------------------------------------------------------------------------------------------
	# REVIEWS
	# ----------------------------------------------------------------------------------------------------
	if ($id)  $sql_where[] = " item_type = 'listing' AND item_id = ".db_formatNumber($id)." ";
	if (true) $sql_where[] = " review IS NOT NULL AND review != '' ";
	if (true) $sql_where[] = " approved = '1' ";
	if ($sql_where) $sqlwhere .= " ".implode(" AND ", $sql_where)." ";
	$pageObj  = new pageBrowsing("Review", $screen, 3, "added DESC", "", "", $sqlwhere);
	$reviewsArr = $pageObj->retrievePage("object");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=<?=EDIR_CHARSET;?>" />
		<title><?=system_showText(LANG_SITEMGR_LISTING_SING)?> <?=ucwords(system_showText(LANG_SITEMGR_PREVIEW))?></title>
		<?
		if (EDIR_THEME) {
			include(THEMEFILE_DIR."/".EDIR_THEME."/".EDIR_THEME.".php");
		} else {
			?>
			<link href="<?=DEFAULT_URL?>/layout/general_structure.css" rel="stylesheet" type="text/css" />
			<link href="<?=DEFAULT_URL?>/layout/results.css" rel="stylesheet" type="text/css" />
			<link href="<?=DEFAULT_URL?>/layout/detail.css" rel="stylesheet" type="text/css" />
			<link href="<?=DEFAULT_URL?>/layout/preview.css" rel="stylesheet" type="text/css" />
			<link href="<?=DEFAULT_URL?>/layout/template.css" rel="stylesheet" type="text/css" />
			<?
		}
		?>
		<?=system_getNoImageStyle($cssfile = true);?>
        <script language="javascript" src="<?=DEFAULT_URL?>/scripts/common.js"></script>
        <script language="javascript" src="<?=DEFAULT_URL?>/scripts/lang.js.php"></script>
	</head>
	<body>

		<?
		if (!$error) {
			?>
			<ul class="basePreviewNavbar">
				<li><a href="javascript:window.close();"><?=system_showText(LANG_SITEMGR_CLOSEWINDOW)?></a></li>
			</ul>
			<?
			$level = new ListingLevel();
			echo "<h5>".system_showText(LANG_SITEMGR_SUMMARYPAGE)."</h5>";
			include(INCLUDES_DIR."/views/view_listing_summary.php");
			if ($level->getDetail($listing->getNumber("level")) == "y") {
				echo "<h5>".system_showText(LANG_SITEMGR_DETAILPAGE)."</h5>";
				include(INCLUDES_DIR."/views/view_listing_detail.php");
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
