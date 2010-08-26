<?
	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/tables/table_listing_reports.php
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

  <table border="0" cellpadding="2" cellspacing="2" class="standard-tableTOPBLUE">
    <tr>
		    <th colspan="7">
                <?
                    if(strpos($_SERVER['REQUEST_URI'], "/gerenciamento") !== false) {
                        if ($listing->getNumber("account_id")) {
                            $account = db_getFromDB("account", "id", db_formatNumber($listing->getNumber("account_id")));
                            $username = $account->getString("username");
                            echo system_showText(LANG_LABEL_ACCOUNT), ": <span>", system_showAccountUserName($username), "</span><br />";
                        } else {
                            echo system_showText(LANG_LABEL_ACCOUNT), ":<span> " . system_showText(LANG_SITEMGR_NOOWNER) . "</span><br />";
                        }
                    }
                ?>
			    <?=system_showText(LANG_LABEL_NAME)?>: <span><?=$listing->getString('title', true); ?></span>
			    <br />
			    <?=system_showText(LANG_LABEL_LEVEL)?>: <?=$levelName?>
			    <br />
			    <?=system_showText(LANG_LABEL_STATUS)?>: <?=$statusName?>
			    <span><?=$owner?></span>
		    </th>
	    </tr>
</table>
	
    
             <br />
         <br />
        <b><font style="color: #1D8BD1; font-size: 18px;">Impress&otilde;es do estabelecimento no resultado das buscas</font></b></div>
		<div id="chartdiv2"></div>
	    <script type="text/javascript">
			   var chart = new FusionCharts("<?php echo DEFAULT_URL ?>/fusioncharts/MSLine.swf", "ChartId", "627", "350", "0", "0");
			   chart.setDataURL("<?php echo DEFAULT_URL ?>/data/reportdata_analytics.php?id=1x<?php echo $id;?>");		   
			   chart.render("chartdiv2");
		</script>

	
	    <table border="0" cellpadding="2" cellspacing="2" class="standard-tableTOPBLUE">
        <tr>
		    <td width="160">
			    <b>M&ecirc;s</b>
		    </td>
		    <td width="200">
			    <b>Impress&otilde;es</b>
		    </td>
		</tr>
        <?
            $idx = 0;
            foreach($reports AS $key => $report) {
                $idx++;
                list($year, $month) = explode('-', $key);
        ?>
                <tr id="dataTR<?=$idx;?>" class="<?=(($idx == 1) ? 'dataActive' : 'dataTR');?>" onmouseover="dataTRMouseOver(<?=$idx;?>)" onmouseout="dataTRMouseOut(<?=$idx;?>)" onclick="javascript:deactivateAll();changeChart(<?=$idx;?>,<?=$report['summary'];?>,<?=$report['detail'];?>,<?=$report['click'];?>,<?=$report['email'];?>,<?=$report['phone'];?>,<?=$report['fax'];?>);">
                    <td><?=system_showDate('F', mktime(0, 0, 0, $month, 1, $year));?> / <?=$year;?></td>
                    <td><?=$report['summary'];?></td>
                </tr>
        <? } ?>
        </table>
            <br />
         <br />
          <b><font style="color: #F1683C; font-size: 18px;">Impress&otilde;es do Minisite</font></b>
        
        	<div id="chartdiv3"></div>
	    <script type="text/javascript">
			   var chart = new FusionCharts("<?php echo DEFAULT_URL ?>/fusioncharts/MSLine.swf", "ChartId", "627", "350", "0", "0");
			   chart.setDataURL("<?php echo DEFAULT_URL ?>/data/reportdata_analytics.php?id=2x<?php echo $id;?>");		   
			   chart.render("chartdiv3");
		</script>
        
        <table border="0" cellpadding="2" cellspacing="2" class="standard-tableTOPBLUE">
         <tr>
		    <td width="100">
			    <b>M&ecirc;s</b>
		    </td>
		  
		    <td width="100">
			    <b>Impress&otilde;es</b>
		    </td>
            
             <td width="250">
			    <b>Impress&otilde;es do minisite / Resultados</b>
		    </td>
	    </tr>
                <?
            $idx = 0;
            foreach($reports AS $key => $report) {
                $idx++;
                list($year, $month) = explode('-', $key);
        ?>
                <tr id="dataTR<?=$idx;?>" class="<?=(($idx == 1) ? 'dataActive' : 'dataTR');?>" onmouseover="dataTRMouseOver(<?=$idx;?>)" onmouseout="dataTRMouseOut(<?=$idx;?>)" onclick="javascript:deactivateAll();changeChart(<?=$idx;?>,<?=$report['summary'];?>,<?=$report['detail'];?>,<?=$report['click'];?>,<?=$report['email'];?>,<?=$report['phone'];?>,<?=$report['fax'];?>);">
                    <td><?=system_showDate('F', mktime(0, 0, 0, $month, 1, $year));?> / <?=$year;?></td>
                    <td><?=$report['detail'];?></td>  
                    <td>%<?=number_format(($report['detail']/$report['summary'])*100, 2, ',', ' ');?></td>    

                </tr>
        <? } ?>
        
         </table>
         <br />
         <br />
          <b><font style="color: #2AD62A; font-size: 18px;">Cliques no link website no mini site</font></b>
        
         	<div id="chartdiv4"></div>
	    <script type="text/javascript">
			   var chart = new FusionCharts("<?php echo DEFAULT_URL ?>/fusioncharts/MSLine.swf", "ChartId", "627", "350", "0", "0");
			   chart.setDataURL("<?php echo DEFAULT_URL ?>/data/reportdata_analytics.php?id=3x<?php echo $id;?>");		   
			   chart.render("chartdiv4");
		</script>
         
        <table border="0" cellpadding="2" cellspacing="2" class="standard-tableTOPBLUE">
         <tr>
		    <td width="100">
			    <b>M&ecirc;s</b>
		    </td>
		    <td width="100">
			   <b>Cliques no website</b>
		    </td>
            <td width="250">
			   <b>Cliques no link website / Impress&otilde;es do minisite</b>
		    </td>

	    </tr>
        <?
            $idx = 0;
            foreach($reports AS $key => $report) {
                $idx++;
                list($year, $month) = explode('-', $key);
        ?>
                <tr id="dataTR<?=$idx;?>" class="<?=(($idx == 1) ? 'dataActive' : 'dataTR');?>" onmouseover="dataTRMouseOver(<?=$idx;?>)" onmouseout="dataTRMouseOut(<?=$idx;?>)" onclick="javascript:deactivateAll();changeChart(<?=$idx;?>,<?=$report['summary'];?>,<?=$report['detail'];?>,<?=$report['click'];?>,<?=$report['email'];?>,<?=$report['phone'];?>,<?=$report['fax'];?>);">
                    <td><?=system_showDate('F', mktime(0, 0, 0, $month, 1, $year));?> / <?=$year;?></td>
                    <td>%<?=$report['click'];?></td>
                    <td>%<?=number_format(($report['click']/$report['detail'])*100, 2, ',', ' ');?></td>

                </tr>
        <? } ?>

    </table>
    
    
         <br />
         <br />
          <b><font style="color: #3B26FA; font-size: 18px;">Envio de emails atrav&eacute;s do minisite</font></b>
        
         	<div id="chartdiv5"></div>
	    <script type="text/javascript">
			   var chart = new FusionCharts("<?php echo DEFAULT_URL ?>/fusioncharts/MSLine.swf", "ChartId", "627", "350", "0", "0");
			   chart.setDataURL("<?php echo DEFAULT_URL ?>/data/reportdata_analytics.php?id=4x<?php echo $id;?>");		   
			   chart.render("chartdiv5");
		</script>
         
        <table border="0" cellpadding="2" cellspacing="2" class="standard-tableTOPBLUE">
         <tr>
		    <td width="100">
			    <b>M&ecirc;s</b>
		    </td>
		    <td width="100">
			   <b>Emails</b>
		    </td>
            <td width="250">
			   <b>Impress&otilde;es no minisite/Emails</b>
		    </td>

	    </tr>
        <?
            $idx = 0;
            foreach($reports AS $key => $report) {
                $idx++;
                list($year, $month) = explode('-', $key);
        ?>
                <tr id="dataTR<?=$idx;?>" class="<?=(($idx == 1) ? 'dataActive' : 'dataTR');?>" onmouseover="dataTRMouseOver(<?=$idx;?>)" onmouseout="dataTRMouseOut(<?=$idx;?>)" onclick="javascript:deactivateAll();changeChart(<?=$idx;?>,<?=$report['summary'];?>,<?=$report['detail'];?>,<?=$report['click'];?>,<?=$report['email'];?>,<?=$report['phone'];?>,<?=$report['fax'];?>);">
                    <td><?=system_showDate('F', mktime(0, 0, 0, $month, 1, $year));?> / <?=$year;?></td>
                    <td><?=$report['email'];?></td>
                    <td>%<?=number_format(($report['email']/$report['summary'])*100, 2, ',', ' ');?></td>

                </tr>
        <? } ?>

    </table>


<?
    # ----------------------------------------------------------------------------------------------------
    # * SCRIPT
    # ----------------------------------------------------------------------------------------------------
?>
    <script language="JavaSCRIPT">
        function changeChart(idx, value1, value2, value3, value4, value5, value6) {
            var label1 = '<?=system_accentOff(system_showText(LANG_LABEL_SUMMARY));?>: ' + value1;
            var label2 = '<?=system_accentOff(system_showText(LANG_LABEL_DETAIL));?>: ' + value2;
            var label3 = '<?=system_accentOff(system_showText(LANG_LABEL_CLICKTHRU));?>: ' + value3;
            var label4 = '<?=system_accentOff(system_showText(LANG_LABEL_EMAIL));?>: ' + value4;
            var label5 = '<?=system_accentOff(system_showText(LANG_LABEL_PHONE));?>: ' + value5;
            var label6 = '<?=system_accentOff(system_showText(LANG_LABEL_FAX));?>: ' + value6;
            
            var total = value1 + value2 + value3 + value4 + value5 + value6;
            value1 = ((value1 * 100) / total);
            value2 = ((value2 * 100) / total);
            value3 = ((value3 * 100) / total);
            value4 = ((value4 * 100) / total);
            value5 = ((value5 * 100) / total);
            value6 = ((value6 * 100) / total);
            
            document.getElementById('dataTR'+idx).className = "dataActive";
            document.getElementById("reportChart").innerHTML = "<img src='http://chart.apis.google.com/chart?chs=700x200&amp;chf=bg,s,ffffff|c,s,ffffff&amp;chxt=x,y&amp;chxl=1:||0:|||&amp;cht=bhg&amp;chd=t:"+value1+"|"+value2+"|"+value3+"|"+value4+"|"+value5+"|"+value6+"&amp;chdl="+label1+"|"+label2+"|"+label3+"|"+label4+"|"+label5+"|"+label6+"&amp;chco=ce9c52,d3cd83,fa5353,527bce,52c6ce,00886d&amp;chbh=25' alt='Report Chart'/>";
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