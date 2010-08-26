<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /membros/gallery/delete.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSession();

	extract($_GET);
	extract($_POST);

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	if ($id) {
		$gallery = new Gallery($id);
		if (sess_getAccountIdFromSession() != $gallery->getNumber("account_id")) {
			header("Location: ".DEFAULT_URL."/membros/gallery/index.php?screen=$screen&letra=$letra");
			exit;
		}
	}
	else {
		header("Location: ".DEFAULT_URL."/membros/gallery/index.php?screen=$screen&letra=$letra");
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		$gallery = new Gallery($_POST['id']);
		$gallery->delete();
		header("Location: ".DEFAULT_URL."/membros/gallery/");
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/header_members.php");

	# ----------------------------------------------------------------------------------------------------
	# NAVBAR
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/navbar.php");

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

				<div id="header-form"><?=system_highlightLastWord(system_showText(LANG_GALLERY_DELETE))?></div>

				<form title="gallery" method="post">
					<input type="hidden" name="id" value="<?=$id?>" />
					<input type="hidden" name="letra" value="<?=$letra?>" />
					<input type="hidden" name="screen" value="<?=$screen?>" />

					<p><?=system_showText(LANG_GALLERY_DELETE_INFORMATION)?> - <strong><?=$gallery->getString("title")?></strong></p>

					<div class="response-msg inf ui-corner-all"><?=system_showText(LANG_GALLERY_DELETE_CONFIRM)?></div>
					
					<div class="baseButtons floatButtons">

						<p class="standardButton">
							<button type="submit" value="Submit"><?=system_showText(LANG_BUTTON_SUBMIT)?></button>
						</p>
						
					</div>

				</form>
				<form action="<?=DEFAULT_URL?>/membros/gallery/" method="post">
					<input type="hidden" name="letra" value="<?=$letra?>" />
					<input type="hidden" name="screen" value="<?=$screen?>" />
					
					<div class="baseButtons floatButtons noPaddingButtons">

							<button class="ui-state-default ui-corner-all"  type="submit" value="Cancel"><?=system_showText(LANG_BUTTON_CANCEL)?></button>
					
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
