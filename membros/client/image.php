<?

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

	$url_redirect = "".DEFAULT_URL."/membros/clientes";
	$url_base = "".DEFAULT_URL."/membros";
	$membros = 1;

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/client_image.php");

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

				<?php 				
				$listing = new Listing($empresaid);
				$empresa = $listing->getString("title");
				?>
				<div id="header-form">Clientes
				</div>

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
					
					<div class="baseButtons<? if($client_image_id) { ?> baseButtonsReduced<? } ?> floatButtons">

							<button class="ui-state-default ui-corner-all"  type="submit" value="Submit"><?=system_showText(LANG_BUTTON_SUBMIT)?></button>
						
					</div>

				</form>
				
				<form action="<?=DEFAULT_URL?>/membros/clientes/<?=$id?>" method="post">
					<input type="hidden" name="screen" value="<?=$screen?>" />
					<input type="hidden" name="letra" value="<?=$letra?>" />
					<div class="baseButtons floatButtons noPaddingButtons">
							<button class="ui-state-default ui-corner-all"  type="submit" name="cancel" value="Cancel"><?=system_showText(LANG_BUTTON_CANCEL)?></button>
					</div>
				</form>

				<? if($client_image_id) { ?>

				<form action="<?=DEFAULT_URL?>/membros/clientes/imagem/apagar/" method="post">
					<input type="hidden" name="client_image_id" id="client_image_id" value="<?=$client_image_id?>" />
					<input type="hidden" name="id" id="id" value="<?=$id?>" />
					<input type="hidden" name="screen" value="<?=$screen?>" />
					<input type="hidden" name="letra" value="<?=$letra?>" />
					
					<div class="baseButtons floatButtons noPaddingButtons">
					
									<button class="ui-state-default ui-corner-all"  type="submit" value="Delete"><?=system_showText(LANG_BUTTON_DELETE)?></button>
								
					</div>
					<div class="clearfix"></div>
					

				</form>

				<? } ?>
				

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

