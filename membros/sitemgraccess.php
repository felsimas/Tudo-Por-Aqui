<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /membros/gerenciamentoaccess.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	if (!empty($_SESSION[SM_LOGGEDIN])) {

		if (isset($_GET["logout"])) {

			if ($_SESSION[SESS_ACCOUNT_ID]) {

				$acctObj = db_getFromDB("account", "id", db_formatNumber($_SESSION[SESS_ACCOUNT_ID]));

				$dbLogoutObj = db_getDBObject();
				$logoutSQL = "INSERT INTO Report_Login (datetime, ip, type, page, username) values (NOW(), ".db_formatString(getenv("REMOTE_ADDR")).", 'logout', ".db_formatString($_SERVER["PHP_SELF"]).", ".db_formatString($acctObj->getString("username")).")";
				$dbLogoutObj->query($logoutSQL);

			}


			unset($_SESSION[SESS_ACCOUNT_ID]);
			unset($_GET["account"]);

			echo "
				<script language=\"javascript\" type=\"text/javascript\">
					window.close();
					opener.focus();
				</script>
			";

			exit;

		}

		if ($_GET["account"]) {

			$accountObj = db_getFromDB("account", "username", db_formatString($_GET["account"]));

			if ($accountObj->getNumber("id")) {

				$_SESSION[SESS_ACCOUNT_ID] = $accountObj->getNumber("id");

				$dbLoginObj = db_getDBObject();
				$loginSQL = "INSERT INTO Report_Login (datetime, ip, type, page, username) values (NOW(), ".db_formatString(getenv("REMOTE_ADDR")).", 'login', ".db_formatString($_SERVER["PHP_SELF"]).", ".db_formatString($_GET["account"]).")";
				$dbLoginObj->query($loginSQL);

			} else {
				unset($_SESSION[SESS_ACCOUNT_ID]);
			}

		} else {
			unset($_SESSION[SESS_ACCOUNT_ID]);
		}

	}

	header("Location: ".DEFAULT_URL."/membros/");
	exit;

?>