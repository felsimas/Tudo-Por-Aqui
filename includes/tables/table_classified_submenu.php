<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/tables/table_classified_submenu.php
	# ----------------------------------------------------------------------------------------------------

?>

<div class="submenu">
	<ul>
		<li><a href="javascript:history.back(-1)"><?=system_showText(LANG_SITEMGR_MENU_BACK)?></a></li>
		<li><a href="<?=DEFAULT_URL?>/gerenciamento/classified/"><?=ucwords(system_showText(LANG_SITEMGR_MENU_CLASSIFIEDSHOME))?></a></li>
		<li><a href="<?=DEFAULT_URL?>/gerenciamento/classified/classifiedlevel.php"><?=system_showText(LANG_SITEMGR_MENU_ADD)?></a></li>
		<li><a href="<?=DEFAULT_URL?>/gerenciamento/classified/search.php"><?=system_showText(LANG_SITEMGR_MENU_SEARCH)?></a></li>
		<li><a href="<?=DEFAULT_URL?>/gerenciamento/classifiedcategs/index.php"><?=system_showText(LANG_SITEMGR_MENU_MANAGECATEGORIES)?></a></li>
	</ul>
</div>
<br clear="all" style="height:0; line-height:0">
