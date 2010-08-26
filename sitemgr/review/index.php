<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/review/index.php
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

	$url_redirect = "".DEFAULT_URL."/gerenciamento/review";
	$url_base     = "".DEFAULT_URL."/gerenciamento";

	extract($_GET);
	extract($_POST);
	
	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	
	if (!$itemObj) {
    	if ($item_type == 'listing') {
    		$itemObj = new Listing($item_id);
    	} else if ($item_type == 'article') {
    	    $itemObj = new Article($item_id);
    	}
    }

	// Page Browsing /////////////////////////////////////////
	if ($item_id) 				 $sql_where[] = " item_type = '$item_type' AND item_id = '$item_id' ";
	if ($item_type && !$item_id) $sql_where[] = " item_type = '$item_type'";
	if ($sql_where) 
		$where .= " ".implode(" AND ", $sql_where)." ";

	$pageObj  = new pageBrowsing("Review", $screen, 10, "approved, added DESC", "review_title", $letra, $where);
	$reviewsArr = $pageObj->retrievePage("object");

	$paging_url = DEFAULT_URL."/gerenciamento/review/index.php?item_type=$item_type&item_id=$item_id".($filter_id ? "&filter_id=1" : '')."&item_screen=$item_screen&item_letra=$item_letra";

	// Letters Menu
	$letras = $pageObj->getString("letras");
	foreach($letras as $each_letra)
		if($each_letra == "#")
			$letras_menu .= "<a href=\"$paging_url\" ".((!$letra) ? "class=\"firstLetter\"" : "" ).">".strtoupper($each_letra)."</a>";
		else
			$letras_menu .= "<a href=\"$paging_url&letra=$each_letra\" ".(($each_letra == $letra) ? "style=\"color:#EF413D\"" : "" ).">".strtoupper($each_letra)."</a>";

	$_GET["review_screen"] = $screen;
	# PAGES DROP DOWN ----------------------------------------------------------------------------------------------
	$pagesDropDown = $pageObj->getPagesDropDown($_GET, $paging_url, $screen, system_showText(LANG_SITEMGR_PAGING_GOTOPAGE)." ", "this.form.submit();");
	# --------------------------------------------------------------------------------------------------------------

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

		<? include(INCLUDES_DIR."/tables/table_listing_submenu.php"); ?>

		<div id="header-view">
			<?=ucwords(system_showText(LANG_SITEMGR_REVIEWS))?><? if ($item_id) { echo ' - '.$itemObj->getString("title", true); } else if ($item_type) { echo ' - '.ucfirst(@constant('LANG_'.strtoupper($item_type))); } ?>
		</div>

		<? include(INCLUDES_DIR."/tables/table_paging.php"); ?>

		<? if ($reviewsArr) { ?>
			<? include(INCLUDES_DIR."/tables/table_review.php"); ?>
		<? } else { ?>
			<div class="response-msg inf ui-corner-all"><?=system_showText(LANG_SITEMGR_REVIEW_NORECORD)?></div>
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