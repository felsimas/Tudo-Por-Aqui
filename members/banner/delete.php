<?


	# ----------------------------------------------------------------------------------------------------
	# * FILE: /membros/banner/delete.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
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

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	if ($id) {
		$banner = new Banner($id);
		if (sess_getAccountIdFromSession() != $banner->getNumber("account_id")) {
			header("Location: ".DEFAULT_URL."/membros/banner/index.php?screen=$screen&letra=$letra");
			exit;
		}
	}
	else {
		header("Location: ".DEFAULT_URL."/membros/banner/index.php?screen=$screen&letra=$letra");
		exit;
	}

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

		<div id="header-form"><?=system_highlightLastWord(system_showText(LANG_BANNER_DELETE))?></div>

		<? $banner = new Banner($id); ?>
		<p><?=system_showText(LANG_BANNER_DELETE_INFORMATION)?> - <strong><?=$banner->getString("caption")?></strong></p>

		<div class="response-msg inf ui-corner-all"><?=system_showText(LANG_BANNER_DELETE_CONFIRM)?></div>
		
		<div class="baseButtons">

		<form title="banner" method="post">

			<input type="hidden" name="id" value="<?=$id?>" />
			<input type="hidden" name="operation" value="delete" />
			<input type="hidden" name="letra" value="<?=$letra?>" />
			<input type="hidden" name="screen" value="<?=$screen?>" />

				<p class="standardButton">
					<button type="submit" value="Submit"><?=system_showText(LANG_BUTTON_SUBMIT)?></button>
				</p>

		</form>
		<form action="<?=DEFAULT_URL?>/membros/banner/index.php" method="post">
			<input type="hidden" name="letra" value="<?=$letra?>" />
			<input type="hidden" name="screen" value="<?=$screen?>" />

				<p class="standardButton">
					<button type="submit" value="Cancel"><?=system_showText(LANG_BUTTON_CANCEL)?></button>
				</p>

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


