<?
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (BANNER_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSession();
	$acctId = sess_getAccountIdFromSession();

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);

	$url_base = "".DEFAULT_URL."/membros";
	$url_redirect = $url_base."/banner";
	$membros = 1;

	include(EDIRECTORY_ROOT."/includes/code/banner.php");

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

			<div id="header-form"><?=system_highlightLastWord(system_showText(LANG_LABEL_ADDBANNER))?></div>

		<form name="banner" action="<?=$_SERVER["PHP_SELF"]?>" method="post" enctype="multipart/form-data">
			<input type="hidden" name="operation" value="add" />
			<input type="hidden" name="account_id" value="<?=$acctId?>" />
			<input type="hidden" name="type" value="<?=$type?>" />
			<input type="hidden" name="letra" value="<?=$letra?>" />
			<input type="hidden" name="screen" value="<?=$screen?>" />

			<? include(INCLUDES_DIR."/forms/form_banner.php"); ?>
			
			<div class="baseButtons floatButtons">

					<button type="submit" class="ui-state-default ui-corner-all" name="submit" value="Submit"><?=system_showText(LANG_BUTTON_SUBMIT)?></button>
				
			</div>

		</form>
		<form action="<?=DEFAULT_URL?>/membros/banner/index.php" method="post" style="margin: 0; padding: 0;">

			<input type="hidden" name="letra" value="<?=$letra?>" />
			<input type="hidden" name="screen" value="<?=$screen?>" />
			
			<div class="baseButtons floatButtons noPaddingButtons">

					<button type="submit" class="ui-state-default ui-corner-all"  value="Cancel"><?=system_showText(LANG_BUTTON_CANCEL)?></button>
				
			</div>
			<div class="clearfix"></div>
		
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


