<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/views/icon_classified.php
	# ----------------------------------------------------------------------------------------------------

    $icon_navbar = "";
	$icon_level = $classified->getNumber("level");

	if ($user) {

		$friend_link = "onclick='javascript:window.open(\"".CLASSIFIED_DEFAULT_URL."/emailform.php?classi_id=".$classified->getNumber("id")."&amp;receiver=friend\",\"popup\",\"toolbar=0,location=0,directories=0,status=0,width=700,height=450,screenX=0,screenY=0,menubar=0,scrollbars,resizable=0\")'";
		$include_favorites_link = "'javascript:includeInCookie(\"".$classified->getNumber("id")."\",\"".EDIRECTORY_FOLDER."\",\"classified\")'";
		$remove_favorites_link = "'javascript:removeFromCookie(\"".$classified->getNumber("id")."\",\"".EDIRECTORY_FOLDER."\",\"classified\")'";
		$print_link = "onclick='javascript:window.open(\"".CLASSIFIED_DEFAULT_URL."/print.php?id=".$classified->getNumber("id")."\",\"popup\",\"\")'";
        
        // SOCIAL BOOKMARKING
        if (SOCIAL_BOOKMARKING != "on") {
        } else {
        
            $classifiedLevelObj = new ClassifiedLevel();
            if ($classifiedLevelObj->getDetail($icon_level) == "y") {
                if (MODREWRITE_FEATURE == "on") {
                    $sbmLink = CLASSIFIED_DEFAULT_URL."/".$classified->getString("friendly_url").".html";
                } else {
                    $sbmLink = CLASSIFIED_DEFAULT_URL."/detail.php?id=".$classified->getNumber("id");
                }
            } else {
                $sbmLink = CLASSIFIED_DEFAULT_URL."/results.php?id=".$classified->getNumber("id");
            }
            $digg        = "href=\"http://digg.com/submit?phase=2&amp;url=".$sbmLink."&amp;title=".urlencode($classified->getString("title"))."\" target=\"_blank\"";
            $delicious   = "href=\"http://del.icio.us/post?url=".$sbmLink."&amp;title=".urlencode($classified->getString("title"))."\" target=\"_blank\"";
            $technorati  = "href=\"http://technorati.com/search/".$sbmLink."\" target=\"_blank\"";
            $reddit      = "href=\"http://reddit.com/submit?url=".$sbmLink."&amp;title=".urlencode($classified->getString("title"))."\" target=\"_blank\"";
            $stumbleupon = "href=\"http://www.stumbleupon.com/submit?url=".$sbmLink."&amp;title=".urlencode($classified->getString("title"))."\" target=\"_blank\"";
            $furl        = "href=\"http://www.furl.net/storeIt.jsp?t=".urlencode($classified->getString("title"))."&amp;u=".$sbmLink."\" target=\"_blank\"";
            $fark        = "href=\"http://cgi.fark.com/cgi/fark/submit.pl?new_url=".$sbmLink."&amp;headline=".urlencode($classified->getString("title"))."\" target=\"_blank\"";
            $blinklist   = "href=\"http://www.blinklist.com/index.php?Action=Blink/addblink.php&amp;Url=".$sbmLink."&amp;title=".urlencode($classified->getString("title"))."\" target=\"_blank\"";
            $slashdot    = "href=\"http://slashdot.org/bookmark.pl?url=".$sbmLink."&amp;title=".urlencode($classified->getString("title"))."\" target=\"_blank\"";
            $newsvine    = "href=\"http://www.newsvine.com/_wine/save?popoff=0&amp;u=".$sbmLink."&amp;h=".urlencode($classified->getString("title"))."\" target=\"_blank\"";
            unset($sbmLink);
            unset($classifiedLevelObj);
        }

	} else {

		$friend_link = "";
		$include_favorites_link = "javascript:void(0)";
		$remove_favorites_link = "javascript:void(0)";
		$print_link = "";
        
        // SOCIAL BOOKMARKING
        if (SOCIAL_BOOKMARKING != "on") {
        } else {
            
            $digg        = "href=\"javascript:void(0);\"";
            $delicious   = "href=\"javascript:void(0);\"";
            $technorati  = "href=\"javascript:void(0);\"";
            $reddit      = "href=\"javascript:void(0);\"";
            $stumbleupon = "href=\"javascript:void(0);\"";
            $furl        = "href=\"javascript:void(0);\"";
            $fark        = "href=\"javascript:void(0);\"";
            $blinklist   = "href=\"javascript:void(0);\"";
            $slashdot    = "href=\"javascript:void(0);\"";
            $newsvine    = "href=\"javascript:void(0);\"";
        }

	}
    
    // SOCIAL BOOKMARKING IMAGES
    if (SOCIAL_BOOKMARKING != "on") {
    } else {
        $digg_img        = "<img src=\"".DEFAULT_URL."/images/icon_digg.gif\" alt=\"".system_showText(LANG_ADDTO_SOCIALBOOKMARKING)." Digg\" title=\"".system_showText(LANG_ADDTO_SOCIALBOOKMARKING)." Digg\" />";
        $delicious_img   = "<img src=\"".DEFAULT_URL."/images/icon_delicious.gif\" alt=\"".system_showText(LANG_ADDTO_SOCIALBOOKMARKING)." Delicious\" title=\"".system_showText(LANG_ADDTO_SOCIALBOOKMARKING)." Delicious\" />";
        $technorati_img  = "<img src=\"".DEFAULT_URL."/images/icon_technorati.gif\" alt=\"".system_showText(LANG_ADDTO_SOCIALBOOKMARKING)." Technorati\" title=\"".system_showText(LANG_ADDTO_SOCIALBOOKMARKING)." Technorati\" />";
        $reddit_img      = "<img src=\"".DEFAULT_URL."/images/icon_reddit.gif\" alt=\"".system_showText(LANG_ADDTO_SOCIALBOOKMARKING)." Reddit\" title=\"".system_showText(LANG_ADDTO_SOCIALBOOKMARKING)." Reddit\" />";
        $stumbleupon_img = "<img src=\"".DEFAULT_URL."/images/icon_stumbleupon.gif\" alt=\"".system_showText(LANG_ADDTO_SOCIALBOOKMARKING)." Stumbleupon\" title=\"".system_showText(LANG_ADDTO_SOCIALBOOKMARKING)." Stumbleupon\" />";
        $furl_img        = "<img src=\"".DEFAULT_URL."/images/icon_furl.gif\" alt=\"".system_showText(LANG_ADDTO_SOCIALBOOKMARKING)." Furl\" title=\"".system_showText(LANG_ADDTO_SOCIALBOOKMARKING)." Furl\" />";
        $fark_img        = "<img src=\"".DEFAULT_URL."/images/icon_fark.gif\" alt=\"".system_showText(LANG_ADDTO_SOCIALBOOKMARKING)." Fark\" title=\"".system_showText(LANG_ADDTO_SOCIALBOOKMARKING)." Fark\" />";
        $blinklist_img   = "<img src=\"".DEFAULT_URL."/images/icon_blinklist.gif\" alt=\"".system_showText(LANG_ADDTO_SOCIALBOOKMARKING)." Blinklist\" title=\"".system_showText(LANG_ADDTO_SOCIALBOOKMARKING)." Blinklist\" />";
        $slashdot_img    = "<img src=\"".DEFAULT_URL."/images/icon_slashdot.gif\" alt=\"".system_showText(LANG_ADDTO_SOCIALBOOKMARKING)." Slashdot\" title=\"".system_showText(LANG_ADDTO_SOCIALBOOKMARKING)." Slashdot\" />";
        $newsvine_img    = "<img src=\"".DEFAULT_URL."/images/icon_newsvine.gif\" alt=\"".system_showText(LANG_ADDTO_SOCIALBOOKMARKING)." Newsvine\" title=\"".system_showText(LANG_ADDTO_SOCIALBOOKMARKING)." Newsvine\" />";
    }

	$links = "";

	$links .= "<li><a class=\"thickbox\" href=\"/emailform.php?id=\".$article->getNumber(\"id\").\"&amp;receiver=friend&KeepThis=true&TB_iframe=true&width=600&height=475\">".system_showText(LANG_ICONEMAILTOFRIEND)."</a></li><li>|</li>";

	$links .= "<li class=\"addQuicklist\"><a href=".$include_favorites_link.">".system_showText(LANG_ICONQUICKLIST_ADD)."</a></li>"; 

	if ($level->getDetail($icon_level) == "y") {
		$links .= "<li>|</li><li><a href=\"javascript:void(0)\" ".$print_link.">".system_showText(LANG_ICONPRINT)."</a></li>";
	}
    
    // SOCIAL BOOKMARKING STYLE
    if (SOCIAL_BOOKMARKING != "on") {
    } else {
    
        echo $icon_navbar .= "
						<ul class=\"socialBookmarkIcons\">
							<li class=\"sbTechnorati\"><a ".$technorati." title=\"Technorati\">".$technorati_img."</a></li>
							<li class=\"sbSlashdot\"><a ".$slashdot." title=\"Slashdot\">".$slashdot_img."</a></li>
							<li class=\"sbStumbleupon\"><a ".$stumbleupon." title=\"Stumbleupon\">".$stumbleupon_img."</a></li>
							<li class=\"sbFurl\"><a ".$furl." title=\"Furl\">".$furl_img."</a></li>
							<li class=\"sbBlinklist\"><a ".$blinklist." title=\"Blinklist\">".$blinklist_img."</a></li>
							<li class=\"sbDelicious\"><a ".$delicious." title=\"Delicious\">".$delicious_img."</a></li>
							<li class=\"sbNewsvine\"><a ".$newsvine." title=\"Newsvine\">".$newsvine_img."</a></li>
							<li class=\"sbReddit\"><a ".$reddit." title=\"Reddit\">".$reddit_img."</a></li>
							<li class=\"sbDigg\"><a ".$digg." title=\"Digg\">".$digg_img."</a></li>
							<li class=\"sbFark\"><a ".$fark." title=\"Fark\">".$fark_img."</a></li>
						</ul>
            ";
    }

	echo "<ul class=\"iconNavbar\">";
		echo $links;
	echo "</ul><br class=\"clear\">";

?>
