<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/estabelecimentoscategs/category.php
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

	$url_redirect = "".DEFAULT_URL."/gerenciamento/estabelecimentoscategs";
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
	include(INCLUDES_DIR."/code/listingcategory.php");

		# ----------------------------------------------------------------------------------------------------
		# HEADER
		# ----------------------------------------------------------------------------------------------------
		include(SM_EDIRECTORY_ROOT."/layout/header_manager.php");

	?>

		<div id="page-wrapper">

			<div id="main-wrapper">

			<?php 	include(SM_EDIRECTORY_ROOT."/menu.php"); ?>

				<div id="main-content"> 

					<div class="page-title ui-widget-content ui-corner-all">

						<div class="other_content">

			<? require(EDIRECTORY_ROOT."/gerenciamento/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

			<? include(INCLUDES_DIR."/tables/table_category_submenu.php"); ?>
			
			<div class="baseForm">

			<form name="category" action="<?=$_SERVER["PHP_SELF"]?>" method="post">

				<input type="hidden" id="id" name="id" value="<?=$id?>" />
				<input type="hidden" id="category_id" name="category_id" value="<?=$category_id?>" />
				<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
				<input type="hidden" name="letra" value="<?=$letra?>" />
				<input type="hidden" name="screen" value="<?=$screen?>" />

				<div id="header-form"><?=ucwords(system_showText(LANG_SITEMGR_LISTING_PLURAL))?> - <?=system_showText(LANG_SITEMGR_CATEGORY_INFORMATION)?></div>
				<? if ($message_category) { ?>
				<div class="response-msg error ui-corner-all"><?=$message_category?></div>
				<? } ?>

				<? include(INCLUDES_DIR."/forms/form_listingcategory.php"); ?>

				<button type="submit" name="submit" value="Submit" class="ui-state-default ui-corner-all"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>

				<button type="button" name="cancel" value="Cancel" class="ui-state-default ui-corner-all" onclick="document.getElementById('formlistingcategorycancel').submit();"><?=system_showText(LANG_SITEMGR_CANCEL)?></button>

			</form>
			<form id="formlistingcategorycancel" action="<?=DEFAULT_URL?>/gerenciamento/estabelecimentoscategs/<?=(($search_page) ? "search.php" : "index.php");?>" method="get">

				<input type="hidden" id="category_id" name="category_id" value="<?=$category_id?>" />
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
