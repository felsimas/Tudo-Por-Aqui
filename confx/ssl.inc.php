<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /conf/ssl.inc.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# FLAGS - on/off
	# ----------------------------------------------------------------------------------------------------
	define(SSL_ENABLED, "off");
	define(FORCE_MEMBERS_SSL, "off");
	define(FORCE_ORDER_SSL, "off");
	define(FORCE_CLAIM_SSL, "off");
	define(FORCE_SITEMGR_SSL, "off");

	# ----------------------------------------------------------------------------------------------------
	# SSL
	# ----------------------------------------------------------------------------------------------------
	if (SSL_ENABLED == "on") {
		if (FORCE_MEMBERS_SSL == "on") {
			if ((HTTPS_MODE != "on") && eregi("^".EDIRECTORY_FOLDER."/membros", $_SERVER["PHP_SELF"])) {
				header("Location: "."https://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]);
				exit;
			}
			if ((HTTPS_MODE != "on") && (FORCE_ORDER_SSL == "on") && (strpos($_SERVER["PHP_SELF"], "order_") !== false)) {
				header("Location: "."https://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]);
				exit;
			}
			if ((HTTPS_MODE != "on") && (FORCE_CLAIM_SSL == "on") && (strpos($_SERVER["PHP_SELF"], "claim.php") !== false)) {
				header("Location: "."https://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]);
				exit;
			}
		}
		if (FORCE_SITEMGR_SSL == "on") {
			if ((HTTPS_MODE != "on") && eregi("^".EDIRECTORY_FOLDER."/gerenciamento", $_SERVER["PHP_SELF"])) {
				header("Location: "."https://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]);
				exit;
			}
		}
	} else {
		if (HTTPS_MODE == "on") {
			header("Location: "."http://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]);
			exit;
		}
	}

?>
