<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/import/rollback.php
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
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_GET);
	extract($_POST);
	if ($id) {
		$import = new ImportLog($id);
		if (($import->getString("status")!="F") && ($import->getString("status")!="S")) {
			header("Location: ".DEFAULT_URL."/gerenciamento/import/importlog.php");
			exit;
		}
	} else {
		header("Location: ".DEFAULT_URL."/gerenciamento/import/importlog.php");
		exit;
	}
	$rollback = false;

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if (($_SERVER["REQUEST_METHOD"] == "POST") && $confirmrollback && $id) {
		$db = db_getDBObject();
		$import = new ImportLog($_POST["id"]);
		$import->setString("status", "C");
		$import->save();
		$import->setHistory(system_showText(LANG_SITEMGR_IMPORT_PROCCESSCANCELLED));
		$num_listings = 0;
		$sql = "SELECT * FROM Listing WHERE importID = ".db_formatNumber($import->getNumber("id"))."";
		$result = $db->query($sql);
		if ($result) {
			while ($row = mysql_fetch_assoc($result)) {
				$listingObj = new Listing($row["id"]);
				if ($listingObj->getNumber("id") > 0) {
					$listingObj->Delete();
					$num_listings++;
				}
			}
		}
		$import->setHistory($num_listings." ".(($num_listings!=1)?(LANG_SITEMGR_LISTING_PLURAL):(LANG_SITEMGR_LISTING))." ".system_showText(LANG_SITEMGR_IMPORT_ROLLEDBACK).".");
		$num_accounts = 0;
		$sql = "SELECT * FROM Account WHERE importID = ".db_formatNumber($import->getNumber("id"))."";
		$result = $db->query($sql);
		if ($result) {
			while ($row = mysql_fetch_assoc($result)) {
				$accountObj = new Account($row["id"]);
				if ($accountObj->getNumber("id") > 0) {
					$accountObj->Delete();
					$num_accounts++;
				}
			}
		}
		$import->setHistory($num_accounts." account".(($num_accounts!=1)?("s"):(""))." ".system_showText(LANG_SITEMGR_IMPORT_ROLLEDBACK).".");
		$import->setHistory(system_showText(LANG_SITEMGR_IMPORT_ROLLBACKDONE).".");
		$rollback = true;
	}

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/header.php");

	# ----------------------------------------------------------------------------------------------------
	# NAVBAR
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/navbar.php");

?>

<div id="main-right">

	<div id="top-content">
		<div id="header-content">
			<h1><?=system_showText(LANG_SITEMGR_IMPORT_IMPORTROLLBACK)?></h1>
		</div>
	</div>

	<div id="content-content">

		<div class="default-margin">

			<? require(EDIRECTORY_ROOT."/gerenciamento/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

			<? if (!$rollback) { ?>
			
			<div class="baseForm">

				<form action="<?=DEFAULT_URL?>/gerenciamento/import/rollback.php" method="post">

					<input type="hidden" name="id" value="<?=$id?>" />

					<div id="header-form">
						<?=system_showText(LANG_SITEMGR_IMPORT_ROLLBACK_MSGSTATUS1_1)?> "<?=$import->getString("filename")?>" <?=system_showText(LANG_SITEMGR_IMPORT_ROLLBACK_MSGSTATUS1_2)?> <?=format_date($import->getString("date"))?> <?=system_showText(LANG_SITEMGR_IMPORT_ROLLBACK_MSGSTATUS1_3)?> <?=($import->getString("time"))?>
					</div>

					<p class="label">
						<?
						$db = db_getDBObject();
						$sql = "SELECT count(id) FROM Account WHERE importID = ".db_formatNumber($_GET["id"]);
						$result = $db->query($sql);
						$accounts_imported = 0;
						if ($result) {
							$row = mysql_fetch_array($result);
							$accounts_imported = $row[0];
						}
						$sql = "SELECT count(id) FROM Listing WHERE importID = ".db_formatNumber($_GET["id"]);
						$result = $db->query($sql);
						$listings_imported = 0;
						if ($result) {
							$row = mysql_fetch_array($result);
							$listings_imported = $row[0];
						}
						?>
						<?=system_showText(LANG_SITEMGR_IMPORT_THISIMPORTHASADDED)?> <?=$accounts_imported;?> <?=(($accounts_imported!=1)?(system_showText(LANG_SITEMGR_ACCOUNT_PLURAL)):(system_showText(LANG_SITEMGR_ACCOUNT)));?> <?=system_showText(LANG_SITEMGR_AND)?> <?=$listings_imported;?> <?=(($listings_imported!=1)?(LANG_SITEMGR_LISTING_PLURAL):(LANG_SITEMGR_LISTING));?>.
					</p>

					<div class="response-msg inf ui-corner-all">
						<? if (($accounts_imported > 0) || ($listings_imported > 0)) { ?>
							<?=system_showText(LANG_SITEMGR_IMPORT_ROLLBACKQUESTION)?>
						<? } else  {?>
							<?=system_showText(LANG_SITEMGR_IMPORT_ROLLBACK_NORECORD)?>
						<? }?>
					</div>

					<input type="hidden" name="id" value="<?=$id?>" />
					<input type="hidden" name="confirmrollback" value="1" />
					<button type="submit" value="Submit" class="ui-state-default ui-corner-all"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
					<button type="button" value="Cancel" class="ui-state-default ui-corner-all" onclick="document.getElementById('formimportrollbakccancel').submit();"><?=system_showText(LANG_SITEMGR_CANCEL)?></button>

				</form>
				<form id="formimportrollbakccancel" action="<?=DEFAULT_URL?>/gerenciamento/import/importlog.php" method="post">
				</form>
				
				</div>

			<? } else { ?>

				<div id="header-form">
					<?=system_showText(LANG_SITEMGR_IMPORT_ROLLBACK_FINISHMSG1)?> "<?=$import->getString("filename")?>" <?=system_showText(LANG_SITEMGR_IMPORT_ROLLBACK_FINISHMSG2)?> <?=format_date($import->getString("date"))?> <?=system_showText(LANG_SITEMGR_IMPORT_ROLLBACK_FINISHMSG3)?> <?=($import->getString("time"))?>
				</div>
				<p class="successMessage">
					<?=system_showText(LANG_SITEMGR_IMPORT_ROLLBACK_FINISHMSG)?>
				</p>
				<div class="baseForm">
				<form action="<?=DEFAULT_URL?>/gerenciamento/import/importlog.php" method="post">
						<button type="submit" title="back" value="Back" class="ui-state-default ui-corner-all"><?=system_showText(LANG_SITEMGR_BACK)?></button>
				</form>
				</div>

			<? } ?>

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
