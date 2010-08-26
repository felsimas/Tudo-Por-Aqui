<?

	$delimiter = (eregi("\?",$paging_url)) ? "&amp;" : "?";

?>

	<? if($pageObj->getString("pages") > 1) { ?>

		<? $letra = ($_GET["letra"]) ? $_GET["letra"] : $_POST["letra"]; ?>

		<table border="0" cellpadding="0" cellspacing="0" align="center" class="pagingContent">
			<tr>
				<td><?=(intval($pageObj->getString("record_amount")) <= 1 ? system_showText(LANG_PAGING_FOUND) : system_showText(LANG_PAGING_FOUND_PLURAL))?> <strong><?=$pageObj->getString("record_amount")?></strong> <?=(intval($pageObj->getString("record_amount")) <= 1 ? system_showText(LANG_PAGING_RECORD) : system_showText(LANG_PAGING_RECORD_PLURAL))?> |</td>
				<td><?=system_showText(LANG_PAGING_SHOWINGPAGE)?> <strong><?=$pageObj->getString("screen")?></strong> <?=system_showText(LANG_PAGING_PAGEOF)?> <strong><?=$pageObj->getString("pages")?></strong> <?=(intval($pageObj->getString("record_amount")) <= 1 ? system_showText(LANG_PAGING_PAGEOF) : system_showText(LANG_PAGING_PAGE_PLURAL))?></td>
			</tr>
			<tr>
				<td colspan="2">

					<table cellpadding="2" cellspacing="2" border="0" align="center">
						<tr>
							<td align="center">
								<? if ($screen > 1) { ?>
								<a class="leftArrow" href="<?=$paging_url?><?=$delimiter?>letra=<?=$letra?>&amp;screen=<?=$pageObj->getString("back_screen")?><?=(($url_search_params) ? "&amp;$url_search_params" : "")?>" title="<?=system_showText(LANG_PAGING_PREVIOUSPAGE)?>"><span><?=system_showText(LANG_PAGING_PREVIOUSPAGE)?></span></a>
								<? } ?>
							</td>
							<td align="left"><?=$pagesDropDown?></td>
							<td align="center">
								<? if (($pageObj->getString("pages")) > $screen) { ?>
									<a class="rightArrow" href="<?=$paging_url?><?=$delimiter?>letra=<?=$letra?>&amp;screen=<?=$pageObj->getString("next_screen")?><?=(($url_search_params) ? "&amp;$url_search_params" : "")?>" title="<?=system_showText(LANG_PAGING_NEXTPAGE)?>"><span><?=system_showText(LANG_PAGING_NEXTPAGE)?></span></a>
								<? } ?>
							</td>
						</tr>
					</table>

				</td>
			</tr>
		</table>

	<? } else { ?>

		<table  border="0" cellpadding="0" cellspacing="0" align="center" class="pagingContent">
			<tr>
				<td><?=(intval($pageObj->getString("record_amount")) != 1 ? system_showText(LANG_PAGING_FOUND_PLURAL) : system_showText(LANG_PAGING_FOUND))?> <b><?=$pageObj->getString("record_amount")?></b> <?=(($pageObj->getString("record_amount")!=1)?(system_showText(LANG_PAGING_RECORD_PLURAL)):(system_showText(LANG_PAGING_RECORD)))?></td>
			</tr>
		</table>

	<? } ?>

	<? if ($letras_menu) { ?>

		<table border="0" cellpadding="0" cellspacing="0" align="center" class="pagingContent" style="margin-bottom: 10px;">
			<tr>
				<td class="paging-letras"><?=$letras_menu?></td>
			</tr>
		</table>

	<? } ?>
