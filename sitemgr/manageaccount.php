<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/manageaccount.php
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
	extract($_POST);
	extract($_GET);


	$success = false;

	if ($_SERVER['REQUEST_METHOD'] == "POST") {

		if ($smaccount) {
			if ($password) {
				$validate_sitemgrcurrentpassword = validate_sitemgrCurrentPassword($_POST, sess_getSMIdFromSession(), $message_smpassword);
			} else {
				$validate_sitemgrcurrentpassword = true;
			}
			if (validate_smaccount($_POST, $message_smaccount) && $validate_sitemgrcurrentpassword) {

				if ($permission) {
					$permissions = $permission;
					$permission = 0;
					foreach ($permissions as $each_permission) {
						$permission += $each_permission;
					}
				} else {
					$permission = 0;
				}
				$_POST["permission"] = $permission;

				$smaccount = new SMAccount($_POST["id"]);
				$smaccount->makeFromRow($_POST);
				$smaccount->save();

				if ($password) {
					$smaccount->setString("password", $password);
					$smaccount->updatePassword();
				}

				$success = true;
				$message_smaccount = system_showText(LANG_SITEMGR_MANAGEACCOUNT_SUCCESSUPDATED) ;

			}
		}

		if ($changelogin) {
			$validate_sitemgrcurrentpassword = true;
			if ($password) {
				setting_get("sitemgr_password", $sitemgr_password);
				if ($sitemgr_password != md5($current_password)) {
					$validate_sitemgrcurrentpassword = false;
					$error_currentpassword = system_showText(LANG_SITEMGR_MSGERROR_CURRENTPASSWORDINCORRECT);
				}
			}
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
					$actions[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MANAGEACCOUNT_PASSWORDWASCHANGED);
				}
				if ($actions) {
					$success = true;
					$message_changelogin .= implode("<br />", $actions);
				}
			}
		}

	}

	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------
	if ($_SESSION[SESS_SM_ID]) {
		$smaccount = new SMAccount($_SESSION[SESS_SM_ID]);
		$smaccount->extract();
	} else {
		setting_get("sitemgr_username", $username);
	}

		# ----------------------------------------------------------------------------------------------------
		# HEADER
		# ----------------------------------------------------------------------------------------------------
		include(SM_EDIRECTORY_ROOT."/layout/header_manager.php");

	?>

		<div id="page-wrapper">

			<div id="main-wrapper">

			<?php 	include(SM_EDIRECTORY_ROOT."/menu.php"); ?>

				<div id="main-content"> 

					<div class="page-title ui-widget-content ui-corner-all">

						<div class="other_content">

			<? require(EDIRECTORY_ROOT."/gerenciamento/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

			<? if ($_SESSION[SESS_SM_ID]) { ?>

				<form name="smaccount" action="<?=$_SERVER["PHP_SELF"]?>" method="post">
					<input type="hidden" name="id" value="<?=$_SESSION[SESS_SM_ID]?>" />
					<? include(INCLUDES_DIR."/forms/form_smaccount.php"); ?>
					<table style="margin: 0 auto 0 auto;">
						<tr>
							<td>
								<button type="submit" name="smaccount" value="Submit" class="ui-state-default ui-corner-all"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
							</td>
						</tr>
					</table>
				</form>

			<? } else { ?>

				<form name="changelogin" action="<?=$_SERVER["PHP_SELF"]?>" method="post">
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
					</div>
				</div>
			</div>
		<div class="clearfix"></div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>
