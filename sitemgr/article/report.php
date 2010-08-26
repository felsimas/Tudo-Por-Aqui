<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/article/report.php
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

	$url_redirect = "".DEFAULT_URL."/gerenciamento/article";
	$url_base = "".DEFAULT_URL."/gerenciamento";
	$sitemgr = 1;

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

    # ----------------------------------------------------------------------------------------------------
    # OBJECTS
    # ----------------------------------------------------------------------------------------------------
	if ($id) {
    $article = new Article($id);
	}	else {
		header("Location: ".DEFAULT_URL."/gerenciamento/index.php");
		exit;
	}

    $articleLevel = new ArticleLevel();
    $levelName = ucwords($articleLevel->getName($article->getNumber('level')));
    
    $status = new ItemStatus();
    $statusName = $status->getStatus($article->getString('status'));

    # ----------------------------------------------------------------------------------------------------
    # REPORT DATA
    # ----------------------------------------------------------------------------------------------------
    $reports = retrieveArticleReport($id);

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
		<h1 class="highlight"><?=system_showText(LANG_SITEMGR_ARTICLE_SING)?> <?=system_showText(LANG_SITEMGR_REPORT_TRAFFICREPORT)?> - <?=$article->getString("title")?></h1>
	</div>
</div>
<div id="content-content">
	<div class="default-margin" style="padding-top:3px;">

		<? require(EDIRECTORY_ROOT."/gerenciamento/registration.php"); ?>
		<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
		<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

		<? include(INCLUDES_DIR."/tables/table_article_submenu.php"); ?>

		<? if ($reports) { ?>
			<? include(INCLUDES_DIR."/tables/table_article_reports.php"); ?>
		<? } else { ?>
			<div class="response-msg inf ui-corner-all">
				<?=system_showText(LANG_SITEMGR_ARTICLE_NOREPORT)?>
			</div>
		<? } ?>
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