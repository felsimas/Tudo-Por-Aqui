<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /membros/promotion/index.php
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

	$url_redirect = "".DEFAULT_URL."/membros/promotion";
	$url_base     = "".DEFAULT_URL."/membros";

	extract($_GET);
	extract($_POST);

	// Page Browsing /////////////////////////////////////////

	$sql_where[] = " account_id = $acctId ";
	if ($sql_where) $where .= " ".implode(" AND ", $sql_where)." ";

	$pageObj = new pageBrowsing("Promotion", $screen, 10, (($_GET["newest"])?("id DESC"):"name"), "name", $letra, $where);
	$promotions = $pageObj->retrievePage();

	$paging_url = DEFAULT_URL."/membros/promotion/index.php";

	// Letters Menu
	$letras = $pageObj->getString("letras");
	foreach ($letras as $each_letra) {
		if ($each_letra == "#") {
			$letras_menu .= "<a href=\"$paging_url\" ".((!$letra) ? "class=\"firstLetter\"" : "" ).">".strtoupper($each_letra)."</a>";
		} else {
			$letras_menu .= "<a href=\"$paging_url?letra=".$each_letra."\" ".(($each_letra == $letra) ? "style=\"color:red\"" : "" ).">".strtoupper($each_letra)."</a>";
		}
	}

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

				<div id="header-form"><?=system_showText(system_highlightLastWord(LANG_MENU_MANAGEPROMOTION));?></div>

				<?
				$contentObj = new Content("", EDIR_LANGUAGE);
				$content = $contentObj->retrieveContentByType("Manage Promotions");
				if ($content) {
						echo "<div class=\"response-msg notice ui-corner-all\">".$content."</div>";
				}
				?>

				<? include(INCLUDES_DIR."/tables/table_paging.php"); ?>

				<? if ($promotions) { ?>

					<? include(INCLUDES_DIR."/tables/table_promotion.php"); ?>

				<? } else { ?>

					<div class="response-msg notice ui-corner-all"><?=system_showText(LANG_NO_PROMOTIONS_IN_THE_SYSTEM)?></div>

				<? } ?>

<!--
				<?
				$contentObj = new Content("", EDIR_LANGUAGE);
				$content = $contentObj->retrieveContentByType("Manage Promotions Bottom");
				if ($content) {
						echo "<div class=\"other-box yellow-box ui-corner-all\"><div class=\"cont ui-corner-all\">
						
						<p> A Promotion is a discount coupon that can be added to a listing and becomes active once associated to a listing. You begin by selecting the promotions link and add your promotion. To activate it the promotion click on the \"gift box\" icon within the listing section and this will attach your promotion \"coupon\" to your showcase listing.

Your promotion will show up at the directory high traffic areas:
<br/><br/>
    * Within the promotion section, there is an area where potential customers will find current promotions. Making an initial search easy.<br/><br/>
    * Within the listing section, linked to a showcase listing you will see a clickable \"promotion icon\". This lets visitors know that your listing is currently offering a promotional coupon.
						
						</p></div></div>";
				}
				?> !-->

			</div>
				</div>
		</div>
	<div class="clearfix"></div>
</div>
