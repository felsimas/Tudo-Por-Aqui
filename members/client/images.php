<?

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
	if ($id) {
		$client = new Client($id);
		if ((!$client->getNumber("id")) || ($client->getNumber("id") <= 0)) {
			header("Location: ".$errorPage);
			exit;
		}
		if (sess_getAccountIdFromSession() != $client->getNumber("account_id")) {
			header("Location: ".$errorPage);
			exit;
		}
	} else {
		header("Location: ".$errorPage);
		exit;
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

				<div id="header-form"><a href="<?=DEFAULT_URL?>/membros/client/view.php?id=<?=$client->getNumber("id")?>">Clientes - <? 
				
		$listing = new Listing($empresaid);
		$empresa = $listing->getString("title");

				echo $empresa ?></div>

			
				<div class="clearfix"></div>

				<a class="btn ui-state-default ui-corner-all" href="<?=DEFAULT_URL?>/membros/client/image.php?id=<?=$id?>&screen=<?=$screen?>&empresaid=<?=$empresaid?>&letra=<?=$letra?>"><?=system_showText("Adicionar Cliente")?><span class="ui-icon ui-icon-circle-plus"/></span></a>
				<div class="clearfix"></div>
				

				<? include(INCLUDES_DIR."/views/view_client.php"); ?>



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

