<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /membros/event/eventlevel.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (EVENT_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSession();

	extract($_GET);
	extract($_POST);

	$url_redirect = "".DEFAULT_URL."/membros/event";
	$url_base = "".DEFAULT_URL."/membros";
	$membros = 1;

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	if ($id) {
		$event = new Event($id);
		if (sess_getAccountIdFromSession() != $event->getNumber("account_id")) {
			header("Location: ".DEFAULT_URL."/membros/event/index.php?screen=$screen&letra=$letra");
			exit;
		}
		$event->extract();
	}

	$levelObj = new EventLevel();
	if ($level) {
		$levelArray[$levelObj->getLevel($level)] = $level;
	} else {
		$levelArray[$levelObj->getLevel($levelObj->getDefaultLevel())] = $levelObj->getDefaultLevel();
	}

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		if (($id) && ($event)) {
			if ($_POST["level"] && ($_POST["level"] != $event->getNumber("level"))) {
				$status = new ItemStatus();
				$event->setString("status", $status->getDefaultStatus());
				$event->setDate("renewal_date", "00/00/0000");
			}
			$event->setString("level", $_POST['level']);
			$event->Save();
			header("Location: ".DEFAULT_URL."/membros/event/index.php?screen=$screen&letra=$letra");
			exit;
		} else {
			header("Location: ".DEFAULT_URL."/membros/event/event.php?level=".$_POST['level']);
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

				<h1 class="standardTitle"><?=system_highlightLastWord(system_showText(LANG_EVENT_LEVEL))?> <span><? if (($event) && ($event->getString("title"))) echo "- ".$event->getString("title"); ?></span></h1>

				<form name="eventlevel" action="<?=$_SERVER["PHP_SELF"]?>" method="post" enctype="multipart/form-data">
					<input type="hidden" name="id" value="<?=$id?>" />
					<input type="hidden" name="screen" value="<?=$screen?>" />
					<input type="hidden" name="letra" value="<?=$letra?>" />
					<? include(INCLUDES_DIR."/forms/form_eventlevel.php"); ?>
				</form>

				<form action="<?=DEFAULT_URL?>/membros/event/index.php" method="post">

					<input type="hidden" name="screen" value="<?=$screen?>" />
					<input type="hidden" name="letra" value="<?=$letra?>" />
					
					<div class="baseButtons">

						<p class="standardButton">
							<button type="button" onclick="document.eventlevel.submit();"><?=system_showText(LANG_BUTTON_SUBMIT)?></button>
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