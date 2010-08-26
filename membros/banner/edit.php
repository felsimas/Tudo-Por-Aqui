<?


	# ----------------------------------------------------------------------------------------------------
	# * FILE: /membros/banner/edit.php
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

		<? if ($process == "signup") { ?>
			<ul class="standardStep">
				<li class="standardStepAD"><?=system_highlightLastWord(system_showText(LANG_ENJOY_OUR_SERVICES))?></li>
				<li><span>1</span>&nbsp;<?=system_showText(LANG_LABEL_ORDER)?></li>
				<li><span>2</span>&nbsp;<?=system_showText(LANG_LABEL_CHECKOUT)?></li>
				<li class="stepActived"><span>3</span>&nbsp;<?=system_showText(LANG_LABEL_CONFIGURATION);?></li>
			</ul>
		<? } ?>

		<div id="header-form"><?=system_showText(LANG_BANNER_EDIT);?></div>

		<form name="banner" action="<?=$_SERVER["PHP_SELF"]?>" method="post" enctype="multipart/form-data">

			<input type="hidden" name="process" id="process" value="<?=$process?>" />
			<input type="hidden" name="operation" value="update" />
			<input type="hidden" name="id" value="<?=$id?>" />
			<input type="hidden" name="account_id" value="<?=$acctId?>" />
			<input type="hidden" name="level" value="<?=$level?>" />
			<input type="hidden" name="letra" value="<?=$letra?>" />
			<input type="hidden" name="screen" value="<?=$screen?>" />

			<? include(INCLUDES_DIR."/forms/form_banner.php"); ?>
			
			<div class="baseButtons floatButtons">

					<button class="ui-state-default ui-corner-all" type="submit" value="<?=system_showText(LANG_BUTTON_UPDATE)?>"><?=system_showText(LANG_BUTTON_UPDATE)?></button>
				
			</div>

		</form>
		<form action="<?=DEFAULT_URL?>/membros/banner/index.php" method="post">

			<input type="hidden" name="letra" value="<?=$letra?>" />
			<input type="hidden" name="screen" value="<?=$screen?>" />
					
			<div class="baseButtons floatButtons noPaddingButtons">

					<button class="ui-state-default ui-corner-all" type="submit" value="Cancel"><?=system_showText(LANG_BUTTON_CANCEL)?></button>
				
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

