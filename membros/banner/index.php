<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /membros/banner/index.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (BANNER_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSession();
	$acctId = sess_getAccountIdFromSession();

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);

	$url_base = "".DEFAULT_URL."/membros";
	$url_redirect = $url_base."/banner";
	$membros = 1;

	# ----------------------------------------------------------------------------------------------------
	# PAGE BROWSING
	# ----------------------------------------------------------------------------------------------------
	$sql_where[] = " account_id = $acctId ";
	if ($sql_where) $where .= " ".implode(" AND ", $sql_where)." ";
	$pageObj = new pageBrowsing("Banner", $screen, 10, (($_GET["newest"])?("id DESC"):("type, caption")), "caption", $letra, $where);
	$banners = $pageObj->retrievePage("array");

	$paging_url = DEFAULT_URL."/membros/banner/index.php";

	// Letters Menu
	$letras = $pageObj->getString("letras");
	foreach ($letras as $each_letra) {
		if ($each_letra == "#") {
			$letras_menu .= "<a href=\"$paging_url\" ".((!$letra) ? "class=\"firstLetter\"" : "" ).">".strtoupper($each_letra)."</a>";
		} else {
			$letras_menu .= "<a href=\"$paging_url?letra=".$each_letra."\" ".(($each_letra == $letra) ? "style=\"color:#EF413D\"" : "" ).">".strtoupper($each_letra)."</a>";
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

		<div id="header-form"><?=system_showText(system_highlightLastWord(LANG_MENU_MANAGEBANNER));?></div>
		
		<?
		$contentObj = new Content("", EDIR_LANGUAGE);
		$content = $contentObj->retrieveContentByType("Manage Banners");
		if ($content) {
			echo "<blockquote>";
				echo "<div class=\"dynamicContent\">".$content."</div>";
			echo "</blockquote>";
		}
		?>

		<? include(INCLUDES_DIR."/tables/table_paging.php"); ?>

		<? if ($banners) { ?>

			<? $hascharge = false; ?>
			<? $hastocheckout = false; ?>

			<? include(INCLUDES_DIR."/tables/table_banner.php"); ?>

			<? if (!($process == "signup")) { ?>

				<? if ($hastocheckout) { ?>
					<? if ($hascharge) { ?>
						<? if ((PAYMENT_FEATURE == "on") && ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on"))) { ?>

									<br/>
									<div class="response-msg notice ui-corner-all"><?=system_showText(LANG_MSG_BANNERS_ARE_ACTIVATED_BY);?> <strong><?=system_showText(LANG_LABEL_SITE_MANAGER)?></strong> <?=system_showText(LANG_MSG_ONLY_PROCCESS_COMPLETE)?></div>
								

						<? } ?>
					<? } ?>
				<? } ?>

			<? } ?>

		<? } else { ?>
			<div class="response-msg notice ui-corner-all"><?=system_showText(LANG_NO_BANNERS_IN_THE_SYSTEM)?></div>
		<? } ?>

		<?
		$contentObj = new Content("", EDIR_LANGUAGE);
		$content = $contentObj->retrieveContentByType("Manage Banners Bottom");
		if ($content) {
			echo "<blockquote>";
				echo "<div class=\"dynamicContent\">".$content."</div>";
			echo "</blockquote>";
		}
		?>

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


