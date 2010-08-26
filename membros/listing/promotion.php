<?
	# ----------------------------------------------------------------------------------------------------
	# * FILE: /membros/listing/promotion.php
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
	include(EDIRECTORY_ROOT."/includes/code/listing_promotion.php");

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
				<div id="header-form"><a href="<?=DEFAULT_URL?>/membros/listing/view.php?id=<?=$listing->getNumber("id")?>"> <?=$listing->getString("title")?> - <?=system_showText(LANG_LISTING_PROMOTION)?></a></div>


				<a href="<?=DEFAULT_URL?>/membros/promocao/adicionar/<?=$listing->getNumber("id")?>" class="btn ui-state-default ui-corner-all">
				<?=system_showText(LANG_LABEL_ADDNEWPROMOTION)?>
				<span class="ui-icon ui-icon-circle-plus"></span>
				</a>

				<ul class="list-view">
					<li><a href=></a></li>
				</ul>

				<table border="0" cellpadding="0" cellspacing="0" class="standard-table">
					<tr>
						<td class="standard-tablenote">
							<p><?=system_showText(LANG_LISTING_PROMOTION_IS_LINKED)?><br /><?=system_showText(LANG_LISTING_TO_BE_ACTIVE_PROMOTION)?>:</p>
							<ul>
								<li><?=system_showText(LANG_LISTING_END_DATE_IN_FUTURE)?></li>
								<li><?=system_showText(LANG_LISTING_ASSOCIATED_WITH_LISTING)?></li>
							</ul>
						</td>
					</tr>
				</table>
				<!--
				<p class="standardSubTitle"><?=system_showText(LANG_MSG_PROMOTION_WILL_APPEAR_HERE);?>:</p>
				<br />

					<center><a href="javascript:void(0);" onclick="javascript:window.open('<?=DEFAULT_URL?>/membros/listing/preview.php?id=<?=$listing->getNumber("id")?>&listings_promotion_page=true', '', 'toolbar=0, location=0, directories=0, status=0, scrollbars=yes, width=800, height=400, screenX=0, screenY=0, menubar=0');" class="standardLINK"><?=system_showText(LANG_MSG_CLICK_TO_PREVIEW_THIS_LISTING);?></a></center>
				!-->
				<table border="0" cellpadding="0" cellspacing="0" class="standard-table" style="margin-bottom: 0;">
					<tr>
						<th class="standard-tabletitle"><?=system_showText(LANG_MSG_ASSOCIATE_EXISTING_PROMOTION)?>:</th>
					</tr>
				</table>

						<form name="promotion" action="<?=$_SERVER["PHP_SELF"]?>" method="post" enctype="multipart/form-data">
							<input type="hidden" name="id" value="<?=$id?>" />
							<input type="hidden" name="listing_id" value="<?=$listing_id?>" />
							<input type="hidden" name="letra" value="<?=$letra?>" />
							<input type="hidden" name="screen" value="<?=$screen?>" />

							<? include(INCLUDES_DIR."/forms/form_listingpromotion.php"); ?>
							
							<div class="baseButtons floatButtons">

									<button class="ui-state-default ui-corner-all" type="submit" value="Submit"><?=system_showText(LANG_BUTTON_SUBMIT)?></button>
						
								
							</div>

						</form>
						<form action="<?=DEFAULT_URL?>/membros/listing/index.php" method="post" style=" margin: 0; padding: 0; ">
							<input type="hidden" name="letra" value="<?=$letra?>" />
							<input type="hidden" name="screen" value="<?=$screen?>" />
							
							<div class="baseButtons floatButtons noPaddingButtons">
							
								<button  class="ui-state-default ui-corner-all" type="submit" value="Cancel"><?=system_showText(LANG_BUTTON_CANCEL)?></button>
						
							
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
