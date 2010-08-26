<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/tables/table_content_special.php
	# ----------------------------------------------------------------------------------------------------
?>

<table border="0" cellspacing="0" cellpadding="0" class="standard-table">
	<tr>
		<th class="standard-tabletitle"><?=ucwords(system_showText(LANG_SITEMGR_CONTENT_SPECIALCONTENTS))?></th>
	</tr>
</table>

<table class="table-table">
	<tr class="th-table">
		<td class="td-th-table">
			<?=system_showText(LANG_SITEMGR_LABEL_NAME)?>
		</td>
		<td class="td-th-table" style="width: 60px;">&nbsp;</td>
	</tr>
	<tr class="tr-table">
		<td class="td-table">
			<a href="<?=DEFAULT_URL?>/gerenciamento/content/content_header.php" class="link-table"><?=system_showText(LANG_SITEMGR_HEADER)?></a>
		</td>
		<td class="td-table">
			<a href="<?=DEFAULT_URL?>/gerenciamento/content/content_header.php" class="link-table">
				<img src="<?=DEFAULT_URL?>/images/icon_seof.gif" alt="<?=system_showText(LANG_SITEMGR_SEOCENTER_SEOFEATURE)?>" title="<?=system_showText(LANG_SITEMGR_SEOCENTER_SEOFEATURE)?>" border="0" />
			</a>
			<a href="<?=DEFAULT_URL?>/gerenciamento/content/content_header.php" class="link-table">
				<img src="<?=DEFAULT_URL?>/images/bt_edit.gif" alt="<?=strtolower(system_showText(LANG_SITEMGR_EDIT))?>" title="<?=strtolower(system_showText(LANG_SITEMGR_EDIT))?>" border="0" />
			</a>
			<img src="<?=DEFAULT_URL?>/images/bt_delete_off.gif" alt="<?=system_showText(LANG_SITEMGR_DELETE)?>" title="<?=system_showText(LANG_SITEMGR_DELETE)?>" border="0" />
		</td>
	</tr>
	<tr class="tr-table">
		<td class="td-table">
			<a href="<?=DEFAULT_URL?>/gerenciamento/content/content_footer.php" class="link-table"><?=system_showText(LANG_SITEMGR_FOOTER)?></a>
		</td>
		<td class="td-table">
			<img src="<?=DEFAULT_URL?>/images/icon_seof_off.gif" alt="<?=system_showText(LANG_SITEMGR_SEOCENTER_SEOFEATURE)?>" title="<?=system_showText(LANG_SITEMGR_SEOCENTER_SEOFEATURE)?>" border="0" />
			<a href="<?=DEFAULT_URL?>/gerenciamento/content/content_footer.php" class="link-table">
				<img src="<?=DEFAULT_URL?>/images/bt_edit.gif" alt="<?=strtolower(system_showText(LANG_SITEMGR_EDIT))?>" title="<?=strtolower(system_showText(LANG_SITEMGR_EDIT))?>" border="0" />
			</a>
			<img src="<?=DEFAULT_URL?>/images/bt_delete_off.gif" alt="<?=system_showText(LANG_SITEMGR_DELETE)?>" title="<?=system_showText(LANG_SITEMGR_DELETE)?>" border="0" />
		</td>
	</tr>
	<tr class="tr-table">
		<td class="td-table">
			<a href="<?=DEFAULT_URL?>/gerenciamento/content/content_noimage.php" class="link-table"><?=system_showText(LANG_SITEMGR_CONTENT_NOIMAGE)?> </a> <span class="itemNote"></span>
		</td>
		<td class="td-table">
			<img src="<?=DEFAULT_URL?>/images/icon_seof_off.gif" alt="<?=system_showText(LANG_SITEMGR_SEOCENTER_SEOFEATURE)?>" title="<?=system_showText(LANG_SITEMGR_SEOCENTER_SEOFEATURE)?>" border="0" />
			<a href="<?=DEFAULT_URL?>/gerenciamento/content/content_noimage.php" class="link-table">
				<img src="<?=DEFAULT_URL?>/images/bt_edit.gif" alt="<?=strtolower(system_showText(LANG_SITEMGR_EDIT))?>" title="<?=strtolower(system_showText(LANG_SITEMGR_EDIT))?>" border="0" />
			</a>
			<img src="<?=DEFAULT_URL?>/images/bt_delete_off.gif" alt="<?=system_showText(LANG_SITEMGR_DELETE)?>" title="<?=system_showText(LANG_SITEMGR_DELETE)?>" border="0" />
		</td>
	</tr>
</table>
