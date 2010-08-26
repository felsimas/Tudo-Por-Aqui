<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /membros/banner/view.php
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
	sess_validateSession();
	$acctId = sess_getAccountIdFromSession();

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);

	$url_base = "".DEFAULT_URL."/membros";
	$url_redirect = $url_base."/banner";
	$membros = 1;

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	
	
	if ($id) {
		$banner = new Banner($id);
		if (sess_getAccountIdFromSession() != $banner->getNumber("account_id")) {
			header("Location: ".DEFAULT_URL."/membros/banner/index.php?screen=$screen&letra=$letra");
			exit;
		}
	}
	else {
		header("Location: ".DEFAULT_URL."/membros/banner/index.php?screen=$screen&letra=$letra");
		exit;
	}

	$operation = "view";

	include(EDIRECTORY_ROOT."/includes/code/banner.php");

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/header_members.php");

?>

	<div id="page-wrapper">

		<div id="main-wrapper">
		<?php 	include(MEMBERS_EDIRECTORY_ROOT."/menu.php"); ?>
			<div id="main-content"> 

				
				<div class="page-title ui-widget-content ui-corner-all">
					<div class="other_content">
						<? require(EDIRECTORY_ROOT."/gerenciamento/registration.php"); ?>
						<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
						<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>
				
				<div id="header-form"><?=system_showText(LANG_MANAGE_BANNER);?> - <?=$banner->getString("caption")?></span></div>

					<? $bannerObj = new Banner($id); ?>
					<div style="float: left; width: 313px;">
					
					<a class="btn2 ui-state-default ui-corner-all" href="<?=DEFAULT_URL?>/membros/banner/editar/<?=$bannerObj->getNumber("id")?>">
						<?=system_showText(LANG_BANNER_EDIT_INFORMATION);?>
						<span class="ui-icon ui-icon-pencil"/></span>
					</a>

					<a class="btn2 ui-state-default ui-corner-all" href="<?=DEFAULT_URL?>/membros/banner/apagar/<?=$bannerObj->getNumber("id")?>" class="link-view">
						<?=system_showText(LANG_BANNER_DELETE);?>
						<span class="ui-icon ui-icon-circle-close"></span>
					</a>
					
					</div>
					<div style="float: left; width: 313px;">
						<a class="btn2 ui-state-default ui-corner-all" href="javascript:void(0);" onclick="javascript:window.open('<?=DEFAULT_URL?>/membros/banner/preview.php?id=<?=$bannerObj->getNumber("id")?>&lang=<?=$array_edir_languages[$i]?>', '', 'toolbar=0, location=0, directories=0, status=0, scrollbars=yes, width=800, height=400, screenX=0, screenY=0, menubar=0');">
							<?=system_showText(LANG_MSG_CLICK_TO_PREVIEW_THIS_BANNER);?><?=((count(explode(",", EDIR_LANGUAGES))>1)?(" (".$array_edir_languagenames[$i].")"):(""));?>
							<span class="ui-icon ui-icon-search"></span>
						</a>
						
					</div>
					<div class="clearfix"></div>

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
					include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");
				?>


