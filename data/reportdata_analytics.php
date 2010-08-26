<?php
	include("../conf/loadconfig.inc.php");
	$xxx = split('x',$_GET['id']);
    $id = $xxx[1];
    $xtype = $xxx[0];
   	header ("Content-Type:text/xml");  
	$sql = "SELECT * FROM Report_Listing_Monthly WHERE listing_id = $id";
	$db = db_getDBObject();
	$r = $db->query($sql);
	$xml = "<chart caption='' subcaption='' lineThickness='1' showValues='1' formatNumberScale='1' anchorRadius='4' divLineAlpha='1' divLineColor='CC3300' divLineIsDashed='1' showAlternateHGridColor='1' alternateHGridColor='0b80e0' shadowAlpha='1' labelStep=\"1\" numvdivlines='5' chartRightMargin=\"35\" bgColor='02539b,eaf4fd' bgAngle='270' bgAlpha='5,60'>
	";
	$xml .= "<categories >";
  
	while ($row = mysql_fetch_array($r)) { 
        $dia = split('-',$row['day']);
		$xml .= "<category label='".str_replace("12", "Dez",str_replace("11", "Nov",str_replace("10", "Out",str_replace("09", "Set",str_replace("08", "Ago",str_replace("07", "Jul",str_replace("06", "Jun",str_replace("05", "Mai",str_replace("04", "Abr",str_replace("03", "Mar",str_replace("02", "Fev",str_replace("01", "Jan", $dia[1]))))))))))))."' />";
		
		//$xml .= "<set label ='".$row['day']."' value ='".$row['summary_view']."' />";
	}
	$xml .= "</categories>";
	
	mysql_data_seek($r, 0);	
	
    
    if ($xtype=="1") {        
	$xml .= "<dataset color='1D8BD1' anchorBorderColor='1D8BD1' anchorBgColor='1D8BD1'>";
	
	while ($row = mysql_fetch_array($r)) { 
	 	
	 	$xml .= "<set value='".$row['summary_view']."' />";
	 	
	
	}	
	
	$xml .= "</dataset>";
    
    }        
	
	mysql_data_seek($r, 0);	
	
    if ($xtype=="2") {        
	$xml .= "<dataset color='F1683C' anchorBorderColor='F1683C' anchorBgColor='F1683C'>";	
	
	while ($row = mysql_fetch_array($r)) { 
	 	$xml .= "<set value='".$row['detail_view']."' />";
			
	}	
	
	$xml .= "</dataset>";
	}
    
    
	mysql_data_seek($r, 0);	
	if ($xtype=="3") {        
	$xml .= "<dataset color='2AD62A' anchorBorderColor='2AD62A' anchorBgColor='2AD62A'>";
		
	while ($row = mysql_fetch_array($r)) { 
	 	$xml .= "<set value='".$row['click_thru']."' />";
			
	}	
	
	$xml .= "</dataset>";
	}
    
    
    mysql_data_seek($r, 0);	
	if ($xtype=="4") {        
	$xml .= "<dataset color='3B26FA' anchorBorderColor='3B26FA' anchorBgColor='3B26FA'>";
		
	while ($row = mysql_fetch_array($r)) { 
	 	$xml .= "<set value='".$row['email_sent']."' />";
			
	}	
	
	$xml .= "</dataset>";
	}


	
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
	
?>
	
	
	
	
	