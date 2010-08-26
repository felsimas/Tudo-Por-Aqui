<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/content/content_footer.php
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

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);
	
	$lang = $lang ? $lang : EDIR_DEFAULT_LANGUAGE;
	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	include(INCLUDES_DIR."/code/content_footer.php");

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/header_manager.php");


?>

<script type="text/javascript">
<!--
function changeComboLang (value) {
	if (value)
		window.location.href = "content_footer.php?lang="+value;
	return true;
}
-->
</script>

<div id="main-right">

	<div id="top-content">
		<div id="header-content">
			<h1><?=ucwords(system_showText(LANG_SITEMGR_CONTENT_MANAGEFOOTERCONTENT))?></h1>
		</div>
	</div>

	<div id="content-content">

		<div class="default-margin" style="padding-top: 3px;">

			<? require(EDIRECTORY_ROOT."/gerenciamento/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

			<? include(INCLUDES_DIR."/tables/table_content_submenu.php"); ?>

			<br />

			<? if ($message_footer) { ?>
				<div class="response-msg success ui-corner-all"><?=$message_footer?></div>
			<? } ?>
			
			<div class="baseForm">

			<form name="header" method="post" action="<?=$_SERVER["PHP_SELF"]?>">

				<? include(INCLUDES_DIR."/forms/form_content_footer.php"); ?>

				<button type="submit" name="submit_button" value="Submit" class="ui-state-default ui-corner-all"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
				<button type="button" value="Cancel" class="ui-state-default ui-corner-all" onclick="document.getElementById('formcontentfootercancel').submit();"><?=system_showText(LANG_SITEMGR_CANCEL)?></button>

				<input type="hidden" name="ieBugFix2" value="1" />

			</form>
			<form id="formcontentfootercancel" action="<?=DEFAULT_URL?>/gerenciamento/content/index.php" method="post">
			</form>
			
			</div>

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
