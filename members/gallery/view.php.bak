<?


	# ----------------------------------------------------------------------------------------------------
	# * FILE: /membros/gallery/view.php
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
	$errorPage = "".DEFAULT_URL."/membros/gallery/index.php?screen=$screen&letra=$letra";
	if ($id) {
		$gallery = new Gallery($id);
		if ((!$gallery->getNumber("id")) || ($gallery->getNumber("id") <= 0)) {
			header("Location: ".$errorPage);
			exit;
		}
		if (sess_getAccountIdFromSession() != $gallery->getNumber("account_id")) {
			header("Location: ".$errorPage);
			exit;
		}
	} else {
		header("Location: ".$errorPage);
		exit;
	}

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

		<div id="header-form"><a href="<?=DEFAULT_URL?>/membros/gallery/view.php?id=<?=$gallery->getNumber("id")?>"><?=system_showText(LANG_MENU_MANAGEGALLERY);?> - <?=$gallery->getString("title")?></div>
			
			<div style="float: left; width: 313px;">
			

			<a class="btn2 ui-state-default ui-corner-all"  href="<?=DEFAULT_URL?>/membros/gallery/gallery.php?id=<?=$id?>&screen=<?=$screen?>&letra=<?=$letra?>"><?=system_showText(LANG_GALLERY_EDIT_INFORMATION);?><span class="ui-icon ui-icon-pencil"/></span></a>
			<a class="btn2 ui-state-default ui-corner-all"  href="<?=DEFAULT_URL?>/membros/gallery/images.php?id=<?=$id?>&screen=<?=$screen?>&letra=<?=$letra?>"><?=system_showText(LANG_GALLERY_MANAGE_IMAGES);?><span class="ui-icon ui-icon-image"/></span></a>
			</div>
			<div style="float: left; width: 313px;">
			
			<a class="btn2 ui-state-default ui-corner-all"  href="<?=DEFAULT_URL?>/membros/gallery/delete.php?id=<?=$id?>&screen=<?=$screen?>&letra=<?=$letra?>"><?=system_showText(LANG_GALLERY_DELETE);?><span class="ui-icon ui-icon-circle-close"/></span></a>
			<a class="btn2 ui-state-default ui-corner-all"  href="javascript:void(0);" onclick="window.open('<?=DEFAULT_URL?>/membros/gallery/preview.php?id=<?=$gallery->getNumber("id")?>', '_blank', 'toolbar=0, location=0, directories=0, status=0, width=750, height=450, screenX=0, screenY=0, menubar=0, scrollbars=yes, resizable=0');">
			<?=system_showText(LANG_MSG_CLICK_TO_PREVIEW_THIS_GALLERY);?>
			<span class="ui-icon ui-icon-search"></span>					
			
			</a>
			
			</div>
			
			<div class="clearfix"></div>
	

			


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
