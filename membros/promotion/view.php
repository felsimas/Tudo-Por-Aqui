<?


	# ----------------------------------------------------------------------------------------------------
	# * FILE: /membros/promotion/view.php
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
		$listing = db_getFromDB("listing", "promotion_id", db_formatNumber($id));
		if (sess_getAccountIdFromSession() != $promotion->getNumber("account_id")) {
			header("Location: ".DEFAULT_URL."/membros/promotion/index.php?screen=$screen&letra=$letra");
			exit;
		}
		$account = new Account($promotion->getNumber("account_id"));
	}

	else {
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

				<div id="header-form"><a href="<?=DEFAULT_URL?>/membros/promotion/view.php?id=<?=$promotion->getNumber("id")?>"><?=system_showText(LANG_MANAGE_PROMOTION);?> - <?=$promotion->getString("name")?></a></div>
					
					<div style="float: left; width: 313px;">
				

						<a class="btn2 ui-state-default ui-corner-all" href="<?=DEFAULT_URL?>/membros/promotion/promotion.php?id=<?=$promotion->getNumber("id")?>&screen=<?=$screen?>&letra=<?=$letra?>">
							<?=system_showText(LANG_PROMOTION_EDIT_INFORMATION);?><span class="ui-icon ui-icon-pencil"/></span
						</a>
				
						<a class="btn2 ui-state-default ui-corner-all" href="<?=DEFAULT_URL?>/membros/promotion/delete.php?id=<?=$promotion->getNumber("id")?>&screen=<?=$screen?>&letra=<?=$letra?>">
							<?=system_showText(LANG_PROMOTION_DELETE);?>
							<span class="ui-icon ui-icon-circle-close"/></span>
						</a>
						</div>
						
						<div style="float: left; width: 313px;">
					
				
					<? if ($listing->getString("title")) { ?>
					
							<a class="btn2 ui-state-default ui-corner-all" href="<?=DEFAULT_URL?>/membros/promotion/relationship.php?id=<?=$promotion->getNumber("id")?>&screen=<?=$screen?>&letra=<?=$letra?>">
								<?=system_showText(LANG_REMOVE_ASSOCIATION_WITH)?> "<b><?=$listing->getString("title")?></b>" <?=system_showText(LANG_LISTING_FEATURE_NAME)?>
							<span class="ui-icon ui-icon-scissors"/></span>
							</a>
						
					<? } ?>
					
					<a class="btn2 ui-state-default ui-corner-all" href="javascript:void(0);" onclick="javascript:window.open('<?=DEFAULT_URL?>/membros/promotion/preview.php?id=<?=$promotion->getNumber("id")?>', '', 'toolbar=0, location=0, directories=0, status=0, scrollbars=yes, width=800, height=400, screenX=0, screenY=0, menubar=0');" class="standardLINK"><?=system_showText(LANG_MSG_CLICK_TO_PREVIEW_THIS_PROMOTION);?>
					<span class="ui-icon ui-icon-circle-zoomin"/></span></a>
						</div>
					
				
				<div class="clearfix" /></div>


				

					</div>
				</div>
			</div>
		</div>
	<div class="clearfix"></div>
</div>

