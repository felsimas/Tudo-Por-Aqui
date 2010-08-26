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

	$url_redirect = "".DEFAULT_URL."/membros/listing";
	$url_base = "".DEFAULT_URL."/membros";
	$membros = 1;

	 if ($id) {
		$listing = new Listing($id);
	}

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/listing.php");

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
					<li class="stepActived"><span>3</span>&nbsp;<?=system_showText(LANG_LABEL_CONFIGURATION)?></li>
				</ul>

				<? } ?>

				<? if($id) {
				?>
					<div id="header-form"><a href="<?=DEFAULT_URL?>/membros/listing/view.php?id=<?=$listing->getNumber("id")?>"><?=$listing->getString("title")?> - <?=system_highlightLastWord(system_showText(LANG_LISTING_INFORMATION))?></a></div>
				<?php }else {?> 
					<div id="header-form"><?=system_highlightLastWord(system_showText(LANG_LISTING_INFORMATION))?></div>
				<?php } ?>

			
				<form name="listing" action="<?=$_SERVER["PHP_SELF"]?>" method="post" enctype="multipart/form-data">

					<? /* Microsoft IE Bug (When the form contain a field with a special char like &#8213; and the enctype is multipart/form-data and the last textfield is empty the first transmitted field is corrupted) */ ?>

					<input type="hidden" name="ieBugFix" value="1" />

					<? /* Microsoft IE Bug */ ?>

					<input type="hidden" name="process" id="process" value="<?=$process?>" />
					<input type="hidden" name="id" id="id" value="<?=$id?>" />
					<input type="hidden" name="listingtemplate_id" id="listingtemplate_id" value="<?=$listingtemplate_id?>" />
					<input type="hidden" name="account_id" id="account_id" value="<?=$acctId?>" />
					<input type="hidden" name="level" id="level" value="<?=$level?>" />
					<input type="hidden" name="screen" id="screen" value="<?=$screen?>" />
					<input type="hidden" name="letra" id="letra" value="<?=$letra?>" />

					<? include(INCLUDES_DIR."/forms/form_listing.php"); ?>

					<? /* Microsoft IE Bug (When the form contain a field with a special char like &#8213; and the enctype is multipart/form-data and the last textfield is empty the first transmitted field is corrupted) */ ?>

					<input type="hidden" name="ieBugFix2" value="1" />

					<? /* Microsoft IE Bug */ ?>

				</form>
				<br />
				<form action="<?=DEFAULT_URL?>/membros/listing/index.php" method="post">

					<input type="hidden" name="screen" value="<?=$screen?>" />
					<input type="hidden" name="letra" value="<?=$letra?>" />
					
					<div class="baseButtons">

							<button type="button" class="ui-state-default ui-corner-all" onclick="JS_submit()"><?=system_showText(LANG_BUTTON_SUBMIT)?></button>
							<button type="submit" class="ui-state-default ui-corner-all" value="Cancel"><?=system_showText(LANG_BUTTON_CANCEL)?></button>
						
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

