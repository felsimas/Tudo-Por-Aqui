<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/articlecategs/index.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (ARTICLE_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	$url_redirect = "".DEFAULT_URL."/gerenciamento/articlecategs";
	$url_base = "".DEFAULT_URL."/gerenciamento";
	$sitemgr = 1;

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);

	// Page Browsing /////////////////////////////////////////
	$pageObj  = new pageBrowsing("ArticleCategory", $screen, 10, "title, id", "title", $letra, "category_id = ".db_formatNumber($category_id)."");
	$categories = $pageObj->retrievePage();

	$paging_url = DEFAULT_URL."/gerenciamento/articlecategs/index.php?category_id=".$category_id;

	// Letters Menu
	$letras = $pageObj->getString("letras");
	foreach($letras as $each_letra)
	if($each_letra == "#") $letras_menu .= "<a href=\"$paging_url\" ".((!$letra) ? "class=\"firstLetter\"" : "" ).">".strtoupper($each_letra)."</a>";
	else $letras_menu .= "<a href=\"$paging_url&letra=".$each_letra."\" ".(($each_letra == $letra) ? "style=\"color:#EF413D\"" : "" ).">".strtoupper($each_letra)."</a>";

	# PAGES DROP DOWN ----------------------------------------------------------------------------------------------
	$pagesDropDown = $pageObj->getPagesDropDown($_GET, $paging_url, $screen, system_showText(LANG_SITEMGR_PAGING_GOTOPAGE)." ", "this.form.submit();");
	# --------------------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/header.php");

	# ----------------------------------------------------------------------------------------------------
	# NAVBAR
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/navbar.php");

?>

<div id="main-right">

	<div id="top-content">
		<div id="header-content">
			<h1><?=ucwords(system_showText(LANG_SITEMGR_ARTICLE_PLURAL))?> - <?=ucwords(system_showText(LANG_SITEMGR_CATEGORIES))?></h1>
		</div>
	</div>

	<div id="content-content">

		<div class="default-margin" style="padding-top:3px;">

			<? require(EDIRECTORY_ROOT."/gerenciamento/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

			<? include(INCLUDES_DIR."/tables/table_category_submenu.php"); ?>

			<br />

			<? include(INCLUDES_DIR."/tables/table_paging.php"); ?>

			<? include(INCLUDES_DIR."/tables/table_articlecategory.php"); ?>

		</div>

	</div>

	<div id="bottom-content">&nbsp;</div>

</div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>
