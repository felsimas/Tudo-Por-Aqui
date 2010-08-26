<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /membros/client/delete_image.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSession();
	$acctId = sess_getAccountIdFromSession();

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_GET);
	extract($_POST);

	$url_redirect = "".DEFAULT_URL."/membros/client";
	$url_base = "".DEFAULT_URL."/membros";
	$membros = 1;

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	$errorPage = "".DEFAULT_URL."/membros/client/index.php?screen=$screen&letra=$letra";
	if (!$client_image_id || !$id) {
		header("Location: ".$errorPage);
		exit;
	}
	$client = new Client($id);
	if ((!$client->getNumber("id")) || ($client->getNumber("id") <= 0)) {
		header("Location: ".$errorPage);
		exit;
	}
	if (sess_getAccountIdFromSession() != $client->getNumber("account_id")) {
		header("Location: ".$errorPage);
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		$client = new Client($id);
		$client->DeleteImage($client_image_id);
	}

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

				<div id="header-form">Remover cliente</span></div>


				<div class="response-msg success ui-corner-all"><?=system_showText(LANG_CLIENT_SUCCESSFULLY_DELETED)?></div>

				<form name="back" action="<?=DEFAULT_URL?>/membros/clientes/imagens/" method="post">
					<input type="hidden" name="id" id="id" value="<?=$id?>" />
					<input type="hidden" name="screen" value="<?=$screen?>" />
					<input type="hidden" name="letra" value="<?=$letra?>" />

						<button class="ui-state-default ui-corner-all" type="submit"><?=system_showText(LANG_BUTTON_BACK)?></button>

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
	include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");
?>
