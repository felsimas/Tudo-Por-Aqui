<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/article/article.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (ARTICLE_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	$url_redirect = "".DEFAULT_URL."/gerenciamento/article";
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
	include(EDIRECTORY_ROOT."/includes/code/article.php");

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/header.php");

	# ----------------------------------------------------------------------------------------------------
	# NAVBAR
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/navbar.php");

?>

<div id="main-right">

	<div id="top-content">
		<div id="header-content">
			<?
			if($id) 
				$prefix = system_showText(LANG_SITEMGR_EDIT);
			else 
				$prefix = system_showText(LANG_SITEMGR_ADD);
			?>
			<h1><?=$prefix?> <?=system_showText(LANG_SITEMGR_ARTICLE_SING)?></h1>
		</div>
	</div>

	<div id="content-content">
		<div class="default-margin" style="padding-top:3px;">

			<? require(EDIRECTORY_ROOT."/gerenciamento/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

			<? include(INCLUDES_DIR."/tables/table_article_submenu.php"); ?>
			
			<div class="baseForm">

			<form name="article" action="<?=$_SERVER["PHP_SELF"]?>" method="post" enctype="multipart/form-data">

				<!-- Microsoft IE Bug (When the form contain a field with a special char like &#8213; and the enctype is multipart/form-data and the last textfield is empty the first transmitted field is corrupted)-->
				<input type="hidden" name="ieBugFix" value="1" /> 
				<!-- Microsoft IE Bug -->

				<input type="hidden" name="sitemgr" id="sitemgr" value="<?=$sitemgr?>" />
				<input type="hidden" name="id" id="id" value="<?=$id?>" />
				<input type="hidden" name="level" value="<?=$level?>" />
				<input type="hidden" name="letra" value="<?=$letra?>" />
				<input type="hidden" name="screen" value="<?=$screen?>" />
				<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
				
				<? include(INCLUDES_DIR."/forms/form_article.php"); ?>

				<button type="button" name="submit_button" class="ui-state-default ui-corner-all" onclick="JS_submit();"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>

				<button type="button" value="Cancel" class="ui-state-default ui-corner-all" onclick="document.getElementById('formarticlecancel').submit();"><?=system_showText(LANG_SITEMGR_CANCEL)?></button>

				<!-- Microsoft IE Bug (When the form contain a field with a special char like &#8213; and the enctype is multipart/form-data and the last textfield is empty the first transmitted field is corrupted)-->
				<input type="hidden" name="ieBugFix2" value="1" /> 
				<!-- Microsoft IE Bug -->

			</form>
			<form id="formarticlecancel" action="<?=DEFAULT_URL?>/gerenciamento/article/<?=(($search_page) ? "search.php" : "index.php");?>" method="get">

				<input type="hidden" name="level" value="<?=$level?>" />
				<input type="hidden" name="letra" value="<?=$letra?>" />
				<input type="hidden" name="screen" value="<?=$screen?>" />
				<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>

			</form>
			
			</div>

		</div>
	</div>

	<div id="bottom-content">&nbsp;</div>

</div>

<script language="javascript">
	<!--

	<? if (DEFAULT_DATE_FORMAT == "m/d/Y") { ?>
		var cal_start = new calendarmdy(document.forms['article'].elements['publication_date']);
	<? } elseif (DEFAULT_DATE_FORMAT == "d/m/Y") { ?>
		var cal_start = new calendardmy(document.forms['article'].elements['publication_date']);
	<? } ?>
	cal_start.year_scroll = true;
	cal_start.time_comp = false;

	<? if (DEFAULT_DATE_FORMAT == "m/d/Y") { ?>
		var cal_end = new calendarmdy(document.forms['article'].elements['publication_date']);
	<? } elseif (DEFAULT_DATE_FORMAT == "d/m/Y") { ?>
		var cal_end = new calendardmy(document.forms['article'].elements['publication_date']);
	<? } ?>
	cal_end.year_scroll = true;
	cal_end.time_comp = false;

	//-->
</script>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>
