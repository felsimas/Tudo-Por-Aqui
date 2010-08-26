<?php
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

    $url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

    if ($id) {
        $listingtemplate = new ListingTemplate($id);
    } else {
        header("Location: ".DEFAULT_URL."/gerenciamento/estabelecimentostemplate/");
        exit;
    }

    # ----------------------------------------------------------------------------------------------------
    # SUBMIT
    # ----------------------------------------------------------------------------------------------------
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $listingtemplate = new ListingTemplate($_POST['id']);
        $listingtemplate->delete();
        $message = system_showText(LANG_SITEMGR_LISTINGTEMPLATE_DELETED);
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
            <h1><?=ucwords(system_showText(LANG_SITEMGR_DELETE))?> <?=ucwords(system_showText(LANG_SITEMGR_LISTINGTEMPLATE))?></h1>
        </div>
    </div>

    <div id="content-content">
        <div class="default-margin">


            <?
            if (""=="") {
                
                if (""=="") {
                    ?>

                    <div id="warning">&nbsp;<?=$message_delete?>&nbsp;</div>
                    
                    <div class="baseForm">

                    <form name="listingtemplate" method="POST">

                        <input type="hidden" name="id" value="<?=$id?>" />
                        <div id="header-form">
                            <?=system_showText(LANG_SITEMGR_DELETE)?> <?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE)?> - <?=$listingtemplate->getString("title")?>
                        </div>
                        <div class="response-msg inf ui-corner-all">
                            <?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_DELETEQUESTION)?>
                        </div>
                        
                        <?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
                        <input type="hidden" name="letra" value="<?=$letra?>" />
                        <input type="hidden" name="screen" value="<?=$screen?>" />
                        <button type="submit" class="ui-state-default ui-corner-all"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
                        <button type="button" class="ui-state-default ui-corner-all" onclick="document.getElementById('formlistingtemplatedeletecancel').submit();"><?=system_showText(LANG_SITEMGR_CANCEL)?></button>

                    </form>
                    <form id="formlistingtemplatedeletecancel" action="<?=DEFAULT_URL?>/gerenciamento/estabelecimentostemplate/<?=(($search_page) ? "search.php" : "index.php");?>" method="POST">

                        <?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
                        <input type="hidden" name="letra" value="<?=$letra?>" />
                        <input type="hidden" name="screen" value="<?=$screen?>" />

                    </form>
                    
                    </div>

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