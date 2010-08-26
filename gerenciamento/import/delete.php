<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/import/delete.php
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
	if ($_GET["id"]) {
		$import = new ImportLog($_GET["id"]);
		if ($import->getString("status")=="R") {
			header("Location: ".DEFAULT_URL."/gerenciamento/import/importlog.php");
			exit;
		}
	} else {
		header("Location: ".DEFAULT_URL."/gerenciamento/import/importlog.php");
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$import = new ImportLog($_POST["id"]);
		$import->delete();
		header("Location: ".DEFAULT_URL."/gerenciamento/import/importlog.php");
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
			<h1><?=system_showText(LANG_SITEMGR_IMPORT_IMPORTLOG)?></h1>
		</div>
	</div>

	<div id="content-content">

		<div class="default-margin">

			<? require(EDIRECTORY_ROOT."/gerenciamento/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>
			
			<div class="baseForm">

			<form name="deleteimport" method="post">
				<input type="hidden" name="id" value="<?=$_GET["id"]?>">
				<div id="header-form"><?=system_showText(LANG_SITEMGR_IMPORT_DELETEIMPORTLOGFILE)?> - <?=$import->getString("filename")?></div>
				<div class="response-msg inf ui-corner-all"><?=system_showText(LANG_SITEMGR_IMPORT_LOG_DELETEQUESTION)?></div>
				<button type="submit" value="Submit" class="ui-state-default ui-corner-all"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
				<button type="button" value="Cancel" class="ui-state-default ui-corner-all" onclick="document.getElementById('formimportdeletecancel').submit();"><?=system_showText(LANG_SITEMGR_CANCEL)?></button>
			</form>
			<form id="formimportdeletecancel" action="<?=DEFAULT_URL?>/gerenciamento/import/importlog.php" method="post">
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
