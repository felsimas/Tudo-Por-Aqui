<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/resetpassword.php
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
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == "POST") {

		if ($_SESSION[SESS_SM_ID]) {
			$smaccountObj = new SMAccount($_SESSION[SESS_SM_ID]);
			$sitemgr_username = $smaccountObj->getString("username");
		} else {
			setting_get("sitemgr_username", $sitemgr_username);
		}

		if ($_POST["password"]) {
			if ($_SESSION[SESS_SM_ID]) {
				$message = validate_password($_POST["password"], $_POST["retype_password"], true);
				if (!$message) {
					$smaccountObj->setString("password", $_POST["password"]);
					$smaccountObj->updatePassword();
					$success_message = system_showText(LANG_SITEMGR_MANAGEACCOUNT_PASSWORDSUCCESSUPDATED);
				}
			} else {
				if (validate_SM_changelogin($_POST, $message)) {
					$pwDBObj = db_getDBObject();
					$sql = "UPDATE Setting SET value = ".db_formatString(md5($_POST["password"]))." WHERE name = 'sitemgr_password'";
					$pwDBObj->query($sql);
					$success_message = system_showText(LANG_SITEMGR_MANAGEACCOUNT_PASSWORDSUCCESSUPDATED);
				}
			}
		} else {
			$message = system_showText(LANG_SITEMGR_MSGERROR_PASSWORDISREQUIRED);
		}

	}

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	if ($_GET["key"]) {

		$forgotPasswordObj = new forgotPassword($_GET["key"]);

		if ($forgotPasswordObj->getString("unique_key") && ($forgotPasswordObj->getString("section") == "sitemgr")) {

			if (!$forgotPasswordObj->getString("account_id")) {
				setting_get("sitemgr_username", $sitemgr_username);
			} else {
				$smaccountObj = new SMAccount($forgotPasswordObj->getString("account_id"));
				$sitemgr_username = $smaccountObj->getString("username");
			}

			$forgotPasswordObj->Delete();

			if (!$sitemgr_username) {
				$error_message = system_showText(LANG_SITEMGR_FORGOTPASS_SORRYWRONGACCOUNT);
			}

		} else {
			$error_message = system_showText(LANG_SITEMGR_FORGOTPASS_SORRYWRONGKEY);
		}

	} else {
		$error_message = system_showText(LANG_SITEMGR_FORGOTPASS_SORRYWRONGKEY);
	}

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
		<div id="header-content">
			<h1><?=ucwords(system_showText(LANG_SITEMGR_RESET))?> <?=ucwords(system_showText(LANG_SITEMGR_LABEL_PASSWORD))?></h1>
		</div>
	</div>

	<div id="content-content">
		<div class="default-margin" style="padding-top:3px;">

			<? require(EDIRECTORY_ROOT."/gerenciamento/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

			<? if ($success_message) { ?>
				<div class="response-msg success ui-corner-all"><?=$success_message;?></div>
			<? } elseif ($error_message && !$message) { ?>
				<p class="errorMessage"><?=$error_message;?></p>
			<? } else { ?>

				<? if ($message) { ?>
					<p class="errorMessage"><?=$message;?></p>
				<? } ?>

				<form name="formResetPassword" method="post" action="<?=$_SERVER["PHP_SELF"];?>">

					<script language="javascript" type="text/javascript" src="<?=DEFAULT_URL?>/scripts/checkpasswordstrength.js"></script>

					<table border="0" cellpadding="2" cellspacing="0" class="standard-table">
						<tr>
							<th><?=system_showText(LANG_SITEMGR_LABEL_USERNAME)?>:</th>
							<td><?=$sitemgr_username;?></td>
						</tr>
						<tr>
							<th><?=system_showText(LANG_SITEMGR_LABEL_PASSWORD)?>:</th>
							<td>
								<input type="password" autocomplete="off" name="password" maxlength="<?=PASSWORD_MAX_LEN?>" class="input-form-account" onkeyup="checkPasswordStrength(this.value, '<?=EDIRECTORY_FOLDER;?>')" />
								<div class="checkPasswordStrength">
									<span><?=system_showText(LANG_LABEL_PASSWORDSTRENGTH);?>:</span>
									<div id="checkPasswordStrength" class="strengthNoPassword">&nbsp;</div>
								</div>
								<span><?=system_showText(LANG_SITEMGR_MSG_PASSWORD_MUST_BE_BETWEEN)?> <?=PASSWORD_MIN_LEN?> <?=system_showText(LANG_SITEMGR_AND)?> <?=PASSWORD_MAX_LEN?> <?=LANG_SITEMGR_MSG_CHARACTERS_WITH_NO_SPACES?></span>
							</td>
						</tr>
						<tr>
							<th><?=system_showText(LANG_SITEMGR_LABEL_RETYPEPASSWORD)?>:</th>
							<td><input type="password" autocomplete="off" name="retype_password" class="input-form-account" /></td>
						</tr>
					</table>

					<table style="margin: 0 auto 0 auto;">
						<tr>
							<td>
								<button type="submit" value="Submit" class="ui-state-default ui-corner-all"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
							</td>
						</tr>
					</table>

				</form>

			<? } ?>

		</div>
	</div>

	<div id="bottom-content">
		&nbsp;
	</div>

</div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>
