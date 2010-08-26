<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/tables/table_listing_submenu.php
	# ----------------------------------------------------------------------------------------------------

?>

<div id="submenu_wrapper">

<ul class="submenu_list">
		<li class="icon_home"><a href="<?=DEFAULT_URL?>/gerenciamento/estabelecimentos">Lista de Empresas </a></li>
		<li class="icon_add"><a href="<?=DEFAULT_URL?>/gerenciamento/estabelecimentos/adicionar"><?=system_showText(LANG_SITEMGR_MENU_ADD)?></a></li>
		<li class="icon_search"><a href="<?=DEFAULT_URL?>/gerenciamento/estabelecimentos/buscar"><?=system_showText(LANG_SITEMGR_MENU_SEARCH)?></a></li>
		<li class="icon_category"><a href="<?=DEFAULT_URL?>/gerenciamento/categorias"><?=system_showText(LANG_SITEMGR_MENU_MANAGECATEGORIES)?></a></li>
		<li class="icon_rating"><a href="<?=DEFAULT_URL?>/gerenciamento/avaliacoes"><?=system_showText(LANG_SITEMGR_MENU_REVIEWS)?></a></li>
	</ul>
	<div class="clearfix"></div>
	</div>