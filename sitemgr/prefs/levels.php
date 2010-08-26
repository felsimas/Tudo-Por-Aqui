<?
	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/prefs/levels.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

    # ----------------------------------------------------------------------------------------------------
    # VALIDATE FEATURE
    # ----------------------------------------------------------------------------------------------------
    if (ABLE_RENAME_LEVEL != "on") { exit; }
    
	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);
    
	// Default CSS class for message
	$message_style = "successMessage";

	if ($_SERVER['REQUEST_METHOD'] == "POST") {

		// Listing Level Names
		if($_POST["listinglevelnames"]) {

			if (validate_form("listinglevelnames", $_POST, $error)) {

				$dbObj = db_getDBObject();
                $levelObj = new ListingLevel(EDIR_DEFAULT_LANGUAGE, true);
				$levelsArray = $levelObj->getLevelValues();
                foreach ($levelsArray as $levelValue) {

                    if(!isset($nameLevel[$levelValue])) { $nameLevel[$levelValue] = ""; }
                    if(!isset($activeLevel[$levelValue])) { $activeLevel[$levelValue] = "n"; }

                    $sql = "UPDATE ListingLevel SET name = '".strtolower($nameLevel[$levelValue])."', active = '".$activeLevel[$levelValue]."' WHERE value = ".$levelValue."";
                    $dbObj->query($sql);
                }

			} else {
                $actions[] = $error;
                $message_style = "errorMessage";
			}
            
            if (!$error) {
                $actions[] = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_SETTINGS_LEVELS_WHERECHANGED);
            } else {
                $actions[] = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_MSGERROR_SYSTEMERROR);
                $message_style = "errorMessage";
            }

            if($actions) {
                $message_listinglevelnames = implode('<br />', $actions);
            }

		}

		// Event Level Names
		else if($_POST["eventlevelnames"]) {

            if (validate_form("eventlevelnames", $_POST, $error)) {

                $dbObj = db_getDBObject();
                $levelObj = new EventLevel(EDIR_DEFAULT_LANGUAGE, true);
                $levelsArray = $levelObj->getLevelValues();
                foreach ($levelsArray as $levelValue) {

                    if(!isset($nameLevel[$levelValue])) { $nameLevel[$levelValue] = ""; }
                    if(!isset($activeLevel[$levelValue])) { $activeLevel[$levelValue] = "n"; }

                    $sql = "UPDATE EventLevel SET name = '".strtolower($nameLevel[$levelValue])."', active = '".$activeLevel[$levelValue]."' WHERE value = ".$levelValue."";
                    $dbObj->query($sql);
                }

            } else {
                $actions[] = $error;
                $message_style = "errorMessage";
            }
            
            if (!$error) {
                $actions[] = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_SETTINGS_LEVELS_WHERECHANGED);
            } else {
                $actions[] = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_MSGERROR_SYSTEMERROR);
                $message_style = "errorMessage";
            }

            if($actions) {
                $message_eventlevelnames .= implode('<br />', $actions);
            }

        }

		// Banner Level Names
		else if($_POST["bannerlevelnames"]) {

            if (validate_form("bannerlevelnames", $_POST, $error)) {

                $dbObj = db_getDBObject();
                $levelObj = new BannerLevel(EDIR_DEFAULT_LANGUAGE, true);
                $levelsArray = $levelObj->getLevelValues();
                foreach ($levelsArray as $levelValue) {

                    if(!isset($nameLevel[$levelValue])) { $nameLevel[$levelValue] = ""; }
                    if(!isset($activeLevel[$levelValue])) { $activeLevel[$levelValue] = "n"; }

                    $sql = "UPDATE BannerLevel SET displayName = '".strtolower($nameLevel[$levelValue])."', active = '".$activeLevel[$levelValue]."' WHERE value = ".$levelValue."";
                    
                    $dbObj->query($sql);
                }

            } else {
                $actions[] = $error;
                $message_style = "errorMessage";
            }

            if (!$error) {
                $actions[] = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_SETTINGS_LEVELS_WHERECHANGED);
            } else {
                $actions[] = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_MSGERROR_SYSTEMERROR);
                $message_style = "errorMessage";
            }

            if($actions) {
                $message_bannerlevelnames .= implode('<br />', $actions);
            }
            
        }

		// Classified Level Names
        else if($_POST["classifiedlevelnames"]) {

            if (validate_form("classifiedlevelnames", $_POST, $error)) {

                $dbObj = db_getDBObject();
                $levelObj = new ClassifiedLevel(EDIR_DEFAULT_LANGUAGE, true);
                $levelsArray = $levelObj->getLevelValues();
                foreach ($levelsArray as $levelValue) {

                    if(!isset($nameLevel[$levelValue])) { $nameLevel[$levelValue] = ""; }
                    if(!isset($activeLevel[$levelValue])) { $activeLevel[$levelValue] = "n"; }

                    $sql = "UPDATE ClassifiedLevel SET name = '".strtolower($nameLevel[$levelValue])."', active = '".$activeLevel[$levelValue]."' WHERE value = ".$levelValue."";

                    $dbObj->query($sql);
                }

            } else {
                $actions[] = $error;
                $message_style = "errorMessage";
            }

            if (!$error) {
                $actions[] = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_SETTINGS_LEVELS_WHERECHANGED);
            } else {
                $actions[] = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_MSGERROR_SYSTEMERROR);
                $message_style = "errorMessage";
            }

            if($actions) {
                $message_classifiedlevelnames .= implode('<br />', $actions);
            }

        }


		// Article Level Names
        else if($_POST["articlelevelnames"]) {

            if (validate_form("articlelevelnames", $_POST, $error)) {

                $dbObj = db_getDBObject();
                $levelObj = new ArticleLevel(EDIR_DEFAULT_LANGUAGE, true);
                $levelsArray = $levelObj->getLevelValues();
                foreach ($levelsArray as $levelValue) {

                    if(!isset($nameLevel[$levelValue])) { $nameLevel[$levelValue] = ""; }
                    if(!isset($activeLevel[$levelValue])) { $activeLevel[$levelValue] = "n"; }

                    $sql = "UPDATE ArticleLevel SET name = '".strtolower($nameLevel[$levelValue])."', active = '".$activeLevel[$levelValue]."' WHERE value = ".$levelValue."";

                    $dbObj->query($sql);
                }

            } else {
                $actions[] = $error;
                $message_style = "errorMessage";
            }

            if (!$error) {
                $actions[] = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_SETTINGS_LEVELS_WHERECHANGED);
            } else {
                $actions[] = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_MSGERROR_SYSTEMERROR);
                $message_style = "errorMessage";
            }

            if($actions) {
                $message_articlelevelnames .= implode('<br />', $actions);
            }

        }
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

			<? $module = "listing"; ?>
            <form name="<?=$module;?>levelnames" action="<?=$_SERVER["PHP_SELF"]?>#link" method="post">
				<? include(INCLUDES_DIR."/forms/form_levelname.php"); ?>
				<table style="margin: 0 auto 0 auto;">
					<tr>
						<td>
							<button type="submit" name="<?=$module;?>levelnames" value="Submit" class="ui-state-default ui-corner-all"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
						</td>
					</tr>
				</table>
			</form>

            <? if (EVENT_FEATURE == "on") { ?>
                <? $module = "event"; ?>
                <form name="<?=$module;?>levelnames" action="<?=$_SERVER["PHP_SELF"]?>#link" method="post">
                    <? include(INCLUDES_DIR."/forms/form_levelname.php"); ?>
                    <table style="margin: 0 auto 0 auto;">
                        <tr>
                            <td>
                                <button type="submit" name="<?=$module;?>levelnames" value="Submit" class="ui-state-default ui-corner-all"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
                            </td>
                        </tr>
                    </table>
                </form>
            <? } ?>

            <? if (BANNER_FEATURE == "on") { ?>
                <? $module = "banner"; ?>
                <form name="<?=$module;?>levelnames" action="<?=$_SERVER["PHP_SELF"]?>#link" method="post">
                    <? include(INCLUDES_DIR."/forms/form_levelname.php"); ?>
                    <table style="margin: 0 auto 0 auto;">
                        <tr>
                            <td>
                                <button type="submit" name="<?=$module;?>levelnames" value="Submit" class="ui-state-default ui-corner-all"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
                            </td>
                        </tr>
                    </table>
                </form>
            <? } ?>
            
            <? if (CLASSIFIED_FEATURE == "on") { ?>
                <? $module = "classified"; ?>
                <form name="<?=$module;?>levelnames" action="<?=$_SERVER["PHP_SELF"]?>#link" method="post">
                    <? include(INCLUDES_DIR."/forms/form_levelname.php"); ?>
                    <table style="margin: 0 auto 0 auto;">
                        <tr>
                            <td>
                                <button type="submit" name="<?=$module;?>levelnames" value="Submit" class="ui-state-default ui-corner-all"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
                            </td>
                        </tr>
                    </table>
                </form>
            <? } ?>
            
            <? if (ARTICLE_FEATURE == "on") { ?>
                <? $module = "article"; ?>
                <form name="<?=$module;?>levelnames" action="<?=$_SERVER["PHP_SELF"]?>#link" method="post">
                    <? include(INCLUDES_DIR."/forms/form_levelname.php"); ?>
                    <table style="margin: 0 auto 0 auto;">
                        <tr>
                            <td>
                                <button type="submit" name="<?=$module;?>levelnames" value="Submit" class="ui-state-default ui-corner-all"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
                            </td>
                        </tr>
                    </table>
                </form>
			<? } ?>
            
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