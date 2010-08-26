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

    extract($_GET);
    extract($_POST);

    $url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

    # ----------------------------------------------------------------------------------------------------
    # SUBMIT
    # ----------------------------------------------------------------------------------------------------
    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        if (validate_listingtemplate($_POST, $message_listingtemplate)) {

            $listingtemplate = new ListingTemplate($_POST);
            $listingtemplate->save();

            $listingtemplate->clearListingTemplateFields();

            $show_order = 0;
            foreach ($label as $fieldname=>$labelname) {
                if (trim($labelname)) {
                    $ltf["field"] = $fieldname;
                    $ltf["label"] = $labelname;
                    unset($aux_fieldvalues);
                    if ($fieldvalues[$fieldname]) {
                        $auxfieldvalues = explode("\n", $fieldvalues[$fieldname]);
                        foreach ($auxfieldvalues as $fieldvalue) {
                            $fieldvalue = str_replace("\n", "", $fieldvalue);
                            $fieldvalue = str_replace("\r", "", $fieldvalue);
                            if (trim($fieldvalue)) {
                                $aux_fieldvalues[] = $fieldvalue;
                            }
                        }
                    }
                    if ($aux_fieldvalues) $ltf["fieldvalues"] = implode(",", $aux_fieldvalues);
                    else $ltf["fieldvalues"] = "";
                    $ltf["instructions"] = $instructions[$fieldname];
                    $ltf["required"] = $required[$fieldname];
                    $ltf["search"] = $search[$fieldname];
                    $ltf["searchbykeyword"] = $searchbykeyword[$fieldname];
                    $ltf["searchbyrange"] = $searchbyrange[$fieldname];
                    $ltf["show_order"] = $show_order;
                    $listingtemplate->addListingTemplateField($ltf);
                    $show_order++;
                }
            }

            // setting categories
            $return_categories_array = explode(",", $return_categories);
            $listingtemplate->setCategories($return_categories_array); // MUST BE ALWAYS AFTER $LISTINGTEMPLATEOBJECT->SAVE();

            if ($id) {
                $message = system_showText(LANG_SITEMGR_LISTINGTEMPLATE_SUCCESSUPDATED);
            } else {
                $message = system_showText(LANG_SITEMGR_LISTINGTEMPLATE_SUCCESSADDED);
            }

            header("Location: ".DEFAULT_URL."/gerenciamento/estabelecimentostemplate/".(($search_page) ? "search.php" : "index.php")."?message=".urlencode($message)."&screen=$screen&letra=$letra".(($url_search_params) ? "&$url_search_params" : "")."");
            exit;

        }

        // removing slashes added if required
        $_POST = format_magicQuotes($_POST);
        $_GET  = format_magicQuotes($_GET);
        extract($_POST);
        extract($_GET);

    }

    # ----------------------------------------------------------------------------------------------------
    # FORMS DEFINES
    # ----------------------------------------------------------------------------------------------------

    if ($id) {
        $listingtemplate = new ListingTemplate($id);
        $listingtemplate->extract();
        $template_fields = $listingtemplate->getListingTemplateFields();
        if ($template_fields) {
            foreach ($template_fields as $template_field) {
                $label[$template_field["field"]] = $template_field["label"];
                $fieldvalues[$template_field["field"]] = str_replace(",", "\n", $template_field["fieldvalues"]);
                $instructions[$template_field["field"]] = $template_field["instructions"];
                $required[$template_field["field"]] = $template_field["required"];
                $search[$template_field["field"]] = $template_field["search"];
                $searchbykeyword[$template_field["field"]] = $template_field["searchbykeyword"];
                $searchbyrange[$template_field["field"]] = $template_field["searchbyrange"];
            }
        }
    }

    $langIndex = language_getIndex(EDIR_LANGUAGE);
    $categories = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if ($return_categories) {
            $return_categories_array = explode(",", $return_categories);
            foreach ($return_categories_array as $each_category) {
                $categories[] = new ListingCategory($each_category);
            }
        }
    } else {
        if (!$categories) if ($listingtemplate) $categories = $listingtemplate->getCategories();
    }
    if ($categories) {
        for ($i=0; $i<count($categories); $i++) {
            if ($categories[$i]->getString("title".$langIndex)) $arr_category[$i]["name"] = $categories[$i]->getString("title".$langIndex);
            else $arr_category[$i]["name"] = $categories[$i]->getString("title");
            $arr_category[$i]["value"] = $categories[$i]->getNumber("id");
            $arr_return_categories[] = $categories[$i]->getNumber("id");
        }
        if ($arr_return_categories) $return_categories = implode(",", $arr_return_categories);
        array_multisort($arr_category);
        $feedDropDown = "<select name='feed' multiple size='5' style=\"width:500px\">";
        if ($arr_category) foreach ($arr_category as $each_category) {
            $feedDropDown .= "<option value='".$each_category["value"]."'>".$each_category["name"]."</option>";
        }
        $feedDropDown .= "</select>";
    } else {
        if ($return_categories) {
            $return_categories_array = explode(",", $return_categories);
            if ($return_categories_array) {
                foreach ($return_categories_array as $each_category) {
                    $categories[] = new ListingCategory($each_category);
                }
            }
        }
        $feedDropDown = "<select name='feed' multiple size='5' style=\"width:500px\">";
        if ($categories) {
            foreach ($categories as $category) {
                if ($category->getString("title".$langIndex)) $name = $category->getString("title".$langIndex);
                else $name = $category->getString("title");
                $feedDropDown .= "<option value='".$category->getNumber("id")."'>$name</option>";
            }
        }
        $feedDropDown .= "</select>";
    }

    extract($_POST);
    extract($_GET);

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
            <h1><?=ucwords(system_showText(LANG_SITEMGR_LISTINGTEMPLATE))?> <?=ucwords(system_showText(LANG_SITEMGR_INFORMATION))?></h1>
        </div>
    </div>
    <div id="content-content">

        <div class="default-margin" style="padding-top:3px;">


            <?
            if (""=="") {
                
                if (""=="") {
                    ?>

                    <? include(INCLUDES_DIR."/tables/table_listingtemplate_submenu.php"); ?>
                    
                    <div class="baseForm">

                    <form id="listingtemplate" name="listingtemplate" action="<?=$_SERVER["PHP_SELF"]?>" method="POST" style="margin:0; padding:0">
                        <input type="hidden" name="id" value="<?=$id?>" />

                        <? include(INCLUDES_DIR."/forms/form_listingtemplate.php"); ?>

                        <?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
                        <input type="hidden" name="letra" value="<?=$letra?>" />
                        <input type="hidden" name="screen" value="<?=$screen?>" />
                        <button type="button" name="submit_button" value="Submit" class="ui-state-default ui-corner-all" onclick="JS_submit();"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
                        <button type="button" name="cancel" value="Cancel" class="ui-state-default ui-corner-all" onclick="document.getElementById('formlistingtemplatecancel').submit();"><?=system_showText(LANG_SITEMGR_CANCEL)?></button>

                    </form>
                    <form id="formlistingtemplatecancel" action="<?=DEFAULT_URL?>/gerenciamento/estabelecimentostemplate/<?=(($search_page) ? "search.php" : "index.php");?>" method="POST">

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