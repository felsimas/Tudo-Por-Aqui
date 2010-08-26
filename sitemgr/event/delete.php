<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/event/delete.php
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

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_GET);
	extract($_POST);

	if ($id) {
		$event = new Event($id);
	}	else {
		header("Location: ".DEFAULT_URL."/gerenciamento/event/".(($search_page) ? "search.php" : "index.php")."?message=".urlencode($message)."&screen=$screen&letra=$letra".(($url_search_params) ? "&$url_search_params" : "")."");
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		$event = new Event($_POST['id']);
		$event->delete();
		$message = system_showText(LANG_SITEMGR_EVENT_SING)." ".system_showText(LANG_SITEMGR_WASSUCCESSDELETED);
		header("Location: ".DEFAULT_URL."/gerenciamento/event/".(($search_page) ? "search.php" : "index.php")."?message=".urlencode($message)."&screen=$screen&letra=$letra".(($url_search_params) ? "&$url_search_params" : "")."");
		exit;
	}

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
		<h1><?=system_showText(LANG_SITEMGR_NAVBAR_EVENT);?></h1>
	</div>
</div>
<div id="content-content">
	<div class="default-margin">

		<? require(EDIRECTORY_ROOT."/gerenciamento/registration.php"); ?>
		<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
		<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>
		
		<div class="baseForm">

		<form name="event" method="post">
			<input type="hidden" name="id" value="<?=$id?>" />
			<div id="header-form">
				<?=ucwords(system_showText(LANG_SITEMGR_DELETE))?> <?=system_showText(LANG_SITEMGR_EVENT_SING);?> - <?=$event->getString("title")?>
			</div>
			<div class="response-msg inf ui-corner-all">
				<?=system_showText(LANG_SITEMGR_EVENT_DELETEQUESTION)?>
			</div>
			<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
			<input type="hidden" name="letra" value="<?=$letra?>" />
			<input type="hidden" name="screen" value="<?=$screen?>" />
			<button type="submit" value="Submit" class="ui-state-default ui-corner-all"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
		</form>
		<form action="<?=DEFAULT_URL?>/gerenciamento/event/<?=(($search_page) ? "search.php" : "index.php");?>" method="post">
			<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
			<input type="hidden" name="letra" value="<?=$letra?>" />
			<input type="hidden" name="screen" value="<?=$screen?>" />
			<button type="submit" value="Cancel" class="ui-state-default ui-corner-all"><?=system_showText(LANG_SITEMGR_CANCEL)?></button>
		</form>
		
		</div>
		
	</div>
</div>
<div id="bottom-content">
	&nbsp;
</div>
</div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>
