<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /membros/add/index.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	session_start();

	# ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/validate_frontrequest.php");

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == "POST") {

		$request_method_seckey = "post";
		include(EDIRECTORY_ROOT."/includes/code/seckey.php");

		$validate_account = validate_addAccount($_POST, $message_account);
		$validate_contact = validate_form("contact", $_POST, $message_contact);

		if ($boolean_seckey && $validate_account && $validate_contact) {

			$account = new Account($_POST);
			$account->save();
			$contact = new Contact($_POST);
			$contact->setNumber("account_id", $account->getNumber("id"));
			$contact->save();
			sess_registerAccountInSession($_POST["username"]);
			setcookie("username", $_POST['username'], time()+60*60*24*30, "".EDIRECTORY_FOLDER."/membros");

			/*****************************************************
			*
			* E-mail notify
			*
			******************************************************/
			setting_get("sitemgr_send_email",$sitemgr_send_email);
			setting_get("sitemgr_email",$sitemgr_email);
			$sitemgr_emails = split(",",$sitemgr_email);
			setting_get("sitemgr_account_email",$sitemgr_account_email);
			$sitemgr_account_emails = split(",",$sitemgr_account_email);

			// sending e-mail to user //////////////////////////////////////////////////////////////////////////
			$error = false;
			$body = system_showText(LANG_DEAR)." ".$contact->getString("first_name")." ".$contact->getString("last_name").",\n".system_showText(LANG_MSG_THANK_YOU_FOR_SIGNING_UP)." ".EDIRECTORY_TITLE." (".DEFAULT_URL.").\n".system_showText(LANG_MSG_LOGIN_TO_MANAGE_YOUR_ACCOUNT)."\n\n".system_showText(LANG_LABEL_USERNAME).": ".$_POST["username"]."\n".system_showText(LANG_LABEL_PASSWORD).": ".$_POST["password"]."\n\n".system_showText(LANG_MSG_YOU_CAN_SEE).":\n".system_showText(LANG_MSG_YOUR_ACCOUNT_IN)." ".DEFAULT_URL."/membros/account/account.php?id=".$account->getNumber("id")."\n";
			//system_mail($contact->getString("email"), "[".EDIRECTORY_TITLE."] ".system_showText(LANG_LABEL_SIGNUP_NOTIFICATION), $body, EDIRECTORY_TITLE." <$sitemgr_email>", 'text/plain', '', '', $error);
			////////////////////////////////////////////////////////////////////////////////////////////////////

			// site manager warning message /////////////////////////////////////
			$sitemgr_msg = "
				<html>
					<head>
						<style>
							.email_style_settings{
								font-size:12px;
								font-family:Verdana, Arial, Sans-Serif;
								color:#000;
							}
						</style>
					</head>
					<body>
						<div class=\"email_style_settings\">
							Site Manager,<br /><br />
							A new account was created in ".EDIRECTORY_TITLE.".<br />
							Please review the account information below:<br /><br />";
							$sitemgr_msg .= "<b>Username: </b>".$account->getString("username")."<br />";
							$sitemgr_msg .= "<b>First Name: </b>".$contact->getString("first_name")."<br />";
							$sitemgr_msg .= "<b>Last Name: </b>".$contact->getString("last_name")."<br />";
							$sitemgr_msg .= "<b>Company: </b>".$contact->getString("company")."<br />";
							$sitemgr_msg .= "<b>Address: </b>".$contact->getString("address")." ".$contact->getString("address2")."<br />";
							$sitemgr_msg .= "<b>City: </b>".$contact->getString("city")."<br />";
							$sitemgr_msg .= "<b>State: </b>".$contact->getString("state")."<br />";
							$sitemgr_msg .= "<b>".ucwords(ZIPCODE_LABEL).": </b>".$contact->getString("zip")."<br />";
							$sitemgr_msg .= "<b>Phone: </b>".$contact->getString("phone")."<br />";
							$sitemgr_msg .= "<b>Fax: </b>".$contact->getString("fax")."<br />";
							$sitemgr_msg .= "<b>Email: </b>".$contact->getString("email")."<br />";
							$sitemgr_msg .= "<b>URL: </b>".$contact->getString("url")."<br />";
							$sitemgr_msg .= "<b>I agree with the terms of use: </b>".(($account->getString("agree_tou") ==1) ? "Yes" : "No")."<br />";
							$sitemgr_msg .="<br /><a href=\"".DEFAULT_URL."/gerenciamento/account/view.php?id=".$account->getNumber("id")."\" target=\"_blank\">".DEFAULT_URL."/gerenciamento/account/view.php?id=".$account->getNumber("id")."</a><br /><br />
						</div>
					</body>
				</html>";

			if ($sitemgr_send_email == "on") {
				if ($sitemgr_emails[0]) {
					foreach ($sitemgr_emails as $sitemgr_email) {
						//system_mail($sitemgr_email, "[".EDIRECTORY_TITLE."] Account Notification", $sitemgr_msg, EDIRECTORY_TITLE." <$sitemgr_email>", "text/html", '', '', $error);
					}
				}
			}
			if ($sitemgr_account_emails[0]) {
				foreach ($sitemgr_account_emails as $sitemgr_account_email) {
					//system_mail($sitemgr_account_email, "[".EDIRECTORY_TITLE."] Account Notification", $sitemgr_msg, EDIRECTORY_TITLE." <$sitemgr_account_email>", "text/html", '', '', $error);
				}
			}
			////////////////////////////////////////////////////////////////////

			header("Location: ".DEFAULT_URL."/membros/index.php");
			exit;

		} else {
			// removing slashes added if required
			$_POST = format_magicQuotes($_POST);
			$_GET  = format_magicQuotes($_GET);
			extract($_POST);
			extract($_GET);
		}

	}

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/header.php");

?>

	<div class="sidebar">
		<h3 class="standardTitle"><?=system_highlightLastWord(system_showText(LANG_LABEL_MEMBER_OPTIONS))?></h3>
		<ul class="memberMenu">
			<li><a href="<?=NON_SECURE_URL?>/index.php"><?=system_showText(LANG_LABEL_BACK_TO_SEARCH)?></a></li>
			<li><a href="<?=DEFAULT_URL?>/membros/index.php"><?=system_showText(LANG_LABEL_GO_TO_LOGIN)?></a></li>
		</ul>
	</div>

	<div class="mainContentExtended">

		<? require(EDIRECTORY_ROOT."/gerenciamento/registration.php"); ?>
		<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
		<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

		<h1 class="standardTitle"><?=system_highlightLastWord(system_showText(LANG_LABEL_ACCOUNT_AND_CONTACT_INFO))?></h1>

		<form name="addaccount" method="post">

			<input type="hidden" name="ieBugFix" value="1" />

			<? include(INCLUDES_DIR."/forms/form_account.php"); ?>
			<? include(INCLUDES_DIR."/forms/form_contact.php"); ?>

			<? include(EDIRECTORY_ROOT."/includes/code/seckey.php"); ?>
			
			<div class="baseButtons">

			<input type="hidden" name="ieBugFix" value="1" />

				<p class="standardButton">
					<button type="submit" value="Submit"><?=system_showText(LANG_BUTTON_SUBMIT)?></button>
				</p>

		</form>
		<form name="cancelaccount" action="<?=DEFAULT_URL?>/membros/" method="post">
				
				<p class="standardButton">
					<button type="submit" value="Cancel"><?=system_showText(LANG_BUTTON_CANCEL)?></button>
				</p>

		</form>
		
		</div>

	</div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");
?>