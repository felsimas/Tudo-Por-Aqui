<?
	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/content/content_noimage.php
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

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	include(INCLUDES_DIR."/code/content_noimage.php");


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

			<? include(INCLUDES_DIR."/tables/table_content_submenu.php"); ?>

			<br />

			<? if ($message_noimage) { ?>
				<? if ($success) { ?>
					<div class="response-msg success ui-corner-all"><?=$message_noimage?></div>
				<? } else { ?>
					<p class="errorMessage"><?=$message_noimage?></p>
				<? } ?>
			<? } ?>
			
			<div class="baseForm">

			<form name="noimage" method="post" action="<?=$_SERVER["PHP_SELF"]?>" enctype="multipart/form-data">

				<? include(INCLUDES_DIR."/forms/form_content_noimage.php"); ?>

				<button type="submit" name="submit_button" value="Submit" class="ui-state-default ui-corner-all"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
				<button type="button" value="Cancel" class="ui-state-default ui-corner-all" onclick="document.getElementById('formcontentnoimagecancel').submit();"><?=system_showText(LANG_SITEMGR_CANCEL)?></button>

				<input type="hidden" name="ieBugFix2" value="1" /> 

			</form>
			<form id="formcontentnoimagecancel" action="<?=DEFAULT_URL?>/gerenciamento/content/index.php" method="post">
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
