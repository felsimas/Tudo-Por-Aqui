<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /membros/event/index.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (EVENT_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSession();
	$acctId = sess_getAccountIdFromSession();
	$url_redirect = "".DEFAULT_URL."/membros/event";
	$url_base     = "".DEFAULT_URL."/membros";

	extract($_GET);
	extract($_POST);

	// Page Browsing /////////////////////////////////////////
	
	$sql_where[] = " account_id = $acctId ";
	if ($sql_where) $where .= " ".implode(" AND ", $sql_where)." ";

	$pageObj = new pageBrowsing("Event", $screen, 10, (($_GET["newest"])?("id DESC"):("level DESC, title")),"title", $letra, $where);
	$events = $pageObj->retrievePage();

	$paging_url = DEFAULT_URL."/membros/event/index.php";

	// Letters Menu
	$letras = $pageObj->getString("letras");
	foreach ($letras as $each_letra) {
		if ($each_letra == "#") {
			$letras_menu .= "<a href=\"$paging_url\" ".((!$letra) ? "style=\"color:#EF413D\"" : "" ).">".strtoupper($each_letra)."</a>";
		} else {
			$letras_menu .= "<a href=\"$paging_url?letra=".$each_letra."\" ".(($each_letra == $letra) ? "class=\"firstLetter\"" : "" ).">".strtoupper($each_letra)."</a>";
		}
	}

	# PAGES DROP DOWN ----------------------------------------------------------------------------------------------
	$pagesDropDown = $pageObj->getPagesDropDown($_GET, $paging_url, $screen, system_showText(LANG_PAGING_GOTOPAGE).": ", "this.form.submit();");
	# --------------------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/header.php");

	# ----------------------------------------------------------------------------------------------------
	# NAVBAR
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/navbar.php");

?>

			<div class="mainContentExtended">

				<? require(EDIRECTORY_ROOT."/gerenciamento/registration.php"); ?>
				<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
				<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

				<h1 class="standardTitle"><?=system_showText(system_highlightLastWord(LANG_MENU_MANAGEEVENT));?></h1>
				
				<?
				$contentObj = new Content("", EDIR_LANGUAGE);
				$content = $contentObj->retrieveContentByType("Manage Events");
				if ($content) {
					echo "<blockquote>";
						echo "<div class=\"dynamicContent\">".$content."</div>";
					echo "</blockquote>";
				}
				?>

				<? include(INCLUDES_DIR."/tables/table_paging.php"); ?>

				<? if ($events) { ?>

					<? $hascharge = false; ?>
					<? $hastocheckout = false; ?>

					<? include(INCLUDES_DIR."/tables/table_event.php"); ?>

					<? if (!($process == "signup")) { ?>

						<? if ($hastocheckout) { ?>
							<? if ($hascharge) { ?>
								<? if ((PAYMENT_FEATURE == "on") && ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on"))) { ?>

									<table width="50%" style="margin: 0 auto 0 auto;">
										<tr>
											<td width="50%">
												<table align="center" border="0" cellpadding="0" cellspacing="0" class="warningBOX">
													<tr>
														<th><a href="<?=DEFAULT_URL?>/membros/billing/index.php" class="warningBOXcontent"><?=system_showText(LANG_MSG_CONTINUE_TO_PAY_EVENT)?></a></th>
														<td><a href="<?=DEFAULT_URL?>/membros/billing/index.php"><img src="<?=DEFAULT_URL?>/images/img_GREENarrow.gif" alt="&raquo;" width="39" height="45" /></a></td>
													</tr>
												</table>
											</td>
										</tr>
									</table>

									<table align="center" border="0" cellpadding="0" cellspacing="0" class="warningBOXtext">
										<tr>
											<th><img src="<?=DEFAULT_URL?>/images/icon_atention.gif" width="16" height="14" alt="Atention Icon" /></th>
											<td><?=system_showText(LANG_MSG_EVENTS_ARE_ACTIVATED_BY);?> <strong><?=system_showText(LANG_LABEL_SITE_MANAGER)?></strong> <?=system_showText(LANG_MSG_ONLY_PROCCESS_COMPLETE)?></td>
										</tr>
									</table>

								<? } ?>
							<? } ?>
						<? } ?>

					<? } ?>

				<? } else { ?>
					<div class="response-msg inf ui-corner-all"><?=system_showText(LANG_NO_EVENTS_IN_THE_SYSTEM)?></div>
				<? } ?>

				<?
				$contentObj = new Content("", EDIR_LANGUAGE);
				$content = $contentObj->retrieveContentByType("Manage Events Bottom");
				if ($content) {
					echo "<blockquote>";
						echo "<div class=\"dynamicContent\">".$content."</div>";
					echo "</blockquote>";
				}
				?>

			</div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");
?>
