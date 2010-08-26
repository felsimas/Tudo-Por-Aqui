<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/promotion/view.php
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

	$url_redirect = "".DEFAULT_URL."/gerenciamento/promotion";
	$url_base = "".DEFAULT_URL."/gerenciamento";
	$sitemgr = 1;

	extract($_GET);
	extract($_POST);

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------

	if ($id) {
		$promotion = new Promotion($id);
		$listing = db_getFromDB("listing", "promotion_id", db_formatNumber($id));
		if ($promotion->getNumber("account_id")) $account = new Account($promotion->getNumber("account_id"));
	} else {
		header("Location: ".DEFAULT_URL."/gerenciamento/promotion/".(($search_page) ? "search.php" : "index.php")."?screen=$screen&letra=$letra".(($url_search_params) ? "&$url_search_params" : "")."");
		exit;
	}

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
	<? include(INCLUDES_DIR."/tables/table_promotion_submenu.php"); ?>

		<div id="header-view">
			<?=ucwords(system_showText(LANG_SITEMGR_MANAGE))?> <?=system_showText(LANG_SITEMGR_PROMOTION_SING)?> - <?=$promotion->getString("name")?>
		</div>
		<div style="float:left; width:313px">

				<a class="btn2 ui-state-default ui-corner-all" href="<?=DEFAULT_URL?>/gerenciamento/promotion/promotion.php?id=<?=$promotion->getNumber("id")?>&screen=<?=$screen?>&letra=<?=$letra?><?=(($url_search_params) ? "&$url_search_params" : "")?>">
					<span class="ui-icon ui-icon ui-icon-pencil"></span>

					<?=ucwords(system_showText(LANG_SITEMGR_EDIT))?> <?=system_showText(LANG_SITEMGR_PROMOTION_SING)?>
				</a>
		
				<a class="btn2 ui-state-default ui-corner-all" href="<?=DEFAULT_URL?>/gerenciamento/promotion/delete.php?id=<?=$promotion->getNumber("id")?>&screen=<?=$screen?>&letra=<?=$letra?><?=(($url_search_params) ? "&$url_search_params" : "")?>">
					<span class="ui-icon ui-icon-closethick"></span>
					
					<?=ucwords(system_showText(LANG_SITEMGR_DELETE))?> <?=system_showText(LANG_SITEMGR_PROMOTION_SING)?>
				</a>
		</div>
		<div style="float:left; width:313px">
		
			<? if ($listing->getString("title")) { ?>
	
					<a class="btn2 ui-state-default ui-corner-all" href="<?=DEFAULT_URL?>/gerenciamento/promotion/relationship.php?id=<?=$promotion->getNumber("id")?>&screen=<?=$screen?>&letra=<?=$letra?><?=(($url_search_params) ? "&$url_search_params" : "")?>">
						<span class="ui-icon ui-icon ui-icon-pencil"></span>
					
						<?=system_showText(LANG_SITEMGR_PROMOTION_RMASSOCWITH)?> <?=system_showText(LANG_SITEMGR_LISTING_SING)?>: "<?=$listing->getString("title")?>"
					</a>

			<? } ?>
			
				<?
				if (!$account) {
					echo "<em>".system_showText(LANG_SITEMGR_ACCOUNTSEARCH_NOOWNER)."</em>";
				} else {
					?><a class="btn2 ui-state-default ui-corner-all" href="<?=DEFAULT_URL?>/gerenciamento/account/view.php?id=<?=$promotion->getNumber("account_id")?>"><?
						echo "<span class=\"ui-icon ui-icon-person\"></span>";
						echo "Conta: "; echo system_showAccountUserName($account->getString("username"));
					?></a><?
				}
				?>
				<a class="btn2 ui-state-default ui-corner-all"  href="javascript:void(0);" onclick="javascript:window.open('<?=DEFAULT_URL?>/gerenciamento/promotion/preview.php?id=<?=$promotion->getNumber("id")?>', '', 'toolbar=0, location=0, directories=0, status=0, scrollbars=yes, width=800, height=400, screenX=0, screenY=0, menubar=0');">
					<span class="ui-icon ui-icon-search"></span>
				
				<?=ucfirst(system_showText(LANG_SITEMGR_CLICKHERETOPREVIEW))?> <?=system_showText(LANG_SITEMGR_PROMOTION_SING)?>
				</a>
				
			</div>
			<div class="clearfix"></div>



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