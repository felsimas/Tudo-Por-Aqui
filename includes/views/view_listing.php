<?php


    //require(EDIRECTORY_ROOT."/gerenciamento/registration.php");
    //require(EDIRECTORY_ROOT."/includes/code/checkregistration.php");

    $templateCSSDetail = "";
    $templateCSSTitle = "";
    $templateCSSLabel = "";
    $templateCSSText = "";

    if ($listingviewtype == "detail") {
        $template_file_name = INCLUDES_DIR."/views/view_listing_".$listingviewtype."_70_0.php";
		// $template_file_name = INCLUDES_DIR."/views/view_listing_".$listingviewtype."_".$listing->getNumber("level")."_0.php";
    } else {
       // $template_file_name = INCLUDES_DIR."/views/view_listing_".$listingviewtype."_".$listing->getNumber("level").".php";
	    $template_file_name = INCLUDES_DIR."/views/view_listing_".$listingviewtype."_70.php";
    }

    if ("0"=="0") {
        
        if ("0"=="0") {

            if ($listing->getNumber("listingtemplate_id") > 0) {

                $listingtemplate = new ListingTemplate($listing->getNumber("listingtemplate_id"));

                if (($listingtemplate) && ($listingtemplate->getNumber("id") > 0) && ($listingtemplate->getString("status") == "enabled")) {

                    $templateColor_background = $listingtemplate->getString("color_background");
                    $templateColor_border = $listingtemplate->getString("color_border");
                    $templateColor_label = $listingtemplate->getString("color_label");
                    $templateColor_text = $listingtemplate->getString("color_text");
                    $templateColor_titlebackground = $listingtemplate->getString("color_titlebackground");
                    $templateColor_titleborder = $listingtemplate->getString("color_titleborder");
                    $templateColor_titletext = $listingtemplate->getString("color_titletext");

                    $templateCSSDetail = "";
                    if ($templateColor_background || $templateColor_border || $templateColor_text) {
                        $templateCSSDetail .= "style=\"";
                        if ($templateColor_background) {
                            $templateCSSDetail .= "background: #".$templateColor_background.";";
                        }
                        if ($templateColor_border) {
                            $templateCSSDetail .= "border: 1px solid #".$templateColor_border.";";
                        }
                        if ($templateColor_border) {
                            $templateCSSDetail .= "color: #".$templateColor_text.";";
                        }
                        $templateCSSDetail .= "\"";
                    }
                    $templateCSSTitle = "";
                    if ($templateColor_titlebackground || $templateColor_titleborder || $templateColor_titletext) {
                        $templateCSSTitle .= "style=\"";
                        if ($templateColor_titlebackground) {
                            $templateCSSTitle .= "background: #".$templateColor_titlebackground.";";
                        }
                        if ($templateColor_titleborder) {
                            $templateCSSTitle .= "border: 1px solid #".$templateColor_titleborder.";";
                        }
                        if ($templateColor_titletext) {
                            $templateCSSTitle .= "color: #".$templateColor_titletext.";";
                        }
                        $templateCSSTitle .= "\"";
                    }
                    $templateCSSLabel = "";
                    if ($templateColor_label) {
                        $templateCSSLabel .= "style=\"";
                        if ($templateColor_label) {
                            $templateCSSLabel .= "color: #".$templateColor_label.";";
                        }
                        $templateCSSLabel .= "\"";
                    }
                    $templateCSSText = "";
                    if ($templateColor_text) {
                        $templateCSSText .= "style=\"";
                        if ($templateColor_label) {
                            $templateCSSText .= "color: #".$templateColor_text.";";
                        }
                        $templateCSSText .= "\"";
                    }

                    if ($listingviewtype == "detail") {

                        if (file_exists(INCLUDES_DIR."/views/view_listing_".$listingviewtype."_70_".$listingtemplate->getNumber("layout_id").".php")) {

                            $template_file_name = INCLUDES_DIR."/views/view_listing_".$listingviewtype."_70_".$listingtemplate->getNumber("layout_id").".php";

                            $templateExtraFields = "";
                            $template_fields = $listingtemplate->getListingTemplateFields();
                            if ($template_fields!==false) {
                                foreach ($template_fields as $row) {
                                    $var_name = strtolower('_'.ereg_replace("[^0-9a-zA-Z]", "", $row["label"]));
                                    $$var_name = $listing->getString($row["field"]);
                                    if (strpos($row["field"], "custom_checkbox") !== false) {
                                        if ($$var_name == "y") $templateExtraFields .= "\t<p><strong>".$row["label"]."</strong>: ".system_showText(LANG_YES)."</p>\n";
                                        else $templateExtraFields .= "\t<p><strong>".$row["label"]."</strong>: ".system_showText(LANG_NO)."</p>\n";
                                    } elseif (strpos($row["field"], "custom_dropdown") !== false) {
                                        if ($$var_name) $templateExtraFields .= "\t<p><strong>".$row["label"]."</strong>: ".nl2br($$var_name)."</p>\n";
                                    } elseif (strpos($row["field"], "custom_text") !== false) {
                                        if ($$var_name) $templateExtraFields .= "\t<p><strong>".$row["label"]."</strong>: ".nl2br($$var_name)."</p>\n";
                                    } elseif (strpos($row["field"], "custom_short_desc") !== false) {
                                        if ($$var_name) $templateExtraFields .= "\t<p><strong>".$row["label"]."</strong>: ".nl2br($$var_name)."</p>\n";
                                    } elseif (strpos($row["field"], "custom_long_desc") !== false) {
                                        if ($$var_name) $templateExtraFields .= "\t<p><strong>".$row["label"]."</strong>: ".nl2br($$var_name)."</p>\n";
                                    }
                                }
                            }
                            if ($templateExtraFields) {
                                $templateExtraFields = "<h3 class=\"detailTitle\" ".$templateCSSLabel.">Campos Extras</h3>".$templateExtraFields;
                            }

                        }

                    }

                }

            }

        }
    }

    include($template_file_name);

?>