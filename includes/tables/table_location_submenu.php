<?


	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/tables/table_location_submenu.php
	# ----------------------------------------------------------------------------------------------------

?>
<div id="submenu_wrapper">

<ul class="submenu_list">
		<li class="icon_category"><a href="<?=DEFAULT_URL?>/gerenciamento/localidades/estados"><?=ucwords(system_showText(LANG_SITEMGR_NAVBAR_COUNTRIES))?></a></li>
		<li class="icon_category"><a href="<?=DEFAULT_URL?>/gerenciamento/localidades/cidades"><?=ucwords(system_showText(LANG_SITEMGR_NAVBAR_STATES))?></a></li>
		<li class="icon_category"><a href="<?=DEFAULT_URL?>/gerenciamento/localidades/bairros"><?=ucwords(system_showText(LANG_SITEMGR_NAVBAR_CITIES))?></a></li>
        <!--  <li><a href="<?=DEFAULT_URL?>/gerenciamento/locations/popularstates.php"><?=ucwords(system_showText(LANG_SITEMGR_NAVBAR_POPULARSTATES))?></a></li>-->
	</ul>
	<div class="clearfix"></div>
	</div>
