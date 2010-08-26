<?
    # ----------------------------------------------------------------------------------------------------
    # * FILE: /includes/tables/table_banner_reports.php
    # ----------------------------------------------------------------------------------------------------
?>

<?
    # ----------------------------------------------------------------------------------------------------
    # * HEADER
    # ----------------------------------------------------------------------------------------------------
?>
<style type="text/css">
    .dataTR     { background-color: #FFF; cursor: pointer; }
    .dataOver   { background-color: #EEE; cursor: pointer; }
    .dataActive { background-color: #CCC; cursor: pointer; }
</style>

<?
    # ----------------------------------------------------------------------------------------------------
    # * HEADER
    # ----------------------------------------------------------------------------------------------------
?>
	<div id="header-view">
		<?=system_showText(LANG_BANNER_TRAFFIC_REPORT)?> - <?=$banner->getString("caption")?>
	</div>
	
	<div style="visibility: hidden; display: none"  id="chartdiv2"></div>

    <script type="text/javascript">
		   var chart = new FusionCharts("<?php echo DEFAULT_URL ?>/fusioncharts/MSLine.swf", "ChartId", "625", "350", "0", "0");
		   chart.setDataURL("<?php echo DEFAULT_URL ?>/data/reportdata_analytics_banner.php?id=<?php echo $id;?>");		   
		   chart.render("chartdiv2");
		</script>
	
	
    <table border="0" cellpadding="2" cellspacing="2" class="standard-tableTOPBLUE">


<?
    # ----------------------------------------------------------------------------------------------------
    # * BANNER 
    # ----------------------------------------------------------------------------------------------------
?>
        <tr>
            <th colspan="3">
                <?
                    if(strpos($_SERVER['REQUEST_URI'], "/gerenciamento") !== false) {
                        if ($banner->getNumber("account_id")) {
                            $account = db_getFromDB("account", "id", db_formatNumber($banner->getNumber("account_id")));
                            $username = $account->getString("username");
                            echo system_showText(LANG_LABEL_ACCOUNT), ": <span>", system_showAccountUserName($username), "</span><br />";
                        } else {
                            echo system_showText(LANG_LABEL_ACCOUNT), ":<span> " . system_showText(LANG_SITEMGR_NOOWNER) . "</span><br />";
                        }
                    }
                ?>
             <!--   <?=system_showText(LANG_LABEL_NAME)?>: <span><?=$banner->getString('title', true); ?></span>
                <br />
                <?=system_showText(LANG_LABEL_LEVEL)?>: <?=$levelName?>
                <br /> -->
                <?=system_showText(LANG_LABEL_STATUS)?>: <?=$statusName?>
                <span><?=$owner?></span>
            </th>
        </tr>

<?
    # ----------------------------------------------------------------------------------------------------
    # * REPORT DATA
    # ----------------------------------------------------------------------------------------------------
?>
        <tr>
            <td width="160">
                <b><?=system_showText(LANG_LABEL_DATE)?></b>
            </td>
            <td width="270">
                <b style="color: #1D8BD1;"><?=system_showText("Impress&otilde;es")?></b>
            </td>
            <td width="270">
                <b style="color: #F1683C;"><?=system_showText("Cliques")?></b>
            </td>
        </tr>

        <?
            $idx = 0;
            foreach($reports AS $key => $report) {
                $idx++;
                list($year, $month) = explode('-', $key);
        ?>
                <tr id="dataTR<?=$idx;?>" class="<?=(($idx == 1) ? 'dataActive' : 'dataTR');?>" onmouseover="dataTRMouseOver(<?=$idx;?>)" onmouseout="dataTRMouseOut(<?=$idx;?>)" onclick="javascript:deactivateAll();changeChart(<?=$idx;?>,<?=$report['view'];?>,<?=$report['click_thru'];?>);">
                    <td><?=system_showDate('F', mktime(0, 0, 0, $month, 1, $year));?> / <?=$year;?></td>
                    <td><?=$report['view'];?></td>
                    <td><?=$report['click_thru'];?></td>
                </tr>
        <? } ?>

    </table>
