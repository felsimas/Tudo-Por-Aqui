<?
    /*==================================================================*\
    ######################################################################
    #                                                                    #
    # SisDir Class- System of Class Online 2009           #
    #                                                                    #
    #                #
    #                       #
    #                                                                    #
    # ---------------- 2009 - this file is used in php. ----------------- #
    #                                                                    #
    # http://wxw.google.cn / wxw.msn.cn #
    ######################################################################
    \*==================================================================*/

    # ----------------------------------------------------------------------------------------------------
    # * FILE: /includes/tables/table_article_reports.php
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
		<?=system_showText(LANG_ARTICLE_TRAFFIC_REPORT)?> - <?=$article->getString("title")?>
	</div>
    <table border="0" cellpadding="2" cellspacing="2" class="standard-tableTOPBLUE">

<?
    # ----------------------------------------------------------------------------------------------------
    # * CHART
    # ----------------------------------------------------------------------------------------------------
?>
        <tr>
            <td  colspan="7">
                <div id="reportChart" style="widht:700px; height:200px; background: #FFF url(<?=DEFAULT_URL?>/images/img_loading.gif) 50% 50% no-repeat;">&nbsp;</div>
            </td>
        </tr>

<?
    # ----------------------------------------------------------------------------------------------------
    # * ARTICLE 
    # ----------------------------------------------------------------------------------------------------
?>
        <tr>
            <th colspan="3">
                <?
                    if(strpos($_SERVER['REQUEST_URI'], "/gerenciamento") !== false) {
                        if ($article->getNumber("account_id")) {
                            $account = db_getFromDB("account", "id", db_formatNumber($article->getNumber("account_id")));
                            $username = $account->getString("username");
                            echo system_showText(LANG_LABEL_ACCOUNT), ": <span>", system_showAccountUserName($username), "</span><br />";
                        } else {
                            echo system_showText(LANG_LABEL_ACCOUNT), ":<span> " . system_showText(LANG_SITEMGR_NOOWNER) . "</span><br />";
                        }
                    }
                ?>
                <?=system_showText(LANG_LABEL_NAME)?>: <span><?=$article->getString('title', true); ?></span>
                <br />
                <?=system_showText(LANG_LABEL_LEVEL)?>: <?=$levelName?>
                <br />
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
                <b style="color: #CE9C52;"><?=system_showText(LANG_LABEL_SUMMARY)?></b>
            </td>
            <td width="270">
                <b style="color: #D3CD83;"><?=system_showText(LANG_LABEL_DETAIL)?></b>
            </td>
        </tr>

        <?
            $idx = 0;
            foreach($reports AS $key => $report) {
                $idx++;
                list($year, $month) = explode('-', $key);
        ?>
                <tr id="dataTR<?=$idx;?>" class="<?=(($idx == 1) ? 'dataActive' : 'dataTR');?>" onmouseover="dataTRMouseOver(<?=$idx;?>)" onmouseout="dataTRMouseOut(<?=$idx;?>)" onclick="javascript:deactivateAll();changeChart(<?=$idx;?>,<?=$report['summary'];?>,<?=$report['detail'];?>);">
                    <td><?=system_showDate('F', mktime(0, 0, 0, $month, 1, $year));?> / <?=$year;?></td>
                    <td><?=$report['summary'];?></td>
                    <td><?=$report['detail'];?></td>
                </tr>
        <? } ?>

    </table>

<?
    # ----------------------------------------------------------------------------------------------------
    # * SCRIPT
    # ----------------------------------------------------------------------------------------------------
?>
    <script language="JavaSCRIPT">
        function changeChart(idx, value1, value2) {
            var label1 = '<?=system_accentOff(system_showText(LANG_LABEL_SUMMARY));?>: ' + value1;
            var label2 = '<?=system_accentOff(system_showText(LANG_LABEL_DETAIL));?>: ' + value2;
           
            var total = value1 + value2;
            value1 = ((value1 * 100) / total);
            value2 = ((value2 * 100) / total);
            
            document.getElementById('dataTR'+idx).className = "dataActive";
            document.getElementById("reportChart").innerHTML = "<img src='http://chart.apis.google.com/chart?chs=700x200&amp;chf=bg,s,ffffff|c,s,ffffff&amp;chxt=x,y&amp;chxl=1:||0:|||&amp;cht=bhg&amp;chd=t:"+value1+"|"+value2+"&amp;chdl="+label1+"|"+label2+"&amp;chco=ce9c52,d3cd83&amp;chbh=25' alt='Report Chart'/>";
        }

        function dataTRMouseOver(idx) {
            if(document.getElementById('dataTR'+idx).className != 'dataActive')
                document.getElementById('dataTR'+idx).className = 'dataOver';
        }

        function dataTRMouseOut(idx) {
            if(document.getElementById('dataTR'+idx).className != 'dataActive')
                document.getElementById('dataTR'+idx).className = 'dataTR';
        }
        
        function deactivateAll() {
            <? for($x=1; $x<=$idx; $x++) { ?>
                document.getElementById('dataTR<?=$x?>').className = "dataTR";
            <? } ?>
        }
        
        document.getElementById('dataTR1').onclick();
        
    </script>