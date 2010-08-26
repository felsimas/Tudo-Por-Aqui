<?
	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/review/delete.php
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
	# AUX
	# ----------------------------------------------------------------------------------------------------
	if ($id) {
		$reviewObj = new Review($id);
	}	else {
		$message = urlencode(system_showText(LANG_SITEMGR_REVIEW_NOTFOUND));
		header("Location: ".DEFAULT_URL."/gerenciamento/review/index.php?class=errorMessage&message=".urlencode($message)."&item_type=$item_type".($filter_id ? "&filter_id=1&item_id=$item_id" : '')."&screen=$screen&letra=$letra&item_letra=$item_letra&item_screen=$item_screen");
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		$reviewObj = new Review($id);
		$reviewObj->delete();
		$message = urlencode(system_showText(LANG_SITEMGR_REVIEW_SUCCESSDELETED));
		header("Location: ".DEFAULT_URL."/gerenciamento/review/index.php?message=".urlencode($message)."&item_type=$item_type".($filter_id ? "&filter_id=1&item_id=$item_id" : '')."&screen=$screen&letra=$letra&item_letra=$item_letra&item_screen=$item_screen");
		exit;
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
		
		<div class="baseForm">

		<form name="delete_review" method="post">
			<input type="hidden" name="id"                 value="<?=$id?>" />
			<input type="hidden" name="item_id"            value="<?=$item_id?>" />
			<input type="hidden" name="item_type"          value="<?=$item_type?>" />
			<? if ($filter_id) { ?>
			<input type="hidden" name="filter_id"          value="1" />
			<? } ?>
			<input type="hidden" name="letra"             value="<?=$letra?>" />
			<input type="hidden" name="screen"             value="<?=$screen?>" />
			<input type="hidden" name="item_screen"        value="<?=$item_screen?>" />
			<input type="hidden" name="item_letra"        value="<?=$item_letra?>" />
			<div id="header-form">
				<?=system_showText(LANG_SITEMGR_DELETE)?> <?=ucwords(system_showText(LANG_SITEMGR_REVIEW))?> - <?=($reviewObj->getString("review_title")) ? $reviewObj->getString("review_title") : "N/A";?> - <?=$reviewObj->getString("rating")?> <?=system_showText(LANG_SITEMGR_REVIEW_STAR_PLURAL)?> 
			</div>
			<div class="response-msg inf ui-corner-all">
				<?=system_showText(LANG_SITEMGR_REVIEW_DELETEQUESTION)?>
			</div>
			<button type="submit" value="Submit" class="ui-state-default ui-corner-all"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
			<button type="button" value="Cancel" class="ui-state-default ui-corner-all" onclick="document.getElementById('formreviewdeletecancel').submit();"><?=system_showText(LANG_SITEMGR_CANCEL)?></button>
		</form>
		<form id="formreviewdeletecancel" action="<?=DEFAULT_URL?>/gerenciamento/review/index.php" method="get">
			<input type="hidden" name="item_type"        value="<?=$item_type?>" />
			<? if ($filter_id) { ?>
			<input type="hidden" name="filter_id"          value="1" />
			<input type="hidden" name="item_id"            value="<?=$item_id?>" />
			<? } ?>
			<input type="hidden" name="letra"           value="<?=$letra?>" />
			<input type="hidden" name="screen"           value="<?=$screen?>" />
			<input type="hidden" name="item_screen"      value="<?=$item_screen?>" />
			<input type="hidden" name="item_letra"      value="<?=$item_letra?>" />
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
