<?
	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/review/view.php
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
	$url_base = "".DEFAULT_URL."/membros";

	extract($_POST);
	extract($_GET);

	$reviewObj  = new Review($id);
	$item_id = $reviewObj->getNumber('item_id');
	
	if ($reviewObj->getString('item_type') == 'listing') {
		$itemObj = new Listing($item_id);
		$item_type = 'listing';
	} else if ($reviewObj->getString('item_type') == 'article') {
	    $itemObj = new Article($item_id);
	    $item_type = 'article';
	}
	
	
	if ($itemObj->getNumber("account_id") != $acctId) {
		header("Location: ".$url_base."/$item_type/index.php");
		exit;
	}

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
					<a href="<?=DEFAULT_URL?>/membros/review/index.php?item_type=listing&item_id=<?=$itemObj->getNumber("id")?>">
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
						- <?=system_showText(LANG_REVIEW_DETAIL)?> 
						</a>
				</div>
				<? 
				$reviewObj->extract();
				$show_item = true;
				$user 	   = false;
				include(INCLUDES_DIR."/views/view_review_detail.php");
				echo $item_reviewcomment;
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
