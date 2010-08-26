<?
	# ----------------------------------------------------------------------------------------------------
	# * FILE: /membros/listing/settings.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

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
		$listing = new Listing($id);
		if (sess_getAccountIdFromSession() != $listing->getNumber("account_id")) {
			header("Location: ".DEFAULT_URL."/membros/listing/index.php?screen=$screen&letra=$letra");
			exit;
		} else {
			if ($listing->getString("status") == "S") {
				$listing->setString("status", "A");
			} elseif ($listing->getString("status") == "A") {
				$listing->setString("status", "S");
			}
			$listing->save();
			header("Location: ".DEFAULT_URL."/membros/listing/index.php?screen=$screen&letra=$letra");
			exit;
		}
	}
	
	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	header("Location: ".DEFAULT_URL."/membros/listing/index.php?screen=$screen&letra=$letra");
	exit;

?>
