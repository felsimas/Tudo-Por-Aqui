<?
	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/tables/table_promotion_submenu.php
	# ----------------------------------------------------------------------------------------------------

?>

<div id="submenu_wrapper">

<ul class="submenu_list">
		<li class="icon_home"><a href="<?=DEFAULT_URL?>/gerenciamento/promotion">Lista de <?php echo utf8_decode(Promoções) ?></a></li>
		<li class="icon_add"><a href="<?=DEFAULT_URL?>/gerenciamento/promotion/promotion.php"><?=ucwords(system_showText(LANG_SITEMGR_MENU_ADD))?></a></li>
		<li class="icon_search"><a href="<?=DEFAULT_URL?>/gerenciamento/promotion/search.php"><?=ucwords(system_showText(LANG_SITEMGR_MENU_SEARCH))?></a></li>
	</ul>
	<div class="clearfix"></div>
	</div>
