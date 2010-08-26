<?php
# ----------------------------------------------------------------------------------------------------
# * FILE: /gerenciamento/estabelecimentos/report.php
# ----------------------------------------------------------------------------------------------------

# ----------------------------------------------------------------------------------------------------
# LOAD CONFIG
# ----------------------------------------------------------------------------------------------------
include("../conf/loadconfig.inc.php");

# ----------------------------------------------------------------------------------------------------


$sitemgr = 1;

extract($_GET);
extract($_POST);


	$id = $_GET['id'];
	header ("Content-Type:text/xml");  
	$sql = "SELECT * FROM Report_Banner_Monthly WHERE banner_id = $id";
	$db = db_getDBObject();
	$r = $db->query($sql);
	$xml = "<chart caption='' subcaption='' lineThickness='1' showValues='0' formatNumberScale='0' anchorRadius='4'   divLineAlpha='0' divLineColor='CC3300' divLineIsDashed='1' showAlternateHGridColor='1' alternateHGridColor='0b80e0' shadowAlpha='0' labelStep=\"2\" numvdivlines='5' chartRightMargin=\"35\" bgColor='02539b,eaf4fd' bgAngle='270' bgAlpha='5,60'>
	";
	$xml .= "<categories >";

	while ($row = mysql_fetch_array($r)) { 
		
		$xml .= "<category label='".$row['day']."' />";
		
		//$xml .= "<set label ='".$row['day']."' value ='".$row['summary_view']."' />";
	}
	$xml .= "</categories>";
	
	mysql_data_seek($r, 0);	
	
	$xml .= "<dataset seriesName='Impressões do banner' color='1D8BD1' anchorBorderColor='1D8BD1' anchorBgColor='1D8BD1'>";
	
	while ($row = mysql_fetch_array($r)) { 
	 	
	 	$xml .= "<set value='".$row['view']."' />";
	 	
	
	}	
	
	$xml .= "</dataset>";
	
	mysql_data_seek($r, 0);	
	
	$xml .= "<dataset seriesName='Cliques no banner' color='F1683C' anchorBorderColor='F1683C' anchorBgColor='F1683C'>";	
	
	while ($row = mysql_fetch_array($r)) { 
	 	$xml .= "<set value='".$row['click_thru']."' />";
			
	}	
	
	$xml .= "</dataset>";
	

	
	$string ="<styles>                
		<definition>
                         
			<style name='CaptionFont' type='font' size='12'/>
		</definition>
		<application>
			<apply toObject='CAPTION' styles='CaptionFont' />
			<apply toObject='SUBCAPTION' styles='CaptionFont' />
		</application>
	</styles>";
	
	$xml .= $string;
	
		
	$xml .= "</chart>";
	
	$resultado = simplexml_load_string($xml);
	
	echo $resultado->asXML();

	
	
	