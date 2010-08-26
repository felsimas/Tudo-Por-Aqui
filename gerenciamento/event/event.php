<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/event/event.php
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

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	include(EDIRECTORY_ROOT."/includes/code/event.php");

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
			<?
			if($id) 
				$prefix = system_showText(LANG_SITEMGR_EDIT);
			else 
				$prefix = system_showText(LANG_SITEMGR_ADD);
			?>
			<h1><?=$prefix?> <?=system_showText(LANG_SITEMGR_EVENT_SING)?></h1>
		</div>
	</div>
	<div id="content-content">
		<div class="default-margin" style="padding-top:3px;">

			<? require(EDIRECTORY_ROOT."/gerenciamento/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

			<? include(INCLUDES_DIR."/tables/table_event_submenu.php"); ?>
			
			<div class="baseForm">

			<form name="form_event" action="<?=$_SERVER["PHP_SELF"]?>" method="post" enctype="multipart/form-data">
				<input type="hidden" name="sitemgr" id="sitemgr" value="<?=$sitemgr?>" />
				<input type="hidden" name="id" value="<?=$id?>" />
				<input type="hidden" name="level" value="<?=$level?>" />
				<input type="hidden" name="letra" value="<?=$letra?>" />
				<input type="hidden" name="screen" value="<?=$screen?>" />
				<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
				<? include(INCLUDES_DIR."/forms/form_event.php"); ?>
				<button type="button" name="submit_button" class="ui-state-default ui-corner-all" onclick="JS_submit();"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
				<button type="button" name="cancel" value="Cancel" class="ui-state-default ui-corner-all" onclick="document.getElementById('formeventcancel').submit();"><?=system_showText(LANG_SITEMGR_CANCEL)?></button>
			</form>
			<form id="formeventcancel" action="<?=DEFAULT_URL?>/gerenciamento/event/<?=(($search_page) ? "search.php" : "index.php");?>" method="get">
				<input type="hidden" name="letra" value="<?=$letra?>" />
				<input type="hidden" name="screen" value="<?=$screen?>" />
				<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
			</form>
			
			</div>
			
		</div>
	</div>
<div id="bottom-content">
	&nbsp;
</div>
</div>

<script language="javascript">
	<!--

	<? if (DEFAULT_DATE_FORMAT == "m/d/Y") { ?>
		var cal_start = new calendarmdy(document.forms['form_event'].elements['start_date']);
	<? } elseif (DEFAULT_DATE_FORMAT == "d/m/Y") { ?>
		var cal_start = new calendardmy(document.forms['form_event'].elements['start_date']);
	<? } ?>
	cal_start.year_scroll = true;
	cal_start.time_comp = false;

	<? if (DEFAULT_DATE_FORMAT == "m/d/Y") { ?>
		var cal_end = new calendarmdy(document.forms['form_event'].elements['end_date']);
	<? } elseif (DEFAULT_DATE_FORMAT == "d/m/Y") { ?>
		var cal_end = new calendardmy(document.forms['form_event'].elements['end_date']);
	<? } ?>
	cal_end.year_scroll = true;
	cal_end.time_comp = false;

	//-->
</script>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>