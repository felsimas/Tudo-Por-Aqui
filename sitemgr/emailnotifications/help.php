<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/emailnotifications/help.php
	# ----------------------------------------------------------------------------------------------------
    header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);
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
	# DEFAULT
	# ----------------------------------------------------------------------------------------------------

	$defaultVAR = array	(
		array("variable" => "ACCOUNT_NAME",				"description" => system_showText(LANG_SITEMGR_EMAILNOTIFICATION_VAR_ACCOUNT_NAME_HELP)),
		array("variable" => "ACCOUNT_USERNAME",			"description" => system_showText(LANG_SITEMGR_EMAILNOTIFICATION_VAR_ACCOUNT_USERNAME_HELP)),
		array("variable" => "ACCOUNT_PASSWORD",			"description" => system_showText(LANG_SITEMGR_EMAILNOTIFICATION_VAR_ACCOUNT_PASSWORD_HELP)),
		array("variable" => "KEY_ACCOUNT",				"description" => system_showText(LANG_SITEMGR_EMAILNOTIFICATION_VAR_KEY_ACCOUNT_HELP)),
		array("variable" => "DEFAULT_URL",				"description" => system_showText(LANG_SITEMGR_EMAILNOTIFICATION_VAR_DEFAULTURL_HELP)." (\"".DEFAULT_URL."\")."),
		array("variable" => "SITEMGR_EMAIL",			"description" => system_showText(LANG_SITEMGR_EMAILNOTIFICATION_VAR_SITEMGR_EMAIL_HELP)),
		array("variable" => "EDIRECTORY_TITLE",			"description" => system_showText(LANG_SITEMGR_EMAILNOTIFICATION_VAR_EDIRECTORY_TITLE_HELP)." (".EDIRECTORY_TITLE.")."),
		array("variable" => "LISTING_TITLE",			"description" => system_showText(LANG_SITEMGR_TITLE)." (\"".system_showText(LANG_SITEMGR_EMAILNOTIFICATION_VAR_LISTING_TITLE)."\")."),
		array("variable" => "EVENT_TITLE",				"description" => system_showText(LANG_SITEMGR_TITLE)." (\"".system_showText(LANG_SITEMGR_EMAILNOTIFICATION_VAR_EVENT_TITLE)."\")."),
		array("variable" => "BANNER_TITLE",				"description" => system_showText(LANG_SITEMGR_TITLE)." (\"".system_showText(LANG_SITEMGR_EMAILNOTIFICATION_VAR_BANNER_TITLE)."\")."),
		array("variable" => "CLASSIFIED_TITLE",			"description" => system_showText(LANG_SITEMGR_TITLE)." (\"".system_showText(LANG_SITEMGR_EMAILNOTIFICATION_VAR_CLASSIFIED_TITLE)."\")."),
		array("variable" => "ARTICLE_TITLE",			"description" => system_showText(LANG_SITEMGR_TITLE)." (\"".system_showText(LANG_SITEMGR_EMAILNOTIFICATION_VAR_ARTICLE_TITLE)."\")."),
		array("variable" => "LISTING_RENEWAL_DATE",		"description" => system_showText(LANG_SITEMGR_EMAILNOTIFICATION_VAR_LISTING_RENEWAL_DATE_HELP)),
		array("variable" => "DAYS_INTERVAL",			"description" => system_showText(LANG_SITEMGR_EMAILNOTIFICATION_VAR_DAYS_INTERVAL)),
		array("variable" => "CUSTOM_INVOICE_AMOUNT",	"description" => system_showText(LANG_SITEMGR_EMAILNOTIFICATION_VAR_CUSTOM_INVOICE_AMOUNT)),
		array("variable" => "ITEM_TITLE",				"description" => system_showText(LANG_SITEMGR_TITLE)." (\"".system_showText(LANG_SITEMGR_EMAILNOTIFICATION_VAR_ITEM_TITLE)."\")."),
		array("variable" => "ITEM_URL",					"description" => DEFAULT_URL."/item/title.html")
		);

	# ----------------------------------------------------------------------------------------------------
	# TABLE CONTENT
	# ----------------------------------------------------------------------------------------------------

	if($_REQUEST['id']){

		$id = $_REQUEST['id'];

		if ($id < 5) {

			$variables = array($defaultVAR[0], $defaultVAR[1], $defaultVAR[4], $defaultVAR[5], $defaultVAR[6], $defaultVAR[12], $defaultVAR[13]);

		} elseif ($id == 5) {

			$variables = array($defaultVAR[0], $defaultVAR[1], $defaultVAR[2], $defaultVAR[4], $defaultVAR[5], $defaultVAR[6]);

		} elseif ($id == 7) {

			$variables = array($defaultVAR[0], $defaultVAR[1], $defaultVAR[3], $defaultVAR[4], $defaultVAR[5], $defaultVAR[6]);

		} elseif ($id < 8) {

			$variables = array($defaultVAR[0], $defaultVAR[1], $defaultVAR[4], $defaultVAR[5], $defaultVAR[6]);

		} elseif ($id == 13) {

			$variables = array($defaultVAR[0], $defaultVAR[1], $defaultVAR[4], $defaultVAR[5], $defaultVAR[6], $defaultVAR[14]);

		} elseif ($id < 19) {

			$variables = array($defaultVAR[0], $defaultVAR[1], $defaultVAR[4], $defaultVAR[5], $defaultVAR[6]);

		} elseif ($id == 19) {

			$variables = array($defaultVAR[6], $defaultVAR[15], $defaultVAR[16]);
			array_push($variables, $defaultVAR[$id-1]);

		} elseif ($id <= 24) {

			$variables = array($defaultVAR[0], $defaultVAR[1], $defaultVAR[2], $defaultVAR[4], $defaultVAR[6]);
			array_push($variables, $defaultVAR[$id-1]);

		} else {

			$variables = array($defaultVAR[0], $defaultVAR[1], $defaultVAR[4], $defaultVAR[5], $defaultVAR[6]);
			array_push($variables, $defaultVAR[$id-1]);

		}

	}

?>

<html>

    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

    <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	
    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=<?=EDIR_CHARSET;?>">
        
		<style type="text/css">
			body
			{
				position: relative;
			}
			div
			{
				width: auto;
				margin: 0px;
				padding: 0px;
			}
			.default_title
			{
				font-family: Verdana, Arial, Helvetica, sans-serif;
				font-size: 10pt;
				font-weight: bold;
				color: #003365;
				clear: both;
				width: 500px;
				padding: 10px;
			}
			.default_text_settings 
			{
				font-family: Verdana, Arial, Sans-Serif;
				font-size: 8pt;
				color: #3B4B5B;
				text-align: justify;
				margin-top: 10px;
				background: #FBFBFB;
				border: 1px solid #E9E9E9;
			}
			.default_text_settings th
			{
				text-align: right;
				vertical-align: top;
			}
			.default_text
			{
				font-family: Verdana, Arial, Sans-Serif;
				font-size: 8pt;
				color: #3B4B5B;
				text-align: justify;
				float: left;
				width: 450px;
			}
			.default_button 
			{
				float: right;
			}
		</style>

	</head>

	<body>

		<div>
			<div class="default_text">
				<?=system_showText(LANG_SITEMGR_EMAILNOTIFICATION_HELP_USEVARIABLES)?>
			</div>
			<div class="default_button">
				<input type="button" name="close" value="<?=system_showText(LANG_SITEMGR_CLOSE)?>" onClick="javascrip: window.close();" />
			</div>
			<div class="default_title">
				<?=system_showText(LANG_SITEMGR_EMAILNOTIFICATION_HELP_VARIABLESDESCRIPTION)?>
			</div>
		</div>

		<div>
			<table border="0" cellpadding="2" cellspacing="2" class="default_text_settings">
			<? if ($variables) { ?>
				<? foreach ($variables as $var) { ?>
					<tr>
						<th><?=$var["variable"]?></th>
						<td><?=$var["description"]?></td>
					</tr>
				<? } ?>
			<? } ?>
			</table>
		</div>

	</body>

</html>
