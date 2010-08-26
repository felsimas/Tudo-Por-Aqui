<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /membros/classified/settings.php
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
		} else {
			if ($classified->getString("status") == "S") {
				$classified->setString("status", "A");
			} elseif ($classified->getString("status") == "A") {
				$classified->setString("status", "S");
			}
			$classified->save();
			header("Location: ".DEFAULT_URL."/membros/classified/index.php?screen=$screen&letra=$letra");
			exit;
		}
	}

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	header("Location: ".DEFAULT_URL."/membros/classified/index.php?screen=$screen&letra=$letra");
	exit;

?>
