<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/langcenter/lang.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");
    
    # ----------------------------------------------------------------------------------------------------
    # VALIDATING FEATURES
    # ----------------------------------------------------------------------------------------------------
    if (MULTILANGUAGE_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	$url_redirect = "".DEFAULT_URL."/gerenciamento/langcenter";
	$url_base 	  = "".DEFAULT_URL."/gerenciamento";
	$sitemgr 	  = 1;

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));
	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/lang.php");

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
			if ($id) $prefix = ucwords(system_showText(LANG_SITEMGR_EDIT)); else $prefix = ucwords(system_showText(LANG_SITEMGR_ADD));
			?>
			<h1><?=$prefix?> <?=ucwords(system_showText(LANG_SITEMGR_LANGUAGE))?></h1>
		</div>
	</div>

	<div id="content-content">
		<div class="default-margin" style="padding-top:3px;">

			<? require(EDIRECTORY_ROOT."/gerenciamento/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>

			<? include(INCLUDES_DIR."/tables/table_langcenter_submenu.php"); ?>
            
            <?
            if ($messageError) {
                echo "<p class=\"errorMessage\">".$messageError."</p>";
            }
            ?>
						
			<div class="baseForm">

			<form name="lang" action="<?=$_SERVER["PHP_SELF"]?>" method="post" enctype="multipart/form-data">

				<!-- Microsoft IE Bug (When the form contain a field with a special char like &#8213; and the enctype is multipart/form-data and the last textfield is empty the first transmitted field is corrupted)-->
				<input type="hidden" name="ieBugFix" value="1" />
				<!-- Microsoft IE Bug -->

				<input type="hidden" name="sitemgr" id="sitemgr" value="<?=$sitemgr?>" />
				<input type="hidden" name="id" id="id" value="<?=$id?>" />
				<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
				<input type="hidden" name="letra" value="<?=$letra?>" />
				<input type="hidden" name="screen" value="<?=$screen?>" />

				<? include(INCLUDES_DIR."/forms/form_lang.php"); ?>

					<button type="submit" name="submit_button" class="ui-state-default ui-corner-all" value="Submit" onclick="JS_submit();"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>

					<button type="button" name="cancel" value="Cancel" class="ui-state-default ui-corner-all" onclick="document.getElementById('formlangcancel').submit();"><?=system_showText(LANG_SITEMGR_CANCEL)?></button>

						<!-- Microsoft IE Bug (When the form contain a field with a special char like &#8213; and the enctype is multipart/form-data and the last textfield is empty the first transmitted field is corrupted)-->
						<input type="hidden" name="ieBugFix2" value="1" /> 
						<!-- Microsoft IE Bug -->

			</form>
			
			<form id="formlangcancel" action="<?=DEFAULT_URL?>/gerenciamento/langcenter/index.php" method="get">

					<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
					<input type="hidden" name="letra" value="<?=$letra?>" />
					<input type="hidden" name="screen" value="<?=$screen?>" />

			</form>
			
			</div>

		</div>
	</div>

	<div id="bottom-content">&nbsp;</div>

</div>
<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>