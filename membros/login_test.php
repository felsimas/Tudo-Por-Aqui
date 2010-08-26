<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /membros/login.php
	# ----------------------------------------------------------------------------------------------------
	header('Content-Type: text/html; charset=ISO-8859-15');

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------

	$membros_section = true;

	$_GET = format_magicQuotes($_GET);
	$_POST = format_magicQuotes($_POST);
	$destiny = $_GET["destiny"] ? $_GET["destiny"] : $_POST["destiny"];
	$destiny = urldecode($destiny);
	if ($destiny) {
		$destiny = system_denyInjections($destiny);
		if (strpos($destiny, "://") !== false) {
			if (strpos($destiny, $_SERVER["HTTP_HOST"]) === false) {
				$destiny = "";
			}
		}
	}
	if ($_SERVER["QUERY_STRING"]) {
		if (strpos($_SERVER["QUERY_STRING"], "query=") !== false) {
			$query = substr($_SERVER["QUERY_STRING"], strpos($_SERVER["QUERY_STRING"], "query=")+6);
		} else {
			$query = $_GET["query"] ? $_GET["query"] : $_POST["query"];
			$query = urldecode($query);
		}
	} else {
		$query = $_GET["query"] ? $_GET["query"] : $_POST["query"];
		$query = urldecode($query);
	}
	if ($query) {
		$query = system_denyInjections($query);
	}

	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		if ($_POST["userform"] == "openid") {

			setcookie("openidurl", $_POST["openidurl"], time()+60*60*24*30, "".EDIRECTORY_FOLDER."/membros");

			if ($destiny) {
				$url = $destiny;
				if ($query) $url .= "?".$query;
			} else {
				$url = ((SSL_ENABLED == "on" && FORCE_MEMBERS_SSL == "on") ? SECURE_URL : DEFAULT_URL)."/membros/";
			}

			setcookie("userform", $_POST["userform"], time()+60*60*24*30, "".EDIRECTORY_FOLDER."/membros");

			$accountObject = db_getFromDB("account", "username", db_formatString("openid::".$_POST["openidurl"]));
			if ($accountObject->getNumber("id")) {
				$accountObject->setForeignAccountRedirect($url);
			}

			$identity = $_POST["openidurl"];
			$trust_root = DEFAULT_URL;
			$return_to = DEFAULT_URL."/membros/openidauth.php";
			$required_fields = array('email', 'fullname');
			$optional_fields = array('dob', 'gender', 'postcode', 'country', 'language', 'timezone');
			$openid = new AuthOpenID($identity, $trust_root, $return_to, $required_fields, $optional_fields);
			try {
				$openid->requestAuth();
			} catch (Exception $ex) {
				$authmessage = system_showText(LANG_MSG_OPENID_SERVER);
			}

		} else {

			if (sess_authenticateAccount($_POST["username"], $_POST["password"], $authmessage)) {
						
				sess_registerAccountInSession($_POST["username"]);
				setcookie("username", $_POST["username"], time()+60*60*24*30, "".EDIRECTORY_FOLDER."/membros");

				if ($_POST["automatic_login"]) setcookie("automatic_login", "true", time()+60*60*24*30, "".EDIRECTORY_FOLDER."/membros");
				else setcookie("automatic_login", "false", time()+60*60*24*30, "".EDIRECTORY_FOLDER."/membros");

				if ($destiny) {
					$url = $destiny;
					if ($query) $url .= "?".$query;
				} else {
					$url = ((SSL_ENABLED == "on" && FORCE_MEMBERS_SSL == "on") ? SECURE_URL : DEFAULT_URL)."/membros/";
				}

				setcookie("userform", "directory", time()+60*60*24*30, "".EDIRECTORY_FOLDER."/membros");
				$_POST["userform"] = "directory";
				
			
				echo "<script>window.location = \"$url\";</script>";
			//	header("Location: ".$url);

				exit;

			}

		}

		$userform = $_POST["userform"];
		$username = $_POST["username"];
		$openidurl = $_POST["openidurl"];

		$message_login = $authmessage;

	} elseif ($_GET["openiderror"]) {

		$openiderror = $_GET["openiderror"];
		if ($openiderror) {
			if ($openiderror == "server") {
				$message_login = system_showText(LANG_MSG_OPENID_SERVER);
			} elseif ($openiderror == "cancel") {
				$message_login = system_showText(LANG_MSG_OPENID_CANCEL);
			} elseif ($openiderror == "invalid") {
				$message_login = system_showText(LANG_MSG_OPENID_INVALID);
			} else {
				$message_login = system_showText(LANG_MSG_OPENID_ERROR);
			}
		}

		$userform = $_COOKIE["userform"];
		$username = $_COOKIE["username"];
		$openidurl = $_COOKIE["openidurl"];

	} elseif ($_GET["facebookerror"]) {

		$facebookerror = $_GET["facebookerror"];

		setcookie("userform", "facebook", time()+60*60*24*30, "".EDIRECTORY_FOLDER."/membros");

		$message_login = $facebookerror;

		$userform = "facebook";
		$username = $_COOKIE["username"];
		$openidurl = $_COOKIE["openidurl"];

	} elseif ($_GET["key"]) {

		$forgotPasswordObj = new forgotPassword($_GET["key"]);

		if ($forgotPasswordObj->getString("unique_key") && ($forgotPasswordObj->getString("section") == "membros")) {

			$accountObj = new Account($forgotPasswordObj->getString("account_id"));

			if ($accountObj->getNumber("id")) {

				sess_registerAccountInSession($accountObj->getString("username"));
				setcookie("username", $accountObj->getString("username"), time()+60*60*24*30, "".EDIRECTORY_FOLDER."/membros");

				header("Location: ".((SSL_ENABLED == "on" && FORCE_MEMBERS_SSL == "on") ? SECURE_URL : DEFAULT_URL)."/membros/resetpassword.php?key=".$_GET["key"]);
				exit;

			} else {
				$message_login = system_showText(LANG_MSG_WRONG_ACCOUNT);
			}

		} else {
			$message_login = system_showText(LANG_MSG_WRONG_KEY);
		}

	} else {

		$userform = $_COOKIE["userform"];
		$username = $_COOKIE["username"];
		if ($_COOKIE["automatic_login"] == "true") $checked = "checked";
		else $checked = "";
		$openidurl = $_COOKIE["openidurl"];

	}

	setting_get("foreignaccount_openid", $foreignaccount_openid);
	setting_get("foreignaccount_facebook", $foreignaccount_facebook);
	setting_get("foreignaccount_facebook_apikey", $foreignaccount_facebook_apikey);
	if (($userform == "openid") && ($foreignaccount_openid != "on")) {
		setcookie("userform", "directory", time()+60*60*24*30, "".EDIRECTORY_FOLDER."/membros");
		$userform = "directory";
	}
	if (($userform == "facebook") && (($foreignaccount_facebook != "on") || (!$foreignaccount_facebook_apikey))) {
		setcookie("userform", "directory", time()+60*60*24*30, "".EDIRECTORY_FOLDER."/membros");
		$userform = "directory";
	}
	
	if (!$userform) {
		echo "<script type=\"text/javascript\">
		
		   	$(\".response-msg\").hide(\"slow\").show(\"slow\");</script>"; 

		echo "<br/>";
		echo $authmessage;
		$userform = "directory";
	}


?>

