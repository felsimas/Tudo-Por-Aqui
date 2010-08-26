<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/account/account.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	// required because of the cookie var
	$username = "";

	extract($_GET);
	extract($_POST);

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == "POST") {

		if ($account_id) {

			if ($password) $message_account = validate_password($password, "", false);
			$validate_contact = validate_form("contact", $_POST, $message_contact);
			if (!$message_account && $validate_contact) {
				if ($_POST['password']) {
					$account = new Account($account_id);
					$account->setString("password", $_POST['password']);
					$account->updatePassword();
				}
				
				$contact = new Contact($_POST);
				$contact->save();

				if ($sendmail && $_POST['password'] && system_checkEmail(SYSTEM_ACCOUNT_UPDATE, $contact->getString("lang"))) {
					system_sendPassword(SYSTEM_ACCOUNT_UPDATE, $_POST['email'], $_POST['username'], $_POST['password'], $_POST['first_name']." ".$_POST['last_name'], $contact->getString("lang"));
				}

				$message = system_showText(LANG_SITEMGR_ACCOUNT_SUCCESSUPDATED);
				header("Location: ".DEFAULT_URL."/gerenciamento/account/".(($search_page) ? "search.php" : "index.php")."?message=".urlencode($message)."&screen=$screen&letra=$letra".(($url_search_params) ? "&$url_search_params" : "")."");
				exit;
			}

		} else {

			$validate_account = validate_SM_account($_POST, $message_account);
			$validate_contact = validate_form("contact", $_POST, $message_contact);
			if ($validate_account && $validate_contact) {
				$account = new Account($_POST);
				$account->save();
				$contact = new Contact($_POST);
				$contact->setNumber("account_id", $account->getNumber("id"));
				$contact->save();

				if ($sendmail && system_checkEmail(SYSTEM_ACCOUNT_CREATE, $contact->getString("lang"))) {
					system_sendPassword(SYSTEM_ACCOUNT_CREATE, $_POST['email'], $_POST['username'], $_POST['password'], $_POST['first_name']." ".$_POST['last_name'], $contact->getString("lang"));
				}

				$message = system_showText(LANG_SITEMGR_ACCOUNT_SUCCESSADDED);
				header("Location: ".DEFAULT_URL."/gerenciamento/account/".(($search_page) ? "search.php" : "index.php")."?message=".urlencode($message)."&newest=1"."&screen=$screen&letra=$letra".(($url_search_params) ? "&$url_search_params" : "")."");
				exit;
			}

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


		# ----------------------------------------------------------------------------------------------------
		# HEADER
		# ----------------------------------------------------------------------------------------------------
		include(SM_EDIRECTORY_ROOT."/layout/header_manager.php");
		

	?>

		<div id="page-wrapper">

			<div id="main-wrapper">

			<?php include(SM_EDIRECTORY_ROOT."/menu.php");?>
			
			<?
		 	$username = '';
			if ($_GET['id']) {
			$account = new Account($_GET["id"]);
			$account->extract();
			$contact = new Contact($_GET["id"]);
			$contact->extract();
			$notification = system_checkEmail(SYSTEM_ACCOUNT_UPDATE, $contact->getString("lang"));
			} else {
				$notification = system_checkEmail(SYSTEM_ACCOUNT_CREATE, EDIR_DEFAULT_LANGUAGE);
			}
			?>
				<div id="main-content"> 

					<div class="page-title ui-widget-content ui-corner-all">

						<div class="other_content">
			<?
			if($id || $account_id) 
				$prefix = "Editar";
			else 
				$prefix = "Adicionar";
			?>

			<? require(EDIRECTORY_ROOT."/gerenciamento/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

			<? include(INCLUDES_DIR."/tables/table_account_submenu.php"); ?>
			<div id="header-form">
				<?=$prefix?> <?=system_showText(LANG_SITEMGR_ACCOUNT_TITLEACCOUNTCONTACT)?>
				</div>
			<div class="baseForm">

			<form name="account" action="<?=$_SERVER["PHP_SELF"]?>" method="post" style="margin:0; padding:0">
				<input type="hidden" name="account_id" value="<?=$account_id?>" />

				<? if ($id || $account_id) $noteditusername = true; ?>
				<? $noteditpassword  = true; ?>
				<? $noteditagree     = true; ?>
				<? if (!($id || $account_id)) $autopw = true; ?>
				<? $sitemgrsection   = true; ?>

				<? include(INCLUDES_DIR."/forms/form_account.php"); ?>
				<? include(INCLUDES_DIR."/forms/form_contact.php"); ?>

							<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
							<input type="hidden" name="letra" value="<?=$letra?>" />
							<input type="hidden" name="screen" value="<?=$screen?>" />
							<button type="submit" value="Submit" class="ui-state-default ui-corner-all"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
							<button type="button" value="Cancel" class="ui-state-default ui-corner-all" onclick="document.getElementById('formaccountcancel').submit();"><?=system_showText(LANG_SITEMGR_CANCEL)?></button>

			</form>
			<form id="formaccountcancel" action="<?=DEFAULT_URL?>/gerenciamento/account/<?=(($search_page) ? "search.php" : "index.php");?>" method="post">

							<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
							<input type="hidden" name="letra" value="<?=$letra?>" />
							<input type="hidden" name="screen" value="<?=$screen?>" />

			</form>
			
			</div>

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