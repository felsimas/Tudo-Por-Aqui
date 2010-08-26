<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/prefs/theme.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");
	
	if (DEMO_MODE == 1) { exit; }
	
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
	
	$fileThemeConfigPath    = EDIRECTORY_ROOT.'/custom/theme.inc.php';
	$folderThemesPath 		= EDIRECTORY_ROOT.'/custom/theme_files';
	
	// Default CSS class for message
	$message_style = "successMessage";

	if ($_SERVER['REQUEST_METHOD'] == "POST") {
    	
    	$select_theme =  $select_theme == 'edirectorycompact' ? '' : $select_theme;
    	
    	$status = 'success';
    	
    	if (!$fileThemeConfig = fopen($fileThemeConfigPath, 'w+')) {
    		
    		$status = 'error';
    		
    	} else {
			
			$buffer  = "<?php ".PHP_EOL."\$edir_theme=\"$select_theme\";".PHP_EOL;
			
			if (!fwrite($fileThemeConfig, $buffer, strlen($buffer))) {
			
			    $status = 'error';
			    
			}
    		
    	}
		
		header("Location: ".DEFAULT_URL."/gerenciamento/prefs/theme.php?status=$status");
	}

	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------
	$folderThemes  = opendir($folderThemesPath);
	$folders 	   = array();
	while ($folder = readdir($folderThemes)) {
		if ($folder != 'sample' && $folder != '.' && $folder != '..') {
			$folders[] = $folder;
		}
	}
	$valuesArray  = array('edirectory'); $_valuesArray = explode(',', EDIR_THEMES);
	$namesArray   = array('eDirectory Default'); $_namesArray  = explode(',', EDIR_THEMENAMES);
	for ($i=0;$i<count($_valuesArray);$i++) {
		if (in_array($_valuesArray[$i], $folders)) {
			if ($_namesArray[$i]) {
				$valuesArray[] = $_valuesArray[$i];
				$namesArray[]  = $_namesArray[$i];
			}
		}
	}
	
	$edir_theme = EDIR_THEME == '' ? 'edirectory' : EDIR_THEME;
	
	$selectThemes = html_selectBox('select_theme', $namesArray, $valuesArray, $edir_theme, "style=\"width:220px;\"", '');
	
	//Messages
	if ($status == 'success') {
		$message = system_showText(LANG_SITEMGR_SETTINGS_THEMES_THEMEWASCHANGED);
		$message_style = 'successMessage';
	} else if ($status == 'failed') {
		$message = system_showText(LANG_SITEMGR_MSGERROR_SYSTEMERROR);
		$message_style = 'errorMessage';
	}

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

			<? include(INCLUDES_DIR."/tables/table_prefs_submenu.php"); ?>
            
			<br />

			<form name="review_options" action="<?=$_SERVER["PHP_SELF"]?>" method="post">
				<? include(INCLUDES_DIR."/forms/form_themesettings.php"); ?>
				<table style="margin: 0 auto 0 auto;">
					<tr>
						<td>
							<button type="submit" name="review_options" value="Submit" class="ui-state-default ui-corner-all"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
						</td>
					</tr>
				</table>
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
