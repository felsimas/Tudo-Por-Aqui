<?
	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/tables/table_smaccount.php
	# ----------------------------------------------------------------------------------------------------

?>

<ul class="standard-iconDESCRIPTION">
		<li class="view-icon"><?=system_showText(LANG_SITEMGR_VIEW)?> </li>
		<li class="edit-icon"><?=system_showText(LANG_SITEMGR_EDIT)?> </li>
		<li class="deleted-icon"><?=system_showText(LANG_SITEMGR_DELETE)?>
		 </li>
</ul>


<? if ($message) { ?>
	<table border="0" width="95%" cellpadding="1" cellspacing="0" class="table-subtitle-table" >
		<tr class="tr-subtitle-table">
			<td align="center">
				<div class="response-msg success ui-corner-all"><?=$message?></div>
			</td>
		</tr>
	</table>
<? } ?>
<div class="hastable">
<table>
	<thead>
	<tr class="th-table">
		<td class="td-th-table">
			<?=system_showText(LANG_SITEMGR_LABEL_USERNAME)?>
		</td>
		<td class="td-th-table">
			<?=system_showText(LANG_SITEMGR_LABEL_NAME)?>
		</td>
		<td class="td-th-table">
			<?=system_showText(LANG_SITEMGR_LABEL_CREATED)?>
		</td>
		<td class="td-th-table" style="width: 60px;">&nbsp;</td>
	</tr>
	</thead>
	<? foreach($smaccounts as $smaccount) { ?>
		<? $id = $smaccount->getNumber("id"); ?>
		<tr class="tr-table">
			<td class="td-table">
				<a class="tooltip" href="<?=DEFAULT_URL?>/gerenciamento/administradores/visualizar/<?=$smaccount->getNumber("id")?>" class="link-table">
					<?=$smaccount->getString("username")?>
				</a>
			</td>
			<td class="td-table" nowrap>
				<a class="tooltip" href="<?=DEFAULT_URL?>/gerenciamento/administradores/visualizar/<?=$smaccount->getNumber("id")?>" class="link-table">
					<?=$smaccount->getString("name")?>
				</a>
			</td>
			<td class="td-table" nowrap>
				<a href="<?=DEFAULT_URL?>/gerenciamento/smaccount/view.php?id=<?=$smaccount->getNumber("id")?>&screen=<?=$screen?>&letra=<?=$letra?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
					<?=(($smaccount->getString("entered") != "0000-00-00 00:00:00") ? (format_date($smaccount->getString("entered"), DEFAULT_DATE_FORMAT." h:ia", "datetime")) : ("---"))?>
				</a>
			</td>
			<td class="td-table" nowrap>

				<a class="tooltip"  title="<?=system_showText(LANG_SITEMGR_VIEW)?>" href="<?=DEFAULT_URL?>/gerenciamento/administradores/visualizar/<?=$smaccount->getNumber("id")?>" class="link-table">
					<img src="<?=DEFAULT_URL?>/images/bt_view.gif" alt="<?=system_showText(LANG_SITEMGR_VIEW)?>" border="0" />
				</a>

				<a class="tooltip"  title="<?=system_showText(LANG_SITEMGR_EDIT)?>" href="<?=DEFAULT_URL?>/gerenciamento/administradores/editar/<?=$smaccount->getNumber("id")?>" class="link-table">
					<img src="<?=DEFAULT_URL?>/images/bt_edit.gif" alt="<?=system_showText(LANG_SITEMGR_EDIT)?>" border="0" />
				</a>

				<? if ($smaccount->getNumber("id") == $_SESSION[SESS_SM_ID]) { ?>
					<img src="<?=DEFAULT_URL?>/images/bt_delete_off.gif" alt="<?=system_showText(LANG_SITEMGR_DELETE)?>" title="<?=system_showText(LANG_SITEMGR_DELETE)?>" border="0" />
				<? } else { ?>
					<a class="tooltip"  title="<?=system_showText(LANG_SITEMGR_DELETE)?>" href="<?=DEFAULT_URL?>/gerenciamento/administradores/apagar/<?=$smaccount->getNumber("id")?>" class="link-table">
						<img src="<?=DEFAULT_URL?>/images/bt_delete.gif" alt="<?=system_showText(LANG_SITEMGR_DELETE)?>" border="0" />
					</a>
				<? } ?>

			</td>
		</tr>
	<? } ?>
</table>
</div>