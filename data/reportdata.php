<?php
	include("../conf/loadconfig.inc.php");
	$id = $_GET['id'];
	 header ("Content-Type:text/xml");  
	$sql = "SELECT * FROM Report_Listing_Monthly WHERE listing_id = $id";
	$db = db_getDBObject();
	$r = $db->query($sql);
	
	$xml = "<chart caption='Relatorio de acesso ao Minisite ' xAxisName='Mes' yAxisName='Acessos' showValues='0' decimals='0' formatNumberScale='0'>";

	while ($row = mysql_fetch_array($r)) { 
		$xml .= "<set label ='".$row['day']."' value ='".$row['summary_view']."' />";
	}
	$xml .= "</chart>";
	$resultado = simplexml_load_string($xml);
	
	echo $resultado->asXML();
	
	?>
	
	
	
	
	