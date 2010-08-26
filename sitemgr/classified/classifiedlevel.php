<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/classified/classifiedlevel.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (CLASSIFIED_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	$url_redirect = "".DEFAULT_URL."/gerenciamento/classified";
	$url_base = "".DEFAULT_URL."/gerenciamento";
	$sitemgr = 1;

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	if ($id) {
		$classified = new Classified($id);
		$classified->extract();
	}

	$levelObj = new ClassifiedLevel();
	if ($level) {
		$levelArray[$levelObj->getLevel($level)] = $level;
	} else {
		$levelArray[$levelObj->getLevel($levelObj->getDefaultLevel())] = $levelObj->getDefaultLevel();
	}

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		if (($id) && ($classified)) {
			$classified->setString("level", $_POST['level']);
			$classified->Save();
			header("Location: ".DEFAULT_URL."/gerenciamento/classified/".(($search_page) ? "search.php" : "index.php")."?message=".urlencode($message)."&screen=$screen&letra=$letra".(($url_search_params) ? "&$url_search_params" : "")."");
			exit;
		} else {
			header("Location: ".DEFAULT_URL."/gerenciamento/classified/classified.php?level=".$_POST['level']);
			exit;
		}
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
			<h1><?=ucwords(system_showText(LANG_SITEMGR_CLASSIFIED_PLURAL))?></h1>
		</div>
	</div>
	<div id="content-content">
		<div class="default-margin" style="padding-top:3px;">

			<? require(EDIRECTORY_ROOT."/gerenciamento/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

			<? include(INCLUDES_DIR."/tables/table_classified_submenu.php"); ?>

			<br />
			<div id="header-view">
				<?= ($id) ? system_showText(LANG_SITEMGR_EDIT)." " : system_showText(LANG_SITEMGR_ADD)." "?><?=ucwords(CLASSIFIED_FEATURE_NAME);?> <?=system_showText(LANG_SITEMGR_LEVEL)?> <? if (($classified) && ($classified->getString("title"))) echo "- ".$classified->getString("title"); ?>
			</div>
			
			<div class="baseForm">

			<form name="classifiedlevel" action="<?=$_SERVER["PHP_SELF"]?>" method="post">

				<input type="hidden" name="id" value="<?=$id?>" />
				<? include(INCLUDES_DIR."/forms/form_classifiedlevel.php"); ?>
					<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
					<input type="hidden" name="letra" value="<?=$letra?>" />
					<input type="hidden" name="screen" value="<?=$screen?>" />
					<button type="submit" value="Submit" class="ui-state-default ui-corner-all"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
					<button type="button" name="back" value="Back" class="ui-state-default ui-corner-all" onclick="document.getElementById('formclassifiedlevelcancel').submit();"><?=system_showText(LANG_SITEMGR_BACK)?></button>

			</form>
			<form id="formclassifiedlevelcancel" action="<?=DEFAULT_URL?>/gerenciamento/classified/<?=(($search_page) ? "search.php" : "index.php");?>" method="post">

				<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
				<input type="hidden" name="letra" value="<?=$letra?>" />
				<input type="hidden" name="screen" value="<?=$screen?>" />

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
