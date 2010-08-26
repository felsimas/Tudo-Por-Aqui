<?
	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/gallery/view.php
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

	$url_redirect = "".DEFAULT_URL."/gerenciamento/gallery";
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
	$errorPage = DEFAULT_URL."/gerenciamento/gallery/index.php?message=".urlencode($message)."&screen=$screen&letra=$letra".(($url_search_params) ? "&$url_search_params" : "");
	if ($id) {
		$gallery = new Gallery($id);
		if ((!$gallery->getNumber("id")) || ($gallery->getNumber("id") <= 0)) {
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

			<!-- <? include(INCLUDES_DIR."/tables/table_gallery_submenu.php"); ?> -->

			<div id="header-view"><?=ucwords(system_showText(LANG_SITEMGR_GALLERY_MANAGEGALLERY))?> - <?=$gallery->getString("title")?></div>
				
				<div style="float:left; width:313px">
						
				<a class="btn2 ui-state-default ui-corner-all" href="<?=DEFAULT_URL?>/gerenciamento/gallery/gallery.php?id=<?=$gallery->getNumber("id")?>&screen=<?=$screen?>&letra=<?=$letra?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-view">
					<span class="ui-icon ui-icon ui-icon-pencil"></span>
					<?=system_showText(LANG_SITEMGR_EDIT)?> <?=system_showText(LANG_SITEMGR_GALLERY_GALLERYINFORMATION)?>
				</a>
				
				<a  class="btn2 ui-state-default ui-corner-all" href="<?=DEFAULT_URL?>/gerenciamento/gallery/images.php?id=<?=$gallery->getNumber("id")?>&screen=<?=$screen?>&letra=<?=$letra?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-view">
					
					<span class="ui-icon ui-icon-image"></span>
					<?=system_showText(LANG_SITEMGR_MANAGE)?> <?=ucwords(system_showText(LANG_SITEMGR_IMAGE_PLURAL))?>
				</a>
				</div>
				<div style="float:left; width:313px">
				<a  class="btn2 ui-state-default ui-corner-all" href="<?=DEFAULT_URL?>/gerenciamento/gallery/delete.php?id=<?=$gallery->getNumber("id")?>&screen=<?=$screen?>&letra=<?=$letra?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-view">
					<span class="ui-icon ui-icon-closethick"></span>
					<?=system_showText(LANG_SITEMGR_DELETE)?> <?=system_showText(LANG_SITEMGR_GALLERY)?>
					
				</a>
				<a class="btn2 ui-state-default ui-corner-all"  onclick="window.open('http://localhost/tudoporaqui/public/gerenciamento/gallery/preview.php?id=6', '_blank', 'toolbar=0, location=0, directories=0, status=0, width=750, height=450, screenX=0, screenY=0, menubar=0, scrollbars=yes, resizable=0');" href="javascript:void(0);">
					<span class="ui-icon ui-icon-search"></span>					
					
				<?php echo utf8_decode("Clique aqui para pré-visualizar este(a) Galeria") ?>
				</a>
	
				</div>
				<div class="clearfix"></div><br/>


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
