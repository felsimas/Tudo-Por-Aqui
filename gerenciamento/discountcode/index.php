<?
	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/discountcode/index.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (PAYMENT_FEATURE != "on") { exit; }
	if ((CREDITCARDPAYMENT_FEATURE != "on") && (INVOICEPAYMENT_FEATURE != "on")) { exit; }

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	extract($_GET);
	extract($_POST);

	$url_base = "".DEFAULT_URL."/gerenciamento";

	// Page Browsing ////////////////////////////////////////
	$pageObj = new pageBrowsing("Discount_Code",$screen,10,"id","id",$letra);

	$discount_codes = $pageObj->retrievePage();

	$paging_url = DEFAULT_URL."/gerenciamento/discountcode/index.php";

	// Letters Menu
	$letras = $pageObj->getString("letras");

	foreach($letras as $each_letra)
	if($each_letra == "#")
		$letras_menu .= "<a href=\"$paging_url\" ".((!$letra) ? "class=\"firstLetter\"" : "" ).">".strtoupper($each_letra)."</a>";
	else
		$letras_menu .= "<a href=\"$paging_url?letra=".$each_letra."\" ".(($each_letra == $letra) ? "style=\"color: #EF413D\"" : "" ).">".strtoupper($each_letra)."</a>";

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

		<? include(INCLUDES_DIR."/tables/table_discount_submenu.php"); ?>

		<? include(INCLUDES_DIR."/tables/table_paging.php"); ?>

		<? if ($discount_codes) { ?>
			<? include(INCLUDES_DIR."/tables/table_discountcode.php"); ?>
		<? } else { ?>
			<div class="response-msg inf ui-corner-all">
				<?=system_showText(LANG_SITEMGR_PROMOTIONALCODE_NORECORD)?>
			</div>
		<? } ?>

		<div class="informationMessage"><?=system_showText(LANG_SITEMGR_PROMOTIONALCODE_TIP1)?></div>


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