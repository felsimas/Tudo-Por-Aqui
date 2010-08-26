<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/setlogin.php
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
	extract($_POST);
	extract($_GET);
	$destiny = $_GET["destiny"] ? $_GET["destiny"] : $_POST["destiny"];
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
	if ($destiny) {
		$url = $destiny;
		if ($query) $url .= "?".$query;
	} else {
		$url = DEFAULT_URL."/gerenciamento/";
	}

	# ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	if (DEMO_DEV_MODE || DEMO_LIVE_MODE) {
		header("Location: ".$url);
		exit;
	} else {
		setting_get("sitemgr_first_login", $sitemgr_first_login);
		if ($sitemgr_first_login != "yes") {
			header("Location: ".$url);
			exit;
		}
		$smusername = "";
		if ($_SESSION[SESS_SM_ID]) {
			$smacctObj = db_getFromDB("smaccount", "id", db_formatNumber($_SESSION[SESS_SM_ID]));
			$smusername = $smacctObj->getString("username");
		}
		if ($smusername == "arcalogin") {
			header("Location: ".$url);
			exit;
		}
	}

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == "POST") {

		if ($changelogin) {

			$validate_sitemgrcurrentpassword = true;
			setting_get("sitemgr_password", $sitemgr_password);
			if ($sitemgr_password != md5($current_password)) {
				$validate_sitemgrcurrentpassword = false;
				$error_currentpassword = system_showText(LANG_SITEMGR_MSGERROR_CURRENTPASSWORDINCORRECT);
			}

			$_POST["setlogin"] = true;
			if ($validate_sitemgrcurrentpassword && validate_SM_changelogin($_POST, $message_changelogin)) {

				if ($username) {
					setting_get("sitemgr_username", $sm_username);
					if ($username != $sm_username) {
						setting_set("sitemgr_username", $username);
						$actions[] = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_MANAGEACCOUNT_USERNAMEWASCHANGED);
					}
				}

				if ($password) {
					$pwDBObj = db_getDBObject();
					$sql = "UPDATE Setting SET value = ".db_formatString(md5($password))." WHERE name = 'sitemgr_password'";
					$pwDBObj->query($sql);
					$actions[] = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_MANAGEACCOUNT_PASSWORDWASCHANGED);
				}

				if ($actions) {
					$message_changelogin .= implode("<br />", $actions);
				}

				if (LISTINGTEMPLATE_FEATURE == "on") {
					setting_set("todo_listingtemplate", "yes");
				} else {
					setting_set("todo_listingtemplate", "done");
				}
				setting_set("todo_pricing", "yes");
				if (PAYMENT_FEATURE == "on") {
					if (INVOICEPAYMENT_FEATURE == "on") {
						setting_set("todo_invoice", "yes");
					} else {
						setting_set("todo_invoice", "done");
					}
				} else {
					setting_set("todo_invoice", "done");
				}
				setting_set("todo_email", "yes");
				setting_set("todo_emailnotification", "yes");
				setting_set("todo_sitecontent", "yes");
				if (GOOGLE_ADS_ENABLED == "on") {
					setting_set("todo_googleads", "yes");
				} else {
					setting_set("todo_googleads", "done");
				}
				if (GOOGLE_MAPS_ENABLED == "on") {
					setting_set("todo_googlemaps", "yes");
				} else {
					setting_set("todo_googlemaps", "done");
				}
				if (GOOGLE_ANALYTICS_ENABLED == "on") {
					setting_set("todo_googleanalytics", "yes");
				} else {
					setting_set("todo_googleanalytics", "done");
				}
				setting_set("todo_headerlogo", "yes");
				setting_set("todo_noimage", "yes");
				if (CLAIM_FEATURE == "on") {
					setting_set("todo_claim", "yes");
				} else {
					setting_set("todo_claim", "done");
				}
                
                if (MULTILANGUAGE_FEATURE == "on") {
                    setting_set("todo_langcenter", "yes");
                } else {
                    setting_set("todo_langcenter", "done");
                }

				setting_set("sitemgr_first_login", "no");

				header("Location: ".$url);
				exit;
			}

		}

	}

	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------
	setting_get("sitemgr_username", $username);

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/header.php");

	# ----------------------------------------------------------------------------------------------------
	# NAVBAR
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/navbar.php");

?>

<div id="main-right">

	<div id="top-content">
		<h1><?=system_showText(LANG_SITEMGR_HOME_WELCOME)?>!</h1>
	</div>

	<div id="content-content">

		<div class="default-margin">

			<div class="response-msg inf ui-corner-all">
				<?=nl2br(system_showText(LANG_SITEMGR_SETLOGIN_INFO1))?>
			</div>

			<br />

			<? if ($_SESSION[SESS_SM_ID]) { ?>

				<p class="errorMessage">
					<?=system_showText(LANG_SITEMGR_SETLOGIN_ERROR1)?><br /><br />
					<?=system_showText(LANG_SITEMGR_SETLOGIN_ERROR2)?> 
				</p>

			<? } else { ?>

				<form name="changelogin" action="<?=$_SERVER["PHP_SELF"]?>" method="post">

					<input type="hidden" name="destiny" value="<?=$destiny?>" />
					<input type="hidden" name="query" value="<?=urlencode($query)?>" />

					<? include(INCLUDES_DIR."/forms/form_changelogin.php"); ?>

					<table style="margin: 0 auto 0 auto;">
						<tr>
							<td>
								<button type="submit" name="changelogin" value="Submit" class="ui-state-default ui-corner-all"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
							</td>
						</tr>
					</table>

				</form>

			<? } ?>

		</div>

	</div>

	<div id="bottom-content">&nbsp;</div>

</div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>
