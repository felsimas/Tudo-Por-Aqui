<?
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSession();

	extract($_GET);
	extract($_POST);

	$url_redirect = "".DEFAULT_URL."/membros/listing";
	$url_base = "".DEFAULT_URL."/membros";
	$membros = 1;

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	if ($id) {
		$listing = new Listing($id);
		if (sess_getAccountIdFromSession() != $listing->getNumber("account_id")) {
			header("Location: ".DEFAULT_URL."/membros/listing/index.php?screen=$screen&letra=$letra");
			exit;
		}
		$listing->extract();
	}

	extract($_POST);
	extract($_GET);

	$levelObj = new ListingLevel();
	if ($level) {
		$levelArray[$levelObj->getLevel($level)] = $level;
	} else {
		$levelArray[$levelObj->getLevel($levelObj->getDefaultLevel())] = $levelObj->getDefaultLevel();
	}

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		if (($id) && ($listing)) {
			if ($_POST["level"] && ($_POST["level"] != $listing->getNumber("level"))) {
				$status = new ItemStatus();
				$listing->setString("status", $status->getDefaultStatus());
				$listing->setDate("renewal_date", "00/00/0000");
			}
			$listing->setString("level", $_POST["level"]);
			$listing->setNumber("listingtemplate_id", $_POST["listingtemplate_id"]);
			$listing->Save();
			header("Location: ".DEFAULT_URL."/membros/listing/index.php?screen=$screen&letra=$letra");
			exit;
		} else {
			header("Location: ".DEFAULT_URL."/membros/listing/listing.php?level=".$_POST["level"]."&listingtemplate_id=".$_POST["listingtemplate_id"]);
			exit;
		}
	}

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/header_members.php");
	
	# ----------------------------------------------------------------------------------------------------
	# NAVBAR
	# ----------------------------------------------------------------------------------------------------

?>

<div id="page-wrapper">

		<div id="main-wrapper">
		<?php 	include(MEMBERS_EDIRECTORY_ROOT."/menu.php"); ?>
		
			<div id="main-content"> 

				
				<div class="page-title ui-widget-content ui-corner-all">

					<div class="other_content">
				<? require(EDIRECTORY_ROOT."/gerenciamento/registration.php"); ?>
				<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
				<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

				<div id="header-form"><?=system_highlightLastWord(system_showText(LANG_LISTING_LEVEL));?> <span><? if (($listing) && ($listing->getString("title"))) echo "- ".$listing->getString("title"); ?></span></div>

				<form name="listinglevel" action="<?=$_SERVER["PHP_SELF"]?>" method="post" enctype="multipart/form-data">
					<input type="hidden" name="id" value="<?=$id?>" />
					<input type="hidden" name="screen" value="<?=$screen?>" />
					<input type="hidden" name="letra" value="<?=$letra?>" />
					<? include(INCLUDES_DIR."/forms/form_listinglevel.php"); ?>
				</form>

				<form action="<?=DEFAULT_URL?>/membros/listing/index.php" method="post">

					<input type="hidden" name="screen" value="<?=$screen?>" />
					<input type="hidden" name="letra" value="<?=$letra?>" />
					
					<div class="baseButtons">

							<button type="button" class="ui-state-default ui-corner-all" onclick="document.listinglevel.submit();"><?=system_showText(LANG_BUTTON_SUBMIT)?></button>
							<button class="ui-state-default ui-corner-all" type="submit"><?=system_showText(LANG_BUTTON_CANCEL)?></button>
					
					</div>

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
					include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");
				?>
