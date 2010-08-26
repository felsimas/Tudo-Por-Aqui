<?


	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/estabelecimentos/view.php
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

	$url_redirect = "".DEFAULT_URL."/gerenciamento/estabelecimentos";
	$url_base = "".DEFAULT_URL."/gerenciamento";
	$sitemgr = 1;

	extract($_POST);
	extract($_GET);

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	if ($id) {
		$listing = new Listing($id);
		if ($listing->getNumber("account_id")) $account = new Account($listing->getNumber("account_id"));
	} else {
		header("Location: ".DEFAULT_URL."/gerenciamento/estabelecimentos/".(($search_page) ? "search.php" : "index.php")."?message=".urlencode($message)."&screen=$screen&letra=$letra".(($url_search_params) ? "&$url_search_params" : "")."");
		exit;
	}

	$level = new ListingLevel();
	$listingImages = $level->getImages($listing->getNumber("level"));
	$listingPromotion = $level->getHasPromotion($listing->getNumber("level"));

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

		<? if($listing->getString("id") == 0){ ?>

			<p class="errorMessage"><?=system_showText(LANG_SITEMGR_LISTING_MIGHTBEDELETED)?></p>

		<? } else { ?>

			<? include(INCLUDES_DIR."/tables/table_listing_submenu.php"); ?>

			<div id="header-view">
					<?=ucwords(system_showText(LANG_SITEMGR_MANAGE))?> <?=system_showText(LANG_SITEMGR_LISTING_SING)?> - <?=$listing->getString("title")?>
				</div>
				
	
				<div style="float:left; width:313px">
					<strong><?=system_showText(LANG_SITEMGR_LASTUPDATED)?>:</strong> <span class="label-field-account"><?=format_date($listing->getNumber("updated"),DEFAULT_DATE_FORMAT." - H:i:s", "datetime")?></span>
									<a href="<?=DEFAULT_URL?>/gerenciamento/estabelecimentos/listing.php?id=<?=$listing->getNumber("id")?>&screen=<?=$screen?>&letra=<?=$letra?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="btn2 ui-state-default ui-corner-all">
										<span class="ui-icon ui-icon ui-icon-pencil"></span>
										<?=ucwords(system_showText(LANG_SITEMGR_EDIT))?> <?=ucwords(system_showText(LANG_SITEMGR_INFORMATION))?>									
									</a>
									
									<a href="<?=DEFAULT_URL?>/gerenciamento/estabelecimentos/listinglevel.php?id=<?=$listing->getNumber("id")?>&screen=<?=$screen?>&letra=<?=$letra?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="btn2 ui-state-default ui-corner-all">
										<span class="ui-icon ui-icon ui-icon-gear"></span>
										<?=ucwords(system_showText(LANG_SITEMGR_EDIT))?> <?=ucwords(system_showText(LANG_SITEMGR_LEVEL))?>									
									</a>

									<a href="<?=DEFAULT_URL?>/gerenciamento/estabelecimentos/delete.php?id=<?=$listing->getNumber("id")?>&screen=<?=$screen?>&letra=<?=$letra?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="btn2 ui-state-default ui-corner-all">
										<span class="ui-icon ui-icon-closethick"></span>
										<?=ucwords(system_showText(LANG_SITEMGR_DELETE))?> <?=system_showText(LANG_SITEMGR_LISTING_SING) ?>									
									</a>
									
									<? $status = new ItemStatus(); ?>
									
									<a href="<?=DEFAULT_URL?>/gerenciamento/estabelecimentos/settings.php?id=<?=$listing->getNumber("id")?>&screen=<?=$screen?>&letra=<?=$letra?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="btn2 ui-state-default ui-corner-all">
										<span class="ui-icon ui-icon-clock
										
										
										
										"></span>
										<?=ucwords(system_showText(LANG_SITEMGR_EDIT))?> <?=ucwords(system_showText(LANG_SITEMGR_STATUS))?>									
									</a>
									<? if ($listing->hasRenewalDate()) { ?>
									
									<a href="<?=DEFAULT_URL?>/gerenciamento/estabelecimentos/settings.php?id=<?=$listing->getNumber("id")?>&screen=<?=$screen?>&letra=<?=$letra?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="btn2 ui-state-default ui-corner-all">
										<span class="ui-icon ui-icon-calendar"></span>
										<?=ucwords(system_showText(LANG_SITEMGR_EDIT))?> <?=ucwords(system_showText(LANG_SITEMGR_RENEWALDATE))?>									
									</a>
									</div>
									<div style="float:left; width:313px">
									<strong><?=system_showText(LANG_SITEMGR_DATECREATED)?>:</strong> <span class="label-field-account"><?=format_date($listing->getNumber("entered"),DEFAULT_DATE_FORMAT." - H:i:s", "datetime")?></span>
									<? } ?>
									<? if ($listingPromotion == "y") { ?>
									<? $promotion_label = ($listing->getNumber("promotion_id") == 0) ? ucwords(system_showText(LANG_SITEMGR_ADD)) : ucwords(system_showText(LANG_SITEMGR_EDIT)); ?>
									<a href="<?=DEFAULT_URL?>/gerenciamento/estabelecimentos/promotion.php?id=<?=$id?>&screen=<?=$screen?>&letra=<?=$letra?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="btn2 ui-state-default ui-corner-all">
										<span class="ui-icon ui-icon-grip-solid-vertical"></span>
										<?=$promotion_label?> <?=ucwords(system_showText(LANG_SITEMGR_PROMOTION))?>
									</a>
									<? } ?>
									
									<? if ((LISTING_MAX_GALLERY > 0) && (($listingImages > 0) || ($listingImages == -1))) { ?>
									
									<a href="<?=DEFAULT_URL?>/gerenciamento/estabelecimentos/gallery.php?item_type=listing&item_id=<?=$id?>&screen=<?=$screen?>&letra=<?=$letra?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="btn2 ui-state-default ui-corner-all">
										<span class="ui-icon ui-icon-image"></span>
										<?=ucwords(system_showText(LANG_SITEMGR_PHOTOGALLERY))?>
									</a>
									<? } ?>
									
									<? if (!$account) { ?>
									<a href="#" class="btn2 ui-state-default ui-corner-all">
										<span class="ui-icon ui-icon-grip-solid-vertical"></span>
										<?=system_showText(LANG_SITEMGR_ACCOUNTSEARCH_NOOWNER)?>
									</a>
									<? } else { ?>
									<a class="btn2 ui-state-default ui-corner-all" href="<?=DEFAULT_URL?>/gerenciamento/account/view.php?id=<?=$listing->getNumber("account_id")?>" class="link-view">
										<span class="ui-icon ui-icon-person"></span>
										<?=ucwords(system_showText(LANG_SITEMGR_EDIT))?> <?=ucwords(system_showText(LANG_SITEMGR_LABEL_ACCOUNT))?> (<?=system_showAccountUserName($account->getString("username"))?>)</span>
										<? } ?>
									</a>
									
									<a href="<?=DEFAULT_URL?>/gerenciamento/estabelecimentos/maptuning.php?id=<?=$id?>&screen=<?=$screen?>&letra=<?=$letra?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="btn2 ui-state-default ui-corner-all">
										<span class="ui-icon ui-icon-wrench"></span>
										<?=ucwords(system_showText(LANG_SITEMGR_MAPTUNING))?>
									</a>
							
									<a href="<?=DEFAULT_URL?>/gerenciamento/estabelecimentos/report.php?id=<?=$id?>&screen=<?=$screen?>&letra=<?=$letra?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="btn2 ui-state-default ui-corner-all">
										<span class="ui-icon ui-icon-signal-diag"></span>
										<?=ucwords(system_showText(LANG_SITEMGR_VIEW))?> <?=ucwords(system_showText(LANG_SITEMGR_TRAFFICREPORTS))?>
									</a>
											
									<a href="<?=DEFAULT_URL?>/gerenciamento/review/index.php?item_type=listing&item_id=<?=$id?>&filter_id=1&item_screen=<?=$item_screen?>&item_letra=<?=$item_letra?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="btn2 ui-state-default ui-corner-all">
										<span class="ui-icon  ui-icon-star"></span>
										<?=ucwords(system_showText(LANG_SITEMGR_VIEW))?> <?=ucwords(system_showText(LANG_SITEMGR_REVIEWS))?>
									</a>
								</div>
								<div class="clearfix"></div>

		

				<!-- 				<br class="clear" />

				<div id="header-view"><?=system_showText(LANG_SITEMGR_LISTING_SING)?> <?=ucwords(system_showText(LANG_SITEMGR_PREVIEW))?></div>
				<center>
					<a href="javascript:void(0);" onclick="javascript:window.open('<?=DEFAULT_URL?>/gerenciamento/estabelecimentos/preview.php?id=<?=$listing->getNumber("id")?>', '', 'toolbar=0, location=0, directories=0, status=0, scrollbars=yes, width=800, height=400, screenX=0, screenY=0, menubar=0');" class="standardLINK"><?=system_showText(LANG_SITEMGR_CLICKHERETOPREVIEW)?> <?=system_showText(LANG_SITEMGR_LISTING_SING)?></a>
				</center> !-->

		<? } ?>
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