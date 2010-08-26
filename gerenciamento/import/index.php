<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/import/index.php
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

	extract($_GET);
	extract($_POST);

	// upload_max_filesize define and post_max_size define are both in .htaccess
	define(MAX_MB_FILE_SIZE_ALLOWED, 20);

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/header.php");

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/import.php");

	# ----------------------------------------------------------------------------------------------------
	# NAVBAR
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/navbar.php");

?>

<div id="main-right">

	<div id="top-content">
		<div id="header-content">
			<h1><?=ucwords(LANG_SITEMGR_LISTING);?> - <?=ucwords(system_showText(LANG_SITEMGR_IMPORT))?></h1>
		</div>
	</div>

	<div id="content-content">

		<div class="default-margin" style="padding-top:3px;">

			<? require(EDIRECTORY_ROOT."/gerenciamento/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

			<? include (INCLUDES_DIR."/tables/table_import_submenu.php"); ?>

			<div id="header-export"><?=ucwords(LANG_SITEMGR_LISTING);?> - <?=ucwords(system_showText(LANG_SITEMGR_IMPORT))?></div>

			<?
			if ($file) {
				// ================================================================
				// ============================== FILE ============================
				// ================================================================
				?>

				<? if ($file == "uploadbybrowser") { ?>
					<div class="response-msg success ui-corner-all"><?=system_showText(LANG_SITEMGR_IMPORT_SUCCESSUPLOADED1)?> "<?=$uploadname?>" <?=system_showText(LANG_SITEMGR_IMPORT_SUCCESSUPLOADED2)?></div><br />
				<? } else { ?>
					<div class="response-msg success ui-corner-all"><?=system_showText(LANG_SITEMGR_IMPORT_WILLBEIMPORTED1)?> "<?=$uploadname?>" <?=system_showText(LANG_SITEMGR_IMPORT_WILLBEIMPORTED2)?> <?=IMPORT_FOLDER_RELATIVE_PATH?> <?=system_showText(LANG_SITEMGR_IMPORT_WILLBEIMPORTED3)?></div><br />
				<? } ?>

				<div class="response-msg inf ui-corner-all">
					* <?=system_showText(LANG_SITEMGR_IMPORT_HOMETEXT1_1)?><br />
					* <?=system_showText(LANG_SITEMGR_IMPORT_HOMETEXT1_2)?><br />
					* <?=system_showText(LANG_SITEMGR_IMPORT_HOMETEXT1_3)?>
				</div>

				<?
			} else {
				// ================================================================
				// ============================== NO FILE =========================
				// ================================================================
				?>

				<p style="margin-top: 10px;"><?=system_showText(LANG_SITEMGR_IMPORT_HOMETEXT2)?></p>

				<div class="tip-base">

					<h1><?=system_showText(LANG_SITEMGR_IMPORT_HOMETIP1_1)?></h1>

					<p style="text-align: justify;"><strong><?=system_showText(LANG_SITEMGR_IMPORT_HOMETIP1_2)?></strong></p><br />

					<span class="warning" style="text-align: justify;"><a href="<?=DEFAULT_URL;?>/gerenciamento/faq.php?keyword=<?=urlencode("import");?>" target="_blank"><?=system_showText(LANG_SITEMGR_IMPORT_HOMETIP1_3)?></a></span>

					<p style="text-align: justify;"><?=system_showText(LANG_SITEMGR_IMPORT_HOMETIP1_4)?></p>

					<form name="importsample" action="importsample.php" method="post" target="_blank">
						<ul class="standardButton">
							<li><button type="submit"><?=system_showText(LANG_SITEMGR_IMPORT_HOMETIP1_5)?></button></li>
						</ul>
					</form>

				</div>
				<table class="standard-table" style="margin-top: 20px;">
					<tr>
						<td class="standard-tablenote" style="text-align: justify;">
							<?
							if ($import_from_export) {
							?>
							<b><?=system_showText(LANG_SITEMGR_IMPORT_FROMEXPORT)?></b><br /><?
							}
							?>
							<?
							if ($import_enable_listing_active) {
								?><?=system_showText(LANG_SITEMGR_IMPORT_ALLIMPORTEDASACTIVE)?><br /><?
							}
							?>
							<?=system_showText(LANG_SITEMGR_IMPORT_DEFAULTLEVELSETTO)?> <b><?=$levelObj->showLevel($import_defaultlevel)?></b>.<br />
							<?
							if ($import_sameaccount) {
								$sameAccountObj = new Account($import_account_id);
								?><?=system_showText(LANG_SITEMGR_IMPORT_IMPORTEDSAMEACCOUNT)?> <b><?=$sameAccountObj->getString('username')?></b>.<br /><?
							} else {
								?><?=system_showText(LANG_SITEMGR_IMPORT_LISTINGWILLBEASSOCIATESEPARATEACCOUNT)?><br /><?
							}
							?>
						</td>
					</tr>
				</table>

				<a href="<?=DEFAULT_URL?>/gerenciamento/prefs/import.php" class="standardLINK" style="text-align: center;"><?=system_showText(LANG_SITEMGR_IMPORT_CLICKHERE_TOCHANGETHESESETTINGS)?></a>

				<br /><hr style="width: 90%"><br />

				<p style="padding-top: 10px;"><strong><?=system_showText(LANG_SITEMGR_IMPORT_UPLOAD_YOURCSVFILEUSINGTHEFORMBELOW)?></strong> <?=system_showText(LANG_SITEMGR_IMPORT_AFTERUPLOAD_FOLLOWTHEPROCCESS)?></p>

				<p style="padding-top: 10px;"><strong><?=system_showText(LANG_SITEMGR_IMPORT_MAXFILESIZE_ALLOWED)?></strong> <?=MAX_MB_FILE_SIZE_ALLOWED;?> MB.</p>

				<form name="byfile" method="post" enctype="multipart/form-data" action="index.php">

					<?=(($messageErrorUpload) ? ("<p class=\"errorMessage\">$messageErrorUpload</p>") : (""));?>
					<center>
						<input type="file" name="file" class="inputButtonFile" />
						<button type="submit" class="ui-state-default ui-corner-all" value="<?=system_showText(LANG_SITEMGR_IMPORT_IMPORTTHISFILE)?>" style="width:150px;"><?=system_showText(LANG_SITEMGR_IMPORT_IMPORTTHISFILE)?></button>
						<input type="hidden" name="fileupload" value="1" />
					</center>

				</form>

				<br /><hr style="width: 90%"><br />

				<p style="padding-top: 10px;"><strong><?=system_showText(LANG_SITEMGR_IMPORT_ORYOUCANUPLOADAT)?></strong> <?=IMPORT_FOLDER_RELATIVE_PATH?></p>

				<p style="padding-top: 10px;"><?=system_showText(LANG_SITEMGR_IMPORT_AFTERUPLOAD_FOLLOWTHEPROCCESS)?></p>

				<p style="padding-top: 10px;"><strong><?=system_showText(LANG_SITEMGR_IMPORT_USEFORMTHEFORMBELLOW)?></strong></p>

				<form name="byftp" method="post" enctype="multipart/form-data" action="index.php">

					<?=(($messageErrorFTPUpload) ? ("<p class=\"errorMessage\">$messageErrorFTPUpload</p>") : (""));?>
					<center>
						<span class="warning"><?=system_showText(LANG_SITEMGR_EXPORT_EXPORTLISTING_FILENAME)?></span>
						<input type="text" name="filename" class="inputButtonFile" style="width: 250px;" />
						<button type="submit" style="width:150px;" value="File Name" class="ui-state-default ui-corner-all"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
						<input type="hidden" name="ftpupload" value="1" />
					</center>

				</form>

				<br /><hr style="width: 90%"><br />

				<?
			}
			?>

		</div>

	</div>

	<div id="bottom-content">&nbsp;</div>

</div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>
