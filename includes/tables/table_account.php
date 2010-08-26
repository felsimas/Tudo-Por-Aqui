<?
	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/tables/table_account.php
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
		<td class="td-th-table" style="width: 450px;">
			<?=system_showText(LANG_SITEMGR_LABEL_USERNAME)?>
		</td>
		<td class="td-th-table">
			<?=system_showText(LANG_SITEMGR_LASTLOGIN)?>
		</td>
		<td class="td-th-table" style="width: 60px;">&nbsp;</td>
	</tr>
	</thead>
	<? foreach($accounts as $account) { ?>
		<? $id = $account->getNumber("id"); ?>
		<tr class="tr-table">
			<td class="td-table">
				<a href="<?=DEFAULT_URL?>/gerenciamento/usuarios/visualizar/<?=$account->getNumber("id")?>" class="link-table">
					<?=system_showAccountUserName($account->getString("username"));?>
				</a>
			</td>
			<td class="td-table" nowrap>
				<? if ($account->getNumber("lastlogin") != 0) {
					echo format_date($account->getNumber("lastlogin"), DEFAULT_DATE_FORMAT." h:ia", "datetime");
				} else echo system_showText(LANG_SITEMGR_ACCOUNT_NEWACCOUNT); ?>
			</td>
			<td class="td-table" nowrap>

				<a class="tooltip"  title="<?=strtolower(system_showText(LANG_SITEMGR_VIEW))?>" href="<?=DEFAULT_URL?>/gerenciamento/usuarios/visualizar/<?=$id?>" class="link-table">
					<img src="<?=DEFAULT_URL?>/images/bt_view.gif" alt="<?=strtolower(system_showText(LANG_SITEMGR_VIEW))?>" border="0" />
				</a>

				<a class="tooltip"  title="<?=strtolower(system_showText(LANG_SITEMGR_EDIT))?>"  href="<?=DEFAULT_URL?>/gerenciamento/usuarios/editar/<?=$id?>" class="link-table">
					<img src="<?=DEFAULT_URL?>/images/bt_edit.gif" alt="<?=strtolower(system_showText(LANG_SITEMGR_EDIT))?>" border="0" />
				</a>

				<? if (!DEMO_LIVE_MODE || ($account->getString("username") != "demo")) { ?>
					<a class="tooltip"  title="<?=strtolower(system_showText(LANG_SITEMGR_DELETE))?>"  href="<?=DEFAULT_URL?>/gerenciamento/usuarios/apagar/<?=$id?>" class="link-table">
						<img src="<?=DEFAULT_URL?>/images/bt_delete.gif" alt="<?=strtolower(system_showText(LANG_SITEMGR_DELETE))?>" border="0" />
					</a>
				<? } ?>

			</td>
		</tr>
	<? } ?>
</table>
</div>