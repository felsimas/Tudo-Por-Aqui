<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /claim.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("./conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	session_start();

	# ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/validate_frontrequest.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (CLAIM_FEATURE != "on") { exit; }

	if (!$claimlistingid) {
		header("Location: ".LISTING_DEFAULT_URL."/");
		exit;
	}
	$listingObject = new Listing($claimlistingid);
	if (!$listingObject->getNumber("id") || ($listingObject->getNumber("id") <= 0)) {
		header("Location: ".LISTING_DEFAULT_URL."/");
		exit;
	}
	if ($listingObject->getNumber("account_id")) {
		header("Location: ".LISTING_DEFAULT_URL."/");
		exit;
	}
	if ($listingObject->getString("claim_disable") != "n") {
		header("Location: ".LISTING_DEFAULT_URL."/");
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if (($_SERVER['REQUEST_METHOD'] == "POST")) {

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

			/**************************************************************************************************/
			/*                                                                                                */
			/* E-mail notify                                                                                  */
			/*                                                                                                */
			/**************************************************************************************************/
			setting_get("sitemgr_send_email",$sitemgr_send_email);
			setting_get("sitemgr_email",$sitemgr_email);
			$sitemgr_emails = split(",",$sitemgr_email);
			if ($sitemgr_emails[0]) $sitemgr_email = $sitemgr_emails[0];
			setting_get("sitemgr_account_email",$sitemgr_account_email);
			$sitemgr_account_emails = split(",",$sitemgr_account_email);

			// sending e-mail to user //////////////////////////////////////////////////////////////////////////
			if ($emailNotificationObj = system_checkEmail(SYSTEM_CLAIM_SIGNUP, $contact->getString("lang"))) {
				$subject = $emailNotificationObj->getString("subject");
				$body = $emailNotificationObj->getString("body");
				$body = str_replace("ACCOUNT_NAME",$contact->getString("first_name").' '.$contact->getString("last_name"),$body);
				$body = str_replace("ACCOUNT_USERNAME",$_POST["username"],$body);
				$body = str_replace("ACCOUNT_PASSWORD",$_POST["password"],$body);
				$body = system_replaceEmailVariables($body, $listingObject->getNumber('id'), 'listing');
				$subject = system_replaceEmailVariables($subject, $listingObject->getNumber('id'), 'listing');
				$body = html_entity_decode($body);
				$subject = html_entity_decode($subject);
				$error = false;
				system_mail($contact->getString("email"), $subject, $body, EDIRECTORY_TITLE." <$sitemgr_email>", $emailNotificationObj->getString("content_type"), "", $emailNotificationObj->getString("bcc"), $error);
			}
			////////////////////////////////////////////////////////////////////////////////////////////////////

			// site manager warning message ////////////////////////////////////////////////////////////////////
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
							New signup claim in ".EDIRECTORY_TITLE.".<br /><br />
							Account:<br /><br />";
							$sitemgr_msg .= "<b>Username: </b>".$account->getString("username")."<br />";
							$sitemgr_msg .= "<b>First name: </b>".$contact->getString("first_name")."<br />";
							$sitemgr_msg .= "<b>Last name: </b>".$contact->getString("last_name")."<br />";
							$sitemgr_msg .= "<b>Company: </b>".$contact->getString("company")."<br />";
							$sitemgr_msg .= "<b>Address: </b>".$contact->getString("address")." ".$contact->getString("address2")."<br />";
							$sitemgr_msg .= "<b>City: </b>".$contact->getString("city")."<br />";
							$sitemgr_msg .= "<b>State: </b>".$contact->getString("state")."<br />";
							$sitemgr_msg .= "<b>".ucwords(ZIPCODE_LABEL).": </b>".$contact->getString("zip")."<br />";
							$sitemgr_msg .= "<b>Country: </b>".$contact->getString("country")."<br />";
							$sitemgr_msg .= "<b>Phone: </b>".$contact->getString("phone")."<br />";
							$sitemgr_msg .= "<b>E-mail: </b>".$contact->getString("email")."<br />";
							$sitemgr_msg .= "<br /><a href=\"".DEFAULT_URL."/gerenciamento/account/view.php?id=".$account->getNumber("id")."\" target=\"_blank\">".DEFAULT_URL."/gerenciamento/account/view.php?id=".$account->getNumber("id")."</a><br /><br />
						</div>
					</body>
				</html>";
			$error = false;
			if ($sitemgr_send_email == "on") {
				if ($sitemgr_emails[0]) {
					foreach ($sitemgr_emails as $sitemgr_email) {
						system_mail($sitemgr_email, "[".EDIRECTORY_TITLE."] Signup Claim Notification", $sitemgr_msg, EDIRECTORY_TITLE." <$sitemgr_email>", "text/html", '', '', $error);
					}
				}
			}
			if ($sitemgr_account_emails[0]) {
				foreach ($sitemgr_account_emails as $sitemgr_account_email) {
					system_mail($sitemgr_account_email, "[".EDIRECTORY_TITLE."] Signup Claim Notification", $sitemgr_msg, EDIRECTORY_TITLE." <$sitemgr_account_email>", "text/html", '', '', $error);
				}
			}
			////////////////////////////////////////////////////////////////////////////////////////////////////

			sess_registerAccountInSession($account->getString("username"));
			setcookie("username", $account->getString("username"), time()+60*60*24*30, "".EDIRECTORY_FOLDER."/membros");

			header("Location: ".DEFAULT_URL."/membros/claim/getlisting.php?claimlistingid=".$claimlistingid);
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
	$extrastyle = array(DEFAULT_URL."/layout/general_order.css", DEFAULT_URL."/layout/results.css");
	$headertag_title = (($listingObject->getString("seo_title"))?($listingObject->getString("seo_title")):($listingObject->getString("title")))." - ".system_showText(LANG_LISTING_CLAIMTHIS);
	$headertag_description = (($listingObject->getStringLang(EDIR_LANGUAGE, "seo_description"))?($listingObject->getStringLang(EDIR_LANGUAGE, "seo_description")):($listingObject->getStringLang(EDIR_LANGUAGE, "description")));
	$headertag_keywords = (($listingObject->getStringLang(EDIR_LANGUAGE, "seo_keywords"))?($listingObject->getStringLang(EDIR_LANGUAGE, "seo_keywords")):(str_replace(" || ", ", ", $listingObject->getStringLang(EDIR_LANGUAGE, "keywords"))));
	include(EDIRECTORY_ROOT."/layout/header.php");

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");

?>

	<script language="javascript" type="text/javascript">
		<!--

		function switchFormUserDisplay(user) {
			if (user == "newuser") {
				document.getElementById("formFacebookUser").className = "isHidden";
				document.getElementById("formOpenIDUser").className = "isHidden";
				document.getElementById("formDirectoryUser").className = "isHidden";
				document.getElementById("formNewUser").className = "isVisible";
			}
			if (user == "directoryuser") {
				document.getElementById("formFacebookUser").className = "isHidden";
				document.getElementById("formOpenIDUser").className = "isHidden";
				document.getElementById("formDirectoryUser").className = "isVisible";
				document.getElementById("formNewUser").className = "isHidden";
			}
			if (user == "openiduser") {
				document.getElementById("formFacebookUser").className = "isHidden";
				document.getElementById("formOpenIDUser").className = "isVisible";
				document.getElementById("formDirectoryUser").className = "isHidden";
				document.getElementById("formNewUser").className = "isHidden";
			}
			if (user == "facebookuser") {
				document.getElementById("formFacebookUser").className = "isVisible";
				document.getElementById("formOpenIDUser").className = "isHidden";
				document.getElementById("formDirectoryUser").className = "isHidden";
				document.getElementById("formNewUser").className = "isHidden";
			}
		}

		//-->
	</script>

	<div class="extendedContent">

		<h1 class="standardTitle"><?=system_highlightLastWord(system_showText(LANG_LISTING_CLAIMTHIS))?></h1>

		<ul class="standardStep">
			<li class="standardStepAD"><?=system_showText(LANG_EASYANDFAST)?> <span><?=system_showText(LANG_THREESTEPS)?> &raquo;</span></li>
			<li class="stepActived"><span>1</span>&nbsp;<?=system_showText(LANG_ACCOUNTSIGNUP)?></li>
			<li><span>2</span>&nbsp;<?=system_showText(LANG_LISTINGUPDATE)?></li>
			<li><span>3</span>&nbsp;<?=system_showText(LANG_CHECKOUT)?></li>
		</ul>

	</div>

	<div class="extendedContent contentBorder">
		<?
		$listing = $listingObject;
		$level = new ListingLevel();
		include(INCLUDES_DIR."/views/view_listing_summary.php");
		unset($listing, $level);
		?>
	</div>

	<table border="0" cellpadding="0" cellspacing="0" class="orderTable">
		<tr>
			<td class="orderTopdetail"><h2 class="standardSubTitle"><?=system_showText(LANG_ALREADYHAVEACCOUNT)?></h2></td>
		</tr>
		<tr>
			<td class="orderUserTable paddingUserTable claimUserTable">

				<table align="center" border="0" cellpadding="0" cellspacing="0">

					<tr>
						<th class="radioChooseLevel"><input type="radio" name="usertype" value="newuser" checked="checked" onclick="javascript:switchFormUserDisplay('newuser');" /></th>
						<td class="warning"><strong><?=system_showText(LANG_ACCOUNTNEWUSER)?></strong></td>
					</tr>

					<tr>
						<th class="radioChooseLevel"><input type="radio" name="usertype" value="directoryuser" <? if ($usertype == "directoryuser") echo "checked"; ?> onclick="javascript:switchFormUserDisplay('directoryuser');" /></th>
						<td><?=system_showText(LANG_ACCOUNTDIRECTORYUSER)?></td>
					</tr>

					<?
					setting_get("foreignaccount_openid", $foreignaccount_openid);
					if ($foreignaccount_openid == "on") {
						?>
						<tr>
							<th class="radioChooseLevel"><input type="radio" name="usertype" value="openiduser" <? if ($usertype == "openiduser") echo "checked"; ?> onclick="javascript:switchFormUserDisplay('openiduser');" /></th>
							<td><?=system_showText(LANG_ACCOUNTOPENIDUSER)?></td>
						</tr>
						<?
					}
					?>

					<?
					setting_get("foreignaccount_facebook", $foreignaccount_facebook);
					setting_get("foreignaccount_facebook_apikey", $foreignaccount_facebook_apikey);
					if (($foreignaccount_facebook == "on") && ($foreignaccount_facebook_apikey)) {
						?>
						<tr>
							<th class="radioChooseLevel"><input type="radio" name="usertype" value="facebookuser" <? if ($usertype == "facebookuser") echo "checked"; ?> onclick="javascript:switchFormUserDisplay('facebookuser');" /></th>
							<td><?=system_showText(LANG_ACCOUNTFACEBOOKUSER)?></td>
						</tr>
						<?
					}
					?>

					<tr>
						<td colspan="2">
							<div id="formDirectoryUser" class="<? if ($usertype == "directoryuser") echo "isVisible"; else echo "isHidden"; ?>">
								<form name="formDirectory" method="post" action="<?=((SSL_ENABLED == "on" && FORCE_MEMBERS_SSL == "on") ? SECURE_URL : NON_SECURE_URL);?>/membros/login.php?destiny=<?=EDIRECTORY_FOLDER?>/membros/claim/getlisting.php&query=claimlistingid=<?=$claimlistingid?>">
									<input type="hidden" name="userform" value="directory" />
									<?
									$membros_section = true;
									$automatically = false;
									include(INCLUDES_DIR."/forms/form_login.php");
									?>
								</form>
							</div>
						</td>
					</tr>

					<tr>
						<td colspan="2">
							<div id="formOpenIDUser" class="<? if ($usertype == "openiduser") echo "isVisible"; else echo "isHidden"; ?>">
								<form name="formOpenID" method="post" action="<?=((SSL_ENABLED == "on" && FORCE_MEMBERS_SSL == "on") ? SECURE_URL : NON_SECURE_URL);?>/membros/login.php?destiny=<?=EDIRECTORY_FOLDER?>/membros/claim/getlisting.php&query=claimlistingid=<?=$claimlistingid?>">
									<input type="hidden" name="userform" value="openid" />
									<? include(INCLUDES_DIR."/forms/form_openidlogin.php"); ?>
								</form>
							</div>
						</td>
					</tr>

					<tr>
						<td colspan="2">
							<div id="formFacebookUser" class="<? if ($usertype == "facebookuser") echo "isVisible"; else echo "isHidden"; ?>">
								<? include(INCLUDES_DIR."/forms/form_facebooklogin.php"); ?>
							</div>
						</td>
					</tr>

				</table>

			</td>
		</tr>
	</table>

	<div id="formNewUser" class="<? if ((!$usertype) || ($usertype == "newuser")) echo "isVisible"; else echo "isHidden"; ?>">

		<form name="signup_claim" action="<?=$_SERVER["PHP_SELF"]?>" method="post" class="standardForm">

			<input type="hidden" name="ieBugFix" value="1" />

			<input type="hidden" name="claim" value="true" />
			<input type="hidden" name="claimlistingid" id="claimlistingid" value="<?=$claimlistingid?>" />

			<script language="javascript" type="text/javascript" src="<?=DEFAULT_URL?>/scripts/checkpasswordstrength.js"></script>

			<table align="center" border="0" cellpadding="2" cellspacing="2" class="standardSIGNUPTable">
				<tr>
					<th colspan="2" class="SIGNUPTable-title"><h2 class="standardSubTitle"><?=system_showText(LANG_ACCOUNTINFO)?> <span><?=system_showText(LANG_ACCOUNTINFOMSG)?></span></h2></th>
				</tr>
				<? if ($message_account) { ?>
				<tr>
					<td colspan="2" class="errorMessage"><?=$message_account?></td>
				</tr>
				<? } ?>
				<tr>
					<th><?=system_showText(LANG_LABEL_USERNAME)?>:</th>
					<td>
						<input type="text" name="username" value="<?=$username?>" maxlength="<?=USERNAME_MAX_LEN?>" class="input-form-account" />
						<span><?=system_showText(LANG_USERNAME_MSG1)." ".USERNAME_MIN_LEN." ".system_showText(LANG_USERNAME_MSG2)." ".USERNAME_MAX_LEN." ".system_showText(LANG_USERNAME_MSG3)?></span>
					</td>
				</tr>
				<tr>
					<th><?=system_showText(LANG_LABEL_PASSWORD)?>:</th>
					<td>
						<input type="password" autocomplete="off" name="password" maxlength="<?=PASSWORD_MAX_LEN?>" class="input-form-account" onkeyup="checkPasswordStrength(this.value, '<?=EDIRECTORY_FOLDER;?>')" />
						<div class="checkPasswordStrength">
							<span><?=system_showText(LANG_LABEL_PASSWORDSTRENGTH);?>:</span>
							<div id="checkPasswordStrength" class="strengthNoPassword">&nbsp;</div>
						</div>
						<span><?=system_showText(LANG_PASSWORD_MSG1)." ".PASSWORD_MIN_LEN." ".system_showText(LANG_PASSWORD_MSG2)." ".PASSWORD_MAX_LEN." ".system_showText(LANG_PASSWORD_MSG3)?></span>
					</td>
				</tr>
				<tr>
					<th><?=system_showText(LANG_LABEL_RETYPEPASSWORD)?>:</th>
					<td><input type="password" autocomplete="off" name="retype_password" class="input-form-account" /></td>
				</tr>
				<tr>
					<th><input type="checkbox" name="agree_tou" value="1" <?=($agree_tou) ? "checked" : ""?> class="inputRadio" /></th>
					<td><a href="javascript: void(0);" onclick="window.open('<?=DEFAULT_URL?>/terms.php','popup','toolbar=0,location=0,directories=0,status=0,width=650,height=500,screenX=0,screenY=0,menubar=0,no-resizable,scrollbars=yes')"><?=system_showText(LANG_IGREETERMS)?></a></td>
				</tr>
				<tr>
					<th colspan="2" class="SIGNUPTable-title"><h2 class="standardSubTitle"><?=system_showText(LANG_CONTACTINFO)?> <span><?=system_showText(LANG_CONTACTINFO_MSG)?></span></h2></th>
				</tr>
				<? if ($message_contact) { ?>
				<tr>
					<td colspan="2" class="errorMessage"><?=$message_contact?></td>
				</tr>
				<? } ?>
				<tr>
					<th>* <?=system_showText(LANG_LABEL_LANGUAGE);?>:</th>
					<td>
						<?=language_langOptions($lang);?>
						<span><?=system_showText(LANG_LABEL_LANGUAGETIP)?></span>
					</td>
				</tr>
				<tr>
					<th>* <?=system_showText(LANG_LABEL_FIRSTNAME)?>:</th>
					<td><input type="text" name="first_name" value="<?=$first_name?>" /></td>
				</tr>
				<tr>
					<th>* <?=system_showText(LANG_LABEL_LASTNAME)?>:</th>
					<td><input type="text" name="last_name" value="<?=$last_name?>" /></td>
				</tr>
				<tr>
					<th><?=system_showText(LANG_LABEL_COMPANY)?>:</th>
					<td><input type="text" name="company" value="<?=$company?>" /></td>
				</tr>
				<tr>
					<th valign="top"><?=system_showText(LANG_LABEL_ADDRESS)?>:</th>
					<td><input type="text" name="address" value="<?=$address?>" maxlength="50" /></td>
				</tr>
				<tr>
					<th><?=system_showText(LANG_LABEL_ADDRESSOPTIONAL)?>:</th>
					<td><input type="text" name="address2" value="<?=$address2?>" maxlength="50" /></td>
				</tr>
				<tr>
					<th><?=system_showText(LANG_LABEL_CITY)?>:</th>
					<td><input type="text" name="city" value="<?=$city?>" /></td>
				</tr>
				<tr>
					<th><?=system_showText(LANG_LABEL_STATE)?>:</th>
					<td><input type="text" name="state" value="<?=$state?>" /></td>
				</tr>
				<tr>
					<th><?=ucwords(ZIPCODE_LABEL)?>:</th>
					<td><input type="text" name="zip" value="<?=$zip?>" /></td>
				</tr>
				<tr>
					<th><?=system_showText(LANG_LABEL_COUNTRY)?>:</th>
					<td><input type="text" name="country" value="<?=$country?>" /></td>
				</tr>
				<tr>
					<th><?=system_showText(LANG_LABEL_PHONE)?>:</th>
					<td><input type="text" name="phone" value="<?=$phone?>" /></td>
				</tr>
				<tr>
					<th>* <?=system_showText(LANG_LABEL_EMAIL)?>:</th>
					<td><input type="text" name="email" value="<?=$email?>" /></td>
				</tr>
			</table>

			<? include(EDIRECTORY_ROOT."/includes/code/seckey.php"); ?>

			<input type="hidden" name="ieBugFix" value="1" />

			<div>
				<p class="standardButton claimButton">
					<button type="submit" name="next" value="<?=system_showText(LANG_LISTING_CLAIMTHIS)?>"><?=system_showText(LANG_LISTING_CLAIMTHIS)?></button>
				</p>
			</div>

		</form>

	</div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/layout/footer.php");
?>
