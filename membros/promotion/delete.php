<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /membros/promotion/delete.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSession();

	extract($_GET);
	extract($_POST);

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	if ($id) {
		$promotion = new Promotion($id);
		if (sess_getAccountIdFromSession() != $promotion->getNumber("account_id")) {
			header("Location: ".DEFAULT_URL."/membros/promotion/index.php?screen=$screen&letra=$letra");
			exit;
		}
	}
	else {
		header("Location: ".DEFAULT_URL."/membros/promotion/index.php?screen=$screen&letra=$letra");
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		$promotion = new Promotion($_POST['id']);
		$promotion->delete();
		header("Location: ".DEFAULT_URL."/membros/promotion/index.php?screen=$screen&letra=$letra");
		exit;
	}

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

				<div id="header-form"><a href="<?=DEFAULT_URL?>/membros/promotion/view.php?id=<?=$promotion->getNumber("id")?>"><?=$promotion->getString("name")?> - <?=system_showText(LANG_PROMOTION_DELETE_INFORMATION);?></a></div>

				<form title="promotion" method="post">
				<input type="hidden" name="id" value="<?=$id?>" />
				<input type="hidden" name="letra" value="<?=$letra?>" />
				<input type="hidden" name="screen" value="<?=$screen?>" />


					<div class="response-msg inf ui-corner-all"><?=system_showText(LANG_PROMOTION_DELETE_CONFIRM)?></div>
					
					<div class="baseButtons floatButtons">

							<button class="ui-state-default ui-corner-all" type="submit" value="Submit"><?=system_showText(LANG_BUTTON_SUBMIT)?></button>
						
					</div>

				</form>
				<form action="<?=DEFAULT_URL?>/membros/promotion/" method="get">
					<input type="hidden" name="letra" value="<?=$letra?>" />
					<input type="hidden" name="screen" value="<?=$screen?>" />
					
					<div class="baseButtons floatButtons noPaddingButtons">

							<button class="ui-state-default ui-corner-all" type="submit" value="Cancel"><?=system_showText(LANG_BUTTON_CANCEL)?></button>
					
					</div>

				</form>

					</div>
				</div>
			</div>
		</div>
	<div class="clearfix"></div>
</div>