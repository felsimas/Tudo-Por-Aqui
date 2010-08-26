<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /membros/article/seocenter.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (ARTICLE_FEATURE != "on") { exit; }

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

	$url_redirect = "".DEFAULT_URL."/membros/article";
	$url_base = "".DEFAULT_URL."/membros";
	$membros = 1;

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/article_seocenter.php");

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

					<h1 class="standardTitle"><?=ucwords(ARTICLE_FEATURE_NAME);?> SEO CENTER - <span><?=$article->getString("title");?></span></h1>

					<form name="articleseocenter" action="<?=$_SERVER["PHP_SELF"]?>" method="post">

						<input type="hidden" name="id" id="id" value="<?=$id?>" />
						<input type="hidden" name="letra" id="letra" value="<?=$letra?>" />
						<input type="hidden" name="screen" id="screen" value="<?=$screen?>" />
						<? include(INCLUDES_DIR."/forms/form_article_seocenter.php"); ?>
						
						<div class="baseButtons floatButtons">

							<p class="standardButton">
								<button type="submit" name="submit" value="Submit"><?=system_showText(LANG_BUTTON_SUBMIT)?></button>
							</p>
							
						</div>

					</form>

					<form action="<?=DEFAULT_URL?>/membros/article/index.php" method="post">

						<input type="hidden" name="letra" value="<?=$letra?>" />
						<input type="hidden" name="screen" value="<?=$screen?>" />
						
						<div class="baseButtons floatButtons noPaddingButtons">
						
							<p class="standardButton">
								<button type="submit" name="cancel" value="Cancel"><?=system_showText(LANG_BUTTON_CANCEL)?></button>
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
