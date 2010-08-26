<?


	# ----------------------------------------------------------------------------------------------------
	# * FILE: /membros/promotion/seocenter.php
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

	$url_redirect = "".DEFAULT_URL."/membros/promotion";
	$url_base = "".DEFAULT_URL."/membros";
	$membros = 1;

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/promotion_seocenter.php");

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

				<div id="header-form"><?=ucwords(PROMOTION_FEATURE_NAME);?> SEO CENTER - <span><?=$promotion->getString("name");?></span></div>

				<form name="promotionseocenter" action="<?=$_SERVER["PHP_SELF"]?>" method="post">

					<input type="hidden" name="id" value="<?=$id?>" />
					<input type="hidden" name="letra" value="<?=$letra?>" />
					<input type="hidden" name="screen" value="<?=$screen?>" />

					<? include(INCLUDES_DIR."/forms/form_promotion_seocenter.php"); ?>
					
					<div class="baseButtons floatButtons">
					
						<p class="standardButton">
							<button type="submit" name="submit" value="Submit"><?=system_showText(LANG_BUTTON_SUBMIT)?></button>
						</p>
					
					</div>

				</form>

				<form action="<?=DEFAULT_URL?>/membros/promotion/index.php" method="post" style=" margin: 0; padding: 0; ">

					<input type="hidden" name="letra" value="<?=$letra?>" />
					<input type="hidden" name="screen" value="<?=$screen?>" />
					
					<div class="baseButtons floatButtons noPaddingButtons">
					
						<p class="standardButton">
							<button type="submit" name="cancel" value="Cancel"><?=system_showText(LANG_BUTTON_CANCEL)?></button>
						</p>
					
					</div>

				</form>

			</div>

			</div>
		</div>
	<div class="clearfix"></div>
</div>
