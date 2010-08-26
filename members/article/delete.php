<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /membros/article/delete.php
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
	if ($id) {
		$article = new Article($id);
		if (sess_getAccountIdFromSession() != $article->getNumber("account_id")) {
			header("Location: ".DEFAULT_URL."/membros/article/index.php?screen=$screen&letra=$letra");
			exit;
		}
	} else {
		header("Location: ".DEFAULT_URL."/membros/article/index.php?screen=$screen&letra=$letra");
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		$article = new Article($_POST['id']);
		$article->delete();
		header("Location: ".DEFAULT_URL."/membros/article/");
		exit;
	}

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

				<h1 class="standardTitle"><?=system_highlightLastWord(system_showText(LANG_ARTICLE_DELETE));?></h1>

				<p><?=system_showText(LANG_ARTICLE_DELETE_INFORMATION)?> - <strong><?=$article->getString("title")?></strong></p>

				<div class="response-msg inf ui-corner-all"><?=system_showText(LANG_ARTICLE_DELETE_CONFIRM)?></div>
				
				<div class="baseButtons">

				<form title="article" method="post">

					<input type="hidden" name="id" value="<?=$id?>" />
					<input type="hidden" name="letra" value="<?=$letra?>" />
					<input type="hidden" name="screen" value="<?=$screen?>" />

						<p class="standardButton">
							<button type="submit" value="Submit"><?=system_showText(LANG_BUTTON_SUBMIT)?></button>
						</p>

				</form>
				<form action="<?=DEFAULT_URL?>/membros/article/index.php" method="post">
					<input type="hidden" name="letra" value="<?=$letra?>" />
					<input type="hidden" name="screen" value="<?=$screen?>" />
					
						<p class="standardButton">
							<button type="submit" value="Cancel"><?=system_showText(LANG_BUTTON_CANCEL)?></button>
						</p>

				</form>
				
				</div>

			</div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");
?>
