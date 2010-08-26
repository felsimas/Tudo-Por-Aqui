<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /membros/gallery/gallery.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSession();
	$acctId = sess_getAccountIdFromSession();

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_GET);
	extract($_POST);

	$url_redirect = "".DEFAULT_URL."/membros/gallery";
	$url_base = "".DEFAULT_URL."/membros";
	$membros = 1;

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/gallery.php");

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/header_members.php");


?>

	<div id="page-wrapper">

		<div id="main-wrapper">
		<?php 	include(MEMBERS_EDIRECTORY_ROOT."/menu.php"); ?>
		
			<div id="main-content"> 

				
				<div class="page-title ui-widget-content ui-corner-all">

					<div class="other_content">
				<? require(EDIRECTORY_ROOT."/gerenciamento/registration.php"); ?>
				<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
				<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

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
					$cancel_action = DEFAULT_URL."/membros/$destiny/gallery.php";
					$cancel_method="get";
					$submit_button_label = system_showText(LANG_BUTTON_SUBMIT);
				} else {
					$cancel_action = DEFAULT_URL."/membros/gallery/index.php";
					$cancel_method = "post";
					$submit_button_label = system_showText(LANG_BUTTON_NEXT);
				}
				?>

				<?
				if($id) {
				?>
				<div id="header-form"><a href="<?=DEFAULT_URL?>/membros/gallery/view.php?id=<?=$gallery->getNumber("id")?>"><?=system_showText(LANG_MENU_MANAGEGALLERY);?> - <?=$gallery->getString("title")?> - <?=system_highlightLastWord(system_showText(LANG_GALLERY_INFORMATION))?></div>
				<?php }else {?> 
					<div id="header-form">Adicionar - <?=system_highlightLastWord(system_showText(LANG_GALLERY_INFORMATION))?></a></div>
				<?php } ?>

				<form name="gallery" action="<?=$_SERVER["PHP_SELF"]?>" method="post" enctype="multipart/form-data">

					<? /* Microsoft IE Bug (When the form contain a field with a special char like &#8213; and the enctype is multipart/form-data and the last textfield is empty the first transmitted field is corrupted) */ ?>
					<input type="hidden" name="ieBugFix" value="1" />
					<? /* Microsoft IE Bug */ ?>

					<input type="hidden" name="process" id="process" value="<?=$process?>" />
					<input type="hidden" name="id" id="id" value="<?=$id?>" />
					<input type="hidden" name="account_id" id="account_id" value="<?=$acctId?>" />
					<input type="hidden" name="screen" id="screen" value="<?=$screen?>" />
					<input type="hidden" name="letra" id="letra" value="<?=$letra?>" />

					<input type="hidden" name="item_type" value="<?=$item_type?>" />
					<input type="hidden" name="item_id" value="<?=$item_id?>" />

					<? include(INCLUDES_DIR."/forms/form_gallery.php"); ?>

					<? /* Microsoft IE Bug (When the form contain a field with a special char like &#8213; and the enctype is multipart/form-data and the last textfield is empty the first transmitted field is corrupted) */ ?>
					<input type="hidden" name="ieBugFix2" value="1" />
					<? /* Microsoft IE Bug */ ?>

				</form>
				<br />
				<form action="<?=$cancel_action?>" method="<?=$cancel_method?>">

					<input type="hidden" name="screen" value="<?=$screen?>" />
					<input type="hidden" name="letra" value="<?=$letra?>" />

					<input type="hidden" name="item_type" value="<?=$item_type?>" />
					<input type="hidden" name="item_id" value="<?=$item_id?>" />
					
					<div class="baseButtons">
					
							<button type="button" class="ui-state-default ui-corner-all"  onclick="JS_submit()"><?=$submit_button_label;?></button>
					
							<button type="submit" class="ui-state-default ui-corner-all"  value="Cancel"><?=system_showText(LANG_BUTTON_CANCEL)?></button>
					
					</div>

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
					include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");
				?>

