<?
	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/tables/table_listingcategory.php
	# ----------------------------------------------------------------------------------------------------

?>

<? if ($message) { ?>
	<div class="response-msg success ui-corner-all"><?=$message?></div>
<? } ?>

<table border="0" cellpadding="2" cellspacing="2" class="standard-tableTOPBLUE">
	<tr>
		<td colspan="3">
			<a href="<?=$url_redirect?>/index.php"><?=system_showText(LANG_SITEMGR_MENU_HOME)?></a>
			<?
			$path_count = 1;
			if ($category_id) {
				$categoryObj = new ListingCategory($category_id);
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

<? if ($categories) { ?>

	<ul class="standard-iconDESCRIPTION">
		<li class="add-icon"><?=system_showText(LANG_SITEMGR_CATEGORY_ADDSUBCATEGORY)?></li>
		<li class="view-icon"><?=ucwords(system_showText(LANG_SITEMGR_VIEW))?> <?=ucwords(system_showText(LANG_SITEMGR_CATEGORY))?></li>
		<li class="edit-icon"><?=ucwords(system_showText(LANG_SITEMGR_EDIT))?> <?=ucwords(system_showText(LANG_SITEMGR_CATEGORY))?></li>
		<li class="delete-icon"><?=ucwords(system_showText(LANG_SITEMGR_DELETE))?> <?=ucwords(system_showText(LANG_SITEMGR_CATEGORY))?></li>
	</ul>
<div class="hastable">
	<table border="0" cellpadding="2" cellspacing="2">
		<thead>
		<tr>
			<th><?=ucwords(system_showText(LANG_SITEMGR_CATEGORY))?> <?=ucwords(system_showText(LANG_SITEMGR_TITLE))?></th>
			<? if ($path_count < LISTING_CATEGORY_LEVEL_AMOUNT) { ?>
				<th style="width: 100px;"><?=ucwords(system_showText(LANG_SITEMGR_SUBCATEGORIES))?></th>
			<? } ?>
			<th style="width: 100px;">&nbsp;</th>
		</tr>
		</thead>
		<?
		foreach ($categories as $category) {
			$id = $category->getNumber("id");
			$subcategories = db_getFromDB("listingcategory", "category_id", $id, "all", "title");
			?>

			<tr>
				<td>
					<? if ($path_count < LISTING_CATEGORY_LEVEL_AMOUNT) { ?>
						<a class="tooltip" href="<?=$url_redirect?>/index.php?category_id=<?=$id?>" class="link-table"><?=$category->getString("title");?></a>
					<? } else { ?>
						<?=$category->getString("title");?>
					<? } ?>
				</td>
				<? if ($path_count < LISTING_CATEGORY_LEVEL_AMOUNT) { ?>
					<td><?=count($subcategories);?></td>
				<? } ?>
				<td nowrap="nowrap">

					<? if ($path_count < LISTING_CATEGORY_LEVEL_AMOUNT) { ?>
						<a class="tooltip" href="<?=$url_redirect?>/category.php?category_id=<?=$id?>" title="<?=system_showText(LANG_SITEMGR_CATEGORY_CLICK_TOADDSUBCATEGORY)?>">
							<img src="<?=DEFAULT_URL?>/images/bt_add.gif" border="0" alt="<?=system_showText(LANG_SITEMGR_CATEGORY_CLICK_TOADDSUBCATEGORY)?>"  />
						</a>
					<? } else { ?>
						<a class="tooltip" href="#" title="<?=system_showText(LANG_SITEMGR_CATEGORY_CLICK_TOADDSUBCATEGORY)?>">
						<img src="<?=DEFAULT_URL?>/images/bt_add_off.gif" border="0" alt="<?=system_showText(LANG_SITEMGR_CATEGORY_CLICK_TOADDSUBCATEGORY)?>"  />
						</a>
					<? } ?>

					<? if ($path_count < LISTING_CATEGORY_LEVEL_AMOUNT) { ?>
						<a class="tooltip" title="<?=system_showText(LANG_SITEMGR_CATEGORY_CLICK_TOVIEW)?>"  href="<?=$url_redirect?>/visualizar/<?=$id?>">
							<img src="<?=DEFAULT_URL?>/images/bt_view.gif" border="0" alt="<?=system_showText(LANG_SITEMGR_CATEGORY_CLICK_TOVIEW)?>"/>
						</a>
					<? } else { ?>
						<a class="tooltip" href="#" title="<?=system_showText(LANG_SITEMGR_CATEGORY_CLICK_TOVIEW)?>">
						<img src="<?=DEFAULT_URL?>/images/bt_view_off.gif" border="0" alt="<?=system_showText(LANG_SITEMGR_CATEGORY_CLICK_TOVIEW)?>"  />
						</a>
					<? } ?>

					<a class="tooltip"  title="<?=system_showText(LANG_SITEMGR_CATEGORY_CLICK_TOEDIT)?>"  href="<?=$url_redirect?>/editar/<?=$id?>">
						<img src="<?=DEFAULT_URL?>/images/bt_edit.gif" border="0" alt="<?=system_showText(LANG_SITEMGR_CATEGORY_CLICK_TOEDIT)?>"/>
					</a>



					<a class="tooltip"  title="<?=system_showText(LANG_SITEMGR_CATEGORY_CLICK_TODELETE)?>" href="<?=$url_redirect?>/apagar/<?=$id?>/<?=$category_id?>">
						<img src="<?=DEFAULT_URL?>/images/bt_delete.gif" border="0" alt="<?=system_showText(LANG_SITEMGR_CATEGORY_CLICK_TODELETE)?>" />
					</a>

				</td>
			</tr>

			<?
			}
		?>

	</table>

<? } else { ?>
	<div class="response-msg inf ui-corner-all"><?=system_showText(LANG_SITEMGR_LISTING_CATEGORY_NORECORD)?></div>
<? } ?>
