<?
	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/promotion/promotion.php
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

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	extract($_GET);
	extract($_POST);

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	include(EDIRECTORY_ROOT."/includes/code/promotion.php");

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
				<?=ucwords(system_showText(LANG_SITEMGR_EDIT))?> <?=system_showText(LANG_SITEMGR_PROMOTION_SING)?> - <?=$promotion->getString("name")?>
			</div>
			<div class="baseForm">

			<form name="promotion" action="<?=$_SERVER["PHP_SELF"]?>" method="post" enctype="multipart/form-data">
				<input type="hidden" name="sitemgr" id="sitemgr" value="<?=$sitemgr?>" />
				<input type="hidden" name="id" value="<?=$id?>" />
				<input type="hidden" name="listing_id" value="<?=$listing_id?>" />
				<? include(INCLUDES_DIR."/forms/form_promotion.php"); ?>
							<input type="hidden" name="letra" value="<?=$letra?>" />
							<input type="hidden" name="screen" value="<?=$screen?>" />
							<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
							<button type="submit" value="Submit" class="ui-state-default ui-corner-all"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
							<button type="button" value="Cancel" class="ui-state-default ui-corner-all" onclick="document.getElementById('formpromotioncancel').submit();"><?=system_showText(LANG_SITEMGR_CANCEL)?></button>
			</form>
			<form id="formpromotioncancel" action="<?=DEFAULT_URL?>/gerenciamento/promotion/<?=(($search_page) ? "search.php" : "index.php");?>" method="post">
							<input type="hidden" name="letra" value="<?=$letra?>" />
							<input type="hidden" name="screen" value="<?=$screen?>" />
							<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
			</form>
			
			</div>

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
