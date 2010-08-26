<?
    include("../../conf/loadconfig.inc.php");

    # ----------------------------------------------------------------------------------------------------
    # SESSION
    # ----------------------------------------------------------------------------------------------------
    sess_validateSMSession();
    permission_hasSMPerm();

    # ----------------------------------------------------------------------------------------------------
    # CODE
    # ----------------------------------------------------------------------------------------------------
    $chartColors     = array();
    $chartColors[1]  = "336699";
    $chartColors[2]  = "6699CC";
    $chartColors[3]  = "339933";
    $chartColors[4]  = "00CC00";
    $chartColors[5]  = "CC3300";
    $chartColors[6]  = "FF6600";
    $chartColors[7]  = "FF9933";
    $chartColors[8]  = "CC9966";
    $chartColors[9]  = "999999";
    $chartColors[10]  = "996699";
    $chartColors[11] = "9999FF";
    $chartColors[12] = "339999";
    $chartColors[13] = "A5A469";
    $chartColors[14] = "000000";
    $chartColors[15] = "666666";

    $modules[] = "h";
    $modules[] = "l";
    if(EVENT_FEATURE == "on")       $modules[] = "e";
    if(CLASSIFIED_FEATURE == "on")  $modules[] = "c";
    if(ARTICLE_FEATURE == "on")     $modules[] = "a";

    # ----------------------------------------------------------------------------------------------------
    # GET DATABASE
    # ----------------------------------------------------------------------------------------------------
    $db = db_getDBObject();

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/header_manager.php");
?>

<script language="JavaSCRIPT">
    function displayReport(module) {
        <? foreach($modules as $module ) { ?>
            document.getElementById("module_<?=$module;?>").style.display = "none";
						document.getElementById("style_module_<?=$module;?>").className = "";
        <? } ?>
				
        document.getElementById(module).style.display = "block";
				document.getElementById('style_' + module).className = "active";
    }
</script>

<div id="page-wrapper">

	<div id="main-wrapper">
	
	<?php 	include(SM_EDIRECTORY_ROOT."/menu.php"); ?>
	
		<div id="main-content"> 

			<div class="page-title ui-widget-content ui-corner-all">

				<div class="other_content">

        <? require(EDIRECTORY_ROOT."/gerenciamento/registration.php"); ?>

        <?
            $sql = "SELECT DISTINCT YEAR(`day`) AS `year` FROM `Report_Statistic` ORDER BY `year` DESC";
            $result = mysql_query($sql);        
            $years = array();
            if($result){
                while($row = mysql_fetch_array($result)) {
                    $years[] = $row['year'];
                }
            }
        ?>
        
        <? if(count($years) > 0) { ?>
        <div class="reportPeriod">
				<form name='searchStatistReport' method='get'>
				<table class="reportForm" cellpadding="0" cellspacing="0">
					<tr>
						<td class="left" align="left">
							<h2><?=system_showText(LANG_SITEMGR_REPORT_LABEL_SELECTAPERIOD)?></h2>
						</td>
						<td class="right" valign="top">

										<label><?=system_showText(LANG_SITEMGR_REPORT_LABEL_MONTH)?>: </label>
										<select name='month'>
												<option value='1'  <?=($_GET['month'] ==  1) ? "selected='selected'" : ""; ?>><?=system_showText(LANG_SITEMGR_REPORT_JANUARY)?></option>
												<option value='2'  <?=($_GET['month'] ==  2) ? "selected='selected'" : ""; ?>><?=system_showText(LANG_SITEMGR_REPORT_FEBRUARY)?></option>
												<option value='3'  <?=($_GET['month'] ==  3) ? "selected='selected'" : ""; ?>><?=system_showText(LANG_SITEMGR_REPORT_MARCH)?></option>
												<option value='4'  <?=($_GET['month'] ==  4) ? "selected='selected'" : ""; ?>><?=system_showText(LANG_SITEMGR_REPORT_APRIL)?></option>
												<option value='5'  <?=($_GET['month'] ==  5) ? "selected='selected'" : ""; ?>><?=system_showText(LANG_SITEMGR_REPORT_MAY)?></option>
												<option value='6'  <?=($_GET['month'] ==  6) ? "selected='selected'" : ""; ?>><?=system_showText(LANG_SITEMGR_REPORT_JUNE)?></option>
												<option value='7'  <?=($_GET['month'] ==  7) ? "selected='selected'" : ""; ?>><?=system_showText(LANG_SITEMGR_REPORT_JULY)?></option>
												<option value='8'  <?=($_GET['month'] ==  8) ? "selected='selected'" : ""; ?>><?=system_showText(LANG_SITEMGR_REPORT_AUGUST)?></option>
												<option value='9'  <?=($_GET['month'] ==  9) ? "selected='selected'" : ""; ?>><?=system_showText(LANG_SITEMGR_REPORT_SEPTEMBER)?></option>
												<option value='10' <?=($_GET['month'] == 10) ? "selected='selected'" : ""; ?>><?=system_showText(LANG_SITEMGR_REPORT_OCTOBER)?></option>
												<option value='11' <?=($_GET['month'] == 11) ? "selected='selected'" : ""; ?>><?=system_showText(LANG_SITEMGR_REPORT_NOVEMBER)?></option>
												<option value='12' <?=($_GET['month'] == 12) ? "selected='selected'" : ""; ?>><?=system_showText(LANG_SITEMGR_REPORT_DECEMBER)?></option>
										</select>

										<label><?=system_showText(LANG_SITEMGR_REPORT_LABEL_YEAR)?>: </label>
										<select name='year'>
												<? foreach($years as $year) { ?>
														<option value='<?=$year;?>' <?=($_GET['year'] == $year) ? "selected='selected'" : ""; ?>><?=$year;?></option>
												<? } ?>
										</select>
											
										
								
						</td>
						<td>
							<input type="submit" value="<?=system_showText(LANG_SITEMGR_SEARCH)?>" class="button-form" />
						</td>
					</tr>
				</table>
				</form>
			</div>
        <? } else { ?>
            <div class="response-msg inf ui-corner-all"><?=system_showText(LANG_SITEMGR_REPORT_REPORTEMPTYMESSAGE)?></div>
        <? } ?>

        <? if (($_GET["year"]) && ($_GET['month']) && is_numeric($_GET["year"]) && is_numeric($_GET['month'])) {
                $sql = "SELECT `module`, `key`, `value`, SUM(`quantity`) AS quantity FROM `Report_Statistic` WHERE YEAR(`day`) = '".$_GET["year"]."' AND MONTH(`day`) = '".$_GET["month"]."' GROUP BY `module`, `key`, `value` ORDER BY `module` ASC, `key` ASC, `quantity` DESC;";
                $result = mysql_query($sql);
                
                if($result) {
                    $report = array();
                    $reportTotalKey = array();
                    $actualModule = "none";
                    $actualKey = "none";
                    
                    while($row = mysql_fetch_array($result)) {
                        $module     = $row["module"];
                        $key        = $row["key"];
                        $value      = $row["value"];
                        $quantity   = $row["quantity"];
                        
                        if($actualModule != $module) {
                            $actualModule = $module;
                            $report[$actualModule] = array();
                            $reportTotalKey[$actualModule] = array();
                        }

                        if($actualKey != $key) {
                            $totalKey = 0;
                            $actualKey = $key;
                            $report[$actualModule][$actualKey] = array();
                            $reportTotalKey[$actualModule][$actualKey] = 0;
                        }

                        if(count($report[$actualModule][$actualKey]) < 15 ) {
                            $report[$actualModule][$actualKey][$value]["quantity"] = $quantity;
                            $reportTotalKey[$actualModule][$actualKey] += $quantity;
                        }
                    }
                }

                /* TABS */
                echo "<div class=\"reportPeriodTabs\">";
                echo "<ul>";
                foreach ($modules as $module) {
                    if($module == 'h') $name = system_showText(LANG_SITEMGR_REPORT_GENERALSEARCHES);
                    if($module == 'l') $name = system_showText(LANG_SITEMGR_NAVBAR_LISTING);
                    if($module == 'a') $name = system_showText(LANG_SITEMGR_NAVBAR_ARTICLE);
                    if($module == 'e') $name = system_showText(LANG_SITEMGR_NAVBAR_EVENT);
                    if($module == 'c') $name = system_showText(LANG_SITEMGR_NAVBAR_CLASSIFIED);
                    echo "<li id='style_module_".$module."'><a href=\"javascript:void(0);\" onclick=\"javascript:displayReport('module_".$module."');\">".$name."</a></li>";
                }
                echo "</ul><br class=\"clear\">";
				echo "</div>";
                ?>

                <? foreach ($modules as $module) { ?>
                    <div id="module_<?=$module;?>" style='display:none;'>
                        <div class='default-report'>
                            <table cellpadding='0' cellspacing='0' border='1' class='highlight-report'>
                                <tbody>
                                    <tr>
                                        <th class='highlight-title'>
                                            <?=system_showText(LANG_SITEMGR_REPORT_STATISTICREPORT)?> : <span>
                                            <?
                                                if($module == 'h') echo system_showText(LANG_SITEMGR_REPORT_GENERALSEARCHES);
                                                if($module == 'l') echo ucwords(system_showText(LANG_SITEMGR_LISTING_PLURAL));
                                                if($module == 'a') echo ucwords(system_showText(LANG_SITEMGR_ARTICLE_PLURAL));
                                                if($module == 'e') echo ucwords(system_showText(LANG_SITEMGR_EVENT_PLURAL));
                                                if($module == 'c') echo ucwords(system_showText(LANG_SITEMGR_CLASSIFIED_PLURAL));
                                            ?>
                                            </span>
                                        </th>
                                        <th class='highlight-title-center'>
                                             <? echo system_showText(LANG_SITEMGR_REPORT_LABEL_MONTH).': <span>', system_showDate('F', mktime(0, 0, 0, $_GET['month'], 1, $_GET['year'])), '</span> / '.system_showText(LANG_SITEMGR_REPORT_LABEL_YEAR).': <span>', $_GET['year'], '</span>'; ?>
                                        </th>
                                    </tr>

                                    <? /* keywords */ ?>
                                    <? if(count($report[$module]['keywords']) > 0) { ?>
                                        <tr>
                                            <td class='left'>

                                                <h3><?=system_showText(LANG_SITEMGR_REPORT_TOP15KEYWORDS)?></h3>

                                                <table cellpadding="0" cellspacing="0" class="reportList">

                                                    <?
                                                    $idx = 1;
                                                    $colorList   = array();
                                                    $percentList = array();
                                                    $labelList   = array();
                                                    foreach($report[$module]['keywords'] as $data => $quantity) {
                                                        $percent = format_money((($quantity['quantity'] * 100) / $reportTotalKey[$module]['keywords']), 2);
                                                        echo "<tr><td class='chart-color-", $idx, "'>", $data, '</td><td class="number">', $percent, '%</td></tr>';
                                                        $idx++;
                                                        $colorList[] = $chartColors[$idx - 1];
                                                        $labelList[]   = $percent . "%";
                                                        $percentList[] = $percent;
                                                    }
                                                    ?>

                                                </table>

                                            </td>
                                            <td class='right'>
                                                <? echo "<img src='http://chart.apis.google.com/chart?chs=350x170&amp;chf=bg,s,ffffff&amp;cht=p3&amp;chd=t:", implode(',', $percentList),"&amp;chl=", implode('|', $labelList),"&amp;chco=", implode(',', $colorList), "' alt='".system_showText(LANG_SITEMGR_REPORT_STATISTICCHART)."'/>"; ?>
                                            </td>
                                        </tr>
                                    <? } else { ?>
                                        <tr>
                                            <td class='left right' colspan="2">
                                                <h3><?=system_showText(LANG_SITEMGR_REPORT_TOP15KEYWORDS)?></h3>
                                                <div class="response-msg inf ui-corner-all"><?=system_showText(LANG_SITEMGR_REPORT_EMPTYMESSAGE)?></div>
                                            </td>
                                        </tr>
                                    <? } ?>

                                    <? /* where */ ?>
                                    <? if(($module != 'a')) { ?>
                                        <? if(count($report[$module]['where']) > 0) { ?>
                                            <tr>
                                                <td class='left'>

                                                    <h3><?=system_showText(LANG_SITEMGR_REPORT_TOP15WHERE)?></h3>
																								    
												    <table cellpadding="0" cellspacing="0" class="reportList">
													    
                                                        <?
													    $idx = 1;
													    $colorList   = array();
													    $percentList = array();
													    $labelList   = array();
													    foreach($report[$module]['where'] as $data => $quantity) {
													        $percent = format_money((($quantity['quantity'] * 100) / $reportTotalKey[$module]['where']), 2);
													        echo "<tr><td class='chart-color-", $idx, "'>", $data, '</td><td class="number">', $percent, '%</td></tr>';
													        $idx++;
													        $colorList[] = $chartColors[$idx - 1];
													        $labelList[]   = $percent . "%";
													        $percentList[] = $percent;
													    }
													    ?>
                                                        
												    </table>
                                                    
                                                </td>
                                                <td class='right'>
                                                    <? echo "<img src='http://chart.apis.google.com/chart?chs=350x170&amp;chf=bg,s,ffffff&amp;cht=p3&amp;chd=t:", implode(',', $percentList),"&amp;chl=", implode('|', $labelList),"&amp;chco=", implode(',', $colorList), "' alt='".system_showText(LANG_SITEMGR_REPORT_STATISTICCHART)."'/>"; ?>
                                                </td>
                                            </tr>
                                        <? } else { ?>
                                            <tr>
                                                <td class='left right' colspan="2">
                                                    <h3><?=system_showText(LANG_SITEMGR_REPORT_TOP15WHERE)?></h3>
                                                    <div class="response-msg inf ui-corner-all"><?=system_showText(LANG_SITEMGR_REPORT_EMPTYMESSAGE)?></div>
                                                </td>
                                            </tr>
                                        <? } ?>
                                    <? } ?>

                                    <? if(($module != 'h')) { ?>
                                        <tr>
                                            <td <?=($module != 'a') ? "class='left'" : "class='extended' colspan='2'"; ?>>
                                                <h3 <?=($module != 'a') ? "" : "class='extended'"; ?>><?=system_showText(LANG_SITEMGR_REPORT_TOP15CATEGORIES)?></h3>
                                                <? if(count($report[$module]['categories']) > 0) { ?>
                                                    <table cellpadding="0" cellspacing="0" class="reportList">
                                                        <?
                                                            foreach($report[$module]['categories'] as $data => $quantity) {
                                                                $percent = format_money((($quantity['quantity'] * 100) / $reportTotalKey[$module]['categories']), 2);
                                                                //echo "<li>", $data, '<span>', $percent, '%</span></li>';
														        echo "<tr><td>", $data, '</td><td class="number">', $percent, '%</td></tr>';
                                                            }
                                                        ?>
                                                    </table>
                                                <? } else { ?>                                            
                                                    <div class="response-msg inf ui-corner-all"><?=system_showText(LANG_SITEMGR_REPORT_EMPTYMESSAGE)?></div>
                                                <? } ?>
                                            </td>
                                            <? if($module != 'a') { ?>
                                                <td class='right'>
                                                    <h3 class="extented"><?=system_showText(LANG_SITEMGR_REPORT_TOP15LOCATIONS)?></h3>
                                                    <? if(count($report[$module]['locations']) > 0) { ?>
												        <table cellpadding="0" cellspacing="0" class="reportList">
                                                            <?
                                                                foreach($report[$module]['locations'] as $data => $quantity) {
                                                                    $percent = format_money((($quantity['quantity'] * 100) / $reportTotalKey[$module]['locations']), 2);
                                                                    echo "<tr><td>", $data, '</td><td class="number">', $percent, '%</td></tr>';
                                                                }
                                                            ?>
                                                        </table>
                                                    <? } else {?>
                                                        <div class="response-msg inf ui-corner-all"><?=system_showText(LANG_SITEMGR_REPORT_EMPTYMESSAGE)?></div>
                                                    <? } ?>
                                                </td>
                                            <? } ?>
                                        </tr>
                                    <? } ?>

                                    <tr>
                                        <th class='highlight-subtitle-left'>
                                            <?=DEFAULT_URL;?>
                                        </th>
                                        <th class='highlight-subtitle'>
                                            <?=system_showText(LANG_SITEMGR_REPORT_STATISTICSEARCHREPORTBY)?> <span></span>
                                        </th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <? } ?>
                <script language="JavaSCRIPT">displayReport('module_h');</script>
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