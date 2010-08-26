<?
	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/tables/table_promotion.php
	# ----------------------------------------------------------------------------------------------------

?>

	<ul class="standard-iconDESCRIPTION">
		<li class="view-icon"><?=system_showText(LANG_LABEL_VIEW);?></li>
		<li class="edit-icon"><?=system_showText(LANG_LABEL_EDIT);?></li>
		<!--<li class="seo-icon"><?=system_showText(LANG_LABEL_SEO_TUNING);?></li> !-->
		<li class="delete-icon"><?=system_showText(LANG_LABEL_DELETE);?></li>
	</ul>

<? if($message){ ?>
	<div class="response-msg success ui-corner-all"><span><?=$message?></span></div>
	<? if($extra_message) { ?>
		<div class="response-msg notice ui-corner-all"><?=system_showText(LANG_PROMOTION_EXTRAMESSAGE);?></div>
	<? } ?>
<? } ?>

<div class="hastable">
<table id="sort-table">
<thead>
	<tr>
		<th><?=system_showText(LANG_PROMOTION_TITLE);?></th>
		<? if (strpos($url_base, "/gerenciamento")) { ?>
			<th style="width: 70px;"><?=system_showText(LANG_LABEL_ACCOUNT);?></th>
		<? } ?>
		<th style="width: 80px;">&nbsp;</th>
	</tr>
</thead>
	<? foreach($promotions as $promotion) { ?>
		<? $id = $promotion->getNumber("id"); ?>
		<tr class="tr-table">
			<td class="td-table">
				<a href="<?=$url_base?>/promotion/view.php?id=<?=$id?>&screen=<?=$screen?>&letra=<?=$letra?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
					<?
					echo $promotion->getString("name");
					?>
				</a>
			</td>
			<? if (strpos($url_base, "/gerenciamento")) { ?>
				<td class="td-table">
					<? if ($promotion->getNumber("account_id")) { ?>
						<a href="<?=$url_base?>/account/view.php?id=<?=$promotion->getNumber("account_id")?>" class="link-table">
							<?
							$account = db_getFromDB("account", "id", db_formatNumber($promotion->getNumber("account_id")));
							echo system_showAccountUserName($account->getString("username"));
							?>
						</a>
					<? } else { ?>
						<em><?=ucwords(system_showText(LANG_SITEMGR_ACCOUNTSEARCH_NOOWNER))?></em>
					<? } ?>
				</td>
			<? } ?>
			<td class="td-table">

				<a class="tooltip" title="<?=system_showText(LANG_MSG_CLICK_TO_VIEW_THIS_PROMOTION)?>" href="<?=$url_base?>/promocao/visualizar/<?=$id?>" class="link-table">
					<img src="<?=DEFAULT_URL?>/images/bt_view.gif" border="0" alt="<?=system_showText(LANG_MSG_CLICK_TO_VIEW_THIS_PROMOTION)?>"  />
				</a>

				<a class="tooltip"  title="<?=system_showText(LANG_MSG_CLICK_TO_EDIT_THIS_PROMOTION)?>" href="<?=$url_base?>/promocao/editar/<?=$id?>" class="link-table">
					<img src="<?=DEFAULT_URL?>/images/bt_edit.gif" border="0" alt="<?=system_showText(LANG_MSG_CLICK_TO_EDIT_THIS_PROMOTION)?>" />
				</a>

			<!--	<a class="tooltip" title="<?=system_showText(LANG_MSG_CLICK_TO_EDIT_SEOCENTER)?>"  href="<?=$url_base?>/promotion/seocenter.php?id=<?=$id?>&screen=<?=$screen?>&letra=<?=$letra?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table" >
					<img src="<?=DEFAULT_URL?>/images/icon_seo.gif" border="0" alt="<?=system_showText(LANG_MSG_CLICK_TO_EDIT_SEOCENTER)?>" />
				</a> !-->

				<a class="tooltip" title="<?=system_showText(LANG_MSG_CLICK_TO_DELETE_THIS_PROMOTION)?>" href="<?=$url_base?>/promocao/apagar/<?=$id?>" class="link-table" >
					<img src="<?=DEFAULT_URL?>/images/bt_delete.gif" border="0" alt="<?=system_showText(LANG_MSG_CLICK_TO_DELETE_THIS_PROMOTION)?>"  />
				</a>

			</td>
		</tr>
	<? } ?>
</table></div>