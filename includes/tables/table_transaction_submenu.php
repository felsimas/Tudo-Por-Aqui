<?
	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/tables/table_transaction_submenu.php
	# ----------------------------------------------------------------------------------------------------

?>
<div id="submenu_wrapper">

<ul class="submenu_list">
		<li class="icon_home"><a href="<?=$url_base?>/transacoes"><?=system_showText(LANG_SITEMGR_MENU_HISTORY)?></a></li>
		<li class="icon_add"><a href="<?=$url_base?>/transacoes/buscar"><?=system_showText(LANG_SITEMGR_MENU_SEARCH)?></a></li>
		<li class="icon_search"><a href="<?=$url_base?>/exportar/pagamentos"><?=system_showText(LANG_SITEMGR_MENU_EXPORTPAYMENTRECORDS)?></a></li>
</ul>
<div class="clearfix"></div>
</div>