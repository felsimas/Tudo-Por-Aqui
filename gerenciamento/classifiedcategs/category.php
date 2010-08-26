<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/classifiedcategs/category.php
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

	$url_redirect = "".DEFAULT_URL."/gerenciamento/classifiedcategs";
	$url_base = "".DEFAULT_URL."/gerenciamento";
	$sitemgr = 1;

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	include(INCLUDES_DIR."/code/classifiedcategory.php");

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
			<h1><?=$_GET["id"] ? system_showText(LANG_SITEMGR_EDIT) : system_showText(LANG_SITEMGR_ADD) ;?> <?=ucwords(system_showText(LANG_SITEMGR_CATEGORY))?></h1>
		</div>
	</div>
	<div id="content-content">
		<div class="default-margin" style="padding-top:3px;">

			<? require(EDIRECTORY_ROOT."/gerenciamento/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

			<? include(INCLUDES_DIR."/tables/table_category_submenu.php"); ?>

			<br />
			
			<div class="baseForm">

			<form name="category" action="<?=$_SERVER["PHP_SELF"]?>" method="post">

				<input type="hidden" id="id" name="id" value="<?=$id?>" />
				<input type="hidden" id="category_id" name="category_id" value="<?=$category_id?>" />
				<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
				<input type="hidden" name="letra" value="<?=$letra?>" />
				<input type="hidden" name="screen" value="<?=$screen?>" />

				<div id="header-form"><?=ucwords(system_showText(LANG_SITEMGR_CLASSIFIED_PLURAL))?> - <?=system_showText(LANG_SITEMGR_CATEGORY_INFORMATION)?></div>
				<? if ($message_category) { ?>
					<div class="response-msg error ui-corner-all"><?=$message_category?></div>
				<? } ?>

				<? include(INCLUDES_DIR."/forms/form_classifiedcategory.php"); ?>

							<button type="submit" name="submit" value="Submit" class="ui-state-default ui-corner-all"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>

			</form>
			<form action="<?=DEFAULT_URL?>/gerenciamento/classifiedcategs/<?=(($search_page) ? "search.php" : "index.php");?>" method="get">

							<input type="hidden" id="category_id" name="category_id" value="<?=$category_id?>" />
							<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
							<input type="hidden" name="letra" value="<?=$letra?>" />
							<input type="hidden" name="screen" value="<?=$screen?>" />
							<button type="submit" name="cancel" value="Cancel" class="ui-state-default ui-corner-all"><?=system_showText(LANG_SITEMGR_CANCEL)?></button>

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
