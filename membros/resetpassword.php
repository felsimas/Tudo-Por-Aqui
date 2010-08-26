<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /membros/resetpassword.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSession();

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == "POST") {

		$accountObj = new Account(sess_getAccountIdFromSession());
		$member_username = $accountObj->getString("username");

		if ($_POST["password"]) {
			if (validate_MEMBERS_account($_POST, $message)) {
				$accountObj->setString("password", $_POST["password"]);
				$accountObj->updatePassword();
				$success_message = system_showText(LANG_MSG_PASSWORD_SUCCESSFULLY_UPDATED);
			}
		} else {
			$message = system_showText(LANG_MSG_PASSWORD_IS_REQUIRED);
		}

	}

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	if ($_GET["key"]) {

		$forgotPasswordObj = new forgotPassword($_GET["key"]);

		if ($forgotPasswordObj->getString("unique_key") && ($forgotPasswordObj->getString("section") == "membros")) {

			$accountObj = new Account($forgotPasswordObj->getString("account_id"));
			$member_username = $accountObj->getString("username");

			$forgotPasswordObj->Delete();

			if (!$member_username) {
				$error_message = system_showText(LANG_MSG_WRONG_ACCOUNT);
			}

		} else {
			$error_message = system_showText(LANG_MSG_WRONG_KEY);
		}

	} else {
		$error_message = system_showText(LANG_MSG_WRONG_KEY);
	}

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/header.php");

	# ----------------------------------------------------------------------------------------------------
	# NAVBAR
	# ----------------------------------------------------------------------------------------------------
   //	include(MEMBERS_EDIRECTORY_ROOT."/layout/navbar.php");

?>

	<div class="mainContentExtended">

		<? require(EDIRECTORY_ROOT."/gerenciamento/registration.php"); ?>
		<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
		<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>
              <br />
		<h1 class="standardTitle"><?=system_highlightLastWord(system_showText(LANG_LABEL_RESET_PASSWORD));?></h1>

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
						<th><?=system_showText(LANG_LABEL_USERNAME)?>:</th>
						<td><?=$member_username;?></td>
					</tr>
					<tr>
						<th><?=system_showText(LANG_LABEL_PASSWORD)?>:</th>
						<td>
							<input type="password" autocomplete="off" name="password" maxlength="<?=PASSWORD_MAX_LEN?>" class="input-form-account" onkeyup="checkPasswordStrength(this.value, '<?=EDIRECTORY_FOLDER;?>')" />
							<div class="checkPasswordStrength">
								<span><?=system_showText(LANG_LABEL_PASSWORDSTRENGTH);?>:</span>
								<div id="checkPasswordStrength" class="strengthNoPassword">&nbsp;</div>
							</div>
							<span><?=system_showText(LANG_MSG_PASSWORD_MUST_BE_BETWEEN)?> <?=PASSWORD_MIN_LEN?> <?=system_showText(LANG_AND)?> <?=PASSWORD_MAX_LEN?> <?=system_showText(LANG_MSG_CHARACTERS_WITH_NO_SPACES)?></span>
						</td>
					</tr>
					<tr>
						<th><?=system_showText(LANG_LABEL_RETYPE_PASSWORD)?>:</th>
						<td><input type="password" autocomplete="off" name="retype_password" class="input-form-account" /></td>
					</tr>
				</table>

				<table border="0" align="center" cellpadding="5" cellspacing="5" style="margin: 0 auto 0 auto;">
					<tr>
						<td>
							<p class="standardButton" style="padding: 0;">
								<button type="submit" value="<?=system_showText(LANG_BUTTON_SUBMIT);?>" class="ui-state-default ui-corner-all"><?=system_showText(LANG_BUTTON_SUBMIT);?></button>
							</p>
						</td>
					</tr>
				</table>

			</form>

		<? } ?>

	</div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");
?>
