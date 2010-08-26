<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/tables/table_listingtemplate.php
	# ----------------------------------------------------------------------------------------------------

?>

<table class="table-subtitle-table" cellspacing="5">
	<tr class="tr-subtitle-table">
		<td class="td-subtitle-table">
			<img src="<?=DEFAULT_URL?>/images/bt_view.gif" alt="<?=strtolower(system_showText(LANG_SITEMGR_VIEW))?>" title="<?=strtolower(system_showText(LANG_SITEMGR_VIEW))?>" border="0" />
		</td>
		<td class="td-subtitle-table">
			<font class="font-subtitle-table">
				<?=ucwords(system_showText(LANG_SITEMGR_VIEW))?>
			</font>
		</td>
		<td class="td-subtitle-table">
			<img src="<?=DEFAULT_URL?>/images/bt_edit.gif" alt="<?=strtolower(system_showText(LANG_SITEMGR_EDIT))?>" title="<?=strtolower(system_showText(LANG_SITEMGR_EDIT))?>" border="0" />
		</td>
		<td class="td-subtitle-table">
			<font class="font-subtitle-table">
				<?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_EDITINFORMATION)?>
			</font>
		</td>
		<td class="td-subtitle-table">
			<img src="<?=DEFAULT_URL?>/images/bt_delete.gif" alt="<?=strtolower(system_showText(LANG_SITEMGR_DELETE))?>" title="<?=strtolower(system_showText(LANG_SITEMGR_DELETE))?>" border="0" />
		</td>
		<td class="td-subtitle-table">
			<font class="font-subtitle-table">
				<?=ucwords(system_showText(LANG_SITEMGR_DELETE))?>
			</font>
		</td>
	</tr>
</table>

<? if ($message) { ?>
	<table border="0" width="95%" cellpadding="1" cellspacing="0" class="table-subtitle-table" >
		<tr class="tr-subtitle-table">
			<td align="center">
				<div class="response-msg success ui-corner-all"><?=$message?></div>
			</td>
		</tr>
	</table>
<? } ?>

<table class="table-table">
	<tr class="th-table">
		<td class="td-th-table">
			<?=system_showText(LANG_SITEMGR_TITLE)?>
		</td>
		<td class="td-th-table" style="width: 60px;">
			<?=system_showText(LANG_SITEMGR_STATUS)?>
		</td>
		<td class="td-th-table" style="width: 110px;">
			<?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_ADDITIONALPRICE)?>
		</td>
		<td class="td-th-table" style="width: 130px;">
			<?=system_showText(LANG_SITEMGR_LASTUPDATE)?>
		</td>
		<td class="td-th-table" style="width: 60px;">&nbsp;</td>
	</tr>
	<? foreach($listingtemplates as $listingtemplate) { ?>
		<? $id = $listingtemplate->getNumber("id"); ?>
		<tr class="tr-table">
			<td class="td-table">
				<a href="<?=DEFAULT_URL?>/gerenciamento/estabelecimentostemplate/view.php?id=<?=$listingtemplate->getNumber("id")?>&screen=<?=$screen?>&letra=<?=$letra?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
					<?=$listingtemplate->getString("title")?>
				</a>
			</td>
			<td class="td-table">
				<a href="<?=DEFAULT_URL?>/gerenciamento/estabelecimentostemplate/template.php?id=<?=$listingtemplate->getNumber("id")?>&screen=<?=$screen?>&letra=<?=$letra?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
					<?=system_showText(@constant('LANG_SITEMGR_LABEL_'.strtoupper($listingtemplate->getString("status"))))?>
				</a>
			</td>
			<td class="td-table">
				<a href="<?=DEFAULT_URL?>/gerenciamento/estabelecimentostemplate/template.php?id=<?=$listingtemplate->getNumber("id")?>&screen=<?=$screen?>&letra=<?=$letra?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
					<?=$listingtemplate->getString("price")?>
				</a>
			</td>
			<td class="td-table">
				<a href="<?=DEFAULT_URL?>/gerenciamento/estabelecimentostemplate/view.php?id=<?=$listingtemplate->getNumber("id")?>&screen=<?=$screen?>&letra=<?=$letra?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
					<?=(($listingtemplate->getString("updated") != "0000-00-00 00:00:00") ? (format_date($listingtemplate->getString("updated"), DEFAULT_DATE_FORMAT." h:ia", "datetime")) : ("---"))?>
				</a>
			</td>
			<td class="td-table" nowrap>

				<a href="<?=DEFAULT_URL?>/gerenciamento/estabelecimentostemplate/view.php?id=<?=$listingtemplate->getNumber("id")?>&screen=<?=$screen?>&letra=<?=$letra?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
					<img src="<?=DEFAULT_URL?>/images/bt_view.gif" alt="<?=strtolower(system_showText(LANG_SITEMGR_VIEW))?>" title="<?=strtolower(system_showText(LANG_SITEMGR_VIEW))?>" border="0" />
				</a>

				<a href="<?=DEFAULT_URL?>/gerenciamento/estabelecimentostemplate/template.php?id=<?=$listingtemplate->getNumber("id")?>&screen=<?=$screen?>&letra=<?=$letra?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
					<img src="<?=DEFAULT_URL?>/images/bt_edit.gif" alt="<?=strtolower(system_showText(LANG_SITEMGR_LISTINGTEMPLATE_EDITINFORMATION))?>" title="<?=strtolower(system_showText(LANG_SITEMGR_LISTINGTEMPLATE_EDITINFORMATION))?>" border="0" />
				</a>

				<a href="<?=DEFAULT_URL?>/gerenciamento/estabelecimentostemplate/delete.php?id=<?=$listingtemplate->getNumber("id")?>&screen=<?=$screen?>&letra=<?=$letra?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
					<img src="<?=DEFAULT_URL?>/images/bt_delete.gif" alt="<?=strtolower(system_showText(LANG_SITEMGR_DELETE))?>" title="<?=strtolower(system_showText(LANG_SITEMGR_DELETE))?>" border="0" />
				</a>

			</td>
		</tr>
	<? } ?>
</table>
