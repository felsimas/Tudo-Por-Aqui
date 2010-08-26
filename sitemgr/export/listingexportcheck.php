<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/export/listingexportcheck.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", FALSE);
	header("Pragma: no-cache");

	if (!$_GET["file"]) {
		mail(EDIR_ADMIN_EMAIL, "[eDirectory] - Export Process", "Error: not get file.");
		exit;
	}

	$filename = IMPORT_FOLDER."/export_".str_replace(".csv", "", $_GET["file"]).".progress";
    
	if (file_exists($filename)) {
		if (!$handle = fopen($filename, "r")) {
			echo system_showText(LANG_SITEMGR_EXPORT_ERRORNUMBER)." 10001<br />".system_showText(LANG_SITEMGR_EXPORT_CONTACTSUPPORT);
		} else {
			$progress = fgets($handle);
			if (!fclose($handle)) {
				echo system_showText(LANG_SITEMGR_EXPORT_ERRORNUMBER)." 10002<br />".system_showText(LANG_SITEMGR_EXPORT_CONTACTSUPPORT);
			} else {
				echo $progress;
			}
		}
	} else {
		echo system_showText(LANG_SITEMGR_EXPORT_ERRORNUMBER)." 10000<br />".system_showText(LANG_SITEMGR_EXPORT_CONTACTSUPPORT);
	}

?>
