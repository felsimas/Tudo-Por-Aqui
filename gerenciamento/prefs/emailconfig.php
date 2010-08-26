<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/prefs/emailconfig.php
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

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);

	if ($ajaxVerify == 1) {

		require_once(CLASSES_DIR.'/class_json.php');

		$json = new Services_JSON();

		$return_json = array();

		$str_server = ($emailconf_protocol ? $emailconf_protocol.'://' : '').$emailconf_host;
        
        //Getting tbe language for phpmailing
        $edirmailer = new EDirMailer();
        $lang = $edirmailer->getLang();
        
		$mail = new PHPMailer();
		$mail->SetLanguage($lang, CLASSES_DIR.'/phpmailer/language/');
		$mail->IsHTML(false);
		$mail->Mailer = "smtp";
		$mail->Port   = $emailconf_port;
		$mail->Host   = $str_server;
		if ($emailconf_auth == 'normal' || $emailconf_auth == 'secure') {
			$mail->SMTPAuth = true;
			$mail->Username = trim($emailconf_username);
			$mail->Password = trim($emailconf_password);
		} else {
			$mail->SMTPAuth = false;
		}
		$mail->From    = trim($emailconf_email);
		$mail->Subject = EDIRECTORY_TITLE." - Config SMTP Email";
		$mail->Body    = EDIRECTORY_TITLE." - Config SMTP Email";
		$mail->AddAddress(trim($emailconf_email));

		if ($mail->Send()) {
			$return_json['status'] = 'success';
		} else {
			$return_json['status'] = 'failed';
			$return_json['msg_error'] = utf8_encode($mail->ErrorInfo);
			if ($mail->smtp->error['error']) {
				$return_json['msg_error'] .= ' ('.utf8_encode($mail->smtp->error['error']).')';
			}
		}

		die($json->encode($return_json));

	}

	// Default CSS class for message
	$message_style = "errorMessage";

	if ($_SERVER['REQUEST_METHOD'] == "POST") {

		$error = false;

		$emailconf_method = str_replace(" ", "", $emailconf_method);
		if (!setting_set("emailconf_method", $emailconf_method)) {
			if (!setting_new("emailconf_method", $emailconf_method)) {
				$error = true;
			}
		}

		$emailconf_host = str_replace(" ", "", $emailconf_host);
		if (!setting_set("emailconf_host", $emailconf_host)) {
			if (!setting_new("emailconf_host", $emailconf_host)) {
				$error = true;
			}
		}

		$emailconf_port = str_replace(" ", "", $emailconf_port);
		if (!setting_set("emailconf_port", $emailconf_port)) {
			if (!setting_new("emailconf_port", $emailconf_port)) {
				$error = true;
			}
		}

		$emailconf_auth = str_replace(" ", "", $emailconf_auth);
		if (!setting_set("emailconf_auth", $emailconf_auth)) {
			if (!setting_new("emailconf_auth", $emailconf_auth)) {
				$error = true;
			}
		}

		$emailconf_email = str_replace(" ", "", $emailconf_email);
		if (!setting_set("emailconf_email", $emailconf_email)) {
			if (!setting_new("emailconf_email", $emailconf_email)) {
				$error = true;
			}
		}

		$emailconf_username = str_replace(" ", "", $emailconf_username);
		if (!setting_set("emailconf_username", $emailconf_username)) {
			if (!setting_new("emailconf_username", $emailconf_username)) {
				$error = true;
			}
		}

		if (isset($emailconf_password) && trim($emailconf_password) != "") {
			$emailconf_password = crypt_encrypt(str_replace(" ", "", $emailconf_password));
			if (!setting_set("emailconf_password", $emailconf_password)) {
				if (!setting_new("emailconf_password", $emailconf_password)) {
					$error = true;
				}
			}	
		}

		if (!$error) {
			$actions[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_SETTINGS_YOURSETTINGSWERECHANGED);
			$message_style = "successMessage";
		} else {
			$actions[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_SYSTEMERROR);
		}

		if($actions) {
			$message_confemail .= implode("<br />", $actions);
		}

	}

	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------
	if (!$emailconf_method) setting_get("emailconf_method", $emailconf_method);
	if (!$emailconf_host) setting_get("emailconf_host", $emailconf_host);
	if (!$emailconf_port) setting_get("emailconf_port", $emailconf_port);
	if (!$emailconf_auth) setting_get("emailconf_auth", $emailconf_auth);
	if (!$emailconf_auth) $emailconf_auth = 'normal';
	if (!$emailconf_email) setting_get("emailconf_email", $emailconf_email);
	if (!$emailconf_username) setting_get("emailconf_username", $emailconf_username);
	if (!$emailconf_password) setting_get("emailconf_password", $emailconf_password);

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/header_manager.php");


?>

<script src="<?=DEFAULT_URL.'/scripts/jquery.js'?>" type="text/javascript"></script>
<script type="text/javascript">
	<!--
	//top variables
	html_testconn = "<a href=\"javascript:void(0)\" onclick=\"doVerifyConnect()\"><img src=\"<?=DEFAULT_URL.'/gerenciamento/images/icon_connection.png'?>\" border=\"0\"> <?=system_showText(LANG_SITEMGR_SETTINGS_EMAILCONF_CLICKHERETOTEST)?></a> (<?=system_showText(LANG_SITEMGR_SETTINGS_EMAILCONF_PLEASEDOTHISBEFORESAVE)?>)";
	html_animloading = "<img src=\"<?=DEFAULT_URL.'/gerenciamento/images/anim_ajaxloading.gif'?>\" border=\"0\" align=\"absmiddle\" />";
	radiovalues = {'normal':1,'secure':2,'noauth':3};
	function initForm() {
		switchAuth('<?=$emailconf_auth?>');
		$('#response').html(html_testconn);
	}
	$("document").ready(initForm);
	function changeMethod() {
		if ($('#method').attr('value') == 'smtp') {
			$('#form-smtp').css('display', 'block');
			$("#bt_submit").attr('disabled', 'disabled');
			$("#bt_submit").attr('class','ui-state-default ui-corner-all ui-state-default ui-corner-all-disabled');
		} else {
			$('#form-smtp').css('display', 'none');
			$("#bt_submit").attr('disabled', '');
			$("#bt_submit").attr('class','ui-state-default ui-corner-all');
		}
	}
	function switchAuth(auth) {
		array_default_ports = new Array('25', '465'); /* normal, secure (ssl/tls) */
		$("#auth"+radiovalues[auth]).attr('checked', true);
		if (auth == 'normal' || auth == 'secure') {
			$('#username').attr('disabled', false);
			$('#password').attr('disabled', false);
			$('#username').attr('className', '');
			$('#password').attr('className', '');
		} else {
			$('#username').attr('disabled', true);
			$('#password').attr('disabled', true);
			$('#username').attr('className', 'inputReadOnly');
			$('#password').attr('className', 'inputReadOnly');
		}
		if (auth == 'secure') {
			$('#port').attr('value', array_default_ports[1]);
			$('#protocol').attr('value', 'ssl');
		} else { 
			$('#port').attr('value', array_default_ports[0]);
			$('#protocol').attr('value', '');
		}
	}
	function isValidEmail (email_str) {
		var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
		return emailPattern.test(email_str);
	}
	function emailChange(email) {
		bufferHtml = "";
		if (email != "") {
			if (isValidEmail(email)) {
				bufferHtml = "<img src=\"<?=DEFAULT_URL.'/gerenciamento/images/icon_accept.gif'?>\" border=\"0\" align=\"absmiddle\" />";
			} else {
				bufferHtml = "<img src=\"<?=DEFAULT_URL.'/gerenciamento/images/icon_reject.gif'?>\" border=\"0\" align=\"absmiddle\" />";
			}
		}
		$('#email_status').html(bufferHtml);
	}
	function emailBlur(form) {
		if (isValidEmail($('#email').attr('value')) && $('#username').attr('value') == "") {
			if (!$('#username').attr('disabled')) $('#username').attr('value', $('#email').attr('value'));
		}
		emailChange($('#email').attr('value'));
	}
	function validateForm() {
		if ($("#emailconf_method").attr("value") == 'smtp') {
			if ($.trim($("#host").attr("value")) == "") {
				alert('<?=system_showText(LANG_SITEMGR_SETTINGS_EMAILCONF_MSGERROR_SERVERFIELD)?>');
				$("#host").focus();
				return false;
			}
			if ($.trim($("#port").attr("value")) == "") {
				alert('<?=system_showText(LANG_SITEMGR_SETTINGS_EMAILCONF_MSGERROR_PORTFIELD)?>');
				$("#port").focus();
				return false;
			}
			if ($.trim($("#email").attr("value")) == "") {
				alert('<?=system_showText(LANG_SITEMGR_SETTINGS_EMAILCONF_MSGERROR_EMAILFIELD)?>');
				$("#email").focus();
				return false;
			}
			if (!$('#auth3').attr("checked")) {
				if ($.trim($("#username").attr("value")) == "") {
					alert('<?=system_showText(LANG_SITEMGR_SETTINGS_EMAILCONF_MSGERROR_USERNAMEFIELD)?>');
					$("#username").focus();
					return false;
				}
				if ($.trim($("#password").attr("value")) == "") {
					alert('<?=system_showText(LANG_SITEMGR_SETTINGS_EMAILCONF_MSGERROR_PASSWORDFIELD)?>');
					$("#password").focus();
					return false;
				}
			}
		}
		return true;
	}
	function doVerifyConnect() {
		if (!validateForm()) return false;
		$("#divSubmit").css('display', 'none');
		$("#response").css('display', 'block');
		$("#response").html(html_animloading);
		$.getJSON('<?=$_SERVER['PHP_SELF']?>', $('#adminemail').serialize(), doVerifyConnect_onload);
	}
	function doVerifyConnect_onload(data, textStatus) {
		$("#response").css('display', 'none');
		if (textStatus == 'success') {
			if (data.status == 'success') {
				$("#response").html('<p class="successMessage" style="margin-left:0px;"><?=system_showText(LANG_SITEMGR_SETTINGS_EMAILCONF_CONNECTEDSUCCESS)?></p>');
				$("#divSubmit").css('display', 'block');
				$("#bt_submit").attr('disabled', '');
				$("#bt_submit").attr('class','ui-state-default ui-corner-all');
			} else {
				$("#response").html('<p class="errorMessage" style="margin-left:0px;"><?=system_showText(LANG_SITEMGR_SETTINGS_EMAILCONF_MSGERROR_ERRORWHILETESTCONNECTION)?><br />'+data.msg_error+'</p>');$("#divSubmit").css('display', 'none');
				$("#bt_submit").attr('disabled', 'disabled');
				$("#bt_submit").attr('class','ui-state-default ui-corner-all ui-state-default ui-corner-all-disabled');
			}
		}
		$("#response").fadeIn('slow', function() {window.setTimeout(function() {$("#response").fadeOut('slow', function() { $('#response').html(html_testconn); $('#response').fadeIn('normal'); } );}, 2500)});
	}
	function submitForm() {
		$("#ajaxVerify").attr('value', 0);
		if (!validateForm()) return false;
		return true;
	}
	-->
</script>

<div id="page-wrapper">

	<div id="main-wrapper">
	
	<?php 	include(SM_EDIRECTORY_ROOT."/menu.php"); ?>
	
		<div id="main-content"> 

			<div class="page-title ui-widget-content ui-corner-all">

				<div class="other_content">

			<? require(EDIRECTORY_ROOT."/gerenciamento/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

			<? include(INCLUDES_DIR."/tables/table_prefs_submenu.php"); ?>

			<br />

			<form name="adminemail" id="adminemail" action="<?=$_SERVER["PHP_SELF"]?>" method="post" onsubmit="return submitForm()">
				<? include(INCLUDES_DIR."/forms/form_adminemailconfig.php"); ?>
				<input type="hidden" name="ajaxVerify" id="ajaxVerify" value="1" />
			</form>

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
