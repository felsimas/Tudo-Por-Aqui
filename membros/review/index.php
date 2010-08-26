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
	sess_validateSession();
	$acctId = sess_getAccountIdFromSession();

	$url_redirect = "".DEFAULT_URL."/membros/review";
	$url_base     = "".DEFAULT_URL."/membros";

	extract($_GET);
	extract($_POST);
	
	if (!$item_type) $item_type = 'listing';
	
    if ($item_type == 'listing') {
    	$itemObj = new Listing($item_id);
    	$tableName  = 'Listing';
    } else if ($item_type == 'article') {
    	$itemObj = new Article($item_id);
    	$tableName  = 'Article';
    }

	// Page Browsing /////////////////////////////////////////   
	$where .= " Review.item_type = '$item_type' AND Review.item_id = '$item_id' AND Review.item_id = $tableName.id AND $tableName.account_id = '$acctId' ";
	

	$pageObj = new pageBrowsing("Review, $tableName", $screen, 10, "approved, added DESC", "review_title", $letra, $where, "Review.*");
	$reviewsArrTmp = $pageObj->retrievePage("array");
	if ($reviewsArrTmp) foreach ($reviewsArrTmp as $each_reviewsArrTmp) {
		$reviewsArr[] = new Review($each_reviewsArrTmp["id"]);
	}

	$paging_url = DEFAULT_URL."/membros/review/index.php?item_id=$item_id&item_screen=$item_screen&item_letra=$item_letra";

	// Letters Menu
	$letras = $pageObj->getString("letras");
	foreach ($letras as $each_letra) {
		if ($each_letra == "#") {
			$letras_menu .= "<a href=\"$paging_url\" ".((!$letra) ? "class=\"firstLetter\"" : "" ).">".strtoupper($each_letra)."</a>";
		} else {
			$letras_menu .= "<a href=\"$paging_url&letra=$each_letra\" ".(($each_letra == $letra) ? "style=\"color:#EF413D\"" : "" ).">".strtoupper($each_letra)."</a>";
		}
	}

	$_GET["review_screen"] = $screen;
	# PAGES DROP DOWN ----------------------------------------------------------------------------------------------
	$pagesDropDown = $pageObj->getPagesDropDown($_GET, $paging_url, $screen, system_showText(LANG_PAGING_GOTOPAGE).": ", "this.form.submit();");
	# --------------------------------------------------------------------------------------------------------------

		# ----------------------------------------------------------------------------------------------------
		# HEADER
		# ----------------------------------------------------------------------------------------------------
		include(MEMBERS_EDIRECTORY_ROOT."/layout/header_members.php");


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

				<div id="header-form">
					<? if ($reviewsArrTmp) { ?>
						<? if ($item_id) { ?>
							<?
							if ($item_type == 'listing') {
								$itemObj = new Listing($item_id); 
							} else if ($item_type == 'article') {
							    $itemObj = new Article($item_id);
							} 
							?>
							<?=$itemObj->getString("title", true)?></span>
						<? } ?>
					<? } ?>
					- <?=system_showText(LANG_REVIEW_PLURAL)?>
					
				</div>


				<?
				if ($reviewsArrTmp) {
					include(INCLUDES_DIR."/tables/table_review.php");
				} else {
					echo "<div class=\"response-msg notice ui-corner-all\">".system_showText(LANG_MSG_NO_RESULTS_FOUND)."</div>";
				}
				?>

							</div>
						</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>


<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");
?>