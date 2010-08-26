<?

	include("../../conf/loadconfig.inc.php");
	sess_validateSession();
	extract($_GET);
	extract($_POST);

	// required because of the cookie var
	$username = "";

	// Default CSS class for message box
	$message_style = "errorMessage";

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == "POST") {

		if ($_POST["password"]) {
			$validate_membercurrentpassword = validate_memberCurrentPassword($_POST, sess_getAccountIdFromSession(), $message_member);
		} else {
			$validate_membercurrentpassword = true;
		}
		$validate_account = validate_MEMBERS_account($_POST, $message_account);
		$validate_contact = validate_form("contact", $_POST, $message_contact);
		if ($validate_membercurrentpassword && $validate_account && $validate_contact) {
			$account = new Account($account_id);
			if ($account->getString("foreignaccount") == "y") {
				$account->setString("foreignaccount_done", "y");
				$account->save();
			}
			if ($_POST["password"]) {
				$account->setString("password", $_POST["password"]);
				$account->updatePassword();
			}
			$contact = new Contact($_POST);
			$contact->save();
			$message = system_showText(LANG_MSG_ACCOUNT_SUCCESSFULLY_UPDATED);
			$message_style = "successMessage";
		}

		// removing slashes added if required
		$_POST = format_magicQuotes($_POST);
		$_GET  = format_magicQuotes($_GET);
		extract($_POST);
		extract($_GET);

	}

	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------
	if (($id) && ($id == sess_getAccountIdFromSession())) {
		$account = new Account($id);
		$account->extract();
		$contact = new Contact($id);
		$contact->extract();
	} else {
		header("Location: ".DEFAULT_URL."/membros/index.php");
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/header_members.php");



?>
	<div id="page-wrapper">

		<div id="main-wrapper">
		<?php 	include(MEMBERS_EDIRECTORY_ROOT."/menu.php"); ?>
		


		<div id="main-content"> 

				
				<div class="page-title ui-widget-content ui-corner-all">

							<div class="other_content">

		

		<? if (($account->getString("foreignaccount") == "y") && ($account->getString("foreignaccount_done") == "n")) { ?>
			<div class="response-msg notice ui-corner-all"></div>
		<? } ?>

		<? require(EDIRECTORY_ROOT."/gerenciamento/registration.php"); ?>
		<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
		<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

		<div id="header-form"><?=system_highlightLastWord(system_showText(LANG_LABEL_ACCOUNT_AND_CONTACT_INFO),2)?></div>

		<?
		$contentObj = new Content("", EDIR_LANGUAGE);
		$content = $contentObj->retrieveContentByType("Manage Account");
		if ($content) {
			echo "<blockquote>";
				echo "<div class=\"dynamicContent\">".$content."</div>";
			echo "</blockquote>";
		}
		?>

		<? if($message){ ?>
			<div class="response-msg success ui-corner-all"><span><?=$message?></span></div>
		<? } ?>
		<br/>
		<form name="account" method="post">

			<input type="hidden" name="account_id" value="<?=$account_id?>" />

			<? $noteditusername = true; ?>
			<? $noteditagree    = true; ?>
			<? include(INCLUDES_DIR."/forms/form_account.php"); ?>
			<? include(INCLUDES_DIR."/forms/form_contact.php"); ?>

			<div class="baseButtons floatButtons">
					<button type="submit" value="Submit" class="ui-state-default ui-corner-all" ><?=system_showText(LANG_BUTTON_SUBMIT)?></button>
			</div>
		<form action="<?=DEFAULT_URL?>/membros/" method="post">

			<div class="baseButtons floatButtons noPaddingButtons">
					<button type="submit" value="Cancel" class="ui-state-default ui-corner-all" ><?=system_showText(LANG_BUTTON_CANCEL)?></button>
			</div>
		</form>
		<div style="clear:both"></div>

		<?
		$contentObj = new Content("", EDIR_LANGUAGE);
		$content = $contentObj->retrieveContentByType("Manage Account Bottom");
		if ($content) {
			echo "<blockquote>";
				echo "<div class=\"dynamicContent\">".$content."</div>";
			echo "</blockquote>";
		}
		?>

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
			include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");
		?>
