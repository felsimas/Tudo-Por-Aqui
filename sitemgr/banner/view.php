<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/banner/view.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (BANNER_FEATURE != "on") { exit; }

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

	$url_redirect = "".DEFAULT_URL."/gerenciamento/banner";
	$url_base = "".DEFAULT_URL."/gerenciamento";
	$sitemgr = 1;

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	if ($id) {
		$banner = new Banner($id);
		if ((!$banner->getNumber("id")) || ($banner->getNumber("id") <= 0)) {
			header("Location: ".DEFAULT_URL."/gerenciamento/banner/index.php?message=".urlencode($message)."&screen=$screen&letra=$letra".(($url_search_params) ? "&$url_search_params" : "")."");
			exit;
		}
	} else {
		header("Location: ".DEFAULT_URL."/gerenciamento/banner/index.php?message=".urlencode($message)."&screen=$screen&letra=$letra".(($url_search_params) ? "&$url_search_params" : "")."");
		exit;
	}

	$operation = "view";
	
	include(EDIRECTORY_ROOT."/includes/code/banner.php");

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

			<? include(INCLUDES_DIR."/tables/table_banner_submenu.php"); ?>

			<?
			$banner = new Banner($id);
			if ($banner->getNumber("account_id")) $account = new Account($banner->getNumber("account_id"));
			?>

	

			<div id="header-view"><?=system_showText(LANG_SITEMGR_MANAGE)?> <?=system_showText(LANG_SITEMGR_BANNER_SING)?> - <?=$banner->getString("caption")?></div>
			
			<div style="float:left; width:313px">


					<a  class="btn2 ui-state-default ui-corner-all"  href="<?=DEFAULT_URL?>/gerenciamento/banner/edit.php?id=<?=$banner->getNumber("id")?>&screen=<?=$screen?>&letra=<?=$letra?><?=(($url_search_params) ? "&$url_search_params" : "")?>">
						<span class="ui-icon ui-icon ui-icon-pencil"></span>
					
						<?=system_showText(LANG_SITEMGR_EDIT)?> <?=system_showText(LANG_SITEMGR_BANNER_SING)?>
					</a>
			
			
					<a  class="btn2 ui-state-default ui-corner-all"  href="<?=DEFAULT_URL?>/gerenciamento/banner/delete.php?id=<?=$banner->getNumber("id")?>">
						<span class="ui-icon ui-icon-closethick"></span>
						<?=system_showText(LANG_SITEMGR_DELETE)?> <?=system_showText(LANG_SITEMGR_BANNER_SING)?>
					</a>
					
					
					<a class="btn2 ui-state-default ui-corner-all"  href="javascript:void(0);" onclick="javascript:window.open('<?=DEFAULT_URL?>/gerenciamento/banner/preview.php?id=<?=$banner->getNumber("id")?>&lang=<?=$array_edir_languages[$i]?>', '', 'toolbar=0, location=0, directories=0, status=0, scrollbars=yes, width=800, height=400, screenX=0, screenY=0, menubar=0');">
						<span class="ui-icon ui-icon-search"></span>
						
						<?=system_showText(LANG_SITEMGR_CLICKHERETOPREVIEW)?> <?=system_showText(LANG_SITEMGR_BANNER)?><?=((count(explode(",", EDIR_LANGUAGES))>1)?(" (".$array_edir_languagenames[$i].")"):(""));?>
						
					</a>
					
					
					
			</div>
			<div style="float:left; width:313px">
			
					<a  class="btn2 ui-state-default ui-corner-all"  href="<?=DEFAULT_URL?>/gerenciamento/banner/settings.php?id=<?=$banner->getNumber("id")?>&screen=<?=$screen?>&letra=<?=$letra?><?=(($url_search_params) ? "&$url_search_params" : "")?>">
						<span class="ui-icon ui-icon-wrench"></span>
						<?=system_showText(LANG_SITEMGR_MENU_SETTINGS)?>
					</a>
					<? if (!$account) { ?>
						<a  class="btn2 ui-state-default ui-corner-all" href="#">
						<span class="ui-icon ui-icon-person"></span>
						<?=system_showText(LANG_SITEMGR_NOOWNER)?>
						</a>
					<? } else { ?>
						<a  class="btn2 ui-state-default ui-corner-all"  href="<?=DEFAULT_URL?>/gerenciamento/account/view.php?id=<?=$banner->getNumber("account_id")?>">
							<? 
							echo "<span class=\"ui-icon ui-icon-person\"></span>Conta: ";
							echo system_showAccountUserName($account->getString("username"));
							?>
						</a>
					<? } ?>

				</div>
				<div class="clearfix"></div>


			<?
			$array_edir_languagenames = explode(",", EDIR_LANGUAGENAMES);
			$array_edir_languages = explode(",", EDIR_LANGUAGES);
			for ($i=0; $i<count($array_edir_languages); $i++) {
				$labelsuffix = "";
				if ($i) $labelsuffix = $i;
				?>
				<center>
				</center>
				<?
			}
			?>
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
