<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/layout/header.php
	# ----------------------------------------------------------------------------------------------------

	header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

	<head>

		<?
		customtext_get("header_title", $headertag_title);
		$headertag_title = (($headertag_title) ? ($headertag_title) : (EDIRECTORY_TITLE));
		?>
		<title><?=$headertag_title?></title>

		<meta name="author" content="Sis Dir 2009 - Classificados">

		<meta http-equiv="Content-Type" content="text/html; charset=<?=EDIR_CHARSET;?>">

		<meta name="ROBOTS" content="noindex, nofollow">

		<?=system_getNoImageStyle($cssfile = true);?>

		<link href="<?=DEFAULT_URL?>/gerenciamento/layout/general_sitemgr.css" rel="stylesheet" type="text/css">

        <script language="JavaScript" src="<?=DEFAULT_URL?>/scripts/common.js"></script>
		<script language="javascript" src="<?=DEFAULT_URL?>/scripts/lang.js.php"></script>
		<script language="JavaScript" src="<?=DEFAULT_URL?>/scripts/location.js"></script>

		<? if (DEFAULT_DATE_FORMAT == "m/d/Y") { ?>
			<script language="JavaScript" src="<?=DEFAULT_URL?>/scripts/calendarmdy.js"></script>
		<? } elseif (DEFAULT_DATE_FORMAT == "d/m/Y") { ?>
			<script language="JavaScript" src="<?=DEFAULT_URL?>/scripts/calendardmy.js"></script>
		<? } ?>

		<? //Clear Searchs ?>
		<script>
			function searchResetSitemgr(form) {
				tot = form.elements.length;
				for (i=0;i<tot;i++) {
					if (form.elements[i].type == 'text') {
						form.elements[i].value = "";
					} else if (form.elements[i].type == 'checkbox' || form.elements[i].type == 'radio') {
						form.elements[i].checked = false;
					} else if (form.elements[i].type == 'select-one') {
						form.elements[i].selectedIndex = 0;
					}
				}
			}
		</script>


	</head>

	<body>

		<div class="topNavbar">
			<div class="wrapper">
				<? include(EDIRECTORY_ROOT."/layout/langnavbar.php"); ?>
			</div>
		</div>

		<div class="wrapper">

			<div class="header">

				<div class="logo"><a href="<?=DEFAULT_URL?>/gerenciamento/index.php" class="logoLink" target="_parent" title="<?=EDIRECTORY_TITLE?>">&nbsp;</a></div>

				<blockquote class="eDirectoryVersion"><?=VERSION?></blockquote>

				<? if (strpos($_SERVER["PHP_SELF"], "registration.php") === false) { ?>
					<ul class="headerNav">
						<? if ($_SESSION[SM_LOGGEDIN] == true) { ?>
							<li><a href="<?=DEFAULT_URL?>/gerenciamento/"><?=system_showText(LANG_SITEMGR_MENU_HOME);?></a></li>
							<li><a href="<?=DEFAULT_URL?>/gerenciamento/manageaccount.php"><?=system_showText(LANG_SITEMGR_MENU_MYACCOUNT)?></a></li>
							<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_SETTINGS)) { ?>
								<li><a href="<?=DEFAULT_URL?>/gerenciamento/prefs/"><?=system_showText(LANG_SITEMGR_MENU_SETTINGS)?></a></li>
							<? } ?>
							<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_EMAILNOTIFICATIONS)) { ?>
								<li><a href="<?=DEFAULT_URL?>/gerenciamento/emailnotifications/"><?=system_showText(LANG_SITEMGR_MENU_EMAILNOTIF)?></a></li>
							<? } ?>
							<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_SITECONTENT)) { ?>
								<li><a href="<?=DEFAULT_URL?>/gerenciamento/content/index.php"><?=system_showText(LANG_SITEMGR_MENU_SITECONTENT)?></a></li>
							<? } ?>
							<li><a href="javascript:void(0);" onClick="window.open('<?=DEFAULT_URL?>/gerenciamento/about.php', '_blank', 'toolbar=0, location=0, directories=0, status=0, width=500, height=650, screenX=0, screenY=0, menubar=0, no-resizable, scrollbars=yes');"><?=system_showText(LANG_SITEMGR_MENU_ABOUT)?></a></li>
							<li><a href="<?=DEFAULT_URL?>/gerenciamento/faq.php?keyword=" target="_blank"><?=system_showText(LANG_SITEMGR_MENU_FAQ)?></a></li>
							<li><a href="<?=DEFAULT_URL?>/gerenciamento/logout.php"><?=system_showText(LANG_SITEMGR_MENU_LOGOUT)?></a></li>
						<? } ?>
					</ul>
				<? } ?>

			</div>

			<div class="content">
