<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /listng/print.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/validate_querystring.php");

	# ----------------------------------------------------------------------------------------------------
	# LISTING
	# ----------------------------------------------------------------------------------------------------
	if (($_GET["id"]) || ($_POST["id"])) {
		$id = $_GET["id"] ? $_GET["id"] : $_POST["id"];
		$listing = new Listing($id);
		$level = new ListingLevel();
		unset($listingMsg);
		if ((!$listing->getNumber("id")) || ($listing->getNumber("id") <= 0)) {
			$listingMsg = system_showText(LANG_MSG_NOTFOUND);
			unset($listing);
		} elseif ($listing->getString("status") != "A") {
			$listingMsg = system_showText(LANG_MSG_NOTAVAILABLE);
			unset($listing);
		} elseif ($level->getDetail($listing->getNumber("level")) != "y") {
			$listingMsg = system_showText(LANG_MSG_NOTAVAILABLE);
			unset($listing);
		}
	} else {
		$listingMsg = system_showText(LANG_MSG_NOTFOUND);
		unset($listing);
	}

	if ($listing) {
		$headertag_title = $listing->getString("title");
		$headertag_description = $listing->getString("description");
		$headertag_keywords = str_replace(" || ", ", ", $listing->getString("keywords"));
	} else {
		$headertag_title = $listingMsg;
	}

	header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);

	include(INCLUDES_DIR."/code/headertag.php");

	# ----------------------------------------------------------------------------------------------------
	# REVIEWS
	# ----------------------------------------------------------------------------------------------------
	if ($id)  $sql_where[] = " item_id = ".db_formatNumber($id)." AND item_type = 'listing' ";
	if (true) $sql_where[] = " review IS NOT NULL AND review != '' ";
	if (true) $sql_where[] = " approved = '1' ";
	if ($sql_where) $where .= " ".implode(" AND ", $sql_where)." ";
	$pageObj  = new pageBrowsing("Review", $screen, 3, "added DESC", "", "", $where);
	$reviewsArr = $pageObj->retrievePage("object");

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
		<link href="<?=DEFAULT_URL?>/layout/template.css" rel="stylesheet" type="text/css" media="all" />
		<?=system_getNoImageStyle($cssfile = true);?>

	</head>

	<body>

		<div class="basePrint">

			<? if ($listing) { ?>
				<ul class="basePrintNavbar" id="print">
					<li><a href="javascript:void(0);" onclick="document.getElementById('print').style.display='none';window.print();document.getElementById('print').style.display='block'"><?=system_showText(LANG_PRINTCLICK);?></a></li>
				</ul>
				<?
				$level = new ListingLevel();
				include(INCLUDES_DIR."/views/view_listing_detail.php");
				?>
			<? } else { ?>
				<p class="errorMessage"><?=$listingMsg?></p>
			<? } ?>

		</div>

	</body>

</html>
