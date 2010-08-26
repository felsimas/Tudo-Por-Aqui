<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/tables/table_content_submenu.php
	# ----------------------------------------------------------------------------------------------------

?>

<div class="submenu">
	<ul>
		<li><a href="<?=DEFAULT_URL?>/gerenciamento/content/index.php"><?=system_showText(LANG_SITEMGR_MENU_GENERAL)?></a></li>
		<li><a href="<?=DEFAULT_URL?>/gerenciamento/content/client.php"><?=system_showText(LANG_SITEMGR_MENU_CUSTOM)?></a></li>
		<li><a href="<?=DEFAULT_URL?>/gerenciamento/content/listing.php"><?=ucwords(system_showText(LANG_SITEMGR_LISTING))?></a></li>
		<? if (EVENT_FEATURE == "on") { ?>
			<li><a href="<?=DEFAULT_URL?>/gerenciamento/content/event.php"><?=system_showText(LANG_SITEMGR_NAVBAR_EVENT)?></a><? if (DEMO_MODE) { echo "<span>*</span>"; } ?></li>
		<? } ?>
		<? if (BANNER_FEATURE == "on") { ?>
			<li><a href="<?=DEFAULT_URL?>/gerenciamento/content/banner.php"><?=ucwords(system_showText(LANG_SITEMGR_BANNER))?></a><? if (DEMO_MODE) { echo "<span>*</span>"; } ?></li>
		<? } ?>
		<? if (CLASSIFIED_FEATURE == "on") { ?>
			<li><a href="<?=DEFAULT_URL?>/gerenciamento/content/classified.php"><?=ucwords(system_showText(LANG_SITEMGR_CLASSIFIED))?></a><? if (DEMO_MODE) { echo "<span>*</span>"; } ?></li>
		<? } ?>
		<? if (ARTICLE_FEATURE == "on") { ?>
			<li><a href="<?=DEFAULT_URL?>/gerenciamento/content/article.php"><?=ucwords(system_showText(LANG_SITEMGR_ARTICLE))?></a><? if (DEMO_MODE) { echo "<span>*</span>"; } ?></li>
		<? } ?>
		<li><a href="<?=DEFAULT_URL?>/gerenciamento/content/member.php"><?=ucwords(system_showText(LANG_SITEMGR_MEMBERS))?></a></li>
	</ul>
</div>

<br clear="all" style="height:0; line-height:0">
