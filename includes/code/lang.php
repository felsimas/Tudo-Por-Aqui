<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/langcenter/lang.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
    # SUBMIT
    # ----------------------------------------------------------------------------------------------------
    
    
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        
        $lang = new Lang();
        
        $messageError = '';
        
        if (!$id) {
            $messageError = system_showText(LANG_SITEMGR_MSGERROR_CODEISREQUIRED);
        }
        
        if (!$name) {
            $messageError = system_showText(LANG_SITEMGR_MSGERROR_NAMEISREQUIRED);
        }
        
        if ($_POST['_lang_enabled'] == 'n' && $_POST['lang_enabled'] == 'y') {
			if (($lang->getCountEnabledLang()+1) > MAX_ENABLED_LANGUAGES) {
				$messageError = system_showText(LANG_SITEMGR_MSGERROR_MAXLANGENABLED);
			}
        }
        
        if ($_POST['lang_default'] == 'y' && !$_POST['lang_enabled']) {
        	$messageError = system_showText(LANG_SITEMGR_MSGERROR_YOUCANNOTDISABLEDEFAULTLANG);
		}
        
        if (!$messageError) {
            
            if ($_POST['lang_default'] == 'y') {
                $dbObj  = db_getDBObject();
                $query  = "UPDATE Lang SET lang_default='n' WHERE 1";
                $result = $dbObj->query($query);
                $_POST['lang_order'] = '0';
            }
        
            $lang->makeFromRow($_POST);
            
            $error = '';
            if ($lang->Save()) {
				$message = LANG_SITEMGR_LANGUAGE.' '.LANG_SITEMGR_SUCCESSUPDATED;
				
            } else  {
                $message = LANG_SITEMGR_MSGERROR_SYSTEMERROR;
                $error = '1';
            }
            
            header("Location: $url_redirect/index.php?message=".urlencode($message)."&error=$error&screen=$screen&letra=$letra".(($url_search_params) ? "&$url_search_params" : ""));
              
            
        }
        
        
    }
    
    # ----------------------------------------------------------------------------------------------------
    # FORMS DEFINES
    # ----------------------------------------------------------------------------------------------------
    $id = $_GET["id"] ? $_GET["id"] : $_POST["id"];
    
    if ($id) {
        $lang = new Lang($id);
        $lang->extract();
    } else {
         $lang = new Lang();
         $lang->makeFromRow($_POST);
    }
    
    extract($_POST);
    extract($_GET);

?>