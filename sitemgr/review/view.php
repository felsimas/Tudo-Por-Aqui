<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/review/view.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	$url_redirect = "".DEFAULT_URL."/gerenciamento/review";
	$url_base = "".DEFAULT_URL."/gerenciamento";

	extract($_POST);
	extract($_GET);

	$reviewObj = new Review($id);

		# ----------------------------------------------------------------------------------------------------
		# HEADER
		# ----------------------------------------------------------------------------------------------------
		include(SM_EDIRECTORY_ROOT."/layout/header_manager.php");

	?>

		<div id="page-wrapper">

			<div id="main-wrapper">

			<?php 	include(SM_EDIRECTORY_ROOT."/menu.php"); ?>

				<div id="main-content"> 

					<div class="page-title ui-widget-content ui-corner-all">

						<div class="other_content">

		<? require(EDIRECTORY_ROOT."/gerenciamento/registration.php"); ?>
		<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
		<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

		<? include(INCLUDES_DIR."/tables/table_review_submenu.php"); ?>

		<div id="header-view">
			<?=system_showText(LANG_SITEMGR_REVIEW_MANAGEREVIEW)?>
		</div>
		<div style="float: left; width: 313px;">

			<? if ($reviewObj->getNumber("approved")==0){ ?>

				<a class="btn2 ui-state-default ui-corner-all"  href="<?=DEFAULT_URL?>/gerenciamento/review/approve.php?id=<?=$reviewObj->getNumber("id")?>&item_type=<?=$item_type?>&item_id=<?=$item_id?><?=($filter_id ? "&filter_id=1" : '')?>&screen=<?=$screen?>&letra=<?=$letra?>&item_screen=<?=$item_screen?>&item_letra=<?=$item_letra?>">
					<span class="ui-icon ui-icon-circle-check"></span>
					
					<?=system_showText(LANG_SITEMGR_REVIEW_APPROVETHISREVIEW)?>
				</a>
				
			<? } ?>	
		</div>
			<div style="float: left; width: 313px;">

				<a class="btn2 ui-state-default ui-corner-all"  href="<?=DEFAULT_URL?>/gerenciamento/review/delete.php?id=<?=$reviewObj->getNumber("id")?>&item_type=<?=$reviewObj->getNumber("item_type")?>&item_id=<?=$item_id?><?=($filter_id ? "&filter_id=1" : '')?>&screen=<?=$screen?>&letra=<?=$letra?>&item_screen=<?=$item_screen?>&item_letra=<?=$item_letra?>">
					<span class="ui-icon ui-icon-circle-close"></span>
				
				<?=system_showText(LANG_SITEMGR_REVIEW_DELETEREVIEW)?>
				
				</a>
			</div>
			<div class="clearfix"></div>
			<br/>
		<div id="header-view">
			<?=system_showText(LANG_SITEMGR_REVIEW_REVIEWPREVIEW)?>
		</div>
		<?
		$reviewObj->extract();
		$show_item = true;
		$user 	   = false;
		include(INCLUDES_DIR."/views/view_review_detail.php");
		echo $item_reviewcomment;
		?>
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
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>