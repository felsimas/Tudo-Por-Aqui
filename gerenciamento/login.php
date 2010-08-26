<?
	include("../conf/loadconfig.inc.php");
	$sitemgr_section = true;

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

	setting_get("sitemgr_special_message", $special_message);

	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		if (sess_authenticateSM($_POST["username"], $_POST["password"], $authmessage)) {

			sess_registerSMInSession($_POST["username"]);
			setcookie("username", $_POST["username"], time()+60*60*24*30, "".EDIRECTORY_FOLDER."/gerenciamento");

			if ($_POST["automatic_login"]) setcookie("automatic_login", "true", time()+60*60*24*30, "".EDIRECTORY_FOLDER."/gerenciamento");
			else setcookie("automatic_login", "false", time()+60*60*24*30, "".EDIRECTORY_FOLDER."/gerenciamento");

			if ($destiny) {
				$url = $destiny;
				if ($query) $url .= "?".$query;
			} else {
				$url = ((SSL_ENABLED == "on" && FORCE_SITEMGR_SSL == "on") ? SECURE_URL : DEFAULT_URL)."/gerenciamento/";
			}

			header("Location: ".$url);
			exit;

		}

		$username = $_POST["username"];
		$message_login = $authmessage;

	} elseif ($_GET["key"]) {

		$forgotPasswordObj = new forgotPassword($_GET["key"]);

		if ($forgotPasswordObj->getString("unique_key") && ($forgotPasswordObj->getString("section") == "sitemgr")) {

			if (!$forgotPasswordObj->getString("account_id")) {
				setting_get("sitemgr_username", $sitemgr_username);
			} else {
				$smaccountObj = new SMAccount($forgotPasswordObj->getString("account_id"));
				$sitemgr_username = $smaccountObj->getString("username");
			}

			if ($sitemgr_username) {

				sess_registerSMInSession($sitemgr_username);
				setcookie("username", $sitemgr_username, time()+60*60*24*30, "".EDIRECTORY_FOLDER."/gerenciamento");

				header("Location: ".((SSL_ENABLED == "on" && FORCE_SITEMGR_SSL == "on") ? SECURE_URL : DEFAULT_URL)."/gerenciamento/resetpassword.php?key=".$_GET["key"]);
				exit;

			} else {
				$message_login = system_showText(LANG_SITEMGR_FORGOTPASS_SORRYWRONGACCOUNT);
			}

		} else {
			$message_login = system_showText(LANG_SITEMGR_FORGOTPASS_SORRYWRONGKEY);
		}

	} else {

		$username = $_COOKIE["username"];
		if ($_COOKIE["automatic_login"] == "true") $checked = "checked";
		else $checked = "";

	}

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/header_login.php");

?>

    <div id="wrapper">
        <div id="container_front" class="login">
        
            <div id="header_front">
            		<a href="<? echo DEFAULT_URL;?>"><img src="<? echo DEFAULT_URL;?>/images/logo_login.png" border="0" alt="Tudo por aqui logo" /></a>
            

            </div>

			<form name="formLogin" method="post" action="<?=SM_LOGIN_PAGE;?>">
				<? include(INCLUDES_DIR."/forms/form_login.php"); ?>
			</form>

			<script language="JavaScript" type="text/javascript">
				<!--
				if (document.formLogin.username) {
					if (document.formLogin.username.value) {
						document.formLogin.password.focus();
					} else {
						document.formLogin.username.focus();
					}
				} else {
					document.formLogin.username.focus();
				}
				//-->
			</script>

	
            </div>
		</div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>
