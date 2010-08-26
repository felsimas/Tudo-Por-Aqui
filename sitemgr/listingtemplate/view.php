<?

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

    extract($_POST);
    extract($_GET);

    $url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

    # ----------------------------------------------------------------------------------------------------
    # AUX
    # ----------------------------------------------------------------------------------------------------
    if ($id) {
        $listingTemplate = new ListingTemplate($id);
    } else {
        header("Location: ".DEFAULT_URL."/gerenciamento/estabelecimentostemplate/".(($search_page) ? "search.php" : "index.php")."?message=".urlencode($message)."&screen=$screen&letra=$letra".(($url_search_params) ? "&$url_search_params" : "")."");
        exit;
    }

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
            <h1><?=ucwords(system_showText(LANG_SITEMGR_LISTINGTEMPLATE))?> <?=ucwords(system_showText(LANG_SITEMGR_DETAIL))?></h1>
        </div>
    </div>
    <div id="content-content">
        <div class="default-margin" style="padding-top:3px;">


            <?
            if (""=="") {
                
                if (""=="") {
                    ?>

                    <? if($listingTemplate->getString("id") == 0){ ?>
                        <p class="warning"> <?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_ITMIGHTBEDELETED)?></p>
                    <? } else { ?>

                        <? include(INCLUDES_DIR."/tables/table_listingtemplate_submenu.php"); ?>
                        <br>
                        <div id="header-view">
                            <?=system_showText(LANG_SITEMGR_MANAGE)?> <?=ucwords(system_showText(LANG_SITEMGR_LISTINGTEMPLATE))?> - <?=$listingTemplate->getString("title")?>
                        </div>
                        <ul class="list-view columnListView">
                            <li>
                                <a href="<?=DEFAULT_URL?>/gerenciamento/estabelecimentostemplate/template.php?id=<?=$listingTemplate->getNumber("id")?>&screen=<?=$screen?>&letra=<?=$letra?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-view"><?=system_showText(LANG_SITEMGR_EDIT)?> <?=ucwords(system_showText(LANG_SITEMGR_LISTINGTEMPLATE))?></a>
                            </li>
                            <li>
                                <a href="<?=DEFAULT_URL?>/gerenciamento/estabelecimentostemplate/delete.php?id=<?=$listingTemplate->getNumber("id")?>&screen=<?=$screen?>&letra=<?=$letra?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-view"><?=system_showText(LANG_SITEMGR_DELETE)?> <?=ucwords(system_showText(LANG_SITEMGR_LISTINGTEMPLATE))?></a>
                            </li>
                            <li>
                                <a href="<?=DEFAULT_URL?>/gerenciamento/estabelecimentostemplate/template.php?id=<?=$listingTemplate->getNumber("id")?>&screen=<?=$screen?>&letra=<?=$letra?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-view"><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_EDITSTATUS)?></a> ( <span class="label-field-account"><?=@constant('LANG_SITEMGR_LABEL_'.strtoupper($listingTemplate->getString("status")))?></span> )
                            </li>
                            <li>
                                <a href="<?=DEFAULT_URL?>/gerenciamento/estabelecimentostemplate/template.php?id=<?=$listingTemplate->getNumber("id")?>&screen=<?=$screen?>&letra=<?=$letra?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-view"><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_EDITPRICE)?></a>
                            </li>
                        </ul>
                        
                        <ul class="list-view columnListView secondaryListView">
                            <li><strong><?=system_showText(LANG_SITEMGR_LASTUPDATED)?>:</strong> <span class="label-field-account"><?=format_date($listingTemplate->getNumber("updated"),DEFAULT_DATE_FORMAT." - H:i:s", "datetime")?></span></li>
                            <li></li>
                            <li><strong><?=system_showText(LANG_SITEMGR_DATECREATED)?>:</strong> <span class="label-field-account"><?=format_date($listingTemplate->getNumber("entered"),DEFAULT_DATE_FORMAT." - H:i:s", "datetime")?></span></li>
                        </ul>
                        
                        <br class="clear" />

                        <? include(INCLUDES_DIR."/views/view_listingtemplate.php"); ?>

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
    <div id="bottom-content">&nbsp;</div>
</div>

<?
    # ----------------------------------------------------------------------------------------------------
    # FOOTER
    # ----------------------------------------------------------------------------------------------------
    include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>