<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/estabelecimentos/report.php
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

	$url_redirect = "".DEFAULT_URL."/gerenciamento/estabelecimentos";
	$url_base = "".DEFAULT_URL."/gerenciamento";
	$sitemgr = 1;

	extract($_GET);
	extract($_POST);

    # ----------------------------------------------------------------------------------------------------
    # OBJECTS
    # ----------------------------------------------------------------------------------------------------
	if ($id) {
	$listing = new Listing($id);
	}	else {
		header("Location: ".DEFAULT_URL."/gerenciamento/index.php");
		exit;
	}

    $listingLevel = new ListingLevel();
    $levelName = ucwords($listingLevel->getName($listing->getNumber('level')));
    
    $status = new ItemStatus();
    $statusName = $status->getStatus($listing->getString('status'));

    # ----------------------------------------------------------------------------------------------------
    # REPORT DATA
    # ----------------------------------------------------------------------------------------------------
    $reports = retrieveListingReport($id);

		# ----------------------------------------------------------------------------------------------------
		# HEADER
		# ----------------------------------------------------------------------------------------------------
		include(SM_EDIRECTORY_ROOT."/layout/header_manager.php");

	?>
	<script language="JavaScript" src="../../../scripts/FusionCharts.js"></script>

		<div id="page-wrapper">

			<div id="main-wrapper">

			<?php 	include(SM_EDIRECTORY_ROOT."/menu.php"); ?>

				<div id="main-content"> 

					<div class="page-title ui-widget-content ui-corner-all">

						<div class="other_content">



		<? require(EDIRECTORY_ROOT."/gerenciamento/registration.php"); ?>
		<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
		<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

		<? include(INCLUDES_DIR."/tables/table_listing_submenu.php"); ?>

		<? if (count($reports) > 0) { ?>
			<? include(INCLUDES_DIR."/tables/table_listing_reports.php"); ?>
		<? } else { ?>
			<div class="response-msg inf ui-corner-all"><?=system_showText(LANG_SITEMGR_REPORT_NORECORD)?></div>
		<? } ?>

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