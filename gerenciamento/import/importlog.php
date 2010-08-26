<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/import/importlog.php
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

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/header.php");

	# ----------------------------------------------------------------------------------------------------
	# NAVBAR
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/navbar.php");

	$import = new ImportLog();
	$imports = $import->getImports();

?>

<div id="main-right">
	<div id="top-content">
		<div id="header-content">
			<h1><?=system_showText(LANG_SITEMGR_IMPORT_IMPORTLOG)?></h1>
		</div>
	</div>
	<div id="content-content">
		<div class="default-margin" style="padding-top:3px;">

			<? require(EDIRECTORY_ROOT."/gerenciamento/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

			<? include (INCLUDES_DIR."/tables/table_import_submenu.php"); ?>

			<div id="header-export"><?=system_showText(LANG_SITEMGR_IMPORT_IMPORTLOG)?></div>

			<div class="tip-base">
				<p style="text-align: justify;"><a href="<?=DEFAULT_URL;?>/gerenciamento/faq.php?keyword=<?=urlencode("import");?>" target="_blank"><?=system_showText(LANG_SITEMGR_IMPORT_HOMETIP1_3)?></a></p>
			</div>
			
			<br class="clear" />

			<? if ($imports){ ?>

				<ul class="standard-iconDESCRIPTION">
					<li class="rollback-icon"><?=system_showText(LANG_SITEMGR_IMPORT_ROLLBACK)?></li>
					<li class="stop-icon"><?=system_showText(LANG_SITEMGR_IMPORT_STOPIMPORT)?></li>
					<li class="delete-icon"><?=system_showText(LANG_SITEMGR_IMPORT_DELETELOG)?></li>
				</ul>

				<table border="0" cellpadding="2" cellspacing="2" class="standard-tableTOPBLUE" >
					<tr>
						<th width="15px" nowrap="nowrap">&nbsp;</th>
						<th width="130px" nowrap="nowrap"><?=system_showText(LANG_SITEMGR_IMPORT_DATETIME)?></th>
						<th nowrap="nowrap"><?=system_showText(LANG_SITEMGR_IMPORT_FILENAME)?></th>
						<th width="85px" nowrap="nowrap"><?=system_showText(LANG_SITEMGR_IMPORT_ADDEDLINES)?></th>
						<th width="85px" nowrap="nowrap"><?=system_showText(LANG_SITEMGR_IMPORT_TOTALLINES)?></th>
						<th width="100px" nowrap="nowrap"><?=system_showText(LANG_SITEMGR_STATUS)?></th>
						<th width="50px" nowrap="nowrap">&nbsp;</th>
					</tr>
					<? foreach ($imports as $import) include (INCLUDES_DIR."/tables/table_import.php"); ?>
				</table>

			<? } else { ?>
				<div class="response-msg inf ui-corner-all"><?=system_showText(LANG_SITEMGR_IMPORT_LOGS_NORECORD)?></div>
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
