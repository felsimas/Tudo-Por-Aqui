<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/tables/table_article_submenu.php
	# ----------------------------------------------------------------------------------------------------

?>

<div class="submenu">
	<ul>
		<li><a href="javascript:history.back(-1)"><?=system_showText(LANG_SITEMGR_BACK)?></a></li>
		<li><a href="<?=DEFAULT_URL?>/gerenciamento/article/"><?=ucwords(system_showText(LANG_SITEMGR_MENU_ARTICLESHOME))?></a></li>
		<li><a href="<?=DEFAULT_URL?>/gerenciamento/article/article.php"><?=system_showText(LANG_SITEMGR_MENU_ADD)?></a></li>
		<li><a href="<?=DEFAULT_URL?>/gerenciamento/article/search.php"><?=system_showText(LANG_SITEMGR_MENU_SEARCH)?></a></li>
		<li><a href="<?=DEFAULT_URL?>/gerenciamento/articlecategs/index.php"><?=system_showText(LANG_SITEMGR_MENU_MANAGECATEGORIES)?></a></li>
		<li><a href="<?=DEFAULT_URL?>/gerenciamento/review/index.php?item_type=article"><?=system_showText(LANG_SITEMGR_MENU_REVIEWS)?></a></li>
	</ul>
</div>
<br clear="all" style="height:0; line-height:0">

