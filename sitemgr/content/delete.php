<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/content/delete.php
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
	extract($_GET);
	extract($_POST);

	if ($id) {
		$content = new Content($id);
		if (!$content->getNumber("id")) {
			header("Location: ".DEFAULT_URL."/gerenciamento/content/client.php");
			exit;
		}
		if ($content->getString("section") != "client") {
			header("Location: ".DEFAULT_URL."/gerenciamento/content/client.php");
			exit;
		}
	} else {
		header("Location: ".DEFAULT_URL."/gerenciamento/content/client.php");
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		$content = new Content($_POST['id']);
		$content->Delete();
		header("Location: ".DEFAULT_URL."/gerenciamento/content/client.php?message=".urlencode(system_showText(LANG_SITEMGR_CONTENT_SUCCESSDELETED)));
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

<script>
	function redirect(){
		document.location.href="<?=DEFAULT_URL?>/gerenciamento/content/client.php";
	}
</script>

<div id="main-right">

	<div id="top-content">
		<div id="header-content">
			<h1><?=ucwords(system_showText(LANG_SITEMGR_DELETE))?> <?=ucwords(system_showText(LANG_SITEMGR_CONTENT))?></h1>
		</div>
	</div>

	<div id="content-content">

		<div class="default-margin">

			<? require(EDIRECTORY_ROOT."/gerenciamento/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>
			
			<div class="baseForm">

			<form name="content" method="post">

				<input type="hidden" name="id" value="<?=$id?>" />

				<div id="header-form"><?=ucwords(system_showText(LANG_SITEMGR_DELETE))?> <?=ucwords(system_showText(LANG_SITEMGR_CONTENT))?> - <?=$content->getString("type")?></div>

				<div class="response-msg inf ui-corner-all"><?=system_showText(LANG_SITEMGR_CONTENT_DELETEQUESTION)?></div>

				<button type="submit" class="ui-state-default ui-corner-all"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>

			</form>

			<button type="button" title="cancel" class="ui-state-default ui-corner-all" onclick="javascript:redirect();"><?=system_showText(LANG_SITEMGR_CANCEL)?></button>
			
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
