<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /membros/classified/classified.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (CLASSIFIED_FEATURE != "on") { exit; }

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

	$url_redirect = "".DEFAULT_URL."/membros/classified";
	$url_base = "".DEFAULT_URL."/membros";
	$membros = 1;

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/classified.php");

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/header.php");

	# ----------------------------------------------------------------------------------------------------
	# NAVBAR
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/navbar.php");

?>

	<div class="mainContentExtended">

		<? require(EDIRECTORY_ROOT."/gerenciamento/registration.php"); ?>
		<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
		<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

		<? if ($process == "signup") { ?>
		<ul class="standardStep">
			<li class="standardStepAD"><?=system_highlightLastWord(system_showText(LANG_ENJOY_OUR_SERVICES))?></li>
			<li><span>1</span>&nbsp;<?=system_showText(LANG_LABEL_ORDER)?></li>
			<li><span>2</span>&nbsp;<?=system_showText(LANG_LABEL_CHECKOUT)?></li>
			<li class="stepActived"><span>3</span>&nbsp;<?=system_showText(LANG_LABEL_CONFIGURATION);?></li>
		</ul>
		<? } ?>

		<h1 class="standardTitle"><?=system_highlightLastWord(system_showText(LANG_CLASSIFIED_INFORMATION));?></h1>

		<form name="classified" action="<?=$_SERVER["PHP_SELF"]?>" method="post" enctype="multipart/form-data">

			<? /* Microsoft IE Bug (When the form contain a field with a special char like &#8213; and the enctype is multipart/form-data and the last textfield is empty the first transmitted field is corrupted) */ ?>

			<input type="hidden" name="ieBugFix" value="1" />

			<? /* Microsoft IE Bug  */ ?>

			<input type="hidden" name="process" id="process" value="<?=$process?>" />
			<input type="hidden" name="id" id="id" value="<?=$id?>" />
			<input type="hidden" name="account_id" id="account_id" value="<?=$acctId?>" />
			<input type="hidden" name="level" id="level" value="<?=$level?>" />
			<input type="hidden" name="screen" id="screen" value="<?=$screen?>" />
			<input type="hidden" name="letra" id="letra" value="<?=$letra?>" />

			<? include(INCLUDES_DIR."/forms/form_classified.php"); ?>

			<? /* Microsoft IE Bug (When the form contain a field with a special char like &#8213; and the enctype is multipart/form-data and the last textfield is empty the first transmitted field is corrupted)  */ ?>

			<input type="hidden" name="ieBugFix2" value="1" /> 

			<? /* Microsoft IE Bug */ ?>

		</form>

		<br />

		<form action="<?=DEFAULT_URL?>/membros/classified/index.php" method="post">

			<input type="hidden" name="screen" value="<?=$screen?>">
			<input type="hidden" name="letra" value="<?=$letra?>">
			
			<div class="baseButtons">

				<p class="standardButton">
					<button type="button" onclick="JS_submit()"><?=system_showText(LANG_BUTTON_SUBMIT)?></button>
				</p>
				<p class="standardButton">
					<button type="submit"><?=system_showText(LANG_BUTTON_CANCEL)?></button>
				</p>
				
			</div>

		</form>

	</div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");
?>
