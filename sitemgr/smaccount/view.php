<?
	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/smaccount/view.php
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

	extract($_GET);
	extract($_POST);

	$url_redirect = "".DEFAULT_URL."/gerenciamento/smaccount";
	$url_base = "".DEFAULT_URL."/gerenciamento";

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	if ($id) {
		$account = new SMAccount($id);
	} else {
		header("Location: ".DEFAULT_URL."/gerenciamento/smaccount/".(($search_page) ? "search.php" : "index.php")."?screen=$screen&letra=$letra".(($url_search_params) ? "&$url_search_params" : "")."");
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

	<? if($account->getString("id") == 0){ ?>

		<p class="errorMessage"><?=system_showText(LANG_SITEMGR_SMACCOUNT_ITMIGHTBEDELETED)?></p>

	<? } else { ?>

		<? include(INCLUDES_DIR."/tables/table_smaccount_submenu.php"); ?>


		<div id="header-view"><?=system_showText(LANG_SITEMGR_SMACCOUNT_MANAGEACCOUNTINFORMATION)?></div>

		<div>
			<div style="float:left; width:313px">
	
	
					<a class="btn2 ui-state-default ui-corner-all" href="<?=DEFAULT_URL?>/gerenciamento/smaccount/smaccount.php?id=<?=$account->getNumber("id")?>&screen=<?=$screen?>&letra=<?=$letra?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-view">
						<span class="ui-icon ui-icon ui-icon-pencil"></span>
					
						<?=system_showText(LANG_SITEMGR_SMACCOUNT_EDITACCOUNTINFORMATION)?>
						
					</a>
				</div>
				<? if ($account->getNumber("id") != $_SESSION[SESS_SM_ID]) { ?>
			<div style="float:left; width:313px">
			
					<a class="btn2 ui-state-default ui-corner-all" href="<?=DEFAULT_URL?>/gerenciamento/smaccount/delete.php?id=<?=$account->getNumber("id")?>" class="link-view">
						<span class="ui-icon ui-icon-closethick"></span>					
						<?=system_showText(LANG_SITEMGR_DELETE)?> <?=system_showText(LANG_SITEMGR_SITEMGR)?> <?=system_showText(LANG_SITEMGR_LABEL_ACCOUNT)?>
					</a>
					
				<? } ?>
			</div>
			<div class="clearfix"></div>
		</div>
		<br/>
		<? include(INCLUDES_DIR."/views/view_smaccount.php"); ?>

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
