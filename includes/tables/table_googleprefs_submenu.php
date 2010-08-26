<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/tables/table_googleprefs_submenu.php
	# ----------------------------------------------------------------------------------------------------

?>

<div class="submenu">
	<ul>
		<li><a href="javascript:history.back(-1)"><?=ucwords(system_showText(LANG_SITEMGR_BACK))?></a></li>
		<? if (GOOGLE_ADS_ENABLED == "on") { ?>
			<li><a href="<?=DEFAULT_URL?>/gerenciamento/googleprefs/googleads.php"><?=ucwords(system_showText(LANG_SITEMGR_NAVBAR_GOOGLEADS))?></a></li>
		<? } ?>
		<? if (GOOGLE_MAPS_ENABLED == "on") { ?>
			<? $has_menu_item = true; ?>
			<li><a href="<?=DEFAULT_URL?>/gerenciamento/googleprefs/googlemaps.php"><?=ucwords(system_showText(LANG_SITEMGR_NAVBAR_GOOGLEMAPS))?></a></li>
		<? } ?>
		<? if (GOOGLE_ANALYTICS_ENABLED == "on") { ?>
			<? $has_menu_item = true; ?>
			<li><a href="<?=DEFAULT_URL?>/gerenciamento/googleprefs/googleanalytics.php"><?=ucwords(system_showText(LANG_SITEMGR_NAVBAR_GOOGLEANALYTICS))?></a></li>
		<? } ?>
	</ul>
</div>

<br clear="all" style="height:0; line-height:0">
