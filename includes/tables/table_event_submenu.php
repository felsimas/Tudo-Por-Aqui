<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/tables/table_event_submenu.php
	# ----------------------------------------------------------------------------------------------------

?>

<div class="submenu">
	<ul>
		<li><a href="javascript:history.back(-1)"><?=system_showText(LANG_SITEMGR_MENU_BACK)?></a></li>
		<li><a href="<?=DEFAULT_URL?>/gerenciamento/event/"><?=ucwords(system_showText(LANG_SITEMGR_MENU_EVENTSHOME))?></a></li>
		<li><a href="<?=DEFAULT_URL?>/gerenciamento/event/eventlevel.php"><?=system_showText(LANG_SITEMGR_MENU_ADD)?></a></li>
		<li><a href="<?=DEFAULT_URL?>/gerenciamento/event/search.php"><?=system_showText(LANG_SITEMGR_MENU_SEARCH)?></a></li>
		<li><a href="<?=DEFAULT_URL?>/gerenciamento/eventcategs/index.php"><?=system_showText(LANG_SITEMGR_MENU_MANAGECATEGORIES)?></a></li>
	</ul>
</div>
<br clear="all" style="height:0; line-height:0">
