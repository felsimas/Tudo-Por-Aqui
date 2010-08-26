<?


	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/estabelecimentos/promotion.php
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

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/listing_promotion.php");

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/header_manager.php");
	
	$level = new ListingLevel($listing->getNumber("level"));

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

			<? include(INCLUDES_DIR."/tables/table_listing_submenu.php"); ?>

				<table border="0" cellpadding="0" cellspacing="0" class="standard-table">
					<tr>
						<th class="standard-tabletitle"><?=system_showText(LANG_SITEMGR_ADDNEW)?> <?=system_showText(LANG_SITEMGR_PROMOTION_SING)?>:</th>
					</tr>
					<tr>
						<td style="background: none;">
							<input type="button" name="new_promotion" value="<?=system_showText(LANG_SITEMGR_ADDNEW)?> <?=system_showText(LANG_SITEMGR_PROMOTION)?>" class="ui-state-default ui-corner-all" onclick="javascript:document.location='<?=DEFAULT_URL?>/gerenciamento/promotion/promotion.php?listing_id=<?=$listing->getNumber("id")?><?=(($url_search_params) ? "&$url_search_params" : "");?>';" style="width: 200px; height: 29px; border: none; font-weight: bold; color: #FFF; font-size:12px;" />
						</td>
					</tr>
					<tr>
						<td class="standard-tablenote">
							<p><?=system_showText(LANG_SITEMGR_PROMOTION_TIP1)?><br /><br /><?=system_showText(LANG_SITEMGR_PROMOTION_TIP2)?></p>
							<ul>
								<li><?=system_showText(LANG_SITEMGR_PROMOTION_TIP3)?></li>
								<li><?=system_showText(LANG_SITEMGR_PROMOTION_TIP4)?></li>
							</ul>
						</td>
					</tr>
				</table>
	
				<p><?=system_showText(LANG_SITEMGR_PROMOTION_WILLAPPEARHERE)?></p>
				<br /><br />

				<a href="javascript:void(0);" onclick="javascript:window.open('<?=DEFAULT_URL?>/gerenciamento/estabelecimentos/preview.php?id=<?=$listing->getNumber("id")?>&listings_promotion_page=true', '', 'toolbar=0, location=0, directories=0, status=0, scrollbars=yes, width=800, height=400, screenX=0, screenY=0, menubar=0');" class="standardLINK"><?=system_showText(LANG_SITEMGR_CLICKHERETOPREVIEW)?> <?=system_showText(LANG_SITEMGR_LISTING_SING)?></a>

				<table border="0" cellpadding="0" cellspacing="0" class="standard-table" style="margin-bottom: 0;">
					<tr>
						<th class="standard-tabletitle"><?=system_showText(LANG_SITEMGR_PROMOTION_ASSOCIATE)?></th>
					</tr>
				</table>
				
			<div class="baseForm">

			<form name="promotion" action="<?=$_SERVER["PHP_SELF"]?>" method="post" enctype="multipart/form-data">
				<input type="hidden" name="id" value="<?=$id?>" />
				<input type="hidden" name="listing_id" value="<?=$listing_id?>">
				<input type="hidden" name="letra" value="<?=$letra?>" />
				<input type="hidden" name="screen" value="<?=$screen?>" />
				<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>

				<? include(INCLUDES_DIR."/forms/form_listingpromotion.php"); ?>

				<button type="submit" value="Submit" class="ui-state-default ui-corner-all"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>

				<button type="button" value="Cancel" class="ui-state-default ui-corner-all" onclick="document.getElementById('formlistingpromotioncancel').submit();"><?=system_showText(LANG_SITEMGR_CANCEL)?></button>

			</form>
			<form id="formlistingpromotioncancel" action="<?=DEFAULT_URL?>/gerenciamento/estabelecimentos/<?=(($search_page) ? "search.php" : "index.php");?>" method="post">
				<input type="hidden" name="letra" value="<?=$letra?>" />
				<input type="hidden" name="screen" value="<?=$screen?>" />
				<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
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
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>
