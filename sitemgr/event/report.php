<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/event/report.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (EVENT_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	$url_redirect = "".DEFAULT_URL."/gerenciamento/event";
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
    $event = new Event($id);
	}	else {
		header("Location: ".DEFAULT_URL."/gerenciamento/index.php");
		exit;
	}

    $eventLevel = new EventLevel();
    $levelName = ucwords($eventLevel->getName($event->getNumber('level')));
    
    $status = new ItemStatus();
    $statusName = $status->getStatus($event->getString('status'));

    # ----------------------------------------------------------------------------------------------------
    # REPORT DATA
    # ----------------------------------------------------------------------------------------------------
    $reports = retrieveEventReport($id);

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
		<h1 class="highlight"><?=system_showText(LANG_SITEMGR_EVENT_SING)?> <?=ucwords(system_showText(LANG_SITEMGR_REPORT_TRAFFICREPORT))?> - <?=$event->getString("title")?></h1>
	</div>
</div>
<div id="content-content">
	<div class="default-margin" style="padding-top:3px;">

		<? require(EDIRECTORY_ROOT."/gerenciamento/registration.php"); ?>
		<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
		<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

		<? include(INCLUDES_DIR."/tables/table_event_submenu.php"); ?>

		<? if ($reports) { ?>
			<? include(INCLUDES_DIR."/tables/table_event_reports.php"); ?>
		<? } else { ?>
			<div class="response-msg inf ui-corner-all">
				<?=system_showText(LANG_SITEMGR_EVENT_NOREPORT)?>
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