<?
	# ----------------------------------------------------------------------------------------------------
	# * FILE: /membros/openidauth.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------

	if ($_GET["openid_mode"] == "id_res") {
		$openid = new AuthOpenID($_GET["openid_identity"]);
		try {
			if ($auth = $openid->validateAuth($_GET)) {
				if (system_registerForeignAccount($auth, "openid")) {
					$accountObject = db_getFromDB("account", "id", db_formatNumber($_SESSION[SESS_ACCOUNT_ID]));
					$redirect = $accountObject->getForeignAccountRedirect();
					$accountObject->setForeignAccountRedirect("");
					if ($redirect) header("Location: ".$redirect);
					else header("Location: ".DEFAULT_URL."/membros/");
					exit;
				} else {
					header("Location: ".DEFAULT_URL."/membros/login.php?openiderror=error");
					exit;
				}
			} else {
				header("Location: ".DEFAULT_URL."/membros/login.php?openiderror=invalid");
				exit;
			}
		} catch (Exception $ex) {
			header("Location: ".DEFAULT_URL."/membros/login.php?openiderror=error");
			exit;
		}
	} elseif ($_GET["openid_mode"] == "cancel") {
		header("Location: ".DEFAULT_URL."/membros/login.php?openiderror=cancel");
		exit;
	} else {
		header("Location: ".DEFAULT_URL."/membros/login.php?openiderror=error");
		exit;
	}

?>
