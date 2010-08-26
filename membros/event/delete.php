<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /membros/event/delete.php
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

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	if ($id) {
		$event = new Event($id);
		if (sess_getAccountIdFromSession() != $event->getNumber("account_id")) {
			header("Location: ".DEFAULT_URL."/membros/event/index.php?screen=$screen&letra=$letra");
			exit;
		}
	} else {
		header("Location: ".DEFAULT_URL."/membros/event/index.php?screen=$screen&letra=$letra");
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		$event = new Event($_POST['id']);
		$event->delete();
		header("Location: ".DEFAULT_URL."/membros/event/index.php?screen=$screen&letra=$letra");
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

				<h1 class="standardTitle"><?=system_highlightLastWord(system_showText(LANG_EVENT_DELETE))?></h1>

				<form title="event" method="post">
					<input type="hidden" name="id" value="<?=$id?>" />
					<input type="hidden" name="letra" value="<?=$letra?>" />
					<input type="hidden" name="screen" value="<?=$screen?>" />

						<p><?=system_showText(LANG_EVENT_DELETE_INFORMATION)?> - <strong><?=$event->getString("title")?></strong></p>

						<div class="response-msg inf ui-corner-all"><?=system_showText(LANG_EVENT_DELETE_CONFIRM)?></div>
						
						<div class="baseButtons floatButtons">

							<p class="standardButton">
								<button type="submit" value="Submit"><?=system_showText(LANG_BUTTON_SUBMIT)?></button>
							</p>
							
						</div>
							
					</form>
					<form action="<?=DEFAULT_URL?>/membros/event/" method="get">
						<input type="hidden" name="letra" value="<?=$letra?>" />
						<input type="hidden" name="screen" value="<?=$screen?>" />
						
						<div class="baseButtons floatButtons noPaddingButtons">

							<p class="standardButton">
								<button type="submit" value="Cancel"><?=system_showText(LANG_BUTTON_CANCEL)?></button>
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