<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /membros/listing/report.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_GET);
	extract($_POST);

	$url_base = "".DEFAULT_URL."/membros";

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSession();
	$acctId = sess_getAccountIdFromSession();

    # ----------------------------------------------------------------------------------------------------
    # OBJECTS
    # ----------------------------------------------------------------------------------------------------
    $listing = new Listing($id);

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
	include(MEMBERS_EDIRECTORY_ROOT."/layout/header_members.php");
	
?>
<script language="JavaScript" src="../../../scripts/FusionCharts.js"></script>

	<div id="page-wrapper">

		<div id="main-wrapper">
		<?php 	include(MEMBERS_EDIRECTORY_ROOT."/menu.php"); ?>
		
			<div id="main-content"> 

				
				<div class="page-title ui-widget-content ui-corner-all">

					<div class="other_content">

				<? require(EDIRECTORY_ROOT."/gerenciamento/registration.php"); ?>
				<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
				<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>
				<div id="header-form"><a href="<?=DEFAULT_URL?>/membros/listing/view.php?id=<?=$listing->getNumber("id")?>"><?=system_showText(LANG_MANAGE_LISTING);?> - <?=$listing->getString("title")?> - <?=system_showText(LANG_LISTING_TRAFFIC_REPORT)?></a></div>








				<? if ($reports) { ?>
						<? include(INCLUDES_DIR."/tables/table_listing_reports.php"); ?>
					<? } else { ?>
						<div class="response-msg inf ui-corner-all"><?=system_showText(LANG_NO_REPORTS)?></div>
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
		include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");
	?>


