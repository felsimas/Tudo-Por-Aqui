<?


	# ----------------------------------------------------------------------------------------------------
	# * FILE: /membros/promotion/promotion.php
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

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	$url_base = "".DEFAULT_URL."/membros";
	$membros = 1;

	include(EDIRECTORY_ROOT."/includes/code/promotion.php");

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


				<?
				if($id) {
				?>
				<div id="header-form"><a href="<?=DEFAULT_URL?>/membros/promotion/view.php?id=<?=$promotion->getNumber("id")?>"><?=$promotion->getString("name")?> - <?=system_highlightLastWord(system_showText(LANG_PROMOTION_INFORMATION))?></a></div>
				<?php }else {?> 
					<div id="header-form">Adicionar <?=system_highlightLastWord(system_showText(LANG_PROMOTION_INFORMATION))?></a></div>
				<?php } ?>
				
				<form name="promotion" action="<?=$_SERVER["PHP_SELF"]?>" method="post" enctype="multipart/form-data">
					<input type="hidden" name="id" value="<?=$id?>" />
					<input type="hidden" name="listing_id" value="<?=$listing_id?>" />
					<input type="hidden" name="account_id" value="<?=$acctId?>" />
					<input type="hidden" name="letra" value="<?=$letra?>" />
					<input type="hidden" name="screen" value="<?=$screen?>" />

					<? include(INCLUDES_DIR."/forms/form_promotion.php"); ?>
					
					<div class="baseButtons floatButtons">

							<button class="ui-state-default ui-corner-all" type="submit" name="submit" value="Submit"><?=system_showText(LANG_BUTTON_SUBMIT)?></button>

					
					</div>

				</form>

			<script language="JavaScript">
				<!--

				<? if (DEFAULT_DATE_FORMAT == "m/d/Y") { ?>
					var cal_start = new calendarmdy(document.forms['promotion'].elements['start_date']);
				<? } elseif (DEFAULT_DATE_FORMAT == "d/m/Y") { ?>
					var cal_start = new calendardmy(document.forms['promotion'].elements['start_date']);
				<? } ?>
				cal_start.year_scroll = true;
				cal_start.time_comp = false;

				<? if (DEFAULT_DATE_FORMAT == "m/d/Y") { ?>
					var cal_end = new calendarmdy(document.forms['promotion'].elements['end_date']);
				<? } elseif (DEFAULT_DATE_FORMAT == "d/m/Y") { ?>
					var cal_end = new calendardmy(document.forms['promotion'].elements['end_date']);
				<? } ?>
				cal_end.year_scroll = true;
				cal_end.time_comp = false;

				//-->
			</script>

				<form action="<?=DEFAULT_URL?>/membros/promotion/index.php" method="post" style=" margin: 0; padding: 0; ">
					<input type="hidden" name="letra" value="<?=$letra?>" />
					<input type="hidden" name="screen" value="<?=$screen?>" />
					
					<div class="baseButtons floatButtons noPaddingButtons">

							<button class="ui-state-default ui-corner-all" type="submit" name="cancel" value="Cancel"><?=system_showText(LANG_BUTTON_CANCEL)?></button>
		
					
					</div>
				<div class="clearfix"></div>

				</form>

				</div>
			 </div>
			</div>
		</div>
	<div class="clearfix"></div>
</div>