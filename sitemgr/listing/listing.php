<?
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	$url_redirect = "".DEFAULT_URL."/gerenciamento/estabelecimentos";
	$url_base 	  = "".DEFAULT_URL."/gerenciamento";
	$sitemgr 	  = 1;

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));
	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/listing.php");

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

			<? include(INCLUDES_DIR."/tables/table_listing_submenu.php"); ?>
			
			<div class="baseForm">

			<form name="listing" action="<?=$_SERVER["PHP_SELF"]?>" method="post" enctype="multipart/form-data">

				<!-- Microsoft IE Bug (When the form contain a field with a special char like &#8213; and the enctype is multipart/form-data and the last textfield is empty the first transmitted field is corrupted)-->
				<input type="hidden" name="ieBugFix" value="1" />
				<!-- Microsoft IE Bug -->

				<input type="hidden" name="sitemgr" id="sitemgr" value="<?=$sitemgr?>" />
				<input type="hidden" name="id" id="id" value="<?=$id?>" />
				<input type="hidden" name="listingtemplate_id" value="<?=$listingtemplate_id?>" />
				<input type="hidden" name="level" value="<?=$level?>">
				<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
				<input type="hidden" name="letra" value="<?=$letra?>" />
				<input type="hidden" name="screen" value="<?=$screen?>" />

				<? include(INCLUDES_DIR."/forms/form_listing.php"); ?>

				<button type="button" name="submit_button" class="ui-state-default ui-corner-all" value="Submit" onclick="JS_submit();"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>

				<button type="button" name="cancel" class="ui-state-default ui-corner-all" value="Cancel" onclick="document.getElementById('formlistingcancel').submit();"><?=system_showText(LANG_SITEMGR_CANCEL)?></button>

				<!-- Microsoft IE Bug (When the form contain a field with a special char like &#8213; and the enctype is multipart/form-data and the last textfield is empty the first transmitted field is corrupted)-->
				<input type="hidden" name="ieBugFix2" value="1" /> 
				<!-- Microsoft IE Bug -->

			</form>

			<form id="formlistingcancel" action="<?=DEFAULT_URL?>/gerenciamento/estabelecimentos/<?=(($search_page) ? "search.php" : "index.php");?>" method="get">

				<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
				<input type="hidden" name="letra" value="<?=$letra?>" />
				<input type="hidden" name="screen" value="<?=$screen?>" />

			</form>
			
			
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