<?php

    if ((strpos($_SERVER["PHP_SELF"], "registration.php") === false) && (strpos($_SERVER["PHP_SELF"], "about.php") === false)) {


        $edir_default_language_aux = $edir_default_language;
        $edir_languages_aux = $edir_languages;
        $edir_languagenames_aux = $edir_languagenames;
        $edir_language_aux = $edir_language;

        $edirlanguages = explode("," , $edir_languages_aux);
        $edirlanguagenames = explode("," , $edir_languagenames_aux);
        $edir_languages_aux = "";
        $edir_languagenames_aux = "";
        for ($ediri=0; $ediri<count($edirlanguages); $ediri++) {
            if (!$edirlanguages[$ediri]) {
                $edirlanguages[$ediri] = $edir_default_language_aux;
            }
            if (!$edirlanguagenames[$ediri]) {
                $edirlanguagenames[$ediri] = $edirlanguages[$ediri];
            }
            if ($edirlanguages[$ediri] != $edir_default_language_aux) {
                $edir_languages_aux = $edir_languages_aux.$edirlanguages[$ediri].",";
                $edir_languagenames_aux = $edir_languagenames_aux.$edirlanguagenames[$ediri].",";
            } else {
                $edir_languages_aux = $edirlanguages[$ediri].",".$edir_languages_aux;
                $edir_languagenames_aux = $edirlanguagenames[$ediri].",".$edir_languagenames_aux;
            }
        }
        if (strpos($edir_languages_aux, $edir_default_language_aux) === false) {
            $edir_languages_aux = $edir_default_language_aux.",".$edir_languages_aux;
            $edir_languagenames_aux = $edir_default_language_aux.",".$edir_languagenames_aux;
        }
        $edir_languages_aux = substr($edir_languages_aux, 0, strlen($edir_languages_aux)-1);
        $edir_languagenames_aux = substr($edir_languagenames_aux, 0, strlen($edir_languagenames_aux)-1);
        unset($edirlanguages);
        unset($edirlanguagenames);
        unset($ediri);


        if (""=="") {

            $edir_default_language_aux = $edir_default_language_aux;
            $edir_languages_aux = $edir_default_language_aux;
            if (strpos($edir_languagenames_aux, ",") !== false) {
                $edir_languagenames_aux = substr($edir_languagenames_aux, 0, strpos($edir_languagenames_aux, ","));
            } else {
                $edir_languagenames_aux = $edir_languagenames_aux;
            }
            $edir_language_aux = $edir_default_language_aux;

        }

        define(EDIR_DEFAULT_LANGUAGE, $edir_default_language_aux);
        define(EDIR_LANGUAGES, $edir_languages_aux);
        define(EDIR_LANGUAGENAMES, $edir_languagenames_aux);
        if (file_exists(EDIRECTORY_ROOT."/lang/".$edir_language_aux.".php")) {
            define(EDIR_LANGUAGE, $edir_language_aux);
            include(EDIRECTORY_ROOT."/lang/".$edir_language_aux.".php");
        } else {
            define(EDIR_LANGUAGE, $edir_default_language_aux);
            include(EDIRECTORY_ROOT."/lang/".$edir_default_language_aux.".php");
        }
        if ((strpos($_SERVER["PHP_SELF"], "/gerenciamento") !== false)) {
            if (file_exists(EDIRECTORY_ROOT."/lang/".$edir_language_aux."_sitemgr.php")) {
                include(EDIRECTORY_ROOT."/lang/".$edir_language_aux."_sitemgr.php");
            } else {
                include(EDIRECTORY_ROOT."/lang/".$edir_default_language_aux."_sitemgr.php");
            }
        }

        unset($edir_default_language_aux);
        unset($edir_languages_aux);
        unset($edir_languagenames_aux);
        unset($edir_language_aux);

    }

?>