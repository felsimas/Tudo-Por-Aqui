<?echo $_SERVER['DOCUMENT_ROOT'];?>
<?echo date("r");?>
<?phpinfo();?>
<?php 
exec( 'which php' , $yaks ) ;
print_r($yaks);
?>