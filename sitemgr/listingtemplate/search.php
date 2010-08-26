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
    # * FILE: /gerenciamento/estabelecimentostemplate/search.php
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

    # ----------------------------------------------------------------------------------------------------
    # AUX
    # ----------------------------------------------------------------------------------------------------
    extract($_GET);
    extract($_POST);

    // Page Browsing ////////////////////////////////////////

    if ($search_title)  $sql_where[] = " title like ".db_formatString('%'.$search_title.'%')." ";
    if ($search_status) $sql_where[] = " status = ".db_formatString($search_status)." ";
    if ($sql_where)     $where .= " ".implode(" AND ", $sql_where)." ";

    $_GET["search_page"] = "1";
    $url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

    $pageObj  = new pageBrowsing("ListingTemplate", $screen, 10, "title", "", "", $where);

    $listingtemplates = $pageObj->retrievePage();

    $paging_url = DEFAULT_URL."/gerenciamento/estabelecimentostemplate/search.php";

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

    $_GET = format_magicQuotes($_GET);
    extract($_GET);
    $_POST = format_magicQuotes($_POST);
    extract($_POST);

?>

<div id="main-right">
<div id="top-content">
    <div id="header-content">
        <h1><?=ucwords(system_showText(LANG_SITEMGR_SEARCH))?> <?=ucwords(system_showText(LANG_SITEMGR_LISTINGTEMPLATE_PLURAL))?></h1>
    </div>
</div>
<div id="content-content">
    <div class="default-margin" style="padding-top:3px;">


        <?
        if (""=="") {
            
            if (""=="") {
                ?>

                <? include(INCLUDES_DIR."/tables/table_listingtemplate_submenu.php"); ?>
                <br>
                <form name="listingtemplate" method="GET">
                    <? include(INCLUDES_DIR."/forms/form_searchlistingtemplate.php"); ?>
                        <table style="margin: 0 auto 0 auto;">
                        <tr>
                            <td>
                                <button type="submit" value="Search" class="ui-state-default ui-corner-all"><?=system_showText(LANG_SITEMGR_SEARCH)?></button>
                            </td>
                            <td>
                                <button type="button" value="Clear" onclick="searchResetSitemgr(this.form);" class="ui-state-default ui-corner-all"><?=system_showText(LANG_SITEMGR_CLEAR)?></button>
                            </td>
                        </tr>
                    </table>
                </form>
                <div id="header-form">
                    <?=system_showText(LANG_SITEMGR_RESULTS)?>
                </div>
                <? include(INCLUDES_DIR."/tables/table_paging.php"); ?>
                <? if ($listingtemplates) { ?>
                    <? include(INCLUDES_DIR."/tables/table_listingtemplate.php"); ?>
                <? } else { ?>
                    <p class="errorMessage"><?=system_showText(LANG_SITEMGR_NORESULTS)?></p>
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