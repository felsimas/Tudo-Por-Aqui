<?

    # ----------------------------------------------------------------------------------------------------
    # * FILE: /gerenciamento/prefs/searchverify.php
    # ----------------------------------------------------------------------------------------------------

    # ----------------------------------------------------------------------------------------------------
    # LOAD CONFIG
    # ----------------------------------------------------------------------------------------------------
    include("../../conf/loadconfig.inc.php");

    # ----------------------------------------------------------------------------------------------------
    # SESSION
    # ----------------------------------------------------------------------------------------------------
    sess_validateSMSession();
    permission_hasSMPerm();

    # ----------------------------------------------------------------------------------------------------
    # SUBMIT
    # ----------------------------------------------------------------------------------------------------
    extract($_POST);
    extract($_GET);
    
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        
        // Google Code
        $searchMetaObj = new SearchMetaTag('google');
        
        if($_POST["google_tag"]) {

            if (validate_form("search_metatag", $_POST, $error)) {
                    
                if ($searchMetaObj->isSetField()) {
                    $searchMetaObj->setString('value', $_POST["google_tag"]);
                    $searchMetaObj->Save();
                } else {
                    $searchMetaObj->setString('name', 'google');
                    $searchMetaObj->setString('value', $_POST["google_tag"]);
                    $searchMetaObj->Save(false);    
                }    
                $success = true;
                
            }
            
        } else $searchMetaObj->Delete();
        
        // Yahoo Code
        $searchMetaObj = new SearchMetaTag('yahoo');
        
        if($_POST["yahoo_tag"]) {

            if (validate_form("search_metatag", $_POST, $error)) {
                
                if ($searchMetaObj->isSetField()) {
                    $searchMetaObj->setString('value', $_POST["yahoo_tag"]);
                    $searchMetaObj->Save();
                } else {
                    $searchMetaObj->setString('name', 'yahoo');
                    $searchMetaObj->setString('value', $_POST["yahoo_tag"]);
                    $searchMetaObj->Save(false);    
                }
                $success = true;
                
            }
            
        } else $searchMetaObj->Delete();
        
        // Live Code
        $searchMetaObj = new SearchMetaTag('live');

        if($_POST["live_tag"]) {

            if (validate_form("search_metatag", $_POST, $error)) {
                
                if ($searchMetaObj->isSetField()) {
                    $searchMetaObj->setString('value', $_POST["live_tag"]);
                    $searchMetaObj->Save();
                } else {
                    $searchMetaObj->setString('name', 'live');
                    $searchMetaObj->setString('value', $_POST["live_tag"]);
                    $searchMetaObj->Save(false);    
                }
                $success = true;
                
            }
            
        } else $searchMetaObj->Delete(); 
        
    }
    # ----------------------------------------------------------------------------------------------------
    # DEFINES
    # ----------------------------------------------------------------------------------------------------
    $searchMetaObj_google = new SearchMetaTag('google');
    $google_tag = html_entity_decode($searchMetaObj_google->getString('value'));
    $searchMetaObj_yahoo = new SearchMetaTag('yahoo');
    $yahoo_tag = html_entity_decode($searchMetaObj_yahoo->getString('value'));
    $searchMetaObj_live = new SearchMetaTag('live');
    $live_tag = html_entity_decode($searchMetaObj_live->getString('value'));
    
    # ----------------------------------------------------------------------------------------------------
    # HEADER
    # ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/header_manager.php");

    
    # ----------------------------------------------------------------------------------------------------
    # MESSAGES
    # ----------------------------------------------------------------------------------------------------
    $msg_success = system_showText(LANG_SITEMGR_SETTINGS_SEARCHVERIFY_MSGSUCCESS);

?>


<div id="page-wrapper">

	<div id="main-wrapper">
	
	<?php 	include(SM_EDIRECTORY_ROOT."/menu.php"); ?>
	
		<div id="main-content"> 

			<div class="page-title ui-widget-content ui-corner-all">

				<div class="other_content">

            <? require(EDIRECTORY_ROOT."/gerenciamento/registration.php"); ?>

            <div class="submenu">
                <ul>
                    <li><a href="javascript:history.back(-1)"><?=system_showText(LANG_SITEMGR_BACK)?></a></li>
                </ul>
            </div>  

            <br />

            <form id="searchmetatag" name="searchmetatag" action="<?=$_SERVER["PHP_SELF"]?>" method="post">
                <? include(INCLUDES_DIR."/forms/form_searchverify.php"); ?>
                <input type="hidden" name="itemedit" value="" />
            </form>

							</div>
						</div>
					</div>
				</div>
			</div>
		<div class="clearfix"></div>
<?
    # ----------------------------------------------------------------------------------------------------
    # FOOTER
    # ----------------------------------------------------------------------------------------------------
    include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>
