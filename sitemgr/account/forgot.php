<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/account/esqueceu-a-senha
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
	if ($id = $_GET['id']) {
		$account = new Account($id);
	} else {
		header("Location: ".DEFAULT_URL."/gerenciamento/account/");
		exit;
	}

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		$section = "membros";
		include(INCLUDES_DIR."/code/forgot_password.php");
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

	<? if ($_SERVER['REQUEST_METHOD'] != "POST") { ?>
	<div class="baseForm">
		<form name="account" method="post">
			<input type="hidden" name="username" value="<?=$account->getString("username")?>" />
			<div id="header-form">
				<?=system_showText(LANG_SITEMGR_ACCOUNT_FORGOTTENPASSWORDACCOUNT)?> - <?=$account->getString("username")?>
			</div>
			<div class="response-msg inf ui-corner-all">
				<?=system_showText(LANG_SITEMGR_ACCOUNT_FORGOTEMAILQUESTION)?>
			</div>
			
			<button type="submit" value="Yes" class="ui-state-default ui-corner-all"><?=system_showText(LANG_SITEMGR_YES)?></button>
		</form>
		<form action="<?=DEFAULT_URL?>/gerenciamento/account/" method="get">
			<button type="submit" value="Cancel" class="ui-state-default ui-corner-all"><?=system_showText(LANG_SITEMGR_CANCEL)?></button>
		</form>
		
		</div>
	<? } else { ?>
		<? if ($message) { ?>
			<div id="warning" class="<?=$message_class;?>">
				&nbsp;<?=$message?>&nbsp;
			</div>
		<? } ?>
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
