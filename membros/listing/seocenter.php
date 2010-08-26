<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /membros/listing/seocenter.php
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

	$url_redirect = "".DEFAULT_URL."/membros/listing";
	$url_base = "".DEFAULT_URL."/membros";
	$membros = 1;

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/listing_seocenter.php");

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

				<div id="header-form"><a href="<?=DEFAULT_URL?>/membros/listing/view.php?id=<?=$listing->getNumber("id")?>"><?=system_showText(LANG_MANAGE_LISTING);?> - <?=$listing->getString("title")?></a></div>

				<form name="listingseocenter" action="<?=$_SERVER["PHP_SELF"]?>" method="post">

					<input type="hidden" name="id" id="id" value="<?=$id?>" />
					<input type="hidden" name="letra" id="letra" value="<?=$letra?>" />
					<input type="hidden" name="screen" id="screen" value="<?=$screen?>" />
					<? include(INCLUDES_DIR."/forms/form_listing_seocenter.php"); ?>
					
					<div class="baseButtons floatButtons">

							<button class="ui-state-default ui-corner-all"  type="submit" name="submit" value="Submit"><?=system_showText(LANG_BUTTON_SUBMIT)?></button>
			
						
					</div>

				</form>

				<form action="<?=DEFAULT_URL?>/membros/listing/index.php" method="post">

						<input type="hidden" name="letra" value="<?=$letra?>" />
						<input type="hidden" name="screen" value="<?=$screen?>" />
						
						<div class="baseButtons floatButtons noPaddingButtons">
						
								<button class="ui-state-default ui-corner-all"  type="submit" name="cancel" value="Cancel"><?=system_showText(LANG_BUTTON_CANCEL)?></button>
							
						
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

