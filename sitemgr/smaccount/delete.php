<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/smaccount/delete.php
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
	extract($_GET);
	extract($_POST);

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	if ($id) {
		$smaccount = new SMAccount($id);
	} else {
		header("Location: ".DEFAULT_URL."/gerenciamento/smaccount/");
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		$smaccount = new SMAccount($_POST['id']);
		$smaccount->delete();
		$message = system_showText(LANG_SITEMGR_SMACCOUNT_SITEMGRACCOUNTDELETED);
		header("Location: ".DEFAULT_URL."/gerenciamento/smaccount/".(($search_page) ? "search.php" : "index.php")."?message=".urlencode($message)."&screen=$screen&letra=$letra".(($url_search_params) ? "&$url_search_params" : "")."");
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

			<? if ($message_delete) { ?>
			<div class="response-msg error ui-corner-all">&nbsp;<?=$message_delete?>&nbsp;</div>
			<? } ?>
			
			<div class="baseForm">

			<form name="smaccount" method="post">

				<input type="hidden" name="id" value="<?=$id?>" />
				<div id="header-form">
					<?=system_showText(LANG_SITEMGR_SMACCOUNT_DELETESITEMGRACCOUNT)?> - <?=$smaccount->getString("username")?>
				</div>
				<div class="response-msg inf ui-corner-all">
					<?=system_showText(LANG_SITEMGR_SMACCOUNT_DELETEQUESTION)?>
				</div>
				<? if ($smaccount->getNumber("id") != $_SESSION[SESS_SM_ID]) { ?>
					<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
					<input type="hidden" name="letra" value="<?=$letra?>" />
					<input type="hidden" name="screen" value="<?=$screen?>" />
					<button type="submit" value="Submit" class="ui-state-default ui-corner-all"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
				<? } ?>

				<button type="button" value="Cancel" class="ui-state-default ui-corner-all" onclick="document.getElementById('formsmaccountdeletecancel').submit();"><?=system_showText(LANG_SITEMGR_CANCEL)?></button>

			</form>
			<form id="formsmaccountdeletecancel" action="<?=DEFAULT_URL?>/gerenciamento/smaccount/<?=(($search_page) ? "search.php" : "index.php");?>" method="post">

				<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
				<input type="hidden" name="letra" value="<?=$letra?>" />
				<input type="hidden" name="screen" value="<?=$screen?>" />

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