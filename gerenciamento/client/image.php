<?
	include("../../conf/loadconfig.inc.php");
	sess_validateSMSession();
	permission_hasSMPerm();

	$url_redirect = "".DEFAULT_URL."/gerenciamento/clientes";
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
	include(EDIRECTORY_ROOT."/includes/code/client_image.php");


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

		<!-- 	<? include(INCLUDES_DIR."/tables/table_client_submenu.php"); ?> -->
			
			<div class="baseForm">

			<form name="client" action="<?=$_SERVER["PHP_SELF"]?>" method="post" enctype="multipart/form-data">
				<input type="hidden" name="client_image_id" value="<?=$client_image_id?>" />
				<input type="hidden" name="id" value="<?=$id?>" />
				<input type="hidden" name="screen" value="<?=$screen?>" />
				<input type="hidden" name="letra" value="<?=$letra?>" />

				<?
				$imgClientW = IMAGE_GALLERY_FULL_WIDTH;
				$imgClientH = IMAGE_GALLERY_FULL_HEIGHT;
				include(INCLUDES_DIR."/forms/form_imagec.php");
				?>

							<button type="submit" value="Submit" class="ui-state-default ui-corner-all"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>

							<button type="button" value="Cancel" class="ui-state-default ui-corner-all" onclick="document.getElementById('formclientcancel').submit();"><?=system_showText(LANG_SITEMGR_CANCEL)?></button>

							<? if ($client_image_id) { ?>
							<button type="button" name="delete" value="Delete" class="ui-state-default ui-corner-all" onclick="document.getElementById('formclientdelete').submit();"><?=system_showText(LANG_SITEMGR_DELETE)?></button>
							<? } ?>

			</form>
			<form id="formclientcancel" action="<?=DEFAULT_URL?>/gerenciamento/client/images.php?id=<?=$id?>" method="post">
				<input type="hidden" name="screen" value="<?=$screen?>" />
				<input type="hidden" name="letra" value="<?=$letra?>" />
			</form>

			<? if ($client_image_id) { ?>

			<form id="formclientdelete" action="<?=DEFAULT_URL?>/gerenciamento/client/delete_image.php" method="post">

							<input type="hidden" name="client_image_id" id="client_image_id" value="<?=$client_image_id?>" />
							<input type="hidden" name="id" id="id" value="<?=$id?>" />
							<input type="hidden" name="screen" value="<?=$screen?>" />
							<input type="hidden" name="letra" value="<?=$letra?>" />

			</form>

			<? } ?>
			
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
