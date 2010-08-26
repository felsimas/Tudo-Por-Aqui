<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/emailnotifications/email.php
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

	if (!isset($_POST["nav_page"])) $_POST["nav_page"] = 0;

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	if ($_REQUEST['id']) {
		$_GET = format_magicQuotes($_GET);
		extract($_GET);
		$_POST = format_magicQuotes($_POST);
		extract($_POST);
		$lang = !$_REQUEST['lang'] ? EDIR_DEFAULT_LANGUAGE : $_REQUEST['lang'];
		include(INCLUDES_DIR."/code/email_notification.php");
	} else {
		header("Location: ./");
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/header_manager.php");


	if ($_SERVER['REQUEST_METHOD'] != 'POST') {
		$_GET = format_magicQuotes($_GET);
		extract($_GET);
		$_POST = format_magicQuotes($_POST);
		extract($_POST);
	}

	$nav_page++;
	if ($nav_page > 2) $nav_page = 1;

?>

<script language="javascript">

	function showWarning() {
		if(document.emailnotifications.deactivate.checked) {
			document.getElementById("box-warning").style.display = 'block'
		} else {
			document.getElementById("box-warning").style.display = 'none'
		}
	}

	function changeComboLang (value) {
		if (value)
			window.location.href = "email.php?id=<?=$id?>&lang="+value;
		return true;
	}

</script>

<div id="page-wrapper">

	<div id="main-wrapper">
	
	<?php 	include(SM_EDIRECTORY_ROOT."/menu.php"); ?>
	
		<div id="main-content"> 

			<div class="page-title ui-widget-content ui-corner-all">

				<div class="other_content">

		<? require(EDIRECTORY_ROOT."/gerenciamento/registration.php"); ?>
		<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
		<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

		<form name="emailnotifications" action="<?=$_SERVER["PHP_SELF"]?>" method="post" style="margin:0px; padding: 0px;">
			<input name="id" type="hidden" value="<?=$_REQUEST['id']?>" />
			<input name="email" type="hidden" value="<?=$emailNotificationObj->getString("email")?>" />
			<input name="nav_page" id="nav_page" type="hidden" value="<?=$nav_page?>" />

			<div class="default-margin">
				<div id="header-export"><?=system_showText(LANG_SITEMGR_EMAILNOTIFICATION_TITLEMANAGE)?></div>
				<? if($nav_page==1) { ?>
					<ul class="list-view">
						<li><a href="<?=DEFAULT_URL?>/gerenciamento/emailnotifications"><?=system_showText(LANG_SITEMGR_BACK)?></a></li>
					</ul>
				<? } ?>
				<div class="response-msg inf ui-corner-all">
					<?=$emailNotificationObjAux->getString("about")?>
				</div>
			</div>

			<table class="table-form">
				<tr>
					<td>
						<table width="500" class="table-form" border="0" cellpadding="2" cellspacing="2">
							<tr>
								<td>
								<?
								if ($nav_page==1) {
									include(INCLUDES_DIR."/forms/form_emailnotification.php");
								} else if($nav_page==2) { 
									include(INCLUDES_DIR."/forms/form_emailnotification2.php");
								}
								?>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>

			<table style="margin: 0 auto 0 auto;" cellspacing="4">
				<tr>
					<td>
						<? if ($nav_page==1) { ?>
							<input type="submit" name="next" value="<?=system_showText(LANG_SITEMGR_NEXT)?>" class="ui-state-default ui-corner-all" />
						<? } elseif($nav_page==2) { ?>
							<input type="button" name="back" value="<?=system_showText(LANG_SITEMGR_BACK)?>" class="ui-state-default ui-corner-all" onclick="JS_Back();" />
					</td>
					<td>
							<input type="submit" name="save" value="<?=system_showText(LANG_SITEMGR_SAVE)?>" class="ui-state-default ui-corner-all" />
						<? } ?>
					</td>
				</tr>
			</table>

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
