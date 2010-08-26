<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/eventcategs/delete.php
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

	$url_redirect = "".DEFAULT_URL."/gerenciamento/eventcategs";
	$url_base = "".DEFAULT_URL."/gerenciamento";
	$sitemgr = 1;

	extract($_GET);
	extract($_POST);

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	if ($id) {
		$category = new EventCategory($id);
	} else {
		$message = system_showText(LANG_SITEMGR_CATEGORY_NOTFOUND);
		header("Location: ".DEFAULT_URL."/gerenciamento/eventcategs/".(($search_page) ? "search.php" : "index.php")."?message=".urlencode($message)."&category_id=".$category_id."&screen=$screen&letra=$letra".(($url_search_params) ? "&$url_search_params" : "")."");
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		$category = new EventCategory($_POST['id']);
		$category->delete();
		$message = system_showText(LANG_SITEMGR_CATEGORY_DELETED);
		header("Location: ".DEFAULT_URL."/gerenciamento/eventcategs/".(($search_page) ? "search.php" : "index.php")."?message=".urlencode($message)."&category_id=".$category_id."&screen=$screen&letra=$letra".(($url_search_params) ? "&$url_search_params" : "")."");
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
			<h1><?=ucwords(system_showText(LANG_SITEMGR_CATEGORY_DELETECATEGORY))?></h1>
		</div>
	</div>
	<div id="content-content">
		<div class="default-margin">

			<? require(EDIRECTORY_ROOT."/gerenciamento/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>
			
			<div class="baseForm">

			<form name="event" action="<?=$_SERVER["PHP_SELF"]?>" method="post">

				<input type="hidden" name="id" value="<?=$id?>" />
				<input type="hidden" id="category_id" name="category_id" value="<?=$category_id?>" />

				<div id="header-form"><?=ucwords(system_showText(LANG_SITEMGR_CATEGORY_DELETECATEGORY))?> - <?=$category->getString("title")?></div>
				<div class="response-msg inf ui-corner-all"><?=system_showText(LANG_SITEMGR_CATEGORY_DELETEQUESTION)?></div>
				<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
				<input type="hidden" name="letra" value="<?=$letra?>" />
				<input type="hidden" name="screen" value="<?=$screen?>" />
				<button type="submit" class="ui-state-default ui-corner-all"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>

			</form>
			<form action="<?=DEFAULT_URL?>/gerenciamento/eventcategs/<?=(($search_page) ? "search.php" : "index.php");?>" method="get">

				<input type="hidden" id="category_id" name="category_id" value="<?=$category_id?>" />
				<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
				<input type="hidden" name="letra" value="<?=$letra?>" />
				<input type="hidden" name="screen" value="<?=$screen?>" />
				<button type="submit" class="ui-state-default ui-corner-all"><?=system_showText(LANG_SITEMGR_CANCEL)?></button>

			</form>
			
			</div>

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
