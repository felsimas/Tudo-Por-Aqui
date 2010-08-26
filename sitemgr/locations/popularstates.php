<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/locations/states.php
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

	$url_redirect = "".DEFAULT_URL."/gerenciamento/locations/popularstates.php";
    $url_base = "".DEFAULT_URL."/gerenciamento";
    $sitemgr = 1;

    $url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

    extract($_GET);
    extract($_POST);
        
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['save'] == 1) {
               
        $dbObj  = db_getDBObject();
        $sql    = "UPDATE Location_State SET popular = 'n' WHERE 1".($estado_id ? " AND estado_id=$estado_id" : '');
        $result = $dbObj->query($sql);
        
        if (count($populars)) {
            $stateObj = new LocationState();
            for ($i=0;$i<count($populars);$i++) {
                $stateObj->id = $populars[$i];
                $stateObj->setPopular();
            }    
        }
        
        $message = ucfirst(LANG_SITEMGR_LOCATION_POPULARSTATES_WERESUCCESSUPDATED);
        
    }
    
    $where = array();
    if ($estado_id) {
        $where[] = "estado_id = $estado_id";
    }
    $where = count($where) > 0 ? implode(' AND ', $where) : '';

    // Page Browsing /////////////////////////////////////////
    $pageObj  = new pageBrowsing("Location_State", $screen, 9999, "popular DESC, name", "name", $letra, $where);
    $states   = $pageObj->retrievePage();

    $paging_url = DEFAULT_URL."/gerenciamento/locations/popularstates.php";

    // Letters Menu
    $letras = $pageObj->getString("letras");
    foreach ($letras as $each_letra) {
        if ($each_letra == "#") {
            $letras_menu .= "<a href=\"$paging_url\" ".((!$letra) ? "class=\"firstLetter\"" : "" ).">".strtoupper($each_letra)."</a>";
        } else {
            $letras_menu .= "<a href=\"$paging_url?letra=".$each_letra."\" ".(($each_letra == $letra) ? "style=\"color:#EF413D\"" : "" ).">".strtoupper($each_letra)."</a>";
        }
    }

    # PAGES DROP DOWN ----------------------------------------------------------------------------------------------
    $pagesDropDown = $pageObj->getPagesDropDown($_GET, $paging_url, $screen, system_showText(LANG_SITEMGR_PAGING_GOTOPAGE)." ", "this.form.submit();");

		# ----------------------------------------------------------------------------------------------------
		# HEADER
		# ----------------------------------------------------------------------------------------------------
		include(SM_EDIRECTORY_ROOT."/layout/header_manager.php");

	?>

		<div id="page-wrapper">

			<div id="main-wrapper">

			<?php 	include(SM_EDIRECTORY_ROOT."/menu.php"); ?>

				<div id="main-content"> 

					<div class="page-title ui-widget-content ui-corner-all">

						<div class="other_content">

		<? require(EDIRECTORY_ROOT."/gerenciamento/registration.php"); ?>
		<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
		<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

		<? include(INCLUDES_DIR."/tables/table_location_submenu.php");?>
        
        <br />
        <div id="header-form">
        <?=system_showText(LANG_SITEMGR_FILTER)?>
        </div>
        <br class="clear" />
        <? include_once(EDIRECTORY_ROOT."/includes/forms/form_location_popularstates_filter.php");?>
        <br class="clear" />
        <br /><br />
		<div id="header-form">
        <?=system_showText(LANG_SITEMGR_NAVBAR_STATES)?>
        </div>
        <? 
        if ($message) {
         echo "<p class=\"successMessage\">".$message."</p>";
        }
        ?>
		<? include_once(EDIRECTORY_ROOT."/includes/forms/form_location_popularstates.php");?>
		<br />
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