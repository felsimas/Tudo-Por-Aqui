<?php	include("./conf/loadconfig.inc.php");

?>

	<?php 
echo $message_browse_section;

echo "<dl class=\"generalResults\">";
	echo "<dt class=\"standardSubTitle\"><a href=\"".LISTING_DEFAULT_URL."/\">".system_showText(LANG_MENU_LISTING)."</a></dt>";
	if (EVENT_FEATURE == "on") { echo "<dt class=\"standardSubTitle\"><a href=\"".EVENT_DEFAULT_URL."/\">".system_showText(LANG_MENU_EVENT)."</a></dt>"; }
	echo "<dt class=\"standardSubTitle\"><a href=\"".PROMOTION_DEFAULT_URL."/\">".system_showText(LANG_MENU_PROMOTION)."</a></dt>";
echo "</dl>"; 
?>

		
