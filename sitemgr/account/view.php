<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/account/view.php
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

	$url_redirect = "".DEFAULT_URL."/gerenciamento/account";
	$url_base = "".DEFAULT_URL."/gerenciamento";

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	if ($id) {
		$account = new Account($id);
		$contact = db_getFromDB("contact", "account_id", db_formatNumber($id));
	} else {
		header("Location: ".DEFAULT_URL."/gerenciamento/account/".(($search_page) ? "search.php" : "index.php")."?screen=$screen&letra=$letra".(($url_search_params) ? "&$url_search_params" : "")."");
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

		<p class="errorMessage"><?=system_showText(LANG_SITEMGR_ACCOUNT_MIGHTBEDELETED)?></p>

	<? } else { ?>

		<? include(INCLUDES_DIR."/tables/table_account_submenu.php"); ?>

		<script language="javascript" type="text/javascript">
			function accountLogin() {
				membrosection = window.open("<?=((SSL_ENABLED == "on" && FORCE_MEMBERS_SSL == "on") ? SECURE_URL : DEFAULT_URL)?>/membros/gerenciamentoaccess.php?account=<?=$account->getString("username")?>", "member_section");
				membrosection.focus();
			}
		</script>

		<div id="header-view"><?=system_showText(LANG_SITEMGR_MANAGE)?> <?=ucwords(system_showText(LANG_SITEMGR_ACCOUNT))?></div>

		<div>
			<div style="float:left; width:313px">

					<a class="btn2 ui-state-default ui-corner-all" href="<?=DEFAULT_URL?>/gerenciamento/account/account.php?id=<?=$account->getNumber("id")?>&screen=<?=$screen?>&letra=<?=$letra?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-view">
						<span class="ui-icon ui-icon ui-icon-pencil"></span>
						<?=system_showText(LANG_SITEMGR_EDIT)?> <?=system_showText(LANG_SITEMGR_ACCOUNT_TITLEACCOUNTCONTACT)?>
					</a>
		
					<a class="btn2 ui-state-default ui-corner-all"  href="<?=DEFAULT_URL?>/gerenciamento/account/delete.php?id=<?=$account->getNumber("id")?>" class="link-view">
						<span class="ui-icon ui-icon-closethick"></span>
					
						<?=system_showText(LANG_SITEMGR_DELETE)?> <?=ucwords(system_showText(LANG_SITEMGR_ACCOUNT))?>
					</a>
			</div>
			<div style="float:left; width:313px">
			
					<a class="btn2 ui-state-default ui-corner-all"  href="javascript:accountLogin();" class="link-view"><?=system_showText(LANG_SITEMGR_LOGIN)?>
						
						<span class="ui-icon ui-icon-person"></span>
						 <?=system_showText(LANG_SITEMGR_INTOTHISACCOUNT)?>
						</a>
		
					<a class="btn2 ui-state-default ui-corner-all"  href="<?=DEFAULT_URL?>/gerenciamento/account/esqueceu-a-senha?id=<?=$id?>" class="link-view">
						<span class="ui-icon ui-icon-mail-closed"></span>
						
						<?=system_showText(LANG_SITEMGR_ACCOUNT_FORGOTEMAILLINK)?>
					</a>
			</div>
			<div class="clearfix"></div><br/>
		</div>

		<div id="header-view">
			<?=ucwords(system_showText(LANG_SITEMGR_ACCOUNT))?>
		</div>

		<br class="clear" />
		<div style="text-align:left; padding-left:20px">
			<? include(INCLUDES_DIR."/views/view_account.php"); ?>
		</div>

		<div id="header-view">
			<?=system_showText(LANG_SITEMGR_CONTACT)?>
		</div>

		<div style="text-align:left; padding-left:20px">
			<? include(INCLUDES_DIR."/views/view_contact.php"); ?>
		</div>

		<div id="header-view">
			<?=ucfirst(system_showText(LANG_SITEMGR_ITEMS))?>
		</div>

		<? include(INCLUDES_DIR."/tables/table_account_items.php"); ?>

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
