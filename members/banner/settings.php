<?


	# ----------------------------------------------------------------------------------------------------
	# * FILE: /membros/banner/settings.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (BANNER_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSession();
	$acctId = sess_getAccountIdFromSession();

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);

	$url_base = "".DEFAULT_URL."/membros";
	$url_redirect = $url_base."/banner";
	$membros = 1;

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	if ($id) {
		$bannerObj = new Banner($id);
		if (sess_getAccountIdFromSession() != $bannerObj->getNumber("account_id")) {
			header("Location: ".DEFAULT_URL."/membros/banner/index.php?screen=$screen&letra=$letra");
			exit;
		} else {
			if ($bannerObj->getString("status") == "S") {
				$bannerObj->setString("status", "A");
			} elseif ($bannerObj->getString("status") == "A") {
				$bannerObj->setString("status", "S");
			}
			$bannerObj->save();
			header("Location: ".DEFAULT_URL."/membros/banner/index.php?screen=$screen&letra=$letra");
			exit;
		}
	}

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	header("Location: ".DEFAULT_URL."/membros/banner/index.php?screen=$screen&letra=$letra");
	exit;

?>
