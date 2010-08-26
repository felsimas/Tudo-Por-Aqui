<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /membros/classified/classifiedlevel.php
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
	if ($id) {
		$classified = new Classified($id);
		if (sess_getAccountIdFromSession() != $classified->getNumber("account_id")) {
			header("Location: ".DEFAULT_URL."/membros/classified/index.php?screen=$screen&letra=$letra");
			exit;
		}
		$classified->extract();
	}

	$levelObj = new ClassifiedLevel();
	if ($level) {
		$levelArray[$levelObj->getLevel($level)] = $level;
	} else {
		$levelArray[$levelObj->getLevel($levelObj->getDefaultLevel())] = $levelObj->getDefaultLevel();
	}

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		if (($id) && ($classified)) {
			if ($_POST["level"] && ($_POST["level"] != $classified->getNumber("level"))) {
				$status = new ItemStatus();
				$classified->setString("status", $status->getDefaultStatus());
				$classified->setDate("renewal_date", "00/00/0000");
			}
			$classified->setString("level", $_POST['level']);
			$classified->Save();
			header("Location: ".DEFAULT_URL."/membros/classified/index.php?screen=$screen&letra=$letra");
			exit;
		} else {
			header("Location: ".DEFAULT_URL."/membros/classified/classified.php?level=".$_POST['level']);
			exit;
		}
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

		<h1 class="standardTitle"><?=system_highlightLastWord(system_showText(LANG_CLASSIFIED_LEVEL))?> <span><? if (($classified) && ($classified->getString("title"))) echo "- ".$classified->getString("title"); ?></span></h1>

		<form name="classifiedlevel" action="<?=$_SERVER["PHP_SELF"]?>" method="post" enctype="multipart/form-data">
			<input type="hidden" name="id" value="<?=$id?>" />
			<input type="hidden" name="screen" value="<?=$screen?>" />
			<input type="hidden" name="letra" value="<?=$letra?>" />
			<? include(INCLUDES_DIR."/forms/form_classifiedlevel.php"); ?>
		</form>

		<form action="<?=DEFAULT_URL?>/membros/classified/index.php" method="post">

			<input type="hidden" name="screen" value="<?=$screen?>" />
			<input type="hidden" name="letra" value="<?=$letra?>" />
			
			<div class="baseButtons">

				<p class="standardButton">
					<button type="button" onclick="document.classifiedlevel.submit();"><?=system_showText(LANG_BUTTON_SUBMIT)?></button>
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
