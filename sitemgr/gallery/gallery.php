<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/gallery/gallery.php
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
	extract($_POST);
	extract($_GET);

	$url_redirect = "".DEFAULT_URL."/gerenciamento/gallery";
	$url_base = "".DEFAULT_URL."/gerenciamento";
	$sitemgr = 1;

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/gallery.php");

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
			<?
			if($id) 
				$prefix = system_showText(LANG_SITEMGR_EDIT);
			else 
				$prefix = system_showText(LANG_SITEMGR_ADD);
			?>


			<? require(EDIRECTORY_ROOT."/gerenciamento/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

			<!-- <? include(INCLUDES_DIR."/tables/table_gallery_submenu.php"); ?> -->

			<?
			if ($item_type && $item_id && $item_id>0) {
				if ($item_type=="listing") {
					$itemObj = new Listing($item_id);
					$destiny = "listing";
				} elseif ($item_type=="event") {
					$itemObj = new Event($item_id);
					$destiny = "event";
				} elseif ($item_type=="classified") {
					$itemObj = new Classified($item_id);
					$destiny = "classified";
				} elseif ($item_type=="article") {
					$itemObj = new Article($item_id);
					$destiny = "article";
				}
				if ($itemObj && $itemObj->getNumber("id")>0) $account_id = $itemObj->getNumber("account_id");
				$cancel_action = DEFAULT_URL."/gerenciamento/$destiny/gallery.php";
				$cancel_method="get";
				$submit_button_label = system_showText(LANG_SITEMGR_SUBMIT);
			} else {
				$cancel_action = DEFAULT_URL."/gerenciamento/gallery/".(($search_page) ? "search.php" : "index.php");
				$cancel_method = "post";
				$submit_button_label = system_showText(LANG_SITEMGR_NEXT);
			}
			?>
			<div id="header-view"><?=ucwords(system_showText($prefix))?> - <?=$gallery->getString("title")?></div>
			
			<div class="baseForm">

			<form name="gallery" action="<?=$_SERVER["PHP_SELF"]?>" method="post" enctype="multipart/form-data">

				<!-- Microsoft IE Bug (When the form contain a field with a special char like &#8213; and the enctype is multipart/form-data and the last textfield is empty the first transmitted field is corrupted)-->
				<input type="hidden" name="ieBugFix" value="1" /> 
				<!-- Microsoft IE Bug -->

				<input type="hidden" name="id" id="id" value="<?=$id?>" />
				<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
				<input type="hidden" name="item_type" value="<?=$item_type?>" />
				<input type="hidden" name="item_id" value="<?=$item_id?>" />
				<input type="hidden" name="letra" value="<?=$letra?>" />
				<input type="hidden" name="screen" value="<?=$screen?>" />

				<? include(INCLUDES_DIR."/forms/form_gallery.php"); ?>

				<button type="button" name="submit_button" class="ui-state-default ui-corner-all" onclick="JS_submit();"><?=$submit_button_label;?></button>

				<button type="button" value="Cancel" class="ui-state-default ui-corner-all" onclick="document.getElementById('formgallerycancel').submit();"><?=system_showText(LANG_SITEMGR_CANCEL)?></button>

				<!-- Microsoft IE Bug (When the form contain a field with a special char like &#8213; and the enctype is multipart/form-data and the last textfield is empty the first transmitted field is corrupted)-->
				<input type="hidden" name="ieBugFix2" value="1" /> 
				<!-- Microsoft IE Bug -->

			</form>
			<form id="formgallerycancel" action="<?=$cancel_action?>" method="<?=$cancel_method?>">

				<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
				<input type="hidden" name="item_type" value="<?=$item_type?>" />
				<input type="hidden" name="item_id" value="<?=$item_id?>" />
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