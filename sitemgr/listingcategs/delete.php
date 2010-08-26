<?
	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/estabelecimentoscategs/delete.php
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

	extract($_GET);
	extract($_POST);

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	if ($id) {
		$category = new ListingCategory($id);
	} else {
		$message = system_showText(LANG_SITEMGR_CATEGORY_NOTFOUND);
		header("Location: ".DEFAULT_URL."/gerenciamento/estabelecimentoscategs/".(($search_page) ? "search.php" : "index.php")."?message=".urlencode($message)."&category_id=".$category_id."&screen=$screen&letra=$letra".(($url_search_params) ? "&$url_search_params" : "")."");
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		$category = new ListingCategory($_POST['id']);
		$category->delete();
		$message = system_showText(LANG_SITEMGR_CATEGORY_DELETED);
		header("Location: ".DEFAULT_URL."/gerenciamento/estabelecimentoscategs/".(($search_page) ? "search.php" : "index.php")."?message=".urlencode($message)."&category_id=".$category_id."&screen=$screen&letra=$letra".(($url_search_params) ? "&$url_search_params" : "")."");
		exit;
	}

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
			
			<div class="baseForm">

			<form name="listing" action="<?=$_SERVER["PHP_SELF"]?>" method="post">

				<input type="hidden" name="id" value="<?=$id?>" />
				<input type="hidden" id="category_id" name="category_id" value="<?=$category_id?>" />

				<div id="header-form"><?=ucwords(system_showText(LANG_SITEMGR_CATEGORY_DELETECATEGORY))?> - <?=$category->getString("title")?></div>
				<div class="response-msg inf ui-corner-all"><?=system_showText(LANG_SITEMGR_CATEGORY_DELETEQUESTION)?></div>
				<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
				<input type="hidden" name="letra" value="<?=$letra?>" />
				<input type="hidden" name="screen" value="<?=$screen?>" />
				<button type="submit" class="ui-state-default ui-corner-all"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
				<button type="button" class="ui-state-default ui-corner-all" onclick="document.getElementById('formlistingcategorydeletecancel').submit();"><?=system_showText(LANG_SITEMGR_CANCEL)?></button>

			</form>
			<form id="formlistingcategorydeletecancel" action="<?=DEFAULT_URL?>/gerenciamento/estabelecimentoscategs/<?=(($search_page) ? "search.php" : "index.php");?>" method="get">

				<input type="hidden" id="category_id" name="category_id" value="<?=$category_id?>" />
				<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
				<input type="hidden" name="letra" value="<?=$letra?>" />
				<input type="hidden" name="screen" value="<?=$screen?>" />

			</form>
			
			</div>

							</div>
						</div>
					</div>
				</div>
			</div>
		<div class="clearfix"></div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>
