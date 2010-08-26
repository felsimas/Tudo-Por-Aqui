<?

    /*==================================================================*\
    ######################################################################
    #                                                                    #
    # SisDir Class- System of Class Online 2009           #
    #                                                                    #
    #                #
    #                       #
    #                                                                    #
    # ---------------- 2009 - this file is used in php. ----------------- #
    #                                                                    #
    # http://wxw.google.cn / wxw.msn.cn #
    ######################################################################
    \*==================================================================*/

    # ----------------------------------------------------------------------------------------------------
    # * FILE: /gerenciamento/estabelecimentostemplate/index.php
    # ----------------------------------------------------------------------------------------------------

    # ----------------------------------------------------------------------------------------------------
    # LOAD CONFIG
    # ----------------------------------------------------------------------------------------------------
    include("../../conf/loadconfig.inc.php");

    # ----------------------------------------------------------------------------------------------------
    # VALIDATE FEATURE
    # ----------------------------------------------------------------------------------------------------
    if (LISTINGTEMPLATE_FEATURE != "on") { exit; }

    # ----------------------------------------------------------------------------------------------------
    # SESSION
    # ----------------------------------------------------------------------------------------------------
    sess_validateSMSession();
    permission_hasSMPerm();

    $url_redirect = "".DEFAULT_URL."/gerenciamento/estabelecimentostemplate";
    $url_base     = "".DEFAULT_URL."/gerenciamento";

    $url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

    # ----------------------------------------------------------------------------------------------------
    # CODE
    # ----------------------------------------------------------------------------------------------------
    extract($_POST);
    extract($_GET);

    // Page Browsing /////////////////////////////////////////
    $pageObj = new pageBrowsing("ListingTemplate", $screen, 10, "title", "title", $letra);
    $listingtemplates = $pageObj->retrievePage();

    $paging_url = DEFAULT_URL."/gerenciamento/estabelecimentostemplate/index.php";

    // Letters Menu
    $letras = $pageObj->getString("letras");
    foreach($letras as $each_letra)
    if ($each_letra == "#") {
        $letras_menu .= "<a href=\"$paging_url\" ".((!$letra) ? "class=\"firstLetter\"" : "" ).">".strtoupper($each_letra)."</a>";
    } else {
        $letras_menu .= "<a href=\"$paging_url?letra=".$each_letra."\" ".(($each_letra == $letra) ? "style=\"color:#EF413D\"" : "" ).">".strtoupper($each_letra)."</a>";
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
            <h1><?=ucwords(system_showText(LANG_SITEMGR_LISTINGTEMPLATE_PLURAL))?></h1>
        </div>
    </div>
    <div id="content-content">
        <div class="default-margin" style="padding-top:3px;">

            <? //require(EDIRECTORY_ROOT."/gerenciamento/registration.php"); ?>
            <? //require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
            <? //require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

            <?
            if (""=="") {
                //
                if (""=="") {
                    ?>

                    <? include(INCLUDES_DIR."/tables/table_listingtemplate_submenu.php"); ?>

                    <br />
                    <div class="tip-base">
                        <p style="text-align: justify;">
                            <a href="<?=DEFAULT_URL;?>/gerenciamento/faq.php?keyword=<?=urlencode("template");?>" target="_blank"><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_TIP)?></a>
                        </p>
                    </div>
                    <br />

                    <? include(INCLUDES_DIR."/tables/table_paging.php"); ?>

                    <? if ($listingtemplates) { ?>
                        <? include(INCLUDES_DIR."/tables/table_listingtemplate.php"); ?>
                    <? } else { ?>
                        <div class="response-msg inf ui-corner-all">
                            <?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_NORECORD)?>
                        </div>
                    <? } ?>

                    <?
                } else {
                    ?><p class="warning"><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_ACTIVATIONISREQUIRED)?></p><?
                }
            } else {
                ?><p class="warning"><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_ACTIVATIONISREQUIRED)?></p><?
            }
            ?>

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