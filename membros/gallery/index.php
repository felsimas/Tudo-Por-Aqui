<?
	# ----------------------------------------------------------------------------------------------------
	# * FILE: /membros/gallery/index.php
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
	
	$url_redirect = "".DEFAULT_URL."/membros/fotos";
	$url_base     = "".DEFAULT_URL."/membros";

	extract($_GET);
	extract($_POST);
	

	// Page Browsing /////////////////////////////////////////
	
	$sql_where[] = " account_id = $acctId ";
	if ($sql_where)         $where .= " ".implode(" AND ", $sql_where)." ";
	
	$pageObj  = new pageBrowsing("Gallery", $screen, 10, "title", "title", $letra, $where);
	$galleries = $pageObj->retrievePage();
	
	$paging_url = DEFAULT_URL."/membros/gallery/index.php";
	
	// Letters Menu
	$letras = $pageObj->getString("letras");
	foreach($letras as $each_letra)
	if($each_letra == "#")
	  $letras_menu .= "<a href=\"$paging_url\" ".((!$letra) ? "class=\"firstLetter\"" : "" ).">".strtoupper($each_letra)."</a>";
	else
	  $letras_menu .= "<a href=\"$paging_url?letra=".$each_letra."\" ".(($each_letra == $letra) ? "style=\"color:red\"" : "" ).">".strtoupper($each_letra)."</a>";
	
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

				<div id="header-form"><?=system_highlightLastWord(system_showText(LANG_LABEL_MANAGEGALLERY_PLURAL))?></div>
				<?
				$contentObj = new Content("", EDIR_LANGUAGE);
				$content = $contentObj->retrieveContentByType("Manage Galleries");
				if ($content) {
					echo "<blockquote>";
						echo "<div class=\"dynamicContent\">".$content."</div>";
					echo "</blockquote>";
				}
				?>

				<? include(INCLUDES_DIR."/tables/table_paging.php"); ?>

				<? if ($galleries) { ?>

					<?  include(INCLUDES_DIR."/tables/table_gallery.php"); ?>

				<? } else { ?>
					<div class="response-msg inf ui-corner-all"><?=system_showText(LANG_NO_GALLERIES_IN_THE_SYSTEM)?></div>
				<? } ?>

				<?
				$contentObj = new Content("", EDIR_LANGUAGE);
				$content = $contentObj->retrieveContentByType("Manage Galleries Bottom");
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
