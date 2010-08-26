<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/lancenter/index.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");
    
    # ----------------------------------------------------------------------------------------------------
    # VALIDATING FEATURES
    # ----------------------------------------------------------------------------------------------------
    if (MULTILANGUAGE_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

    $url_redirect = "".DEFAULT_URL."/gerenciamento/langcenter";
    $url_base = "".DEFAULT_URL."/gerenciamento";
    $sitemgr = 1;

    $url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

    extract($_GET);
    extract($_POST);

    // Page Browsing /////////////////////////////////////////
    $pageObj  = new pageBrowsing("Lang", $screen, 10, "lang_default DESC, lang_order", "name", $letra);
    $langs    = $pageObj->retrievePage();

    $paging_url = DEFAULT_URL."/gerenciamento/langcenter/index.php";

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
    $pagesDropDown = $pageObj->getPagesDropDown($_GET, $paging_url, $screen, system_showText(LANG_SITEMGR_PAGING_GOTOPAGE)." ", "this.form.submit();");
    # --------------------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/header.php");

	# ----------------------------------------------------------------------------------------------------
	# NAVBAR
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/navbar.php");

?>

<div id="main-right">

	<div id="top-content">
		<div id="header-content">
			<h1><?=system_showText(LANG_SITEMGR_LANGCENTER_LANGUAGECENTER)?></h1>
		</div>
	</div>
	<div id="content-content">
		<div class="default-margin" style="padding-top:3px;">

			<? require(EDIRECTORY_ROOT."/gerenciamento/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			
			<? include(INCLUDES_DIR."/tables/table_langcenter_submenu.php"); ?>
			<div class="response-msg inf ui-corner-all"><?=system_showText(LANG_SITEMGR_LANGCENTER_INFOTEXT)?><divp>
			<? include(INCLUDES_DIR."/tables/table_paging.php"); ?>
            
            <? if ($langs) { ?>
                <? include(INCLUDES_DIR."/tables/table_lang.php"); ?>
            <? } else { ?>
                <div class="response-msg inf ui-corner-all">
                    <?=system_showText(LANG_SITEMGR_LANGCENTER_NORECORDS)?>
                </div>
            <? } ?>

		</div>
	</div>

	<div id="bottom-content">
		&nbsp;
	</div>

</div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>
