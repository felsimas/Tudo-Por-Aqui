<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/prefs/editorchoice.php
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

	if ($delete && $id) {
		$editorChoice = new EditorChoice($id);
	} elseif ($delete && !$id) {
		header("Location: ".DEFAULT_URL."/gerenciamento/prefs/editorchoice.php");
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		if ($editorchoice) {
			include(INCLUDES_DIR."/code/editor_choice.php");
		} elseif ($delete) {
			$editorChoice = new EditorChoice($id);
			$editorChoice->delete();
			$message_editorchoice = system_showText(LANG_SITEMGR_SETTINGS_EDITORCHOICE_WASSUCCESSDELETED)."<br />";
			header("Location: ".DEFAULT_URL."/gerenciamento/prefs/editorchoice.php?message_editorchoice=".urlencode($message_editorchoice));
			exit;
		}
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

			<? include(INCLUDES_DIR."/tables/table_prefs_submenu.php"); ?>

			<br />

			<? if ($delete) { ?>
				<div class="baseForm">
				<form name="account" method="post">
					<input type="hidden" name="id" value="<?=$id?>" />
					<input type="hidden" name="delete" value="y" />
					<div id="header-form">
						<?=system_showText(LANG_SITEMGR_SETTINGS_EDITORCHOICE_DELETELISTINGDESIGNATION)?> - <?=$editorChoice->getString("name")?>
					</div>
					<div class="response-msg inf ui-corner-all">
						<?
							$imageObj = new Image($editorChoice->getString("image_id"));
							if($imageObj->imageExists()) {
								echo $imageObj->getTag(true, IMAGE_DESIGNATION_WIDTH, IMAGE_DESIGNATION_HEIGHT, $editorChoice->getString("name"))."<br />";
							}
						?>
						<?=system_showText(LANG_SITEMGR_SETTINGS_EDITORCHOICE_DELETEQUESTION)?>
					</div>
					<button type="submit" value="Submit" class="ui-state-default ui-corner-all"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
					<button type="button" value="Cancel" class="ui-state-default ui-corner-all" onclick="document.getElementById('formeditorchoicecancel').submit();"><?=system_showText(LANG_SITEMGR_CANCEL)?></button>
				</form>
				<form id="formeditorchoicecancel" action="<?=DEFAULT_URL?>/gerenciamento/prefs/editorchoice.php" method="post">
				</form>
				</div>
			<? } else { ?>
				<div class="baseForm">
				<form name="editorchoice" action="<?=$_SERVER["PHP_SELF"]?>" method="post" enctype="multipart/form-data">
					<? include(INCLUDES_DIR."/forms/form_editorchoice.php"); ?>
					<button type="submit" name="editorchoice" value="Submit" class="ui-state-default ui-corner-all"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
				</form>
				</div>
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
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>
