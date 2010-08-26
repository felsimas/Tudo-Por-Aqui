<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/tables/table_eventcategory.php
	# ----------------------------------------------------------------------------------------------------

?>

<? if ($message) { ?>
	<br /><div class="response-msg success ui-corner-all"><?=$message?></div><br />
<? } ?>

<table border="0" cellpadding="2" cellspacing="2" class="standard-tableTOPBLUE">
	<tr>
		<td colspan="3">
			<a href="<?=$url_redirect?>/index.php"><?=system_showText(LANG_SITEMGR_MENU_HOME)?></a>
			<?
			$path_count = 1;
			if ($category_id) {
				$categoryObj = new EventCategory($category_id);
				$path_elem_array = $categoryObj->getFullPath();
				if ($path_elem_array) {
					foreach ($path_elem_array as $each_category) {
						echo " <a href=\"".$url_redirect."/index.php?category_id=".$each_category["id"]."&screen=".$screen."&letra=".$letra.(($url_search_params) ? "&$url_search_params" : "")."\">&raquo; ".$each_category["title"]."</a>";
						$path_count++;
					}
				}
			}
			?>
		</td>
	</tr>
</table>

<a href="<?=DEFAULT_URL?>/gerenciamento/eventcategs/category.php?category_id=<?=$category_id?>&screen=<?=$screen?>&letra=<?=$letra?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="addLINK"><?=system_showText(LANG_SITEMGR_CATEGORY_ADDNEW)?> &raquo;</a>

<? if ($categories) { ?>

	<ul class="standard-iconDESCRIPTION">
		<li class="add-icon"><?=system_showText(LANG_SITEMGR_CATEGORY_ADDSUBCATEGORY)?></li>
		<li class="view-icon"><?=system_showText(LANG_SITEMGR_VIEW)?> <?=ucwords(system_showText(LANG_SITEMGR_CATEGORY))?></li>
		<li class="edit-icon"><?=system_showText(LANG_SITEMGR_EDIT)?> <?=ucwords(system_showText(LANG_SITEMGR_CATEGORY))?></li>
		<li class="seof-icon"><?=system_showText(LANG_SITEMGR_SEOCENTER_SEOFEATURE)?></li>
		<li class="delete-icon"><?=system_showText(LANG_SITEMGR_DELETE)?> <?=ucwords(system_showText(LANG_SITEMGR_CATEGORY))?></li>
	</ul>

	<table border="0" cellpadding="2" cellspacing="2" class="standard-tableTOPBLUE">

		<tr>
			<th><?=ucwords(system_showText(LANG_SITEMGR_CATEGORY))?> <?=ucwords(system_showText(LANG_SITEMGR_TITLE))?></th>
			<? if ($path_count < 2) { ?>
				<th style="width: 100px;"><?=system_showText(LANG_SITEMGR_SUBCATEGORIES)?></th>
			<? } ?>
			<th style="width: 100px;">&nbsp;</th>
		</tr>

		<?
		foreach ($categories as $category) {
			$id = $category->getNumber("id");
			$subcategories = db_getFromDB("eventcategory", "category_id", $id, "all", "title");
			?>

			<tr>
				<td>
					<? if ($path_count < 2) { ?>
						<a href="<?=$url_redirect?>/index.php?category_id=<?=$id?>" class="link-table"><?=$category->getString("title");?></a>
					<? } else { ?>
						<?=$category->getString("title");?>
					<? } ?>
				</td>
				<? if ($path_count < 2) { ?>
					<td><?=count($subcategories);?></td>
				<? } ?>
				<td nowrap="nowrap">

					<? if ($path_count < 2) { ?>
						<a href="<?=$url_redirect?>/category.php?category_id=<?=$id?>" class="link-table">
							<img src="<?=DEFAULT_URL?>/images/bt_add.gif" border="0" alt="<?=system_showText(LANG_SITEMGR_CATEGORY_CLICK_TOADDSUBCATEGORY)?>" title="<?=system_showText(LANG_SITEMGR_CATEGORY_CLICK_TOADDSUBCATEGORY)?>" />
						</a>
					<? } else { ?>
						<img src="<?=DEFAULT_URL?>/images/bt_add_off.gif" border="0" alt="<?=system_showText(LANG_SITEMGR_CATEGORY_CLICK_TOADDSUBCATEGORY)?>" title="<?=system_showText(LANG_SITEMGR_CATEGORY_CLICK_TOADDSUBCATEGORY)?>" />
					<? } ?>

					<? if ($path_count < 2) { ?>
						<a href="<?=$url_redirect?>/index.php?category_id=<?=$id?>" class="link-table">
							<img src="<?=DEFAULT_URL?>/images/bt_view.gif" border="0" alt="<?=system_showText(LANG_SITEMGR_CATEGORY_CLICK_TOVIEW)?>" title="<?=system_showText(LANG_SITEMGR_CATEGORY_CLICK_TOVIEW)?>" />
						</a>
					<? } else { ?>
						<img src="<?=DEFAULT_URL?>/images/bt_view_off.gif" border="0" alt="<?=system_showText(LANG_SITEMGR_CATEGORY_CLICK_TOVIEW)?>" title="<?=system_showText(LANG_SITEMGR_CATEGORY_CLICK_TOVIEW)?>" />
					<? } ?>

					<a href="<?=$url_redirect?>/category.php?id=<?=$id?>&category_id=<?=$category_id?>&screen=<?=$screen?>&letra=<?=$letra?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
						<img src="<?=DEFAULT_URL?>/images/bt_edit.gif" border="0" alt="<?=system_showText(LANG_SITEMGR_CATEGORY_CLICK_TOEDIT)?>" title="<?=system_showText(LANG_SITEMGR_CATEGORY_CLICK_TOEDIT)?>" />
					</a>

					<a href="<?=$url_redirect?>/category.php?id=<?=$id?>&category_id=<?=$category_id?>&screen=<?=$screen?>&letra=<?=$letra?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
						<img src="<?=DEFAULT_URL?>/images/icon_seof.gif" border="0" alt="<?=system_showText(LANG_SITEMGR_SEOCENTER_SEOFEATURE)?>" title="<?=system_showText(LANG_SITEMGR_SEOCENTER_SEOFEATURE)?>" />
					</a>

					<a href="<?=$url_redirect?>/delete.php?id=<?=$id?>&category_id=<?=$category_id?>&screen=<?=$screen?>&letra=<?=$letra?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
						<img src="<?=DEFAULT_URL?>/images/bt_delete.gif" border="0" alt="<?=system_showText(LANG_SITEMGR_CATEGORY_CLICK_TODELETE)?>" title="<?=system_showText(LANG_SITEMGR_CATEGORY_CLICK_TODELETE)?>" />
					</a>

				</td>
			</tr>

			<?
			}
		?>

	</table>

<? } else { ?>
	<div class="response-msg inf ui-corner-all"><?=system_showText(LANG_SITEMGR_EVENT_CATEGORY_NORECORD)?></div>
<? } ?>
