<?php
include("class.ipdetails.php");
$ip=$_SERVER['REMOTE_ADDR'];
if($ip="127.0.0.1"){$ip="66.84.41.158";}
$myip=new ipdetails($ip);
$myip->scan();

$CountryCode=$myip->get_countrycode();
$Code3=$myip->get_code3();
$Country=$myip->get_country();
$Region=$myip->get_region();
$City=$myip->get_city();
$PostalCode=$myip->get_postalcode();
$Latitude=$myip->get_latitude();   
$Longitude=$myip->get_longitude();   
$DMAcode=$myip->get_dmacode();     
$Areacode=$myip->get_areacode();  

$myip->close();

?>

<html>
<head><title>IP Details/Location Example</title></head>
<body>
<center>
<br /><br />
<h3><?php echo $ip; ?> Details : </h3><br><br>
<table>
<tr><td><b>CountryCode</b></td><td>:</td><td><?php echo $CountryCode ; ?></td></tr>
<tr><td><b>Code3</b></td><td>:</td><td><?php echo $Code3; ?></td></tr>
<tr><td><b>Country</b></td><td>:</td><td><?php echo $Country; ?></td></tr>
<tr><td><b>Region</b></td><td>:</td><td><?php echo $Region; ?></td></tr>
<tr><td><b>City</b></td><td>:</td><td><?php echo $City; ?></td></tr>
<tr><td><b>PostalCode</b></td><td>:</td><td><?php echo $PostalCode; ?></td></tr>
<tr><td><b>Latitude</b></td><td>:</td><td><?php echo $Latitude; ?></td></tr>
<tr><td><b>Longitude</b></td><td>:</td><td><?php echo $Longitude; ?></td></tr>
<tr><td><b>DMAcode</b></td><td>:</td><td><?php echo $DMAcode; ?></td></tr>
<tr><td><b>Areacode</b></td><td>:</td><td><?php echo $Areacode; ?></td></tr>

</table>
</center>
</body>
</html>